# Docker y Render — guía corta

## docker-compose mínimo (desarrollo)
Servicios: `app` (PHP-FPM o `php artisan serve` con la imagen oficial de PHP 8.3 + Composer), `db` (MySQL 8 o PostgreSQL 16), y opcional `frontend` (Node para Vite).
- Volumen para la base de datos.
- Variables tomadas de `.env`.
- Comando de arranque: `php artisan migrate --seed --force` y luego el servidor.
- Puerto expuesto documentado en el README.

Verificar SIEMPRE con la documentación oficial vigente antes de copiar configuraciones (Laravel Sail también es una opción: `laravel/sail`).

## Render
- Servicio web con Docker (Dockerfile en `backend/`) o el entorno que se usó en clase.
- Base de datos administrada de Render (PostgreSQL) o la que indique el profe.
- Variables de entorno: `APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, datos de la base.
- Comando de despliegue con `php artisan migrate --seed --force`.
- El plan gratuito puede "dormir" el servicio: abrir la URL 5 minutos antes del pitch para despertarlo.

## Plan B
- La demo también corre local con `docker compose up`.
- Video de 60–90 s grabado el jueves al mediodía.
