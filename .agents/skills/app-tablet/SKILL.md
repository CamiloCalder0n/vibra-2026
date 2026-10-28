---
name: app-tablet
description: "Construye las pantallas de la app de tablet del Refugio Yesenia en frontend/: tablet Android de 10\" en horizontal, para una señora de casi 70 años, con el sistema de diseño y los textos exactos del proyecto, datos falsos con el formato del contrato mientras la API no está, y conexión a la API con VITE_API_URL. Usar al crear o cambiar pantallas, componentes, estilos o la conexión del frontend con la API."
---

# App de tablet (frontend)

Fuentes obligatorias: `AGENTS.md` sección 4 (contrato), `docs/evento/flujos.md` (historia, Dentro y Fuera), `docs/diseno/00-sistema-diseno.md` (colores, letras y reglas) y `docs/diseno/contenido.md` (textos exactos). La app vive en `frontend/`.

## Orden de trabajo
1. **Decidir el framework antes de programar** y anotarlo en `docs/evento/decisiones.md` (recomendado: Vite + Vue o React, sin librerías de componentes pesadas).
2. **Datos falsos primero** en `frontend/mock/*.json`, con exactamente el formato de AGENTS.md sección 4. Un solo módulo `api` decide: si existe `VITE_API_URL`, llama a la API; si no, usa los mocks. Así la demo funciona aunque el backend falle (plan de respaldo).
3. Pantallas en este orden: Hoy → Un perro está mal → Medicinas → Ficha → Mis perros → Llegó un perro → Para el veterinario. Solo lo que está en "Dentro" de flujos.md.
4. Un commit por pantalla que funcione, en la rama del frontend.

## Reglas de diseño (no negociables)
- Tablet de 10" en horizontal (1280×800). Barra lateral fija: Hoy, Medicinas, Mis perros, Para el veterinario.
- Letra mínima de 22 px; títulos de 44–72 px. Todo lo que se toca mide 64 px o más, y el botón principal 72 px. 16 px entre botones.
- Una acción principal y máximo 5 opciones por pantalla. Siempre ícono + palabra; el color nunca va solo.
- Sin gestos ocultos (nada de deslizar ni mantener presionado).
- Guardar al instante y mostrar "Deshacer" 8 s (llama a `DELETE /api/reportes/{id}`). Nada de "¿Está segura?".
- Doble dosis: si la API responde 409, mostrar su `mensaje` en una banda con un solo botón "Entendido".
- Voz: "Léame en voz alta" con `speechSynthesis` (es-CO) y dictado con `SpeechRecognition` si existe; si no existe, se oculta.
- Veterinario: `tel:` y `sms:`, nunca WhatsApp.
- Textos exactos de `contenido.md`, con "usted". Nada de jerga, MAYÚSCULAS en etiquetas, emojis ni flechas en botones.
- Conteos y fechas siempre de la API, nunca escritos fijos.

## Fuera (salvo que sobre tiempo, decidido por Camilo)
Manifest para instalarla con ícono y guardar reportes sin señal. Nada de login, service worker complejo ni librerías nuevas sin pasar por plan-demo.

## Antes de entregar
Recorrer la historia de flujos.md sección 3 en la tablet real (o el navegador a 1280×800), tomar captura de cada pantalla y escribir una línea en la bitácora.
