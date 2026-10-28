#!/bin/sh
# El puerto se abre primero: Render da el despliegue por fallido si no ve el puerto abierto a tiempo.
# Migrar y sembrar van en segundo plano, sin preguntas y con tiempo máximo; si fallan, queda en el log
# y la API sigue arriba (/api/salud responde aunque la base no esté lista).
set -e

# La caché de paquetes del computador puede nombrar paquetes de desarrollo que la imagen no trae.
rm -f bootstrap/cache/packages.php bootstrap/cache/services.php
php artisan package:discover --no-interaction
php artisan config:clear --no-interaction

LIMITE="${TIEMPO_MAXIMO_BASE:-180}"

paso() {
    descripcion="$1"; shift
    echo "[arranque] $descripcion (máximo $LIMITE s)..."
    codigo=0
    timeout -k 10 "$LIMITE" "$@" --no-interaction </dev/null || codigo=$?
    if [ "$codigo" -eq 0 ]; then
        return 0
    elif [ "$codigo" -eq 124 ] || [ "$codigo" -eq 137 ]; then
        echo "[arranque] ERROR: $descripcion pasó de $LIMITE s y se detuvo. La API sigue arriba; revise la base." >&2
    else
        echo "[arranque] ERROR: $descripcion falló (código $codigo). La API sigue arriba; revise la base." >&2
    fi
    return 1
}

preparar_base() {
    paso "Migrar" php artisan migrate --force || return 0
    # RESEMBRAR=AAAA-MM-DD (render.yaml): ese día, en el primer arranque, borra y siembra con las fechas de hoy.
    paso "Sembrar" php artisan refugio:sembrar --fecha="${RESEMBRAR:-}" || return 0
    echo "[arranque] Base lista."
}

preparar_base &

# --no-reload: sin esto, artisan serve ignora PHP_CLI_SERVER_WORKERS y atiende de a una petición.
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}" --no-reload
