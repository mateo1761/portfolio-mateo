# syntax=docker/dockerfile:1.7

FROM dunglas/frankenphp:1-php8.5-bookworm AS php-base

RUN install-php-extensions \
    intl \
    opcache \
    pdo_pgsql

WORKDIR /app

FROM php-base AS php-dependencies

RUN apt-get update \
    && apt-get install --no-install-recommends --yes unzip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --prefer-dist

COPY . .

RUN composer dump-autoload \
    --classmap-authoritative \
    --no-dev \
    --no-interaction \
    && php artisan package:discover --ansi \
    && php artisan wayfinder:generate --with-form --no-interaction

FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
COPY --from=php-dependencies /app/resources/js/actions ./resources/js/actions
COPY --from=php-dependencies /app/resources/js/routes ./resources/js/routes
COPY --from=php-dependencies /app/resources/js/wayfinder ./resources/js/wayfinder

ENV WAYFINDER_SKIP_GENERATION=1

RUN npm run build \
    && find public/build -type f -name '*.map' -delete

FROM php-base AS runtime

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    LOG_LEVEL=warning \
    QUEUE_CONNECTION=sync \
    SERVER_NAME=:8080

COPY --chown=www-data:www-data . .
COPY --from=php-dependencies --chown=www-data:www-data /app/vendor ./vendor
COPY --from=frontend --chown=www-data:www-data /app/public/build ./public/build
COPY docker/production/Caddyfile /etc/caddy/Caddyfile
COPY docker/production/php.ini /usr/local/etc/php/conf.d/zz-production.ini

RUN rm -rf \
        .github \
        .agents \
        .env.example \
        .env.production.example \
        docker \
        docs \
        eslint.config.js \
        node_modules \
        package.json \
        package-lock.json \
        phpstan.neon \
        phpunit.xml \
        prettier.config.js \
        tests \
        tsconfig.json \
        vite.config.ts \
        public/hot \
        public/fonts-manifest.dev.json \
    && mkdir -p \
        storage/app/private \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        /config/caddy \
        /data/caddy \
    && php artisan package:discover --ansi \
    && php artisan event:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chown -R www-data:www-data storage bootstrap/cache /config /data \
    && setcap -r /usr/local/bin/frankenphp

USER www-data

EXPOSE 8080

ENTRYPOINT ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
