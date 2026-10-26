# Reto Vibra+ UNAB 2026 — Reglas para todos los agentes

> Fuente única de verdad. La leen Claude Code (vía CLAUDE.md), agy y OpenCode. Mantener corto (< 150 líneas).
> El estado del día va en `docs/evento/bitacora.md`, no aquí.

## 1. Hechos del reto (fuente: bases oficiales)
Solo esto es seguro. Detalle y cronograma en `docs/01-reto-hechos.md`.
- Hackathon presencial de 48 h (martes 27 oct 3:00 p. m. → jueves 29 oct, presentaciones 3:00 p. m.), sprint de design thinking.
- Temática: transformación social (inclusión, calidad de vida, bienestar colectivo).
- Jurado: personal de la Fundación aliada (no son ingenieros). Mentores: profesores UNAB, 4 retroalimentaciones.
- Organiza Ingeniería Biomédica. Equipo: Camilo (Sistemas) + Silvia, Natalia, Andrés, Manuel (Biomédica).

## 2. Lo que NO sabemos (no asumir)
- Fundación y problema · rúbrica · tipo de solución esperada · materiales y equipos disponibles · si hay buena señal de celular o internet en el lugar del problema.
Si una tarea depende de esto: pregunta, o decide lo más simple y anótalo en `docs/evento/decisiones.md`.

## 3. Problema (se llena el martes en el checkpoint 2, COMPLETO antes de cerrar)
- Fundación:
- Usuario principal:
- Usuario secundario:
- Frase (máx. 30 palabras, sin solución adentro):
- Criterio de éxito (qué cambia para el usuario, no cómo):
- Restricciones dichas por la fundación:

## 4. Decisiones técnicas (vacío hasta el checkpoint 3; se escoge DESPUÉS de idear)
- Idea y nombre:
- Qué aporta Biomédica (obligatorio):
- Tipo de solución:
- Stack:
- Qué se simula en la demo:
- Contrato de datos:
- Carpetas y dueños:

## 5. Reglas del sprint
1. Un solo flujo de punta a punta primero. Cero extras antes.
2. Si el jurado no lo ve y no ayuda a la demo, no se hace (ej.: service worker, login, arquitectura invisible).
3. Hardware siempre OPCIONAL hasta confirmar materiales. La solución tiene que valer sin él; lo que falte se simula.
4. Diseño por excepción: el usuario solo marca lo que cambió. Nadie llena formularios largos.
5. Todo en español y sin jerga. Datos ficticios; nunca datos reales de personas.
6. Cada cifra que vaya al pitch: frase textual + link + año + estado "Verificada" + revisión humana (`/verificar-cifras`).
7. Un agente no edita la carpeta de otro. Camilo integra a `main` antes de cada mentoría.
8. Si un agente lleva más de 10 minutos en algo que no está en `docs/evento/flujos.md`, se detiene y pregunta.

## 6. Memoria
- Antes de una tarea: leer las últimas 10 líneas de `docs/evento/bitacora.md` y solo el doc relacionado.
- Al terminar una tarea que cambió archivos: UNA línea en la bitácora con hora de Bogotá (`TZ=America/Bogota date`):
  `- AAAA-MM-DD HH:MM · [herramienta] · qué se hizo · qué sigue`
- Preguntas que no cambian nada: no se escribe.
- Si inventas algo que no está decidido (campo, ruta, formato, supuesto): anótalo en `docs/evento/decisiones.md` ANTES de seguir.
