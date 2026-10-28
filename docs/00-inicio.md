---
tags: [vibra, indice]
---
# Reto Vibra+ 2026: inicio

**Cliente:** Refugio Yesenia · **Problema:** [[02-problema]] · **Requerimientos:** [[restricciones]] · **Reto y reglas:** [[01-reto-hechos]]

## Dónde vamos (cierre del martes 27, 11:40 p. m.)
| # | Fase | Estado | Entregable |
|---|---|---|---|
| 1 | Empatizar | ✓ | [[notas-fundacion]] (Gem, 5 roles y 2 rondas) |
| 2 | Definir | ✓ | [[02-problema]] (problema, pregunta, objetivo) y [[restricciones]] |
| 3 | Idear | ✓ | Opción a: **app de tablet** ([[decisiones]], [[flujos]]) |
| 4 | Construir | Tareas 1–4 listas + arreglos de la revisión ([[revision-27oct]]). **Sigue la 5** | Demo de punta a punta |
| 5 | Pulir y probar | Pendiente | Demo estable, plan B, video |
| 6 | Pitch | Pendiente | 3 min + demo |

## ▶ Mañana se empieza aquí (miércoles 28)
1. ✅ **RESEMBRAR=2026-10-28** en `render.yaml` (commit 5b40417). Revisar en Render → Environment y Logs: "Sembrado el 2026-10-28". **Jueves temprano:** cambiar `render.yaml` a `"2026-10-29"`, commit, push, Blueprint → Manual sync si no llega, y revisar Logs. En local: `docker compose exec app php artisan refugio:sembrar --de-nuevo`.
2. **Visita a la señora** (Biomédica) con [[preguntas-apertura]]; **contarle al profe** que la tablet es el dispositivo (Camilo).
3. **Tarea 5** en Claude Code (rama `backend`): endpoints de Hoy, perros y reportes, con API Resources (fechas con −05:00) y Postman.
4. **Tarea 6:** medicinas y el 409 con `update ... whereNull('dada_en')`.
5. **En paralelo, tarea 7:** `claude --worktree frontend` → "usa el subagente constructor; te toca frontend/ con la skill app-tablet".
6. **Antes de la mentoría (2:20 p. m.):** integrar a `main`, `/demo-check` y "usa el subagente qa-demo".
7. Biomédica: tareas 10–13 ([[aporte-biomedica]], datos, prueba con la usuaria, [[pitch]] de 3 min).

## El flujo a seguir
### Hoy martes (hasta las 11:30 p. m.)
1. ~~Decidir la solución~~ → **a, app de tablet** (10:05 p. m.).
2. ~~Endpoints y JSON~~ → listos en AGENTS.md sección 4.
3. ~~Esqueleto Laravel + Docker + despliegue en Render~~ → en línea: https://refugio-yesenia-api.onrender.com/api/salud responde {"ok":true} (10:53 p. m.).
4. Biomédica: leer [[preguntas-apertura]], repartir los roles de la visita y llenar [[aporte-biomedica]].
5. **Turnos de descanso**: nadie trasnocha las dos noches.

### Miércoles 28
| Hora | Qué | Quién |
|---|---|---|
| Temprano | Visita a la señora con [[preguntas-apertura]]; fotos con permiso | 2–3 de Biomédica |
| Temprano | Contarle al profe la decisión (app de tablet) y escuchar su reparo de P2 | Camilo |
| Al volver | Ajustar [[02-problema]] y [[restricciones]] con lo que dijo ella | Todos |
| Hasta 12:00 m. | **Flujo completo funcionando** (hito) | Camilo + quien haga hardware |
| 2:20 p. m. | Mentoría 2: mostrar la demo; antes, `/demo-check` | Todos |
| Tarde | Mockups finales con el prompt de Apple, prueba con usuaria (SUS), [[fuentes]] | Biomédica |
| **10:00 p. m.** | **Congelar funciones**: después solo errores y pitch | Todos |

### Jueves 29
| Hora | Qué |
|---|---|
| 8:20 a. m. | Mentoría 3 con el pitch armado ([[pitch]]) |
| Mañana | Ensayar los 3 min con cronómetro, mínimo 3 veces; todos hablan |
| 12:00 m. | **Video de respaldo** de la demo |
| 2:00 p. m. | Mentoría 4 |
| **3:00 p. m.** | **Presentación** |

## Mapa
- Reto: [[01-reto-hechos]] · [[recomendaciones-fabian]]
- Problema: [[02-problema]] · [[notas-fundacion]] · [[restricciones]] · [[preguntas-apertura]]
- Solución: [[decisiones]] · [[flujos]] · [[hardware]] · [[aporte-biomedica]] · [[00-sistema-diseno]]
- Cierre: [[demo-check]] · [[fuentes]] · [[pitch]]
- Herramientas: [[comandos]] · [[herramientas]] · [[bitacora]]
- Crudo (fuentes originales): carpeta `evento/crudo`. Viejo: carpeta `_archivo`.
