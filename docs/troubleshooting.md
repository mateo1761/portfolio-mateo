# Solución de problemas locales

Ejecuta los comandos desde la raíz del repositorio en WSL2. Evita operaciones que eliminen volúmenes o reinicien bases de datos.

## Recursos de WSL2

Síntomas habituales:

- Docker o Vite responden lentamente.
- Procesos terminan por falta de memoria.
- El build queda congelado.

Comprueba recursos:

```bash
free -h
docker stats
```

Ejecuta pruebas, análisis y build uno por uno. Si utilizas `%UserProfile%\.wslconfig`, asigna aproximadamente 3 GB de RAM y 2 CPU y reinicia WSL después del cambio.

## Reiniciar WSL2 y Docker Desktop

1. Detén el proyecto sin eliminar datos:

   ```bash
   ./vendor/bin/sail stop
   ```

2. Cierra las terminales WSL.
3. Ejecuta en PowerShell:

   ```powershell
   wsl --shutdown
   ```

4. Reinicia Docker Desktop y espera a que su integración WSL esté disponible.
5. Abre WSL, vuelve al repositorio e inicia:

   ```bash
   ./vendor/bin/sail up -d
   ```

No uses `docker compose down -v`.

## `/var/www/html` vacío o bind mount inválido

Después de reiniciar WSL/Docker, `laravel.test` puede aparecer activo pero no encontrar `artisan`.

```bash
docker compose exec laravel.test ls -la /var/www/html
docker compose logs --tail=100 laravel.test
```

Si el repositorio existe en WSL pero el directorio del contenedor está vacío, recrea únicamente Laravel:

```bash
docker compose up -d --force-recreate laravel.test
```

Esto no recrea PostgreSQL ni elimina volúmenes. Comprueba:

```bash
./vendor/bin/sail artisan --version
curl -I http://localhost:8080
```

## Conflictos de puertos

```bash
docker compose ps
ss -ltn
```

Puertos predeterminados: Nginx `80/443`, Laravel `8080`, Vite `5173`, PostgreSQL `5432` y Mailpit `1025/8025`.

Este equipo usa `FORWARD_DB_PORT=5434`. Cambia sólo la variable de reenvío en `.env`; Laravel debe seguir usando `DB_HOST=postgres` y `DB_PORT=5432`.

## PostgreSQL no saludable

```bash
docker compose ps postgres
docker compose logs --tail=100 postgres
docker compose exec postgres sh -lc \
    'pg_isready -U "$POSTGRES_USER" -d "$POSTGRES_DB"'
./vendor/bin/sail artisan migrate:status
```

No ejecutes `migrate:fresh`, `db:wipe`, `docker volume rm` ni `down -v`.

## Mailpit no recibe correo

Confirma en `.env` sin compartir credenciales:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
```

Después:

```bash
docker compose ps mailpit
docker compose logs --tail=100 mailpit
```

La interfaz debe responder en `http://localhost:8025`.

## Nginx o HTTPS

Comprueba que existan ambos archivos sin mostrar su contenido:

```bash
test -f docker/nginx/certs/portfolio-mateo.test.pem
test -f docker/nginx/certs/portfolio-mateo.test-key.pem
docker compose exec nginx nginx -t
```

Si el navegador no confía en el certificado:

- Ejecuta `mkcert -install` en Windows, no dentro de WSL.
- Genera un certificado nuevo para todos los nombres documentados.
- No uses `curl -k` como solución.
- Comprueba `127.0.0.1 portfolio-mateo.test` en el archivo hosts de Windows.

El endpoint `http://localhost/nginx-health` permanece en HTTP para Docker.

## Laravel Boost MCP no inicia

Comprueba primero Laravel:

```bash
./vendor/bin/sail artisan --version
./vendor/bin/sail artisan list | grep boost
./vendor/bin/sail artisan boost:mcp
```

Si falla después de reiniciar Docker, revisa el bind mount de `/var/www/html`. Abre Codex desde la raíz para que detecte `boost.json` y `AGENTS.md`.

## Vite o HMR

Inicia Vite dentro de Sail:

```bash
./vendor/bin/sail npm run dev
```

Comprueba:

```bash
docker compose exec laravel.test ps aux | grep '[v]ite'
curl.exe --ssl-no-revoke --head \
    https://portfolio-mateo.test:5173/@vite/client
```

Si HMR no conecta:

- Confirma `VITE_HMR_HOST=portfolio-mateo.test`.
- Comprueba el certificado y la entrada de hosts.
- Abre la aplicación mediante HTTPS, sin mezclar HTTP y HTTPS.
- Reinicia sólo Vite después de cambiar `.env` o certificados.
- Considera `server.watch.usePolling` sólo si WSL no detecta cambios.

`--ssl-no-revoke` conserva la validación TLS de Windows y sólo evita la consulta de revocación que la CA local de mkcert no publica. No utilices `-k`.

## Estado general

```bash
docker compose config
docker compose ps
git status --short
```

Los servicios oficiales deben aparecer bajo `portfolio-mateo`: `nginx`, `laravel.test`, `postgres` y `mailpit`.
