---
name: aporte-biomedica
description: "Construye la respuesta explícita a qué aporta Ingeniería Biomédica aunque no haya hardware: especificación de uso, escenarios de error de uso con mitigaciones, prueba rápida con usuarios medida con la escala SUS en español, seguridad del paciente y rangos fisiológicos. Usar en la ideación, al definir la propuesta de valor, al diseñar la prueba con usuarios, al preparar preguntas del jurado, o cuando pregunten por el rol de Biomédica."
---

# Aporte de Ingeniería Biomédica

Salida: `docs/evento/aporte-biomedica.md` y 3 frases para el pitch. Lo trabajan los 4 de Biomédica; la IA prepara, ellos deciden.

## 1. Especificación de uso (enfoque de la IEC 62366-1)
Usuarios previstos (edad, visión, motricidad, cognición, manejo de tecnología, cansancio, turno), entorno (ruido, luz, conectividad, espacio), tarea principal y frecuencia, y lo que la solución NO hace.

## 2. Escenarios de error de uso (mínimo 3)
| Tarea | Error de uso previsible | Consecuencia para la persona | Mitigación en el diseño | Cómo se ve en la demo |
Priorizar los que afectan seguridad o bienestar (p. ej., dosis repetida, alerta que no llega, dato mal marcado).

## 3. Prueba rápida con 3–5 personas (evaluación formativa)
- Medir: tarea lograda (sí/no), errores, tiempo, comentarios textuales.
- SUS en español: usar la versión validada de Sevilla-González et al., JMIR Human Factors 2020 (https://www.ncbi.nlm.nih.gov/pmc/articles/PMC7773510/). Copiar los 10 ítems de ese artículo; no inventarlos. Puntaje: ítems impares = respuesta − 1; pares = 5 − respuesta; suma × 2,5 = 0–100.
- Reportar la n real ("con 4 personas, SUS promedio X"). Nunca extrapolar a toda la población.

## 4. Si hay variables fisiológicas o escalas clínicas
Variable o escala, rango o punto de corte, para qué decisión sirve, fuente (pasa por verificar-cifras) y por qué la solución NO diagnostica. Escalas clínicas (riesgo de caídas, actividades de la vida diaria, etc.) solo en versión validada en español y verificada.

## 5. Frases para el pitch
"Desde Ingeniería Biomédica: (1) definimos para quién y en qué contexto es seguro usarlo; (2) identificamos N errores de uso y los evitamos en el diseño; (3) lo probamos con N personas: SUS = X."

## Prohibido
Decir que se cumple la IEC 62366, la ISO 14971 o que tiene registro sanitario. Decir: "aplicamos el enfoque de ingeniería de usabilidad de la IEC 62366-1".
