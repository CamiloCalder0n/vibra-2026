---
name: checkpoint
description: "Cierra un checkpoint del equipo: revisa que su entregable esté completo, lo marca como hecho en docs/00-inicio.md, registra avances, bloqueos y horas restantes en docs/evento/bitacora.md con hora de Bogotá, prepara la próxima mentoría y hace commit. Usar solo cuando el usuario invoque /checkpoint."
disable-model-invocation: true
argument-hint: "[número de checkpoint, opcional]"
---

# Checkpoint $ARGUMENTS

1. Hora: ejecutar `TZ=America/Bogota date "+%Y-%m-%d %H:%M"`. Nunca usar UTC ni la hora que creas saber.
2. Calcular horas restantes hasta el jueves 2026-10-29 15:00 (Bogotá).
3. Si se dio un número: revisar en `docs/00-inicio.md` el entregable de ese checkpoint. Decir qué falta. Si está completo, cambiar su estado a "hecho".
4. Comparar el avance real con las tareas de `docs/evento/flujos.md`.
5. AGREGAR al final de `docs/evento/bitacora.md` (solo agregar; el archivo usa merge=union):

   ### [AAAA-MM-DD HH:MM] Checkpoint $ARGUMENTS — quedan N h
   - Hecho (visible en la demo):
   - En curso (responsable):
   - Bloqueos y a quién se pide ayuda:
   - Decisiones (ver decisiones.md):
   - Riesgo principal ahora:
   - Próximas 2 horas:

6. Si viene una mentoría (4 en total): proponer 3 preguntas concretas para el mentor. Después de la mentoría, anotar su respuesta y la acción que sale de ella.
7. Si el avance va más de 2 horas atrasado: proponer qué sacar de "Dentro" en flujos.md.
8. Commit: `git add -A && git commit -m "Checkpoint $ARGUMENTS"`.
