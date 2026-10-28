#!/bin/sh
set -e

# La caché de paquetes del computador puede nombrar paquetes de desarrollo que la imagen no trae.
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php
php artisan package:discover
php artisan config:clear
php artisan migrate --seed --force

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
