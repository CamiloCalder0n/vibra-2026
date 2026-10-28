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
