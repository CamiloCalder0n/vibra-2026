# API del Refugio Yesenia

API REST en Laravel 13 + MySQL 8.4 para la app de tablet del refugio. Contrato de endpoints: `AGENTS.md` sección 4 (raíz del repo).

## Correr en local (Docker)

```sh
cd backend
cp .env.example .env
docker compose up --build
```

La primera vez, genere la llave: `docker compose exec app php artisan key:generate` y reinicie con `docker compose restart app`.

- API: http://localhost:8000/api/salud → `{"ok":true}`
- MySQL desde el computador: `localhost:3307`, usuario `refugio`, clave `refugio_local`, base `refugio`.
- Al arrancar se ejecuta `php artisan migrate --seed --force`.
- Comandos de artisan: `docker compose exec app php artisan <comando>`.
- Borrar la base y empezar de cero: `docker compose down -v`.

## Variables principales

| Variable | Local | Render |
|---|---|---|
| `APP_KEY` | `php artisan key:generate` | la misma llave, como variable |
| `APP_ENV` / `APP_DEBUG` | `local` / `true` | `production` / `false` |
| `APP_TIMEZONE` | `America/Bogota` | `America/Bogota` |
| `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | servicio `db` del compose | los de la base en línea |
| `PORT` | 8000 | la pone Render |

## Errores

Todas las rutas `api/*` responden errores así: `{"mensaje":"...","errores":{...}}` con 404, 409, 422 o 500 (`bootstrap/app.php`).
