# Portafolio Mateo

![Laravel 13](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![PHP 8.5](https://img.shields.io/badge/PHP-8.5-777BB4?logo=php&logoColor=white)
![Vue 3](https://img.shields.io/badge/Vue-3-4FC08D?logo=vuedotjs&logoColor=white)
![TypeScript](https://img.shields.io/badge/TypeScript-5-3178C6?logo=typescript&logoColor=white)
![Inertia.js 3](https://img.shields.io/badge/Inertia.js-3-9553E9?logo=inertia&logoColor=white)
![Tailwind CSS 4](https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss&logoColor=white)

Portafolio profesional de **Mateo Quintero Zapata**, Full Stack Developer enfocado en crear aplicaciones web mantenibles, seguras y centradas en las personas usuarias.

## Sobre el desarrollador

Mateo Quintero Zapata es Full Stack Developer. Este proyecto refleja su enfoque para construir productos web con una arquitectura clara, una experiencia de usuario cuidada, controles de seguridad y procesos de calidad automatizados.

- **LinkedIn:** [Mateo Quintero Zapata](https://www.linkedin.com/in/mateo-quintero-zapata-114235204/)
- **Correo público:** [mateoquinterozapata@gmail.com](mailto:mateoquinterozapata@gmail.com)
- **Sitio del portafolio:** en proceso

## Sobre el proyecto

Portafolio Mateo tiene como propósito presentar el perfil, las capacidades técnicas y, progresivamente, los proyectos de Mateo a reclutadores, equipos técnicos y posibles colaboradores.

El repositorio también funciona como muestra de sus prácticas de ingeniería: separación entre backend y frontend, autenticación reforzada, rutas tipadas, pruebas automatizadas, análisis estático y formato consistente. El contenido público definitivo del portafolio todavía está en desarrollo.

## Funcionalidades principales

| Estado       | Funcionalidad              | Detalle                                                                                                                          |
| ------------ | -------------------------- | -------------------------------------------------------------------------------------------------------------------------------- |
| Implementado | Base adaptable             | La interfaz actual usa Vue y Tailwind CSS con comportamiento adaptable; el diseño definitivo del portafolio sigue en desarrollo. |
| Planificado  | Flujo de contacto          | No existe todavía formulario, endpoint ni persistencia de mensajes de contacto.                                                  |
| Implementado | Administrador único        | El administrador se crea de forma idempotente mediante el seeder y variables de entorno.                                         |
| Implementado | Recuperación de contraseña | Fortify gestiona la solicitud y el restablecimiento de contraseña.                                                               |
| Implementado | Confirmación de contraseña | Las operaciones sensibles requieren una confirmación reciente.                                                                   |
| Implementado | Segundo factor TOTP        | Incluye activación, confirmación, desafío, código QR y códigos de recuperación.                                                  |
| Implementado | Sin registro público       | Las rutas de registro y verificación pública de correo están deshabilitadas.                                                     |
| Implementado | Calidad automatizada       | Pest, PHPStan/Larastan, Pint, ESLint, Prettier y comprobación de tipos forman parte del flujo de validación.                     |

## Arquitectura técnica

| Tecnología                 | Función en el proyecto                                                                                         |
| -------------------------- | -------------------------------------------------------------------------------------------------------------- |
| Laravel 13 y PHP 8.5       | Backend, rutas, validación, sesiones, acceso a datos y lógica de aplicación.                                   |
| Laravel Fortify            | Autenticación sin interfaz acoplada, recuperación de contraseña, confirmación y TOTP.                          |
| Vue 3 y TypeScript         | Componentes de interfaz con tipado estático.                                                                   |
| Inertia.js 3               | Integración entre Laravel y Vue sin mantener una API SPA separada.                                             |
| Tailwind CSS 4 y Reka UI   | Estilos, diseño adaptable y componentes accesibles.                                                            |
| Vite                       | Servidor de desarrollo y compilación optimizada del frontend.                                                  |
| Laravel Wayfinder          | Generación de funciones TypeScript tipadas para rutas y controladores de Laravel.                              |
| SQLite                     | Base de datos aislada en memoria para las pruebas automatizadas.                                               |
| MySQL 8.4                  | Base de datos persistente del entorno local Sail.                                                              |
| Docker y Laravel Sail      | Entorno local reproducible con PHP 8.5, MySQL y Mailpit.                                                       |
| Mailpit                    | Captura y previsualización de correo durante el desarrollo local.                                              |
| Pest 4                     | Pruebas unitarias y de funcionalidad.                                                                          |
| PHPStan/Larastan y Pint    | Análisis estático y formato del backend.                                                                       |
| ESLint, Prettier y Vue TSC | Linting, formato y comprobación de tipos del frontend.                                                         |
| Laravel Boost y Codex      | Apoyo al desarrollo y acceso al contexto técnico del proyecto; no son dependencias de ejecución en producción. |

## Seguridad

- El sistema está diseñado para un solo administrador y no ofrece registro público.
- Las credenciales administrativas se leen desde <code>.env</code> y no se incluyen en el repositorio.
- Las contraseñas se almacenan mediante el sistema de hashing de Laravel.
- TOTP añade un segundo factor con confirmación y códigos de recuperación.
- La recuperación y la confirmación de contraseña usan los flujos de Laravel Fortify.
- El inicio de sesión y el desafío de segundo factor tienen limitación de intentos.
- <code>.env</code>, claves privadas, tokens y archivos de almacenamiento sensibles están excluidos de Git.

## Instalación local

### Requisitos

- Windows con WSL2 y una distribución Linux.
- Docker Desktop con integración para WSL2.
- Git disponible dentro de WSL2.
- Asignar a WSL2 un máximo aproximado de 3 GB de RAM y 2 CPU es suficiente para los tres servicios configurados.

### Preparación

Ejecuta estos comandos desde una terminal WSL2:

```bash
git clone https://github.com/mateo1761/portfolio-mateo.git
cd portfolio-mateo
docker run --rm \
    --user "$(id -u):$(id -g)" \
    --volume "$(pwd):/var/www/html" \
    --workdir /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
cp .env.example .env
```

El archivo <code>compose.yaml</code> ya está versionado y contiene únicamente la aplicación Laravel, MySQL y Mailpit. No ejecutes <code>sail:install</code>: no es necesario y podría reemplazar esta configuración mínima.

Configura valores propios antes de ejecutar el seeder:

```dotenv
ADMIN_NAME="<nombre del administrador>"
ADMIN_EMAIL="<correo del administrador>"
ADMIN_PASSWORD="<contraseña segura y exclusiva>"
```

No reutilices credenciales de producción ni confirmes <code>.env</code> en Git.

### Inicio

```bash
./vendor/bin/sail up -d --build
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm install
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
./vendor/bin/sail npm run dev
```

<code>migrate</code> ejecuta únicamente migraciones pendientes; no uses <code>migrate:fresh</code> ni elimines el volumen de MySQL. El seeder es idempotente, pero requiere que <code>ADMIN_NAME</code>, <code>ADMIN_EMAIL</code> y <code>ADMIN_PASSWORD</code> tengan valores locales válidos.

- Verifica Sail primero en <code>http://localhost:8080</code>.
- Vite escucha en <code>http://localhost:5173</code> y su HMR es accesible desde el navegador de Windows.
- MySQL se publica en <code>localhost:3306</code> y conserva los datos en el volumen nombrado <code>sail-mysql</code>.
- Mailpit recibe SMTP en <code>localhost:1025</code> y su interfaz abre en <code>http://localhost:8025</code>.
- <code>APP_URL=http://portfolio-mateo.test</code> prepara la generación de URLs para el dominio local planeado. La configuración de Nginx y de los puertos 80/443 se realizará por separado.

Si cambias esos puertos en <code>.env</code>, utiliza los valores configurados localmente.

## Comandos de desarrollo

Los comandos se ejecutan desde la raíz del proyecto con Sail activo.

| Tarea                               | Comando                                                               |
| ----------------------------------- | --------------------------------------------------------------------- |
| Iniciar y construir contenedores    | <code>./vendor/bin/sail up -d --build</code>                          |
| Iniciar contenedores ya construidos | <code>./vendor/bin/sail up -d</code>                                  |
| Detener contenedores                | <code>./vendor/bin/sail stop</code>                                   |
| Instalar dependencias PHP           | <code>./vendor/bin/sail composer install</code>                       |
| Instalar dependencias JavaScript    | <code>./vendor/bin/sail npm install</code>                            |
| Consultar migraciones               | <code>./vendor/bin/sail artisan migrate:status</code>                 |
| Ejecutar migraciones pendientes     | <code>./vendor/bin/sail artisan migrate</code>                        |
| Crear el administrador              | <code>./vendor/bin/sail artisan db:seed --class=DatabaseSeeder</code> |
| Iniciar Vite                        | <code>./vendor/bin/sail npm run dev</code>                            |
| Ejecutar pruebas                    | <code>./vendor/bin/sail artisan test --compact</code>                 |
| Comprobar PHP con PHPStan           | <code>./vendor/bin/sail composer types:check</code>                   |
| Comprobar formato PHP               | <code>./vendor/bin/sail composer lint:check</code>                    |
| Aplicar formato PHP                 | <code>./vendor/bin/sail composer lint</code>                          |
| Comprobar ESLint                    | <code>./vendor/bin/sail npm run lint:check</code>                     |
| Aplicar correcciones ESLint         | <code>./vendor/bin/sail npm run lint</code>                           |
| Comprobar Prettier                  | <code>./vendor/bin/sail npm run format:check</code>                   |
| Aplicar Prettier                    | <code>./vendor/bin/sail npm run format</code>                         |
| Comprobar tipos del frontend        | <code>./vendor/bin/sail npm run types:check</code>                    |
| Generar build de producción         | <code>./vendor/bin/sail npm run build</code>                          |
| Ver estado                          | <code>./vendor/bin/sail ps</code>                                     |
| Ver y seguir logs                   | <code>./vendor/bin/sail logs -f</code>                                |
| Abrir Mailpit                       | <code>http://localhost:8025</code>                                    |

Ejecuta pruebas, lint, formato, comprobaciones de tipos y build uno por uno para reducir el consumo de memoria en WSL2.

## Estado del proyecto y hoja de ruta

### Implementado

- Base Laravel, Vue, TypeScript e Inertia con diseño adaptable.
- Inicio y cierre de sesión para el administrador.
- Recuperación, actualización y confirmación de contraseña.
- Autenticación TOTP y códigos de recuperación.
- Gestión básica del perfil y preferencias de apariencia.
- Pruebas automatizadas y herramientas de calidad.

### Pendiente

- Sustituir la pantalla inicial del starter kit por la experiencia visual definitiva del portafolio.
- Incorporar las secciones públicas de perfil, habilidades y proyectos.
- Diseñar e implementar el flujo de contacto.
- Confirmar y publicar los enlaces de contacto profesionales.
- Definir y añadir formalmente la licencia del repositorio.

## Autor y contacto

**Mateo Quintero Zapata — Full Stack Developer**

- **LinkedIn:** [Mateo Quintero Zapata](https://www.linkedin.com/in/mateo-quintero-zapata-114235204/)
- **Correo público:** [mateoquinterozapata@gmail.com](mailto:mateoquinterozapata@gmail.com)
- **Portafolio:** en proceso

## Licencia

El repositorio no contiene actualmente un archivo <code>LICENSE</code>. Aunque <code>composer.json</code> declara <code>MIT</code> en sus metadatos, debe añadirse un texto de licencia explícito antes de presentar el proyecto como licenciado públicamente.
