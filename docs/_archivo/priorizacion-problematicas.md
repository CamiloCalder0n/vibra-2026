---
tags: [evento, definir, priorizacion]
---
# Priorización de problemáticas: 4 lentes (27 oct, 9:30 p. m.)

Cuatro análisis independientes sobre las mismas citas: operación, biomédica, factibilidad (hardware barato, escondido, sin internet) y jurado. Fuente: [[notas-fundacion]] y [[restricciones]].

## Ranking consolidado
| # | Problemática | Operación | Biomédica | Factibilidad | Jurado | Veredicto |
|---|---|---|---|---|---|---|
| 1 | **Medicación en el cambio de turno (Rocco)** | 1.º | 1.º | 1.º | 1.º | **Unánime. Núcleo** |
| 2 | **Síntomas que se notan tarde (Nube)** | 3.º | 2.º (la más biomédica) | 6.º (la celda de carga se moja y se descalibra) | 2.º (la más emotiva) | **Fuerte; demo con riesgo medio** |
| 3 | **Información del perro ausente en el canil (Toby)** | 4.º | — | 2.º | 3.º | **Fuerte y barata** |
| 4 | Saber qué ya se hizo en el turno (tablero, paseos repetidos) | 2.º | — | 3.º | 5.º (suena a app) | Va unida a la 1 y a la 3 |
| 5 | Peleas y ladridos de noche | 7.º | 5.º | 5.º (solo con umbral de volumen; no TinyML) | 6.º (solo lo dice el vecino) | Complemento |
| 6 | Escapes por la puerta | 6.º | 9.º | 3.º | 9.º (banal) | Extra si sobra tiempo |
| 7 | Ingreso sin historial / cuarentena | 10.º | 3.º | 7.º | 10.º | Es protocolo, no dispositivo |
| 8 | Todo depende de la encargada (pagos, llamadas) | Raíz alta | — | No es de hardware | Delicado | Contexto del pitch, no objetivo |
| — | Adopciones lentas · plata · transporte · olor | — | — | No es de hardware o la demo es mala | Poca emoción o riesgoso | **Fuera** |

## Causas raíz (operación)
- C1: el estado de cada perro no está donde se actúa → Rocco, Toby, tareas repetidas.
- C2: nadie vigila a los perros de forma continua, solo ojos humanos ocupados → Nube, peleas, escapes.
- C3: el conocimiento está en la cabeza de la encargada.
- Ciclo vicioso: el voluntario no sabe qué hacer → se va → más carga → menos registro.

## Advertencias para el pitch (biomédica + jurado)
- NO decir: "detecta parvovirus / moquillo / ehrlichiosis", "mide la fiebre" (el IR sobre pelo no es temperatura corporal), "mide dolor", "reduce X % los errores", "reemplaza al veterinario".
- SÍ decir: "alerta de un cambio; la persona o el vet decide".
- Rocco como falla del sistema ("una casilla en papel no basta"), nunca "alguien se equivocó".
- Nube: "las señales estaban, pero nadie podía juntarlas", no "los voluntarios no se fijaron".
- No abrir con olor, escapes ni peleas: suena a que el albergue molesta (y el vecino dice que "la señora es un ángel").
- No afirmar la edad de la señora (el Gem dice 48, el profe ~70).

## Trampas técnicas (factibilidad)
Temperatura IR sobre pelo · TinyML de audio en 48 h · SOS por GSM (saldo, 2G en retiro) · sensores de gas MQ (precalentamiento y deriva) · cama con piezo · test de carácter (implica asustar perros) · cámaras.

## Combinación recomendada
- Menor riesgo (factibilidad): **Tablero vivo + reloj de medicinas que no se calla + canil que habla** (ESP32, RTC con pila, sensor Hall, LEDs, DFPlayer, batería 18650). Cubre 1, 3 y 4. Sin internet; adentro y fijo.
- Capa de innovación (biomédica): **ingesta por celda de carga** para Nube, si la demo resulta confiable.
