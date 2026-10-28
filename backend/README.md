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
docker compose up --build
```

La primera vez, genere la llave: `docker compose exec app php artisan key:generate` y reinicie con `docker compose restart app`.

- API: http://localhost:8000/api/salud → `{"ok":true}`
- MySQL desde el computador: `localhost:3307`, usuario `refugio`, clave `refugio_local`, base `refugio`.
- Al arrancar se ejecuta `php artisan migrate --force` y luego `php artisan refugio:sembrar`, que siembra solo si la tabla `perros` está vacía (redesplegar no duplica).
- Datos ficticios del refugio: 35 perros (Chispa adoptada), 3 tratamientos con sus dosis, 11 reportes de la semana, con fechas relativas al día en que se siembra. Casos de la demo: Rocco (cefalexina 8:00 a. m. pendiente), Nube (3 días comiendo poco, hoy decaída), Toby (no tolera machos), Bruno (llegó hace 2 días, vacunas "no se sabe").
- Resembrar con las fechas de hoy (borra solo los datos del refugio): `docker compose exec app php artisan refugio:sembrar --de-nuevo`. En Render: poner la variable `RESEMBRAR=si`, redesplegar, comprobar y quitarla (si se deja, borra en cada arranque, también cuando el plan gratis se despierta).
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
