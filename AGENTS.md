# Reto Vibra+ UNAB 2026 — Reglas para todos los agentes

> Fuente única de verdad. La leen Claude Code (vía CLAUDE.md), agy y OpenCode. Mantener corto (< 150 líneas).
> Las capacidades viven en `.agents/skills/` (ver sección 7).
> El estado del día va en `docs/evento/bitacora.md`, no aquí.

## 1. Hechos del reto (PRIORIDAD: `docs/01-reto-hechos.md`; requerimientos en `docs/evento/restricciones.md`)
- Hackathon presencial de 48 h (martes 27 oct → jueves 29 oct). Prototipo FUNCIONANDO el jueves; penalización grave si los dispositivos fallan.
- Cliente: Refugio Yesenia, albergue de perros de una señora de casi 70 años, muy bajos recursos, barrio pobre y peligroso de Floridablanca (solo contesta llamadas, no WhatsApp). Camino 1: mejorar la gestión del albergue. Camino 2: mejorar la vida de un perrito en particular.
- Proceso: Problema → Pregunta → Objetivo. Hasta las 6 p. m. solo problema. Entrevista al Gem del profe + mapa de empatía.
- Pitch: 3 min sin preguntas + demo breve. Jurado probable: la señora + personas de otras facultades.
- El profe (8 p. m.): las soluciones de página web no sirven; hay que ir por hardware.
- Equipo de 5: Camilo (Sistemas) + Silvia, Natalia, Andrés, Manuel (Biomédica).

## 2. Lo que NO sabemos (no asumir)
- Rúbrica oficial (la foto con Innovación 40/Impacto 30/Presentación 30 dice "Colegio": confirmar) · materiales y equipos disponibles · cuántos perros, quién ayuda, qué celular usa la señora · si se puede llevar código hecho.
Si una tarea depende de esto: pregunta, o decide lo más simple y anótalo en `docs/evento/decisiones.md`.

## 3. Problema (cerrado; detalle en `docs/02-problema.md`)
- Cliente: Refugio Yesenia.
- Usuaria principal: la dueña (única usuaria de lo que hagamos). Secundarios: quienes ayudan y el veterinario. Beneficiados: los perros.
- Frase: El equipo del refugio pierde en cada cambio de turno qué necesita cada animal y qué ya se hizo, porque depende del papel y la memoria.
- Criterio de éxito: ninguna dosis repetida ni saltada; un perro que empieza a estar mal se nota el mismo día; quien ayuda sabe con qué perro tener cuidado; la dueña solo se ocupa del que está mal.
- Restricciones y requerimientos: `docs/evento/restricciones.md`

## 4. Decisiones técnicas (detalle en `docs/evento/flujos.md`)
- Idea: **app de tablet del Refugio Yesenia** para la dueña. Registro por excepción: solo se reporta el perro que está mal; los demás quedan "bien". Decidido el 27 oct (opción a).
- Qué aporta Biomédica: seguridad en la administración de medicamentos (los "5 correctos" y el bloqueo de la doble dosis), signos de alarma y regla de 3 días seguidos, y prueba con usuaria (SUS).
- Tipo de solución: app para tablet Android de 10" en horizontal (PWA) + API.
- Stack: Laravel MVC como API REST + MySQL en Docker, desplegado en Render. Frontend en `frontend/` consumiendo la API. Sin login (un solo perfil).
- Qué se simula: la semana anterior (seeders con fechas relativas a hoy), la voz (navegador), las fotos. Llamar al veterinario abre el marcador (`tel:`) y el mensaje abre SMS (`sms:`).
- Carpetas: `backend/` (Laravel) · `frontend/` (app) · `docs/`.

### Contrato de datos
- `perros`: id, nombre, sexo (macho|hembra|no_se), descripcion, edad_aprox, foto_url, como_llego (bien|flaco|herido|enfermo), vacunas (si|no|no_se), cuidados (texto corto), llego_el (fecha), estado (en_refugio|adoptado).
- `reportes`: id, perro_id, sintomas (lista: no_comio, comio_poco, decaido, vomito, diarrea, cojea, tose, herida), nota_voz_url, creado_en.
- `tratamientos`: id, perro_id, medicamento, dosis (texto), horas (lista "08:00", "20:00"), desde, hasta.
- `dosis`: id, tratamiento_id, programada_para (fecha y hora), dada_en (nula hasta darla).
- `vacunas`: id, perro_id, nombre (moquillo|parvovirus|rabia), aplicada_el (nula = falta).
- Reglas (todas calculadas en PHP con la hora de Bogotá, nunca con funciones de fecha de la base):
  - "Necesita atención" = reporte ayer u hoy, o medicina pendiente hoy hasta la hora actual, o llegó hace 3 días o menos. Todos los demás perros en el refugio están "bien". Los conteos se calculan; ningún número va fijo.
  - "Llame al veterinario" = 3 días seguidos con reporte, contando hoy (días distintos).
  - Una dosis ya dada no se puede volver a dar: 409.
  - Fechas en el JSON: con hora en ISO con −05:00; sin hora como AAAA-MM-DD.

### Endpoints (JSON de ejemplo)
| Método y ruta | Para qué |
|---|---|
| GET `/api/salud` | `{"ok":true}` |
| GET `/api/hoy` | `{"fecha":"2026-10-28","necesitan":[{"id":2,"nombre":"Nube","motivo":"Lleva 2 días comiendo poco","alerta":false}],"medicinas_pendientes":[{"dosis_id":7,"perro":"Rocco","medicamento":"Cefalexina","hora":"14:00"}],"en_refugio":34,"bien":31}` |
| GET `/api/perros?filtro=mal\|medicina\|nuevos` | `[{"id":1,"nombre":"Rocco","foto_url":"...","estado_hoy":"medicina"}]` |
| GET `/api/perros/{id}` | ficha: `{"id":2,"nombre":"Nube","descripcion":"Hembra, criolla blanca, 4 años","cuidados":"Comida blanda","ultimos_7_dias":["bien","bien","bien","comio_poco","comio_poco","comio_poco","decaido"],"alerta":"Nube lleva 3 días seguidos mal. Llame al veterinario.","vacunas":[{"nombre":"moquillo","aplicada_el":null}],"tratamientos":[]}` |
| POST `/api/perros` | perro nuevo (Form Request `StorePerroRequest`) → 201 con el perro |
| PATCH `/api/perros/{id}` | cambiar datos → 200 |
| POST `/api/perros/{id}/reportes` | `{"sintomas":["comio_poco","decaido"]}` → 201 `{"id":88,"mensaje":"Listo, quedó guardado lo de Nube"}` |
| DELETE `/api/reportes/{id}` | deshacer → 204 |
| GET `/api/medicinas/hoy` | `[{"dosis_id":41,"perro":"Rocco","medicamento":"Cefalexina","dosis":"1 pastilla","hora":"08:00","dada_en":null}]` |
| POST `/api/dosis/{id}/dar` | 200 `{"dada_en":"2026-10-29T15:05:00-05:00","mensaje":"Dada a las 3:05 p. m."}` · si ya se dio, **409** `{"mensaje":"Rocco ya se tomó la cefalexina a las 3:05 p. m. La próxima es a las 2:00 a. m.","errores":{"dosis":["ya_dada"]}}` |
| GET `/api/veterinario/resumen?desde=2026-10-21&hasta=2026-10-27` | `{"revisar":[...],"tratamientos":[...],"recien_llegados":[...]}` |

| POST `/api/demo/reiniciar` | 200: vuelve la historia al comienzo (sin Lucero, Nube sin aviso, dosis #7 pendiente) |

**Formato real = `backend/docs/postman.json`** (manda sobre los ejemplos de esta tabla). Notas para el frontend:
- Sin envoltura `data`. Campos extra que sí llegan: `perro_id`, `alerta`, `mensaje`, `motivo`, `reportes`, `estado_hoy` (mal | medicina | nuevo | bien | adoptado).
- POST de perro nuevo manda `vacunas` (si | no | no_se); la ficha devuelve `vacunas_al_llegar` (si | no | no_se) y `vacunas` (lista). "Todavía no tiene nombre" manda `"Sin nombre"`.
- `ultimos_7_dias` va del más viejo a hoy con códigos (`bien`, `comio_poco`, `decaido`...); el frontend los traduce con los textos de `docs/diseno/contenido.md`.
- `hora` llega en 24 h ("14:00"); se muestra como "2:00 p. m.".
- `/api/perros` lista solo los que están en el refugio (34).
- Rocco aparece en Hoy desde su hora (2:00 p. m.); antes de eso Hoy da 2 necesitan y 32 bien.

Errores siempre: `{"mensaje":"...","errores":{...}}` con 404, 409, 422 o 500.

## 5. Reglas del sprint
1. Un solo flujo de punta a punta primero. Cero extras antes.
2. Si el jurado no lo ve y no ayuda a la demo, no se hace (ej.: service worker, arquitectura invisible). Login solo si la demo necesita usuarios o roles, y entonces con Sanctum, sin reinventar.
3. Solo la app de tablet (decisión del equipo, 27 oct 11:15 p. m.). El profe pidió hardware (P2): riesgo aceptado, se le explica el miércoles temprano. Nada de hardware en este proyecto; si falla la demo hay penalización grave, así que siempre respaldo local en Docker y video.
4. Diseño por excepción: el usuario solo marca lo que cambió. Nadie llena formularios largos.
5. Todo en español y sin jerga. Datos ficticios; nunca datos reales de personas.
6. Ninguna cifra, precio o cita entra a docs o al pitch sin fila VERIFICADA o PARCIAL en `docs/evento/fuentes.md` (skill verificar-cifras) y revisión de una persona.
7. Un agente no edita la carpeta de otro. Ramas por frente, commits pequeños y frecuentes; Camilo integra a `main` antes de cada mentoría. Nada de merges gigantes al final.
8. Solo se construye lo que está en "Dentro" de `docs/evento/flujos.md` (skill plan-demo). Si un agente lleva más de 10 minutos en algo que no está ahí, se detiene y pregunta.
9. Ninguna idea se puntúa sin pasar el filtro de `docs/evento/restricciones.md` (skill idear).
10. Las skills preparan la decisión; el equipo decide.
11. Desplegar TEMPRANO: el esqueleto en línea la primera noche. Siempre con respaldo local en Docker y video.
12. Seeders con datos realistas del contexto, nunca "prueba" ni "test".
13. Descanso por turnos: nadie trasnocha las dos noches.
14. Recomendaciones del profe Fabián (`docs/recomendaciones-fabian.md`) tienen prioridad alta en lo técnico y en el pitch.

## 6. Memoria
- Antes de una tarea: leer las últimas 10 líneas de `docs/evento/bitacora.md` y solo el doc relacionado.
- Al terminar una tarea que cambió archivos: UNA línea en la bitácora con hora de Bogotá (`TZ=America/Bogota date`):
  `- AAAA-MM-DD HH:MM · [herramienta] · qué se hizo · qué sigue`
- Preguntas que no cambian nada: no se escribe.
- Si inventas algo que no está decidido (campo, ruta, formato, supuesto): anótalo en `docs/evento/decisiones.md` ANTES de seguir.

## 7. Skills (en `.agents/skills/`; Claude Code las ve por symlink en `.claude/skills/`)
| Skill | Cuándo | Escribe en |
|---|---|---|
| entrevista-empatia | Preparar preguntas o sintetizar entrevistas | `docs/evento/notas-fundacion.md` |
| definir-problema | Día 1, después de la apertura | `docs/evento/restricciones.md`, sección 3 |
| idear | Ideación, puntuar o elegir ideas | `docs/evento/decisiones.md`, sección 4 |
| aporte-biomedica | Propuesta de valor, prueba con usuarios | `docs/evento/aporte-biomedica.md` |
| plan-demo | Antes de construir; ante funciones nuevas | `docs/evento/flujos.md` |
| laravel-api | Backend, API, base de datos, Docker, despliegue, README, Postman | `backend/` |
| app-tablet | Pantallas de la app de tablet (frontend) | `frontend/` |
| prototipo-hardware | Sin uso (solo app) | — |
| verificar-cifras | Cualquier número, precio o cita | `docs/evento/fuentes.md` |
| pitch | Guion, diapositivas, ensayo | `docs/evento/pitch.md` |
| checkpoint (`/checkpoint N`, solo manual) | Al cerrar cada checkpoint y antes de mentorías | `docs/evento/bitacora.md` |
| demo-check (`/demo-check`, solo manual) | Antes de cada mentoría y el jueves | `docs/evento/demo-check.md` |

