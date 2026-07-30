# Portafolio Mateo

Portafolio profesional de **Mateo Quintero Zapata**, full-stack developer enfocado en construir aplicaciones web mantenibles, seguras y centradas en las personas usuarias.

## Tecnología

- Laravel 13 y PHP 8.5
- Vue 3, TypeScript, Inertia.js 3 y Tailwind CSS 4
- Laravel Fortify con autenticación TOTP
- PostgreSQL 16 y Mailpit
- Docker Compose, Laravel Sail y Nginx
- Pest, Pint, PHPStan/Larastan, ESLint, Prettier y Vue TSC
- Laravel Boost y Codex para asistencia de desarrollo

## Entorno local oficial

Docker Compose con Laravel Sail administra cuatro servicios:

| Servicio | Función |
| --- | --- |
| `nginx` | Proxy inverso y terminación HTTPS local |
| `laravel.test` | Laravel, PHP, Composer, Artisan, npm y Vite |
| `postgres` | Base de datos PostgreSQL persistente |
| `mailpit` | Captura local de correo SMTP |

Cada desarrollador genera sus propios certificados de confianza con mkcert. Los certificados y secretos locales nunca se guardan en Git.

Consulta:

- [Guía completa de desarrollo local](docs/local-development.md)
- [Solución de problemas](docs/troubleshooting.md)

## Inicio rápido

Después de completar la preparación y los certificados descritos en la guía:

```bash
./vendor/bin/sail up -d --build
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
./vendor/bin/sail npm run dev
```

La aplicación abre en `https://portfolio-mateo.test`. El acceso `http://localhost:8080` se conserva únicamente para diagnóstico directo de Laravel.

## Calidad

```bash
./vendor/bin/sail artisan test --compact
./vendor/bin/sail composer lint:check
./vendor/bin/sail npm run lint:check
./vendor/bin/sail npm run format:check
./vendor/bin/sail composer types:check
./vendor/bin/sail npm run types:check
./vendor/bin/sail npm run build
```

GitHub Actions ejecuta las comprobaciones con SQLite en memoria y no depende de Docker ni PostgreSQL.

## Estado

El proyecto incluye autenticación de administrador, recuperación y confirmación de contraseña, gestión de perfil y segundo factor TOTP. El contenido público definitivo del portafolio y el flujo de contacto continúan en desarrollo.

## Autor

**Mateo Quintero Zapata — Full-Stack Developer**

- [LinkedIn](https://www.linkedin.com/in/mateo-quintero-zapata-114235204/)
- [Correo público](mailto:mateoquinterozapata@gmail.com)

## Licencia

El repositorio aún no incluye un archivo `LICENSE`. Aunque `composer.json` declara MIT, debe añadirse el texto de licencia antes de presentar el proyecto como formalmente licenciado.
