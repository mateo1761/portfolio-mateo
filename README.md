# Portafolio Mateo

![Laravel 13](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![PHP 8.5](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![Vue 3](https://img.shields.io/badge/Vue-3-4FC08D?logo=vuedotjs&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-5-3178C6?logo=typescript&logoColor=white)
![Inertia.js 3](https://img.shields.io/badge/Inertia.js-3-9553E9?logo=inertia&logoColor=white)
![Tailwind CSS 4](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)
![PostgreSQL 16](https://img.shields.io/badge/PostgreSQL-16-4169E1?logo=postgresql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Sail_+_Nginx-2496ED?logo=docker&logoColor=white)

Portafolio profesional de **Mateo Quintero Zapata**, full-stack developer enfocado en construir productos web mantenibles, seguros y centrados en las personas usuarias.

Este proyecto presenta mi perfil, experiencia y trabajo, y al mismo tiempo funciona como una muestra práctica de cómo estructuro una aplicación moderna: arquitectura clara, autenticación reforzada, frontend tipado, entorno reproducible y calidad automatizada.

> Una base técnica sólida para convertir experiencia profesional en una presentación digital cuidada.

## Lo que demuestra el proyecto

- Integración full-stack con Laravel, Inertia y Vue sin mantener una API SPA separada.
- Autenticación de administrador con recuperación de contraseña, confirmación y segundo factor TOTP.
- Interfaz adaptable construida con TypeScript, Tailwind CSS y componentes accesibles.
- Experiencia pública bilingüe en español e inglés, con rutas y metadatos SEO específicos por idioma.
- Desarrollo local reproducible mediante Docker Compose, Laravel Sail y HTTPS confiable.
- Fotografía profesional procesada por Vite y hoja de vida pública descargable.
- Persistencia y pruebas de integración con PostgreSQL 16.
- Calidad continua con Pest, Pint, PHPStan/Larastan, ESLint, Prettier y Vue TSC.
- Cabeceras HTTP defensivas y CSP con nonce habilitadas automáticamente en producción.

## Funcionalidades

| Estado       | Funcionalidad                                                                        |
| ------------ | ------------------------------------------------------------------------------------ |
| Implementado | Inicio y cierre de sesión para un administrador único                                |
| Implementado | Recuperación, actualización y confirmación de contraseña                             |
| Implementado | Segundo factor TOTP, QR y códigos de recuperación                                    |
| Implementado | Perfil, apariencia y navegación con Inertia                                          |
| Implementado | Entorno Docker con Nginx, HTTPS, Vite, PostgreSQL y Mailpit                          |
| Implementado | Portada profesional con fotografía, proyectos y CV descargable                       |
| Implementado | Contenido público y SEO en español (`/`) e inglés (`/en`)                            |
| Implementado | Formulario de contacto bilingüe con validación, honeypot y limitación de solicitudes |
| Implementado | Consentimiento anonimizado, métricas diarias y política de retención                  |

## Arquitectura

| Capa                  | Tecnología                                               |
| --------------------- | -------------------------------------------------------- |
| Backend               | Laravel 13, PHP 8.5 y Laravel Fortify                    |
| Frontend              | Vue 3, TypeScript, Inertia.js 3 y Tailwind CSS 4         |
| Datos                 | PostgreSQL 16 en desarrollo, CI y producción             |
| Infraestructura local | Docker Compose, Laravel Sail, Nginx y mkcert             |
| Correo local          | Mailpit                                                  |
| Calidad               | Pest, Pint, PHPStan/Larastan, ESLint, Prettier y Vue TSC |
| Asistencia técnica    | Laravel Boost, MCP y Codex                               |

## Entorno local oficial

Docker Compose con Laravel Sail administra cinco servicios:

| Servicio       | Función                                                              |
| -------------- | -------------------------------------------------------------------- |
| `nginx`        | Proxy inverso y terminación HTTPS local                              |
| `laravel.test` | Laravel, PHP, Composer y Artisan                                     |
| `vite`         | Servidor de desarrollo frontend, HMR y generación de rutas Wayfinder |
| `postgres`     | Base de datos PostgreSQL persistente                                 |
| `mailpit`      | Captura local de correo SMTP                                         |

Cada desarrollador genera sus propios certificados de confianza con mkcert. Los certificados, credenciales y secretos locales nunca se guardan en Git.

El destinatario del formulario público se configura localmente mediante `CONTACT_MAIL_TO`; durante el desarrollo, los mensajes pueden verificarse en Mailpit.

El servicio `vite` inicia `npm run dev` automáticamente después de que Laravel está saludable. No inicies una segunda instancia de Vite manualmente.

### Documentación

- [Guía completa de desarrollo local](docs/local-development.md)
- [Solución de problemas](docs/troubleshooting.md)

## Inicio rápido

Después de completar la preparación y los certificados descritos en la guía, el orden normal de arranque es:

```bash
cd ~/code/portfolio-mateo
docker compose up -d
docker compose ps
codex
```

En la preparación inicial también deben ejecutarse las migraciones y el seeder:

```bash
./vendor/bin/sail up -d --build
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
```

La versión en español abre en `https://portfolio-mateo.test` y la versión en inglés en `https://portfolio-mateo.test/en`. El acceso `http://localhost:8080` se conserva únicamente para diagnóstico directo de Laravel.

La fotografía se procesa desde `resources/images/mateo-quintero.webp`. La hoja de vida estática se publica desde `public/documents/Hoja_de_vida_Mateo_Quintero_2026.pdf`.

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

GitHub Actions levanta PostgreSQL 16 y ejecuta análisis estático, formato, lint, comprobación de tipos, pruebas y auditorías de seguridad para Composer y npm. Dependabot revisa semanalmente Composer, npm y GitHub Actions.

## Producción

La aplicación está preparada para desplegarse en una plataforma Laravel administrada —Laravel Cloud es la opción recomendada— o en una infraestructura que proporcione PHP 8.5, PostgreSQL 16, HTTPS, un scheduler y procesos persistentes para colas. `compose.yaml`, Mailpit, mkcert y `portfolio-mateo.test` pertenecen exclusivamente al entorno local y no deben reutilizarse como infraestructura de producción.

Usa [.env.production.example](.env.production.example) como inventario de variables, pero almacena los valores reales en el gestor de secretos de la plataforma. Nunca confirmes `.env.production`, credenciales, certificados ni llaves. Antes del primer despliegue deben estar definidos, como mínimo:

- `APP_KEY`, `APP_URL`, `APP_DEBUG=false` y `APP_ENV=production`.
- Conexión PostgreSQL con TLS y una estrategia externa de backups verificados.
- SMTP transaccional real, remitente validado y destinatario de contacto.
- Credenciales iniciales del administrador y una clave independiente para anonimizar consentimientos.
- Cookies seguras, CSP y HSTS habilitados.
- Logs persistentes, monitoreo de `/up` y alertas de errores.

El despliegue debe instalar dependencias reproducibles, compilar los recursos y optimizar Laravel:

```bash
composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan optimize
php artisan queue:restart
```

La plataforma debe mantener activos un worker (`php artisan queue:work`) y el scheduler (`php artisan schedule:work` o una invocación por minuto a `schedule:run`). Después del primer `db:seed --class=DatabaseSeeder`, cambia la contraseña desde la aplicación y elimina `ADMIN_PASSWORD` del entorno si el proveedor permite separar secretos de inicialización.

Checklist previo a cada publicación:

```bash
composer audit --locked
npm audit
composer ci:check
npm run build
```

Las respuestas Laravel eliminan `X-Powered-By` e incluyen protección contra MIME sniffing, framing, filtración de referrer y permisos del navegador. En producción también incluyen HSTS y una Content Security Policy basada en nonce. El proxy o CDN debe conservar estas cabeceras y restringir el dominio configurado en `APP_URL`.

## Pendiente del lanzamiento

- Definir el dominio definitivo y completar las URL canónicas y Open Graph.
- Preparar una imagen social específica para Open Graph.
- Seleccionar la plataforma, configurar backups, correo, monitoreo, worker y scheduler.
- Añadir el texto formal de licencia.

## Autor

**Mateo Quintero Zapata — Full-Stack Developer**

- [LinkedIn](https://www.linkedin.com/in/mateo-quintero-zapata-114235204/)
- [Correo público](mailto:mateoquinterozapata@gmail.com)

## Licencia

El repositorio aún no incluye un archivo `LICENSE`. Aunque `composer.json` declara MIT, debe añadirse el texto de licencia antes de presentar el proyecto como formalmente licenciado.
