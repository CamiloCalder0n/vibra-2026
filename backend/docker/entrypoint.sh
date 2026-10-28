#!/bin/sh
set -e

# La caché de paquetes del computador puede nombrar paquetes de desarrollo que la imagen no trae.
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php
php artisan package:discover
php artisan config:clear
php artisan migrate --force
# RESEMBRAR=si (variable en Render) borra y siembra con las fechas de hoy; quitarla después de la demo.
if [ "$RESEMBRAR" = "si" ]; then
    php artisan refugio:sembrar --de-nuevo
else
    php artisan refugio:sembrar
fi

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
