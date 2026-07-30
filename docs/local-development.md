# Desarrollo local

Esta guía describe el entorno oficial de Portfolio Mateo. La aplicación completa se ejecuta con Docker Compose y Laravel Sail dentro de WSL2.

## Requisitos

- Windows 10 u 11 con WSL2 y Ubuntu.
- Docker Desktop con integración WSL2 habilitada.
- Git instalado dentro de WSL2.
- PowerShell con permisos de administrador para configurar hosts y mkcert.
- Codex instalado o conectado al repositorio cuando se utilice asistencia.
- Aproximadamente 3 GB de RAM y 2 CPU disponibles para WSL2.

PHP, Composer, Node.js y npm no necesitan instalarse directamente en WSL: se ejecutan dentro de Sail.

## Git y clonación

Configura tu identidad Git y una llave SSH propia. No compartas llaves privadas:

```bash
git config --global user.name "Your Name"
git config --global user.email "you@example.com"
ssh-keygen -t ed25519 -C "you@example.com"
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/id_ed25519
```

Añade únicamente `~/.ssh/id_ed25519.pub` a GitHub y comprueba la conexión:

```bash
ssh -T git@github.com
git clone git@github.com:mateo1761/portfolio-mateo.git
cd portfolio-mateo
```

Nunca copies ni confirmes la llave privada, tokens o archivos de autenticación.

## Dependencias iniciales

Antes de disponer de Sail, instala Composer con su imagen auxiliar:

```bash
docker run --rm \
    --user "$(id -u):$(id -g)" \
    --volume "$(pwd):/var/www/html" \
    --workdir /var/www/html \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
```

Crea el entorno local:

```bash
cp .env.example .env
```

No inicies Nginx hasta completar los certificados de la sección HTTPS.

## Variables locales y secretos

Edita `.env` sólo en tu equipo y configura valores exclusivos:

```dotenv
ADMIN_NAME="<administrator name>"
ADMIN_EMAIL="<administrator email>"
ADMIN_PASSWORD="<long unique password>"
DB_USERNAME="<local database user>"
DB_PASSWORD="<long local database password>"
```

Mantén estas opciones para Docker:

```dotenv
APP_URL=https://portfolio-mateo.test
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
MAIL_HOST=mailpit
MAIL_PORT=1025
SESSION_SECURE_COOKIE=true
VITE_HMR_HOST=portfolio-mateo.test
```

No reutilices credenciales de producción. `.env` está ignorado y nunca debe añadirse a Git.

## HTTPS local con mkcert

mkcert crea una autoridad local y certificados confiables para desarrollo. Cada desarrollador debe generar los suyos. No uses certificados compartidos, OpenSSL autofirmado ni Let’s Encrypt para este dominio local.

### Windows

Instala mkcert desde uno de los métodos publicados por el proyecto, por ejemplo Chocolatey:

```powershell
choco install mkcert
mkcert -install
```

Añade como administrador esta línea a `C:\Windows\System32\drivers\etc\hosts`:

```text
127.0.0.1 portfolio-mateo.test
```

Genera el certificado en una carpeta temporal:

```powershell
$CertificateOutput = Join-Path $env:USERPROFILE 'portfolio-mateo-certs'
New-Item -ItemType Directory -Force $CertificateOutput
Set-Location $CertificateOutput

mkcert `
  -cert-file portfolio-mateo.test.pem `
  -key-file portfolio-mateo.test-key.pem `
  portfolio-mateo.test localhost 127.0.0.1 ::1
```

`rootCA-key.pem` otorga control total sobre la confianza local: nunca lo copies, compartas o confirmes en Git.

### Copia a WSL

Desde la raíz del repositorio en WSL:

```bash
WINDOWS_PROFILE="$(wslpath "$(cmd.exe /c echo %USERPROFILE% | tr -d '\r')")"

install -m 0644 \
    "$WINDOWS_PROFILE/portfolio-mateo-certs/portfolio-mateo.test.pem" \
    docker/nginx/certs/portfolio-mateo.test.pem

install -m 0600 \
    "$WINDOWS_PROFILE/portfolio-mateo-certs/portfolio-mateo.test-key.pem" \
    docker/nginx/certs/portfolio-mateo.test-key.pem

test -f docker/nginx/certs/portfolio-mateo.test.pem
test -f docker/nginx/certs/portfolio-mateo.test-key.pem
git status --short
```

Sólo esos dos archivos de servidor deben copiarse. `docker/nginx/certs` ignora certificados, llaves, autoridades raíz y archivos PKCS#12.

## Servicios y comandos Sail

En una instalación nueva, después de copiar los certificados, inicia primero Laravel y sus dependencias, genera `APP_KEY` y después inicia Nginx:

```bash
./vendor/bin/sail up -d --build postgres mailpit laravel.test
./vendor/bin/sail artisan key:generate
./vendor/bin/sail up -d nginx
```

En los siguientes arranques inicia el entorno completo:

```bash
./vendor/bin/sail up -d
```

Detén los servicios sin eliminar datos:

```bash
./vendor/bin/sail stop
```

No ejecutes `docker compose down -v` ni elimines volúmenes.

PHP, Composer, npm y Artisan se ejecutan mediante Sail:

```bash
./vendor/bin/sail php --version
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail artisan about
./vendor/bin/sail artisan migrate:status
```

Aplica únicamente migraciones pendientes y crea el administrador de forma idempotente:

```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
```

No uses `migrate:fresh`, `db:wipe` ni comandos destructivos.

## PostgreSQL

Laravel se conecta a `postgres:5432`. El puerto publicado es `5432` por defecto; este equipo lo sobrescribe con `FORWARD_DB_PORT=5434`.

Los datos oficiales persisten en el volumen Compose `portfolio-mateo_sail-pgsql`. Detener o recrear un contenedor no elimina ese volumen.

```bash
./vendor/bin/sail artisan migrate:status
docker compose ps postgres
```

## Mailpit

Laravel entrega correo a `mailpit:1025`. La interfaz está disponible en `http://localhost:8025`.

```bash
docker compose ps mailpit
```

Mailpit sólo captura correo de desarrollo; no es un proveedor SMTP de producción.

## Nginx y URLs

Nginx recibe HTTP en `80`, conserva `/nginx-health` y redirige las solicitudes normales a HTTPS. TLS termina en `443` y el tráfico interno continúa hacia `laravel.test:80`.

| Servicio | URL o puerto |
| --- | --- |
| Aplicación principal | `https://portfolio-mateo.test` |
| Laravel directo, diagnóstico | `http://localhost:8080` |
| Vite/HMR | `https://portfolio-mateo.test:5173` |
| PostgreSQL portable | `localhost:5432` |
| PostgreSQL en este equipo | `localhost:5434` |
| Mailpit SMTP | `localhost:1025` |
| Mailpit dashboard | `http://localhost:8025` |

El acceso directo `8080` evita Nginx y no representa la URL normal de desarrollo.

## Vite y HMR

Inicia Vite dentro de Sail:

```bash
./vendor/bin/sail npm run dev
```

Cuando existen los certificados esperados, Vite sirve HTTPS y HMR utiliza WebSocket seguro. El certificado incluye `portfolio-mateo.test`, `localhost`, `127.0.0.1` y `::1`.

## Laravel Boost y Codex

El repositorio incluye `boost.json`, `AGENTS.md` y las dependencias Boost/MCP. Codex debe abrirse desde la raíz para detectar las instrucciones del proyecto.

El servidor MCP se inicia normalmente mediante la configuración del cliente. Para comprobarlo manualmente dentro de Sail:

```bash
./vendor/bin/sail artisan boost:mcp
```

Boost proporciona información de la aplicación, documentación específica de versión, consultas de sólo lectura y diagnóstico. No debe utilizarse para exponer secretos o ejecutar operaciones destructivas.

## Calidad

Ejecuta las comprobaciones una por una:

```bash
./vendor/bin/sail artisan test --compact
./vendor/bin/sail composer lint:check
./vendor/bin/sail npm run lint:check
./vendor/bin/sail npm run format:check
./vendor/bin/sail composer types:check
./vendor/bin/sail npm run types:check
./vendor/bin/sail npm run build
```

GitHub Actions usa SQLite `:memory:` y no requiere Docker, PostgreSQL ni certificados locales.

## Otro equipo

1. Instala Windows/WSL2, Docker Desktop y Git.
2. Configura una llave SSH propia y clona el repositorio.
3. Instala las dependencias Composer iniciales.
4. Copia `.env.example` a `.env` y asigna credenciales locales nuevas.
5. Instala mkcert en Windows, registra su CA local y genera certificados nuevos.
6. Añade la entrada de hosts y copia sólo el certificado/llave del servidor.
7. Inicia primero PostgreSQL, Mailpit y Laravel; genera `APP_KEY` y después inicia Nginx.
8. Ejecuta migraciones y el seeder.
9. Instala dependencias npm e inicia Vite.

Nunca copies `.env`, certificados, llaves, volúmenes o datos desde otro desarrollador.

## Desarrollo y producción

Esta configuración es exclusiva de desarrollo:

- mkcert confía certificados sólo en la máquina local.
- Sail publica puertos de diagnóstico y herramientas como Mailpit.
- `APP_DEBUG=true` es apropiado únicamente en local.
- Los volúmenes Docker locales no son una estrategia de respaldo o producción.

Producción necesita una plataforma de despliegue, TLS público, secretos administrados, copias de seguridad, workers, observabilidad, restricciones de red y una base de datos gestionada. No reutilices `compose.yaml`, mkcert ni credenciales locales como configuración de producción.
