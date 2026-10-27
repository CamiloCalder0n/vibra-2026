---
name: idear
description: "Genera ideas de solución, las filtra primero contra las restricciones de docs/evento/restricciones.md y solo después puntúa las que sobreviven con criterios ponderados, incluido el aporte de Ingeniería Biomédica. Usar en la fase de ideación o brainstorming, o cuando se pida comparar, votar, rankear, puntuar o elegir ideas."
---

# Idear con restricciones primero

## Paso 0 — Precondición
Si `docs/evento/restricciones.md` no existe o está vacío: DETENERSE y pedir correr la skill definir-problema. Nunca puntuar sin restricciones.

## Paso 1 — Divergir (12 ideas, una línea cada una)
Incluir: solo software, dispositivo + software, proceso o servicio, y al menos 2 de bajo costo. No evaluar todavía.

## Paso 2 — Filtro duro (antes de cualquier puntaje)
Tabla idea × R1..Rn: Cumple / No cumple / Desconocido, con una línea citando la restricción. Además se descarta si:
- no se puede mostrar funcionando en 90 s;
- depende de hardware que quizá no exista y no se puede simular;
- es tan simple que no muestra ingeniería.
"No cumple" ⇒ se lista como descartada con su razón, sin puntaje. "Desconocido" ⇒ pregunta para la fundación o el mentor.

## Paso 3 — Puntuar solo las sobrevivientes (1–5, enteros, con justificación)
| Criterio | Peso |
|---|---|
| Impacto en el usuario principal | 30% |
| Factible en el tiempo que queda con materiales confirmados | 25% |
| Demostrable en vivo en 90 s | 20% |
| Aporte claro de Ingeniería Biomédica | 15% |
| Diferencia frente a lo que ya existe o ya intentaron | 10% |
Si la fundación comparte su rúbrica, ajustar los pesos y anotarlo en decisiones.

## Paso 4 — Finalistas (top 3)
Para cada una: flujo de demo en 3 pasos, qué se construye, qué se simula, riesgo principal, supuesto más débil, una prueba de 30 min que podría descartarla, nombre corto, stack simple y qué aporta Biomédica. Decir si combinar 2 ideas resuelve mejor el problema.

## Paso 5 — Decisión
La decide el equipo, no la IA. Registrar en `docs/evento/decisiones.md` la idea escogida y las descartadas con su porqué, con hora `TZ=America/Bogota date "+%Y-%m-%d %H:%M"`. Luego llenar la sección 4 de `AGENTS.md`.
