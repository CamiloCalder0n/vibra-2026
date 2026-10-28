#!/bin/sh
set -e

# La caché de paquetes del computador puede nombrar paquetes de desarrollo que la imagen no trae.
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php
php artisan package:discover
php artisan config:clear
php artisan migrate --force
# RESEMBRAR=AAAA-MM-DD (render.yaml): ese día, en el primer arranque, borra y siembra con las fechas de hoy.
php artisan refugio:sembrar --fecha="${RESEMBRAR:-}"

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
