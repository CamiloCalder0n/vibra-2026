---
tags: [plan-b, contexto]
---
# Contexto para el plan B (para abrir en un chat nuevo)

Este documento resume todo lo necesario para trabajar el **plan B** sin depender del chat del plan A. Fecha: miércoles 28 oct 2026, 8:35 a. m. (Bogotá).

## 1. Quién y cómo trabajar
- **Cami** (Juan Camilo Calderón, Ing. Sistemas UNAB): líder técnico. Mac, Warp, Claude Code, Obsidian, Docker. Español colombiano casual, guías directas y listas para copiar. Quiere opiniones sinceras (no darle la razón siempre) y trabajar **juntos**: él construye, Claude guía.
- **Equipo:** Camilo (Sistemas) + Silvia, Natalia, Andrés, Manuel (Ing. Biomédica, empezando de cero en programación).
- **Repo:** `~/Proyectos/vibra-2026` (también es la bóveda de Obsidian). GitHub: `CamiloCalder0n/vibra-2026` (privado). Reglas en `AGENTS.md`. Skills en `.agents/skills/` (12, entre ellas `prototipo-hardware`, `idear`, `plan-demo`, `aporte-biomedica`, `verificar-cifras`, `pitch`, `checkpoint`, `demo-check`).
- **Regla para el plan B:** no tocar `backend/`, `frontend/` ni los docs del plan A. El plan B vive en `docs/plan-b/` (y `firmware/` si es hardware) y en la rama `plan-b`.

## 2. El reto (hechos)
- Hackathon **Reto Vibra+ UNAB 2026**, 48 h: mar 27 oct 3 p. m. → **jue 29 oct, presentaciones a las 3:00 p. m.** Mentorías: mié 2:20 p. m., jue 8:20 a. m. y jue 2:00 p. m.
- **Cliente real: Refugio Yesenia** (Instagram @refugioyesenia), Floridablanca: casa con luz y agua en un barrio pobre y peligroso. Dueña: señora de casi 70 años, muy bajos recursos, carácter fuerte, de barrio; solo contesta llamadas (no WhatsApp).
- El agente (Gem) del profe simula el albergue "Huellitas" (35 perros y 20 gatos, encargada de 48 años y equipo de 4). Sirve para entender dolores; los datos de la señora real mandan.
- **Lo que pidió el profe:** prototipo **funcionando** el jueves (penalización grave si los dispositivos fallan); Problema → Pregunta → Objetivo; pensar en la usuaria real; la plata no es el centro; dos caminos (gestión del albergue o la vida de un perrito). **A las 8 p. m. del martes dijo: "soluciones de página web no sirven; hay que ir por hardware".**
- **Pitch:** 3 min sin preguntas + demo breve. Jurado probable: la señora + personas de otras facultades.
- **Rúbrica (foto, sin confirmar si es la nuestra):** Innovación 40 %, Impacto 30 %, Presentación 30 %.
- **Profe Fabián** (mentor técnico): Laravel MVC, endpoints y JSON antes de programar, seeders realistas, Form Request, errores JSON, Docker, desplegar temprano, README/Postman, ramas y commits pequeños, congelar funciones el miércoles a las 10 p. m., video de respaldo, hablan todos, descansar.

## 3. El problema (cerrado)
**Frase:** el equipo del refugio pierde en cada cambio de turno qué necesita cada animal y qué ya se hizo, porque depende del papel y la memoria.
**Causa de fondo:** lo que pasa con cada perro no queda registrado en el momento ni visible para quien llega después.

| # | Problemática | Lo que dijeron (Gem) |
|---|---|---|
| 1 | Medicinas en el cambio de turno (Rocco) | "Olvidó anotarlo en la libreta... se la volvió a administrar" → doble dosis de cefalexina, gastritis, emergencia. 8 perros en tratamiento, 12 medicamentos al día, 3–5 fallas al mes, sobre todo el fin de semana (vet) |
| 2 | Síntomas que se notan tarde (Nube) | "Dejó un tercio de la comida... asumieron que solo era su carácter"; al 4.º día, encías blancas (vet) |
| 3 | El perro no "dice" cómo es (Toby) | "Nadie me lo advirtió y en su canil no había ninguna señal" (voluntario) |
| 4 | Nadie sabe qué ya se hizo | Tablero borroso de 2–3 días, 15 min esperando, 4–5 de 8–10 voluntarios se fueron en un mes |
| 5 | Peleas y ladridos de noche | "Conciertos de ladridos a medianoche" (vecino) |
| 6 | Todo depende de la dueña | "Si yo no estoy... no sabe qué llamadas hacer ni qué pagos priorizar" |

Cuidado en el pitch: no culpar a nadie ("una casilla de papel no alcanza"); no decir "detecta enfermedades" ni "mide la fiebre", sino "avisa de un cambio y el veterinario decide".

## 4. Requerimientos que el plan B también debe cumplir
- Funcionar en la demo sin fallar (P1); idealmente **hardware** (P2, lo que pidió el profe).
- Para una señora de casi 70: un toque, sin escribir, letra grande, voz, nada de gestos ocultos.
- **Costo casi cero** y piezas comunes reparables; **barrio peligroso:** nada visible ni fácil de robar (escondido o fijo).
- **Sin depender de internet** ni plan de datos; aguanta cortes de luz.
- **Nadie carga dispositivos** (ni ella ni los perros: nada de collares).
- Alertas por **llamada o SMS** antes que WhatsApp.
- Los **módulos de sensores pueden no existir** en el laboratorio: el hardware es opcional hasta confirmar materiales; lo que falte se simula (Wokwi).
- Datos ficticios en la demo.

## 5. Estado del plan A (no tocar)
- **Solución A:** app de tablet (PWA) para la dueña con **registro por excepción** (solo reporta el perro que está mal; los demás quedan "bien"), medicinas con bloqueo de doble dosis (409), aviso de 3 días seguidos, ficha del perro, perro nuevo en 5 pasos, resumen para el veterinario.
- **Backend:** Laravel 13 + Docker (MySQL local), en línea en Render (Postgres): https://refugio-yesenia-api.onrender.com/api/salud. Tareas 1–4 listas (contrato en `AGENTS.md` sec. 4, migraciones, seeders de 35 perros). Siguen las tareas 5–6 (endpoints) y 7–9 (frontend).
- **Endpoint útil para un plan B con hardware:** `POST /api/dosis/{id}/dar` → 200 o 409 si ya se dio. `GET /api/medicinas/hoy`. (Un dispositivo podría usar esto; pero el plan B debe poder funcionar solo.)
- **Diseño:** marca real del refugio (fondo mantequilla #F7F3D9, oliva #4A4B2C, café #7A4E36, ámbar #F2D667, rojo #922F18; letras Big Shoulders + Atkinson Hyperlegible Next). Ver `docs/diseno/00-sistema-diseno.md`.
- **Riesgos del plan A:** el profe pidió hardware; la usuaria real no está validada (visita hoy en la mañana); una sola persona construyendo.

## 6. Candidatos para el plan B (ya analizados)
Priorización hecha con 4 análisis (operación, biomédica, factibilidad, jurado). Las cámaras, la cámara térmica y la IA de visión se descartaron por costo y robo.

| Idea | Qué es | Ataca | Factibilidad 48 h | Notas |
|---|---|---|---|---|
| **Tablero vivo + reloj de medicinas** | Su mismo tablero con fichas con imán por perro (sensor Hall) que se prenden cuando toca la dosis; alarma que no se calla hasta voltear la ficha a "dado". Va adentro y fijo | 1, 3, 4 | Alta (ESP32, RTC DS3231 con pila, LEDs, buzzer, batería 18650) | Recomendada por factibilidad: sin internet, sin cámaras, barata |
| **El pastillero que recuerda** | Caja de medicinas con ESP32, botón grande "Ya se la di", LED y buzzer; a la hora suena; si ya se dio, parpadea | 1 | Alta | Recomendada por el agente de jurado; puede conectarse a la API del plan A |
| **El canil que habla** | Botón en la reja que dice en voz quién es el perro y qué cuidado tiene ("Soy Toby, no me cruces con machos") | 3 | Alta (DFPlayer + parlante) | Barata y simpática |
| **El oído del albergue** | Micrófono escondido que avisa peleas o quejidos de noche | 5 | Media (solo con umbral de volumen; TinyML en 48 h es trampa) | Muy innovadora, demo riesgosa |
| **Báscula del comedero / de paso** | Mide cuánto comió o pesa al perro al pasar; avisa si baja | 2 (Nube) | Media (celda de carga + HX711; agua y perros la descalibran) | La más biomédica |
| **Bebedero que mide la sed** | Mide el agua que toma cada canil | 2 | Alta | Biomédica: balance hídrico |

Trampas: temperatura IR sobre pelo (no es fiebre), TinyML de audio en 48 h, SMS por GSM (saldo, 2G), sensores de gas MQ, cama con piezo, test de carácter (asusta perros), cámaras.

## 7. Lo que falta decidir para el plan B
1. **Cuál idea** (o combinación de máximo 2).
2. **Quién lo construye** (recomendado: 1–2 de Biomédica, para no frenar a Camilo).
3. **Qué materiales hay** en el laboratorio o se pueden comprar hoy (ESP32/Arduino, LEDs, botones, buzzer, RTC, DFPlayer, celda de carga, protoboard, fuente). Si no hay, Wokwi.
4. Si es **independiente** del plan A o se conecta a su API (recomendado: que funcione solo y, si sobra tiempo, se conecte).

## 8. Cronograma que queda
- Mié 28, hasta las 12 m.: flujo completo del plan A. 2:20 p. m.: mentoría 2. **10:00 p. m.: congelar funciones.**
- Jue 29, 8:20 a. m.: mentoría 3. 12 m.: video de respaldo. 2:00 p. m.: mentoría 4. **3:00 p. m.: presentación.**
- El plan B tiene que estar demostrable (aunque sea en Wokwi + video) antes del congelamiento.

## 9. Archivos para leer en el repo
`AGENTS.md` · `docs/00-inicio.md` · `docs/01-reto-hechos.md` · `docs/02-problema.md` · `docs/evento/restricciones.md` · `docs/evento/notas-fundacion.md` · `docs/evento/decisiones.md` · `docs/evento/revision-27oct.md` · `docs/diseno/00-sistema-diseno.md` · `.agents/skills/prototipo-hardware/SKILL.md` · `.agents/skills/idear/SKILL.md`.
