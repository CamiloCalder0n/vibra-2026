---
name: pitch
description: "Construye y ensaya el pitch para el jurado de la fundación (no técnico) en versión de 5 y de 10 minutos: persona y momento real, problema con cifra verificada, demo con guion, cómo funciona por dentro, qué aporta Ingeniería Biomédica, costo verificado, impacto y siguiente paso, con los 5 integrantes hablando y banco de preguntas difíciles. Usar al preparar guion, diapositivas, ensayo, tiempos o respuestas al jurado."
argument-hint: "[cambios o comentarios del mentor, opcional]"
---

# Pitch para el jurado de la fundación

Comentarios a incorporar: $ARGUMENTS

Entradas obligatorias: `docs/evento/notas-fundacion.md`, `docs/evento/flujos.md`, `docs/evento/aporte-biomedica.md`, `docs/evento/fuentes.md`. Si falta alguna, avisar y NO inventar su contenido.
Salida: `docs/evento/pitch.md`.

## Estructura
La duración no está en las bases; el profe Fabián habla de 10 minutos. Preparar las dos versiones y confirmar en la apertura.
Orden (profe Fabián): primero que el jurado entienda el problema, luego cómo lo resolvemos, combinando lo funcional con lo técnico.

### Versión 5 minutos
| Bloque | Dura | Contenido |
|---|---|---|
| 1. Gancho | 30 s | Una persona y un momento concretos de lo que contó la fundación, con sus palabras |
| 2. Problema | 35 s | Máximo 2 datos: un testimonio de la fundación y una cifra VERIFICADA (frase exacta de fuentes.md) |
| 3. Demo en vivo | 90 s | La historia de flujos.md; decir qué está simulado |
| 4. Cómo funciona + Biomédica | 30 s | Sin jerga, y las 3 frases de aporte-biomedica.md |
| 5. Viabilidad y costo | 35 s | Costo total en COP con desglose y fuente; quién lo usa y lo mantiene |
| 6. Impacto y siguiente paso | 30 s | Impacto como hipótesis medible; propuesta de piloto con la fundación |
| 7. Cierre | 15 s | Nombre y frase memorable |

### Versión 10 minutos (misma estructura, más profundidad)
Gancho 45 s · Problema 1:15 · Demo con guion 3:00 · Cómo funciona por dentro 1:30 (Camilo: arquitectura Laravel MVC, API, Docker, despliegue; sin siglas sin explicar) · Biomédica 1:15 · Costo y viabilidad 1:00 · Impacto y siguiente paso 0:45 · Cierre 0:30.

## Reglas
- Lenguaje de la fundación: nada de "API", "ESP32", "backend", "app web" en voz alta salvo que pregunten.
- Toda cifra y precio con estado VERIFICADA o PARCIAL en fuentes.md, dicho con su alcance. Si no, se elimina.
- Nunca culpar al personal: el jurado ES ese personal.
- Hablan los 5 (recomendación del profe Fabián: hablan todos). Sugerencia: gancho y cierre (Biomédica), problema (Biomédica), demo (Camilo maneja, otro narra), Biomédica (investigación de usuario), costo e impacto (Biomédica).
- Plan B de demo: capturas en la diapositiva 3 y video listo.
- Rúbrica desconocida: cubrir impacto social, viabilidad, innovación, claridad, trabajo con el usuario y sostenibilidad. Si la fundación comparte criterios, ajustar.

## Banco de preguntas difíciles (respuesta de 2 frases cada una, ensayadas en voz alta)
¿Qué aporta Ingeniería Biomédica? · ¿Cuánto cuesta y quién lo paga? · ¿Quién mantiene la información al día? · ¿Lo probaron con usuarios? · ¿Qué pasa si falla, no hay internet o no hay señal? · ¿Qué datos personales guardan? · ¿Por qué esto sí se va a usar y no terminará en un cajón? · ¿Qué pasa si alguien no puede cumplir el paso obligatorio? · ¿En qué se diferencia de lo que ya existe? · ¿Qué sigue mañana con la fundación?

## Ensayo
Ensayar mínimo 3 veces con cronómetro, cada versión y registrar los tiempos en pitch.md. Al final, correr la skill verificar-cifras sobre el guion.
