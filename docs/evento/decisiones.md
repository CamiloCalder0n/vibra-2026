---
tags: [evento, decisiones]
---
# Decisiones

| Fecha | Decisión | Por qué | Quién |
|---|---|---|---|

## 2026-10-27 20:27 · Cambio de rumbo: hardware
- Decisión: el profe dijo que las soluciones de página web no sirven; la solución debe basarse en hardware.
- Por qué: indicación directa del profe en la revisión de las 8 p. m.
- Se mantiene: el problema (la información se pierde en cada traspaso: medicinas, síntomas, restricciones de cada perro).
- Pendiente: inventario de materiales del laboratorio.

## 2026-10-27 21:42 · App de tablet (hardware en standby)
- Decisión: diseñar una app de tablet (PWA + Laravel) para la dueña; el hardware queda en standby.
- Por qué: decisión del equipo (Cami). Registro por excepción: solo se reportan los perros que están mal.
- Riesgo: el profe dijo "nada de web" y R12 pide nada visible que se pueda robar. Confirmar las dos cosas mañana.

## 2026-10-27 21:59 · Limpieza de Obsidian
- Decisión: dejar solo lo que sirve. El cliente es el Refugio Yesenia. Lo de antes del evento va a docs/_archivo; el problema queda en docs/02-problema.md y los requerimientos en docs/evento/restricciones.md (fuente única).
- Pendiente: decidir la solución (paso 1 del flujo en 00-inicio).

## 2026-10-27 22:04 · Solución: app de tablet (opción a)
- Decisión: app de tablet del Refugio Yesenia para la dueña, con registro por excepción; sin pieza de hardware.
- Por qué: decisión del equipo (Cami). Ataca las problemáticas 1, 2 y 3 y respeta U1–U5.
- Riesgo aceptado: el profe dijo "página web no sirve, hardware" (P2). Se le cuenta mañana temprano; si lo exige, la opción b (sumar una pieza física) queda lista en [[00-inicio]].
- Contrato de datos y endpoints: AGENTS.md sección 4.

## 2026-10-27 22:21 · Esqueleto del backend (tarea 2)
- Decisión: Laravel 13 + MySQL 8.4 con `php artisan serve` dentro de un solo `Dockerfile` (sirve para compose y para Render). Rutas API registradas a mano, sin `install:api`, para no instalar Sanctum (sin login).
- Supuestos: zona horaria `America/Bogota`, idioma `es`. MySQL publicado en el puerto 3307 del computador. Laravel Boost no se instala (es un extra).

## 2026-10-27 22:40 · Despliegue en Render (tarea 3, opción a)
- Decisión: PostgreSQL 16 de Render en línea, MySQL 8.4 en local; solo Eloquent y migraciones, nada de SQL propio de un motor. Blueprint en `render.yaml` (raíz), región Oregon, plan gratis.
- Consecuencia: cada despliegue corre `migrate --seed --force`, así que los seeders de la tarea 4 deben poder repetirse sin duplicar (`updateOrCreate` o revisar si ya hay datos).
- Riesgos: el plan gratis duerme el servicio (abrir la URL 5 min antes) y la base gratis de Render vence a los 30 días (sirve para el reto).

## 2026-10-27 22:55 · Render usa la instancia Postgres existente
- Decisión (Camilo): Render solo da una base gratis por workspace y ya está facebook-db-prod (Oregon). La API usa una base nueva `refugio_yesenia` dentro de esa instancia; `render.yaml` ya no crea base y `DB_URL` se pega a mano.
- Arranque: `migrate --force` siempre; `refugio:sembrar` corre los seeders solo si `perros` está vacía. Reemplaza lo de "seeders repetibles" de la entrada anterior.
- Riesgos: comparte espacio (1 GB) y fecha de vencimiento con facebook-db-prod; si esa instancia vence o se borra, se cae la demo en línea (plan B: Docker local).

## 2026-10-27 23:04 · Base de datos y seeders (tarea 4)
- Listas fijas (sexo, como_llego, vacunas, estado, nombre de vacuna) como `string` validado con constantes del modelo, no `enum` (en Postgres es un check difícil de cambiar). `sintomas` y `horas` en columnas `json`.
- Relaciones con otro nombre porque chocan con columnas del contrato: `Perro::registroVacunas()` (columna `vacunas`) y `Tratamiento::tomas()` (columna `dosis`).
- `perros.vacunas` = lo que se sabía al llegar; la tabla `vacunas` = el registro actual. Bruno (no_se) no tiene filas.
- Seeders fijos (sin Faker), fechas relativas al día de siembra. Las dosis de hoy quedan pendientes (Rocco 8:00 y 20:00, Canela 7:00 y 19:00); las de días anteriores, dadas.
- Para el día de la demo: `refugio:sembrar --de-nuevo` (local) o `RESEMBRAR=si` en Render. Los ids quedan fijos (Nube = 2, dosis de Rocco de las 8:00 = 7).
- `foto_url` queda vacía en los seeders: el frontend muestra la foto de ejemplo.
- Ojo con la historia de la demo: hay 35 perros pero Chispa está adoptada, así que en el refugio quedan 34 (3 necesitan + 31 bien, no 32). Si se quiere "32 bien", se agrega un perro más.

## 2026-10-27 23:30 · Solo la app; arreglos de la revisión
- Decisión: el proyecto es solo la app de tablet. No se suma pieza física (P2: riesgo aceptado).
- Historia de la demo ajustada a la presentación del jueves a las 3 p. m.: Rocco con dosis a las 2:00 p. m. y 2:00 a. m.; Nube con 2 días sembrados y el tercero en vivo; perro nuevo en vivo: Lucero; conteos calculados (34 en el refugio, 3 necesitan, 31 bien).
- "Necesita atención" = reporte ayer u hoy, o medicina pendiente hasta la hora actual, o llegó hace 3 días o menos. "Llame al veterinario" = 3 días seguidos contando hoy.
- Veterinario por llamada y SMS, no WhatsApp (U11).

## 2026-10-27 23:25 · Resiembra por fecha (revisión, punto 1)
- `RESEMBRAR=2026-10-29` en `render.yaml` reemplaza `RESEMBRAR=si`. La fecha sembrada queda en la tabla `ajustes` (clave `sembrado_el`).
- Regla: resiembra solo si hoy es la fecha de RESEMBRAR y lo sembrado no es de hoy. Comparar solo con la fecha guardada no sirve: o resiembra en cada arranque del día anterior o deja los datos del día anterior.
- El truncate va fuera de la transacción (en MySQL la cerraría); la siembra y el marcador van dentro de `DB::transaction`.
