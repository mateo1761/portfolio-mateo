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
- Desarrollo local reproducible mediante Docker Compose, Laravel Sail y HTTPS confiable.
- Persistencia con PostgreSQL y pruebas aisladas con SQLite en memoria.
- Calidad continua con Pest, Pint, PHPStan/Larastan, ESLint, Prettier y Vue TSC.

## Funcionalidades

| Estado | Funcionalidad |
| --- | --- |
| Implementado | Inicio y cierre de sesión para un administrador único |
| Implementado | Recuperación, actualización y confirmación de contraseña |
| Implementado | Segundo factor TOTP, QR y códigos de recuperación |
| Implementado | Perfil, apariencia y navegación con Inertia |
| Implementado | Entorno Docker con Nginx, HTTPS, PostgreSQL y Mailpit |
| Implementado | Portada profesional, proyectos y formulario de contacto |

## Arquitectura

| Capa | Tecnología |
| --- | --- |
| Backend | Laravel 13, PHP 8.5 y Laravel Fortify |
| Frontend | Vue 3, TypeScript, Inertia.js 3 y Tailwind CSS 4 |
| Datos | PostgreSQL 16 en desarrollo y SQLite en CI |
| Infraestructura local | Docker Compose, Laravel Sail, Nginx y mkcert |
| Correo local | Mailpit |
| Calidad | Pest, Pint, PHPStan/Larastan, ESLint, Prettier y Vue TSC |
| Asistencia técnica | Laravel Boost, MCP y Codex |

## Entorno local oficial

Docker Compose con Laravel Sail administra cuatro servicios:

| Servicio | Función |
| --- | --- |
| `nginx` | Proxy inverso y terminación HTTPS local |
| `laravel.test` | Laravel, PHP, Composer, Artisan, npm y Vite |
| `postgres` | Base de datos PostgreSQL persistente |
| `mailpit` | Captura local de correo SMTP |

Cada desarrollador genera sus propios certificados de confianza con mkcert. Los certificados, credenciales y secretos locales nunca se guardan en Git.

El destinatario del formulario público se configura localmente mediante `CONTACT_MAIL_TO`; durante el desarrollo, los mensajes pueden verificarse en Mailpit.

### Documentación

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

## Próximos pasos

- Incorporar una fotografía profesional.
- Publicar una versión descargable del CV.
- Añadir el texto formal de licencia.

## Autor

**Mateo Quintero Zapata — Full-Stack Developer**

- [LinkedIn](https://www.linkedin.com/in/mateo-quintero-zapata-114235204/)
- [Correo público](mailto:mateoquinterozapata@gmail.com)

## Licencia

El repositorio aún no incluye un archivo `LICENSE`. Aunque `composer.json` declara MIT, debe añadirse el texto de licencia antes de presentar el proyecto como formalmente licenciado.
