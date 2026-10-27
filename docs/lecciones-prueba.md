---
tags: [vibra, lecciones]
---
# Lecciones de la prueba (24–25 oct, problema ficticio)

La prueba completa está en `~/Proyectos/vibra-prueba` (tag `prueba-cerrada`).

## Por fase
| Fase | Qué funcionó | Qué falló | Regla para el real |
|---|---|---|---|
| Empatizar | "¿Cómo lo hacen hoy?" y "¿qué han intentado?" sacaron lo más valioso | Preguntas con la solución adentro; dolores escritos con palabras propias; conclusión que culpaba al personal (que ES el jurado) | Plantilla abierta, cazar frases textuales y quién las dijo; buscar la causa común sin culpar a nadie |
| Definir | Dolor de fondo bien encontrado | Frase de 70 palabras; criterio con solución adentro; campos vacíos | Frase ≤ 30 palabras; llenar la sección 3 completa |
| Idear | Filtrar con las restricciones dejó 2 ideas fuertes; combinar ideas mejoró | La IA puntuó primero una idea que rompía una restricción | Filtro de restricciones ANTES de puntuar (skill idear) |
| Construir | Con `flujos.md` detallado la app salió fiel en ~40 min; 2 agentes en paralelo sin choques | Constructor gastó 10 min en algo invisible (service worker) | Regla 8: más de 10 min fuera de flujos.md → parar |
| Investigar | Pedir frase textual + link + estado mejoró mucho | 2 de 3 cifras mal atribuidas en v1; en v2 las frases del pitch exageraban el alcance | skill verificar-cifras + revisión humana de cada cifra del pitch |
| Pitch | Gancho con una persona y un momento reales; plan B; 10 preguntas | Sistemas no habla; sin respuesta a "¿qué tiene de biomédica?"; sin precio | Aporte de Biomédica definido en Idear; precio verificado; todos hablan |

## Respuestas difíciles que hay que tener listas
- **¿Qué tiene de biomédica?** Definirlo en el checkpoint 3, no en el pitch. Ejemplos posibles (por validar con los biomédicos): escala clínica validada, criterios de seguridad del paciente, ergonomía, validación del sensor.
- **¿Quién carga y actualiza la información base?** Nombrar un responsable real de la fundación y no asumir que hay una sola persona por turno.
- **¿Y si el usuario no puede cumplir el paso obligatorio?** Siempre una salida de emergencia ("cierre rápido") y que el resto del equipo de turno pueda completarlo.

## Lo que funcionó del método (se queda)
AGENTS.md como fuente única · Obsidian para ver y escribir · checkpoints con entregable · decisiones con el porqué · flujos.md antes de construir · agentes en carpetas separadas · simular lo que no exista.
