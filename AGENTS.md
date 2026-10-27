# Reto Vibra+ UNAB 2026 — Reglas para todos los agentes

> Fuente única de verdad. La leen Claude Code (vía CLAUDE.md), agy y OpenCode. Mantener corto (< 150 líneas).
> Las capacidades viven en `.agents/skills/` (ver sección 7).
> El estado del día va en `docs/evento/bitacora.md`, no aquí.

## 1. Hechos del reto (fuente: bases oficiales)
Solo esto es seguro. Detalle y cronograma en `docs/01-reto-hechos.md`.
- Hackathon presencial de 48 h (martes 27 oct 3:00 p. m. → jueves 29 oct, presentaciones 3:00 p. m.), sprint de design thinking.
- Temática: transformación social (inclusión, calidad de vida, bienestar colectivo).
- Jurado: personal de la Fundación aliada (no son ingenieros). Mentores: profesores UNAB, 4 retroalimentaciones.
- Organiza Ingeniería Biomédica. Equipo: Camilo (Sistemas) + Silvia, Natalia, Andrés, Manuel (Biomédica).

## 2. Lo que NO sabemos (no asumir)
- Fundación y problema · rúbrica · tipo de solución esperada · materiales y equipos disponibles · si hay buena señal de celular o internet en el lugar del problema · duración del pitch (las bases no la dicen; el profe Fabián habla de 10 min: confirmar en la apertura).
Si una tarea depende de esto: pregunta, o decide lo más simple y anótalo en `docs/evento/decisiones.md`.

## 3. Problema (se llena el martes en el checkpoint 2, COMPLETO antes de cerrar)
- Fundación:
- Usuario principal:
- Usuario secundario:
- Frase (máx. 30 palabras, sin solución adentro):
- Criterio de éxito (qué cambia para el usuario, no cómo):
- Restricciones: ver `docs/evento/restricciones.md`

## 4. Decisiones técnicas (vacío hasta el checkpoint 3; se escoge DESPUÉS de idear)
- Idea y nombre:
- Qué aporta Biomédica (obligatorio):
- Tipo de solución:
- Stack (por defecto, recomendación del profe Fabián): Laravel MVC como API REST + Docker, desplegado en Render. Frontend: el que la idea pida, consumiendo la API. Cambiarlo solo si una restricción lo exige y anotarlo en decisiones.
- Endpoints y ejemplo de respuesta JSON de cada uno (se definen ANTES de programar):
- Qué se simula en la demo:
- Contrato de datos:
- Carpetas y dueños: `backend/` (Laravel) · `frontend/` · `firmware/` (si hay hardware) · `docs/`

## 5. Reglas del sprint
1. Un solo flujo de punta a punta primero. Cero extras antes.
2. Si el jurado no lo ve y no ayuda a la demo, no se hace (ej.: service worker, arquitectura invisible). Login solo si la demo necesita usuarios o roles, y entonces con Sanctum, sin reinventar.
3. Hardware siempre OPCIONAL hasta confirmar materiales. La solución tiene que valer sin él; lo que falte se simula.
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
| prototipo-hardware | Sensores, Arduino, ESP32, Wokwi | `docs/evento/hardware.md`, `firmware/` |
| verificar-cifras | Cualquier número, precio o cita | `docs/evento/fuentes.md` |
| pitch | Guion, diapositivas, ensayo | `docs/evento/pitch.md` |
| checkpoint (`/checkpoint N`, solo manual) | Al cerrar cada checkpoint y antes de mentorías | `docs/evento/bitacora.md` |
| demo-check (`/demo-check`, solo manual) | Antes de cada mentoría y el jueves | `docs/evento/demo-check.md` |

