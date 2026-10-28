# Color: app Refugio Yesenia

Sale de muestrear píxeles de `refugio-yesenia-instagram.png` con PIL (promedio de píxeles dentro de ±24 del color dominante en cada zona). Los contrastes se calcularon con `ds/tools/contrast.py`, que usa la fórmula de luminancia relativa de WCAG 2.x.

## 1. Colores de marca extraídos

| Nombre | Hex | De dónde sale |
|---|---|---|
| Crema logo | `#F0EDCC` | Fondo del círculo del logo y de los destacados |
| Oliva wordmark | `#515234` | Letras "YESENIA" del logo. Al muestrear sale oliva oscuro, no café. Es el mismo tono del fondo del post "Detrás de cada peludito" (`#505234`) |
| Café chocolate | `#83573E` | Cara del perro, "REFUGIO" pequeño, "VAQUITA ADOPTADA", la píldora @refugioyesenia y "AYUDAR" |
| Mantequilla | `#FCF7C2` | Fondo de los posts tipo cartel. Es amarillo pálido, no beige |
| Huella amarilla | `#EFDB7C` | Las huellitas ilustradas del post "Vaquita" |
| Lengua | `#922F18` | La lengua del perro del logo, el único rojo de la marca |

## 2. Tokens de interfaz (modo claro, roles HIG)

| Token | Rol HIG equivalente | Hex | Origen |
|---|---|---|---|
| `fondo` | systemGroupedBackground | `#F7F3D9` | Mantequilla aclarada |
| `superficie` | secondarySystemGroupedBackground | `#FFFEF7` | Blanco con un toque de mantequilla |
| `superficie-elevada` | hojas, modales | `#FFFFFF` + sombra cálida `rgba(37,38,15,.12)` | — |
| `texto-primario` | label | `#25260F` | Oliva wordmark llevado casi a negro |
| `texto-secundario` | secondaryLabel | `#55563A` | Oliva wordmark |
| `separador` | separator | `#DDD7B4` | Es decorativo y no lleva texto |
| `accion-primaria` / su texto | tint, botón relleno | `#4A4B2C` / `#FCF7C2` | Oliva wordmark sobre mantequilla, como el logo |
| `accion-secundaria` | botón con borde | texto y borde de 2 px `#7A4E36` sobre `superficie` | Café |
| `estado-bien` | — | texto/ícono `#33401A`, relleno opcional `#E3E9C9` | Oliva verdoso |
| `estado-atencion` | — | relleno `#F2D667`, texto `#3D2F00` | Huella amarilla |
| `estado-urgente` (medicina pendiente) | — | relleno `#922F18`, texto `#FFFFFF` | Lengua |
| `estado-nuevo` | — | relleno `#FCF7C2`, borde de 2 px y texto `#7A4E36` | Mantequilla + café |
| `foco` | anillo de foco | anillo de 3 px `#25260F` con 2 px de separación `#FFFEF7` | — |

## 3. Contraste WCAG

| Texto / fondo | Ratio | Resultado |
|---|---|---|
| texto-primario / fondo | 13.78 | AAA |
| texto-primario / superficie | 15.24 | AAA |
| texto-primario / elevada | 15.41 | AAA |
| texto-secundario / fondo | 6.76 | AA (solo texto ≥ 17 pt) |
| texto-secundario / superficie | 7.48 | AAA |
| texto-secundario / elevada | 7.56 | AAA |
| texto de acción primaria / acción primaria | 8.24 | AAA |
| acción primaria / fondo (contorno) | 8.05 | Pasa |
| acción secundaria / superficie | 6.99 | AA (texto de botón ≥ 20 pt, en negrilla) |
| acción secundaria / fondo | 6.32 | AA |
| estado-bien / su relleno | 8.87 | AAA |
| estado-bien / superficie (sin relleno) | 11.00 | AAA |
| atención: texto / relleno | 9.09 | AAA |
| urgente: blanco / relleno | 7.95 | AAA |
| urgente como texto / superficie | 7.86 | AAA |
| urgente como texto / fondo | 7.11 | AAA |
| nuevo: texto / relleno | 6.47 | AA (insignia en negrilla) |
| foco / superficie · fondo | 15.24 · 13.78 | Pasa el 3:1 que se exige a componentes no textuales |

Ajustes respecto a la marca cruda:
- El oliva bajó de `#515234` a `#4A4B2C` en los botones.
- El café bajó de `#83573E` a `#7A4E36`: el original daba 5.66 sobre mantequilla y ahora da 6.47.
- La lengua `#922F18` se usa tal cual, porque ya pasa.

## 4. Reglas de estado

- **Cada estado tiene su propia claridad.** Luminancia relativa de cada uno:
  - nuevo, relleno pálido con borde: 0.91
  - bien, sin relleno o con un relleno muy pálido: 0.79
  - atención, amarillo medio: 0.68
  - urgente, oscuro sólido: 0.08

  Aunque se pase a escala de grises o la persona tenga daltonismo, urgente se ve oscuro, atención se ve de valor medio y bien queda casi en silencio.
- **Siempre ícono + palabra**:
  - Bien: chulito y "Bien".
  - Atención: perrito con signo de pregunta y "Revisar".
  - Urgente: frasco de medicina y "Falta darle".
  - Nuevo: casita y "Llegó hace X días".

  El color nunca es la única señal.
- **No hay verde ni rojo puros.** Bien es oliva grisáceo y urgente es rojo ladrillo oscuro. Además se diferencian por claridad y por relleno: urgente lleva relleno sólido y bien no lleva.
- **Por registro por excepción, "bien" es el estado más callado.** El color fuerte se reserva para lo que pide acción.
- **Solo hay un relleno oscuro saturado por pantalla.** Urgente no compite con la acción primaria: esta es oliva y urgente es ladrillo, con distinto tono.

## 5. Por qué es de Yesenia y no un cliché

- **El fondo no es crema-beige `#F4F1EA`.** Es la mantequilla amarilla real de sus carteles. Se nota más cálida y más "de ella" que un hueso neutro.
- **El color de mando es el oliva de su wordmark**, no terracota ni el azul de iOS. Con oliva sobre mantequilla, el botón principal se lee como su propio logo.
- **El café chocolate de la carita de perro** queda para lo secundario y lo "nuevo". Así se separan claramente los dos tonos de su marca.
- **El único rojo es la lengua del perro**, y aparece solo cuando falta una medicina. Es la señal más fuerte de la app.
- **Tiene la estructura de Apple** (fondo agrupado, superficies que flotan, etiquetas primaria y secundaria), pero los grises están teñidos de oliva. No es el gris frío de iOS genérico ni la salvia que el cliente ya rechazó.
