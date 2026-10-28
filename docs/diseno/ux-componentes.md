# UX y componentes: Refugio Yesenia (tablet 1280×800, horizontal)

Unidad: px CSS = dp (en una 10" de 1280×800 coinciden).

## 1. Principios medibles

1. **Toque mínimo 64×64 px** (todo lo que se toca), principal 72 px de alto. Es más que los 44 pt de Apple y los 48 dp de Material porque ella usa dedos gruesos o sucios.
2. **16 px mínimo entre objetivos**, 24 px entre acciones opuestas (dar o no dar).
3. **Máximo 1 acción primaria y 5 opciones por pantalla.** Más de eso se convierte en búsqueda o se divide en pasos.
4. **Sin gestos ocultos**: nada de deslizar para borrar, mantener presionado ni pellizcar. Todo es un botón visible con texto.
5. **Deshacer en vez de "¿Está segura?"**: se guarda al instante y queda un toast de 8 s. La única excepción es la doble dosis, que se bloquea directamente.
6. **Respuesta en menos de 100 ms**: cambio de color, marca y vibración corta (50 ms). No se usa sonido, porque el barrio es ruidoso.
7. **Voz antes que teclado**: cada campo de texto trae micrófono de 64 px y todo se puede hacer sin escribir.
8. **Texto 20 px mínimo, títulos de 28 px o más, contraste 7:1** (WCAG AAA). Nada de texto gris claro.
9. **Etiqueta con texto en todo**: un ícono nunca va solo, y el color nunca es la única señal.
10. **Mismo lugar, mismo nombre**: la navegación no se mueve, las palabras salen de su forma de hablar ("Ya se la di", "Está mal") y ninguna pantalla está a más de 2 toques.

## 2. Navegación

**Barra lateral fija estilo iPadOS, 4 destinos, 220 px de ancho y siempre visible**: Hoy, Medicinas, Mis perros, Veterinario. Reportar y Llegó uno nuevo son acciones, no destinos, así que viven como botones dentro de Hoy y de Mis perros.
Por qué: en horizontal la parte de abajo queda lejos de los pulgares y las pestañas abajo se esconden con el teclado. El lateral con texto grande se ve siempre, no se colapsa y le dice dónde está (destino activo con fondo lleno). Apple recomienda la barra lateral para el nivel superior en iPad.

## 3. Componentes

| Componente | Especificación |
|---|---|
| Botón primario | 72 px de alto, mínimo 280 px de ancho, radio 18, texto 22 px semibold, color de marca lleno. Uno solo por pantalla. |
| Botón secundario | 64 px, solo borde de 2 px o fondo tenue, texto 20 px. |
| Fila agrupada (inset) | 72 px de alto, grupo con radio 14 y margen de 24 px, separador interno con sangría de 20 px, texto 22 px y dato a la derecha. |
| Tarjeta de perro | Foto 1:1 de 160 px (siempre la foto real), nombre 24 px y una sola línea de estado. Si está mal, borde de 3 px y fondo cálido; si está bien, sin adornos. Tarjeta entera tocable. |
| Chip de síntoma | 64 px de alto, mínimo 160 px de ancho, ícono y palabra. Al activarse se llena de color y aparece una palomita. Máximo 8 por pantalla, en 2 filas. |
| Hoja para reportar | Sube desde abajo hasta el 70 % de la altura. Arriba, foto y nombre del perro; en medio, los chips; abajo, "Guardar" primario. Botón "Cerrar" con texto. No se cierra deslizando. |
| Bloqueo de doble dosis | Reemplaza al botón: "Ya se la dio hoy a las 8:40 a. m." con una banda de 80 px y fondo de alerta. No hay "dar de todas formas". |
| Progreso de pasos | Pocos segmentos gruesos de 8 px y el texto "Paso 2 de 4" a 20 px. Botón Atrás siempre visible. |
| Estado vacío | Ilustración de marca de 200 px, "Hoy nadie está mal" a 32 px y un botón secundario "Reportar uno". |
| Toast con deshacer | 72 px, abajo al centro, 8 s, "Guardado: Nube" y botón "Deshacer" de 64 px. No tapa la acción primaria. |

## 4. Lo más visible en cada pantalla

1. **Hoy**: cuántos necesitan atención y quiénes son (o el estado vacío).
2. **Reportar**: los chips de síntomas.
3. **Medicinas**: la siguiente dosis pendiente con "Ya se la di".
4. **Mis perros**: las fotos, con los que están mal primero.
5. **Ficha**: los últimos 7 días como tira de colores, con la alerta de 3 días encima si aplica.
6. **Llegó uno nuevo**: la pregunta del paso actual.
7. **Veterinario**: la lista de perros con problema y su resumen.

## 5. Errores a evitar del mockup anterior

- **Tarjetas idénticas**: el que está bien se queda en silencio y solo resalta el que está mal.
- **Exceso de texto**: una línea de estado. El detalle va en la ficha.
- **Grid de 35 perros**: máximo 12 visibles (4×3) con búsqueda por voz o por nombre, y primero los que necesitan algo.
- Sombras iguales en todo, etiquetas en MAYÚSCULAS, "A · B", flechas en botones y emojis.
- Grises claros y un verde genérico: usar el café, el oliva y el amarillo de su marca con contraste real.

## Fuentes

- Apple HIG, Accesibilidad: https://developer.apple.com/design/human-interface-guidelines/accessibility
- Apple HIG, Barras laterales: https://developer.apple.com/design/human-interface-guidelines/sidebars
- NN/g, Usability for Senior Citizens: https://www.nngroup.com/articles/usability-for-senior-citizens/
- W3C WAI, Older Users and Web Accessibility: https://www.w3.org/WAI/older-users/
- WCAG 2.2, Target Size: https://www.w3.org/WAI/WCAG22/Understanding/target-size-minimum.html
- Material 3, Accessibility basics: https://m3.material.io/foundations/accessible-design/accessibility-basics
