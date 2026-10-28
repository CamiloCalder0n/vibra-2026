# API del Refugio Yesenia

API REST en Laravel 13 + MySQL 8.4 para la app de tablet del refugio. Contrato de endpoints: `AGENTS.md` sección 4 (raíz del repo).

## En línea (Render)

- URL: https://refugio-yesenia-api.onrender.com → prueba: https://refugio-yesenia-api.onrender.com/api/salud responde `{"ok":true}`.
- Se redespliega solo con cada push a la rama `backend` que cambie algo en `backend/` (`render.yaml` en la raíz).
- Base: `refugio_yesenia` dentro de la instancia Postgres `facebook-db-prod` (Oregon).
- El plan gratis se duerme: abrir la URL 5 minutos antes de la demo.

## Correr en local (Docker)

```sh
cd backend
cp .env.example .env
docker compose up --build -V
```

- `--build` reconstruye la imagen si cambió el código o `composer.json`; `-V` renueva el volumen de `vendor` (si no, el contenedor sigue con las dependencias viejas).
- Si algo quedó raro (variables del `.env` que no cambian, contenedor a medias): `docker compose up --build -V --force-recreate`.

La primera vez, genere la llave: `docker compose exec app php artisan key:generate` y reinicie con `docker compose restart app`.

- API: http://localhost:8000/api/salud → `{"ok":true}`
- MySQL solo desde este computador: `127.0.0.1:3307`, usuario `refugio`, clave `refugio_local`, base `refugio`.
- Al arrancar se ejecuta `php artisan migrate --force` y luego `php artisan refugio:sembrar`, que siembra solo si la tabla `perros` está vacía (redesplegar no duplica).
- Datos ficticios del refugio (historia de `docs/evento/flujos.md` sección 3): 35 perros (Chispa adoptada; Lucero no se siembra porque se registra en vivo), 3 tratamientos con 33 dosis, 9 reportes de la semana, con fechas relativas al día en que se siembra. Casos: Rocco (cefalexina cada 12 h, la de hoy a las 2:00 p. m. pendiente), Nube (2 días comiendo poco; el aviso nace al reportarla en vivo), Toby (no tolera machos), Bruno (llegó hace 2 días, vacunas "no se sabe"), Canela (tratamiento terminado ayer).
- Resembrar con las fechas de hoy (borra solo los datos del refugio): `docker compose exec app php artisan refugio:sembrar --de-nuevo`. En Render: `RESEMBRAR=2026-10-29` (en `render.yaml`). Ese día, el primer arranque borra y siembra con las fechas de hoy y guarda `sembrado_el` en la tabla `ajustes`; los demás arranques de ese día y de otros días no tocan los datos.
- Comandos de artisan: `docker compose exec app php artisan <comando>`.
- Borrar la base y empezar de cero: `docker compose down -v`.

## Variables principales

| Variable | Local | Render |
|---|---|---|
| `APP_KEY` | `php artisan key:generate` | la misma llave, como variable |
| `APP_ENV` / `APP_DEBUG` | `local` / `true` | `production` / `false` |
| `APP_TIMEZONE` | `America/Bogota` | `America/Bogota` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | servicio `db` del compose | no se usan |
| `DB_CONNECTION` / `DB_URL` | `mysql` / vacía | `pgsql` / Internal Database URL de facebook-db-prod terminada en `/refugio_yesenia` |
| `PORT` | 8000 | la pone Render |

## Errores

Todas las rutas `api/*` responden errores así: `{"mensaje":"...","errores":{...}}` con 404, 409, 422 o 500 (`bootstrap/app.php`).
