# Portafolio Mateo

![Laravel 13](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![PHP 8.5](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![Vue 3](https://img.shields.io/badge/Vue-3-4FC08D?logo=vuedotjs&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-5-3178C6?logo=typescript&logoColor=white)
![Pest 4](https://img.shields.io/badge/Pest-4-F59E0B)
![Licencia MIT](https://img.shields.io/badge/Licencia-MIT-green)

Portafolio profesional de Mateo Quintero Zapata, Full Stack Developer. La aplicación combina un backend moderno en Laravel con una interfaz SPA desarrollada en Vue e Inertia.js, e incorpora un acceso administrativo seguro para gestionar el contenido del portafolio.

## Estado del proyecto

En desarrollo activo. La base técnica, el acceso del administrador y las funciones de seguridad están implementados; el contenido y las funcionalidades del portafolio continúan evolucionando.

## Tecnologías principales

- Laravel 13 y PHP 8.5.
- Vue 3, TypeScript e Inertia.js 3.
- Tailwind CSS 4.
- MySQL como base de datos del entorno Docker.
- Docker y Laravel Sail para el entorno local.
- Mailpit para inspeccionar correo localmente.
- Pest 4 para pruebas automatizadas.
- Laravel Boost y Codex como herramientas de apoyo al desarrollo.

> El repositorio incluye Laravel Sail como dependencia. La instalación local descrita abajo genera la configuración de Docker Compose con MySQL y Mailpit.

## Requisitos

- Windows con WSL2 habilitado.
- Una distribución Linux instalada en WSL2.
- Docker Desktop con la integración de WSL2 habilitada.
- Git, PHP 8.5 y Composer disponibles dentro de WSL2 para preparar Sail.

## Instalación local con WSL2 y Laravel Sail

Ejecuta los comandos desde una terminal WSL2, dentro del directorio del proyecto:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan sail:install --with=mysql,mailpit --php=8.5 --no-interaction
./vendor/bin/sail up -d
./vendor/bin/sail npm install
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
```

Laravel Sail crea los servicios locales de MySQL y Mailpit. Para detener los contenedores:

```bash
./vendor/bin/sail down
```

## Configuración del entorno

Usa `.env.example` como plantilla y conserva `.env` únicamente en tu entorno local:

```bash
cp .env.example .env
```

Después de instalar Sail, revisa las variables `APP_*`, `DB_*` y `MAIL_*` generadas para los servicios locales. Configura también las variables del único administrador con valores propios y seguros:

```dotenv
ADMIN_NAME="Nombre del administrador"
ADMIN_EMAIL="correo del administrador"
ADMIN_PASSWORD="contraseña larga, única y segura"
```

No confirmes `.env` en Git ni reutilices credenciales de producción en el entorno local.

## Comandos de desarrollo

Todos los comandos siguientes se ejecutan desde WSL2 con los contenedores de Sail activos.

### Base de datos

Ejecutar migraciones:

```bash
./vendor/bin/sail artisan migrate
```

Crear el administrador configurado en `.env` mediante el seeder idempotente:

```bash
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
```

### Frontend

Iniciar Vite en modo desarrollo:

```bash
./vendor/bin/sail npm run dev
```

Generar los recursos optimizados para producción:

```bash
./vendor/bin/sail npm run build
```

### Pruebas y análisis

Ejecutar las comprobaciones del backend y la suite de Pest:

```bash
./vendor/bin/sail composer test
```

Ejecutar todas las comprobaciones de integración continua:

```bash
./vendor/bin/sail composer ci:check
```

### Linting y formato

Comprobar el estilo de PHP y el frontend sin modificar archivos:

```bash
./vendor/bin/sail composer lint:check
./vendor/bin/sail npm run lint:check
./vendor/bin/sail npm run format:check
```

Aplicar el formato configurado para PHP y el frontend:

```bash
./vendor/bin/sail composer lint
./vendor/bin/sail npm run lint
./vendor/bin/sail npm run format
```

## Autenticación

La autenticación está implementada con Laravel Fortify y está orientada a un único administrador:

- El administrador se crea mediante `DatabaseSeeder` usando las variables `ADMIN_NAME`, `ADMIN_EMAIL` y `ADMIN_PASSWORD`.
- No existe registro público ni verificación pública de correo.
- Incluye inicio y cierre de sesión, recuperación de contraseña y confirmación de contraseña para operaciones sensibles.
- Admite autenticación de dos factores mediante TOTP, con código QR, confirmación y códigos de recuperación.
- El inicio de sesión y el desafío de segundo factor cuentan con limitación de intentos.

## Autor

**Mateo Quintero Zapata**, Full Stack Developer.

## Licencia

Este proyecto está configurado bajo la licencia MIT.
