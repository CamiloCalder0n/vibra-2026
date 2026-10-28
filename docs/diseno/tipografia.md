# Tipografía: app Refugio Yesenia (tablet 10", 1280×800, a ~40 cm)

## 1. Familias (solo 2)

| Rol | Google Fonts | Pesos | Por qué |
|---|---|---|---|
| Display | **Big Shoulders** (variable, eje `opsz`; antes "Big Shoulders Display") | 700, 800 | Es condensada, alta y de remate recto, igual que el wordmark YESENIA. Tiene ese aire de cartel callejero sin caer en la serif genérica. Solo va en títulos de 40 px o más; nunca en párrafos. |
| Texto | **Atkinson Hyperlegible Next** | 400, 500, 700 | La hizo el Braille Institute para personas con baja visión. Distingue bien I/l/1, 0/O y 5/S, que es justo lo que se confunde en dosis y horas. Sus formas abiertas y redondeadas recuerdan la letra de "Vaquita adoptada". Tiene cifras tabulares. |

Respaldo: `Big Shoulders` → `"Big Shoulders Display", "Arial Narrow", sans-serif`; `Atkinson Hyperlegible Next` → `"Atkinson Hyperlegible", sans-serif`.

## 2. Escala (base 1×; Dynamic Type con `--t: 1 | 1.15 | 1.3`)

| Rol (Apple) | Familia / peso | Tamaño / interlineado | Tracking | Uso |
|---|---|---|---|---|
| Large Title | Big Shoulders 800 | 56 / 60 px | +0.5 px | Título de cada pantalla ("Medicinas de hoy") y el wordmark |
| Title 1 | Big Shoulders 700 | 44 / 50 px | +0.25 px | Nombre del perro en la ficha |
| Title 2 | Atkinson 700 | 32 / 40 px | 0 | Secciones ("Necesitan atención") |
| Title 3 | Atkinson 700 | 28 / 36 px | 0 | Hora de la dosis, número grande del estado general |
| Headline | Atkinson 700 | 26 / 34 px | 0 | Nombre del perro en listas, texto de los botones |
| Body | Atkinson 400 | 24 / 36 px | 0 | Texto corriente y preguntas paso a paso |
| Callout | Atkinson 500 | 22 / 32 px | +0.1 px | Ayudas bajo un botón, estado ("Comió poco") |
| Footnote | Atkinson 400 | 20 / 28 px | +0.2 px | Solo metadatos ("Reportado ayer") |

Nada baja de 20 px. Las cajas de texto usan Body. `font-size: calc(24px * var(--t))`.

## 3. Reglas

- **Sentence case siempre**: "Ya se la di", "En busca de hogar". Nada de etiquetas en MAYÚSCULAS. La única excepción es el logotipo YESENIA.
- **Números tabulares** en horas, dosis, pesos y conteos: `font-variant-numeric: tabular-nums;`. Así las horas quedan alineadas en columna y no "bailan" al cambiar.
- **Horas en formato de 12 horas, como se dice en Colombia**: "8:00 a. m.", "2:30 p. m.", "12:00 m.". Sin cero inicial. Va un espacio fino que no se corta entre la cifra y "a. m." (`8:00&#8239;a.&nbsp;m.`), para que nunca se parta en dos renglones. Para referencias cercanas se usa "Hoy", "Ayer" o "Hace 3 días", nunca fechas ISO.
- **Longitud de línea**: entre 45 y 60 caracteres (`max-width: 32em` en Body). En la tablet en horizontal, el texto va en columnas y nunca a lo ancho de los 1280 px.
- **Alineación** a la izquierda, sin justificar y sin cortar palabras con guion (`hyphens: none`).
- **Peso para jerarquía**: se usa 400, 500 o 700. Nada más delgado que 400, ni gris claro sobre crema. El contraste del texto es de al menos 7:1 (AAA).
- **Nada de cursivas** para dar énfasis; se usa 700.
- **Los números de dosis van en cifras**: "2 pastillas", no "dos pastillas".

## 4. Link de Google Fonts (css2)

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:wght@400;500;700&family=Big+Shoulders:wght@700;800&display=swap" rel="stylesheet">
```

Como la app es una PWA sin internet, el service worker debe guardar en caché el CSS y los `.woff2` de fonts.gstatic.com desde la primera carga, o hay que alojarlos en la app.
