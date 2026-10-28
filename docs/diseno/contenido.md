# Contenido y estructura: app del Refugio Yesenia

Voz: la del Instagram del refugio, cálida y de barrio ("peludito", "en busca de hogar"), pero corta y clara. Siempre "usted". Frases de una línea. Cada botón dice lo que pasa, y la confirmación repite la misma palabra.

Menú fijo a la izquierda: **Hoy**, **Medicinas**, **Mis perros**, **Para el veterinario**. Arriba a la derecha, siempre visibles: **Un perro está mal** y **Llegó un perro**.

## 1. Hoy
Objetivo: ver de un vistazo quién necesita ayuda hoy.

```
+--------+---------------------------------------------------------+
| Hoy    | [día y fecha de hoy]    [Un perro está mal] [Llegó un perro]
| Medici-| Hoy hay 3 peluditos que la necesitan                    |
| nas    | +-----------------+ +-----------------+ +--------------+|
| Mis    | | Nube            | | Rocco           | | Bruno        ||
| perros | | Lleva 3 días    | | Cefalexina 8 p.m| | Recién llegó ||
| Para el| | comiendo poco   | | Falta darla     | | Falta revisar||
| veteri-| | [Ver a Nube]    | | [Ya se la di]   | | [Ver a Bruno]||
| nario  | +-----------------+ +-----------------+ +--------------+|
|        | Los otros [N] están bien                                |
+--------+---------------------------------------------------------+
```
- Título: "Hoy hay 3 peluditos que la necesitan" (si es uno: "Hoy hay 1 peludito que la necesita").
- Pie: "Los otros [N] están bien" (N calculado: perros en el refugio menos los que la necesitan; en la demo, 31).
- **Todos bien:** "Hoy todos sus peluditos están bien". Debajo: "Si alguno se ve mal, toque Un perro está mal". Sin tarjetas, solo la carita del logo.
- **Urgencia:** la tarjeta de Nube va primero y más grande: "Nube lleva 3 días comiendo poco y hoy está decaída. Llame al veterinario." Botón: **Ver a Nube**.

## 2. Un perro está mal
Objetivo: avisar en 3 toques qué le pasa a un perro.

```
+------------------------------------------------------------------+
| [Volver]          ¿Cuál perro está mal?                          |
| [foto Rocco] [foto Nube] [foto Toby] [foto Bruno] [foto Canela]  |
|------------------------------------------------------------------|
| ¿Qué le pasa a Nube?   (puede tocar varias)                      |
| [No comió] [Comió poco] [Está decaída] [Vomitó] [Diarrea]        |
| [Cojea]    [Tose]       [Tiene una herida]                       |
| [Grabar nota de voz]                                             |
|                                          [Guardar lo de Nube]    |
+------------------------------------------------------------------+
```
- Confirmación: "Listo, quedó guardado lo de Nube".
- Botón deshacer: **Me equivoqué, borrar**.
- Si no elige nada: "Toque lo que le pasa a Nube".

## 3. Medicinas
Objetivo: dar cada medicina una sola vez y a tiempo.

```
+--------+---------------------------------------------------------+
| (menú) | Medicinas de hoy                                        |
|        | Rocco  Cefalexina, 1 pastilla, cada 12 horas            |
|        |   Tarde    2:00 p. m.              [Ya se la di]        |
|        |   Noche    2:00 a. m.                                   |
|        | Canela Gotas para el ojo, 2 veces al día                |
|        |   Mañana   Dada a las 7:40 a. m.                        |
+--------+---------------------------------------------------------+
```
- Tras tocar: "Dada a las [hora real]". El botón desaparece.
- Si toca otra vez: "Rocco ya se tomó la cefalexina a las [hora]. La próxima es a las 2:00 a. m." Botón único: **Entendido**.
- Vacío: "Hoy no hay medicinas que dar".

## 4. Mis perros
Objetivo: encontrar a cualquier perro rápido.

```
+--------+---------------------------------------------------------+
| (menú) | Mis perros (35)               [Buscar por nombre]       |
|        | [Todos] [Están mal] [En busca de hogar] [Adoptados]     |
|        | [foto] Rocco   [foto] Nube    [foto] Toby  [foto] Bruno |
|        |  Toma medicina  Está mal       Está bien    Recién llegó|
+--------+---------------------------------------------------------+
```
- Búsqueda sin resultado: "No hay ningún perro llamado así".

## 5. Ficha del perro
Objetivo: ver cómo ha estado y cómo cuidarlo.

```
+------------------------------------------------------------------+
| [Volver]  [foto] Nube   Hembra, criolla blanca, 4 años           |
| ! Nube lleva 3 días seguidos mal. Llame al veterinario.          |
| Últimos 7 días:  mié  jue  vie  sáb  dom  lun  mar               |
|                  bien bien bien poco poco poco decaída            |
| Cuidados           | Vacunas               | Notas de voz        |
| Comida blanda      | Rabia: abril 2026     | [Escuchar] 26 oct   |
|                    | Moquillo: falta       | [Grabar nota de voz]|
|                         [Un perro está mal] [Cambiar datos]      |
+------------------------------------------------------------------+
```
- El aviso de 3 días sale solo; no hay que hacer nada.
- Toby, en Cuidados: "No se la lleva bien con otros machos. Póngalo con hembras."

## 6. Llegó un perro
Objetivo: anotar al recién llegado, una pregunta por pantalla.

1. "¿Cómo se llama?" (si no tiene: **Todavía no tiene nombre**)
2. "Tómele una foto" **Tomar foto**
3. "¿Es macho o hembra?" **Macho** **Hembra** **No sé**
4. "¿Cómo llegó?" **Bien** **Flaco** **Herido** **Enfermo**
5. "¿Tiene vacunas?" **Sí** **No** **No sé**
6. **Guardar a [nombre]** (en la demo: Lucero)

Barra de pasos: "Paso 2 de 5". Siempre: **Atrás**.
Confirmación: "Bienvenido, [nombre]. Ya está en Mis perros." Si eligió No sé en vacunas: "Pregúntele al veterinario por las vacunas de [nombre]". Si toca "Todavía no tiene nombre", se guarda como "Sin nombre".

## 7. Para el veterinario
Objetivo: mostrarle al veterinario lo importante en una sola hoja.

```
+--------+---------------------------------------------------------+
| (menú) | Para el veterinario     [últimos 7 días, calculado]      |
|        | Nube   3 días comiendo poco, hoy decaída                |
|        | Rocco  Cefalexina cada 12 h, va en el día 4             |
|        | Bruno  Recién llegado, flaco, vacunas no se sabe        |
|        |   [Llamar al veterinario] [Mandarle un mensaje] [Mostrar]|
+--------+---------------------------------------------------------+
```
- Vacío: "Esta semana no hay nada que contarle al veterinario".
- "Llamar al veterinario" abre el marcador (`tel:`). "Mandarle un mensaje" abre SMS con el resumen (`sms:`). Nada de WhatsApp: ella solo contesta llamadas (U11).

## Glosario

| Sí decir | No decir |
|---|---|
| Un perro está mal | Registrar incidencia |
| Guardar lo de Nube | Enviar, Registro |
| Ya se la di / Dada a las... | Marcar como administrado |
| Mis perros | Inventario, Base de datos |
| Para el veterinario | Reporte, Dashboard |
| Hoy | Inicio, Panel |
| Llegó un perro | Nuevo ingreso, Alta |
| Cambiar datos | Editar, Actualizar |
| Peludito | Animal, Usuario, Ítem |
| Se guarda solo | Sincronizar, Sin conexión |

## Datos de ejemplo (ficticios)

| Perro | Cómo es | Estado |
|---|---|---|
| Rocco | Macho, pitbull café, 5 años | Toma cefalexina cada 12 h (2:00 p. m. y 2:00 a. m.) |
| Nube | Hembra, criolla blanca, 4 años | 2 días comiendo poco; en la demo se reporta "decaída" y sale el aviso |
| Toby | Macho, negro con pecho blanco, 6 años | Bien; no tolera machos |
| Bruno | Macho, criollo canela, ~2 años | Recién llegado, flaco, vacunas no se sabe |
| Canela | Hembra, mestiza mona, 8 años | Gotas en el ojo |
| Mona | Hembra, pequeña y peluda, 3 años | En busca de hogar |
| Lucas | Macho, cachorro manchado, 5 meses | Bien |
| Princesa | Hembra, french poodle gris, 10 años | Bien |
| Pirata | Macho, tuerto, labrador cruzado | Cojea de la pata de atrás |
| Chispa | Hembra, cachorra negra, 4 meses | Adoptada |

La dueña no aparece con nombre en la app; los saludos son en "usted" ("la necesitan").
