---
tags: [vibra, herramientas]
---
# Herramientas y quién las usa

| Herramienta | Para qué | Quién | Nota |
|---|---|---|---|
| Obsidian | Ver y escribir notas, decisiones, flujos | Todo el equipo | Abrir la carpeta `vibra-2026` como bóveda. Sin plugins |
| Claude Code | Construir (agentes en paralelo) e integrar | Camilo | Lee CLAUDE.md, que importa AGENTS.md |
| agy (Antigravity CLI) | Investigación y pitch en `docs/` | Biomédicos | Lee AGENTS.md solo. Sus cifras siempre pasan por `/verificar-cifras` |
| OpenCode | Respaldo si se acaba el uso de Claude | Camilo | Lee AGENTS.md solo, no hay que configurar nada |
| Git | Guardar cada avance; integrar antes de cada mentoría | Camilo | `bitacora.md` usa `merge=union`, no choca |

## Qué NO instalar para las 48 h (evaluado)
- **Spec Kit (GitHub):** su flujo (constitución → especificar → planear → tareas) es el mismo que ya tenemos (AGENTS.md reglas → sección 3 → sección 4 → flujos.md), pero con más archivos y pasos. Para 48 h, el nuestro es más liviano.
- **Colecciones de 100+ subagentes (awesome-claude-code-subagents):** útiles para copiar uno puntual si hace falta, no para instalar todo: más agentes = más contexto y más confusión.

## Comandos de Claude Code
| Comando | Cuándo |
|---|---|
| `/definir-problema` | Checkpoint 2 |
| `/idear` | Checkpoint 3 (filtra restricciones antes de puntuar) |
| `/checkpoint N` | Al cerrar cada checkpoint |
| `/verificar-cifras` | Antes de poner cualquier cifra en el pitch |
| `/demo-check` | Antes de cada mentoría y el jueves en la mañana |
| `/pitch` | Desde el miércoles en la noche |
