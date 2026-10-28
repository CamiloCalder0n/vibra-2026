---
name: app-tablet
description: "Construye las pantallas de la app de tablet del Refugio Yesenia en frontend/: tablet Android de 10\" en horizontal, para una señora de casi 70 años, con el sistema de diseño y los textos exactos del proyecto, datos falsos con el formato del contrato mientras la API no está, y conexión a la API con VITE_API_URL. Usar al crear o cambiar pantallas, componentes, estilos o la conexión del frontend con la API."
---

# App de tablet (frontend)

Fuentes obligatorias: `AGENTS.md` sección 4 (contrato), `docs/evento/flujos.md` (historia, Dentro y Fuera), `docs/diseno/00-sistema-diseno.md` (colores, letras y reglas) y `docs/diseno/contenido.md` (textos exactos). La app vive en `frontend/`.

## Orden de trabajo
1. **Stack decidido:** Vite + Vue 3 (`npm create vue@latest`), sin router, Pinia ni librerías de UI (un `ref` con la pantalla actual basta para 7 pantallas). Fuentes alojadas en la app con `@fontsource/big-shoulders` y `@fontsource/atkinson-hyperlegible-next` (no Google Fonts).
2. **Datos falsos primero** en `frontend/mock/*.json`, copiados de las respuestas reales de `backend/docs/postman.json` (ese formato manda). Un solo módulo `src/api.js` decide: si existe `VITE_API_URL` (sin `/api` al final), llama a la API; si no existe, falla o tarda más de 8 s, usa los mocks. Al abrir la app llama `/api/salud` para despertar Render (un "error de CORS" con Render dormido casi siempre es Render dormido, no CORS).
3. Pantallas en este orden: Hoy → Un perro está mal → Medicinas → Ficha → Mis perros → Llegó un perro → Para el veterinario. Solo lo que está en "Dentro" de flujos.md.
4. Un commit por pantalla que funcione, en la rama del frontend.

## Carpetas
```
frontend/
  src/ api.js · formato.js ("14:00"→"2:00 p. m.", códigos→textos) · voz.js · tokens.css · App.vue
       pantallas/*.vue · componentes/*.vue
  mock/*.json
  public/ manifest.webmanifest · iconos/ (192 y 512, maskable)
```

## Que se sienta como app instalada (no como página)
- `manifest.webmanifest`: `"display": "fullscreen"`, `"orientation": "landscape"`, `"start_url": "/"`, `theme_color` y `background_color` #F7F3D9.
- En la tablet: Chrome → menú → Instalar app; luego Ajustes → Seguridad → Fijar app (que no se salga).
- CSS: `user-select: none`, `overscroll-behavior: none`, `touch-action: manipulation` (sin zoom por doble toque).
- Sin service worker.

## Reglas de diseño (no negociables)
Si los documentos de diseño se contradicen, manda `docs/diseno/contenido.md` (textos, navegación) y `00-sistema-diseno.md` (tamaños). Mínimo 22 px; título de pantalla 56 px.
- Tablet de 10" en horizontal (1280×800). Barra lateral fija: Hoy, Medicinas, Mis perros, Para el veterinario.
- Letra mínima de 22 px; títulos de 44–72 px. Todo lo que se toca mide 64 px o más, y el botón principal 72 px. 16 px entre botones.
- Una acción principal y máximo 5 opciones por pantalla. Siempre ícono + palabra; el color nunca va solo.
- Sin gestos ocultos (nada de deslizar ni mantener presionado).
- Guardar al instante y mostrar 8 s el `mensaje` de la API con el botón "Me equivoqué, borrar" (llama a `DELETE /api/reportes/{id}`). Nada de "¿Está segura?". El toast con `aria-live`.
- Doble dosis: si la API responde 409, mostrar su `mensaje` en una banda con un solo botón "Entendido".
- Voz: "Léame en voz alta" con `speechSynthesis` (pedir es-CO; si no hay, cualquier `es-*`). Dictado con `SpeechRecognition` solo si existe (necesita https e internet); si no, se oculta el micrófono.
- Veterinario: `tel:` y `sms:`, nunca WhatsApp.
- Textos exactos de `contenido.md`, con "usted". Nada de jerga, MAYÚSCULAS en etiquetas, emojis ni flechas en botones.
- Conteos, fechas, `motivo`, `alerta` y `mensaje` siempre de la API, tal cual; nunca escritos fijos.

## Fuera (salvo que sobre tiempo, decidido por Camilo)
Manifest para instalarla con ícono y guardar reportes sin señal. Nada de login, service worker complejo ni librerías nuevas sin pasar por plan-demo.

## Probar en la tablet
- Rápido: `npm run dev -- --host` y abrir `http://IP-del-Mac:5173` en la misma wifi (por http no funcionan el micrófono ni "Instalar app").
- Real: desplegar el build por https (Render Static Site) y abrirlo en Chrome de la tablet.

## Antes de entregar
Recorrer la historia de flujos.md sección 3 en la tablet real (o el navegador a 1280×800), tomar captura de cada pantalla y escribir una línea en la bitácora.
