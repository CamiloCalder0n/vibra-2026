---
tags: [evento, revision]
---
# Revisión profunda, 27 oct, 11:30 p. m. (3 agentes: backend, producto y demo, proceso)

## Veredicto
El problema está bien trabajado y el backend va adelantado y limpio. Pero hay 3 cosas que pueden costar el reto: (1) se va contra la única indicación explícita del profe (P2, hardware), (2) la historia de la demo no cuadra con los datos y (3) la usuaria real no está validada (todo sale del Gem).

## Crítico
1. **P2 (hardware):** el agente de jurado propuso sumar una pieza física. **Decisión de Cami (11:15 p. m.): solo la app.** Riesgo aceptado; se le explica al profe el miércoles temprano con el argumento de que la tablet es el dispositivo, funciona sin escribir y está pensada para ella.
2. **Resiembra el día de la demo:** sin RESEMBRAR las fechas quedan corridas; con RESEMBRAR=si, el plan gratis borra todo al despertar. Arreglo: `RESEMBRAR=2026-10-29` + marcador de la fecha sembrada en la base.
3. **Historia vs datos:**
   - Canela tiene dosis hoy (sale entre los que "necesitan") → terminar su tratamiento ayer.
   - Con Chispa adoptada quedan 34 → conteos calculados, nunca fijos.
   - Nube ya trae el reporte de hoy → sembrar solo −3, −2, −1; el toque en vivo dispara la alerta.
   - Bruno ya está sembrado → en vivo se registra otro perro.
   - Rocco "8:02 a. m." no cuadra con la presentación a las 3 p. m. → horas de la demo relativas a la presentación.
   - Fechas fijas en los textos ("Martes 27", "Del 21 al 27") → calcularlas.
4. **Usuaria real (P3):** validar en la visita si hay equipo y "cambio de turno", qué celular usa, internet, robo.

## Importante (backend)
- Fechas del JSON: falta `serializeDate`/casts `date:Y-m-d`; `dada_en` sale en UTC y no con −05:00.
- "Hoy" siempre calculado en PHP (las bases corren en UTC).
- 409: responderlo desde el controlador con `update ... whereNull('dada_en')` (no se cuela un doble toque) y con `errores.dosis:["ya_dada"]`.
- Regla de 3 días: días distintos agrupados en PHP; "Deshacer" recalcula.
- `vacunas` choca (texto vs lista): usar API Resources (`vacunas_al_llegar`).
- StorePerroRequest: `llego_el` por defecto hoy; falta UpdatePerroRequest; "Todavía no tiene nombre" debe mandar un texto.
- Menores: puerto 3307 solo en 127.0.0.1, `DB::transaction` en la siembra, índices, `PHP_CLI_SERVER_WORKERS=4`, falta Postman.

## Proceso
- Tarea 4 sin push; `.gitignore` sin `.claude/worktrees/` ni `.revision/`.
- AGENTS regla 3 contradice la decisión (dice "debe ser hardware").
- Pitch: las skills dicen 5 y 10 min; el reto es de 3 min.
- `comandos.md` desactualizado (imágenes, migrate:fresh, ramas).
- Falta la skill `app-tablet` para el frontend; qa-demo no puede escribir (le faltan Write/Edit); constructor precarga skills de backend y hardware.
- No se ha corrido ningún `/checkpoint`.
- Cuello de botella: Camilo con 8 tareas en serie; pasar la tarea 7 a un worktree en paralelo con datos falsos.
- U11: cambiar "Mandar por WhatsApp" por "Llamar al veterinario" (tel:) y SMS.

Resumen de acciones y comandos: ver el chat del 27 oct, 11:30 p. m.

## Qué se arregló (27 oct, 11:30 p. m.)
- Documentación: AGENTS (regla 3, contrato con conteos calculados, horas de la demo, reglas de "necesita" y "Llame al veterinario"), flujos (historia con Nube en vivo, Rocco a las 2:00 p. m., Lucero como perro nuevo, tel/sms), contenido (textos sin números ni fechas fijas, sin WhatsApp), pitch de 3 min en la skill, los agentes, demo-check y pitch.md, comandos.md al día, plan-demo con despliegue dentro.
- Herramientas: skill nueva app-tablet; qa-demo puede escribir; constructor usa app-tablet en el frontend.
- Pendiente en código (Claude Code): resiembra por fecha, datos de la historia, fechas del JSON, Form Requests y menores de Docker.
