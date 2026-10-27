---
name: verificar-cifras
description: "Verifica cifras, estadísticas, precios y citas antes de usarlos en docs o en el pitch: busca la fuente primaria, abre la página, copia la frase textual, revisa atribución, fecha, alcance geográfico y población, corrige la frase al alcance exacto y registra el resultado en docs/evento/fuentes.md. Usar siempre que aparezca un número, porcentaje, precio, costo, prevalencia o cita, y antes de cerrar el pitch."
---

# Verificar cifras y precios

Regla: un dato sin fila VERIFICADA o PARCIAL en `docs/evento/fuentes.md` no se usa.

## Checklist por dato (copiar y marcar)
- [ ] 1. Copiar la afirmación exacta tal como se quiere decir.
- [ ] 2. Buscar la fuente primaria en este orden: entidad oficial colombiana (DANE, MinSalud/SISPRO, alcaldía, gobernación, normativa) → artículo revisado por pares (SciELO, LILACS, PubMed, Redalyc) → OMS/OPS → prensa SOLO como pista para llegar a la primaria.
- [ ] 3. Abrir la fuente y copiar una frase textual de máximo 25 palabras. Si no se pudo abrir: NO VERIFICADA.
- [ ] 4. Revisar: ¿quién lo dice realmente? ¿fecha o año? ¿dónde (mundo, Colombia, una ciudad)? ¿a quién mide (población, edad)? ¿qué tipo de estudio (real, simulado, encuesta)? Una revista no es la universidad que hizo el estudio.
- [ ] 5. Reescribir la afirmación al alcance EXACTO de la fuente. Prohibido pasar de una ciudad al país, de un experimento simulado a "en la vida real", o de "dificultad" a "discapacidad severa".
- [ ] 6. Estado: VERIFICADA / PARCIAL (reescrita) / NO VERIFICADA (no usar) / NO ENCONTRADA. Nunca reemplazar por otra cifra "parecida".
- [ ] 7. Registrar la fila con hora `TZ=America/Bogota date "+%Y-%m-%d %H:%M"`.

## Fila en docs/evento/fuentes.md
| ID | Frase final (como se dirá) | Fuente (entidad, documento) | Link | Frase textual | Año o corte | Alcance | Estado | Verificó / hora |

## Precios (obligatorio para el costo de la solución)
- Mínimo 2 referencias por componente: link, tienda, fecha de consulta, precio en COP con IVA.
- Si está en USD: anotar tasa y fecha. Marcar "precio de referencia, no cotización".
- Costo total = suma de componentes + margen explícito. Nunca "aprox." sin desglose.

## Datos colombianos
Antes de usar cifras de discapacidad, salud o población, leer [references/fuentes-colombia.md](references/fuentes-colombia.md).

## Salida
Tabla de datos revisados y frases corregidas listas para pegar. Lo que no se pudo verificar se dice explícitamente.
