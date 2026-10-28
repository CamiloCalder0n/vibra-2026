---
tags: [evento, requerimientos, restricciones]
---
# Requerimientos y restricciones (fuente única)

Ninguna idea pasa a votación sin cumplir esto (skill idear). Si algo choca, se anota en [[decisiones]].

## A. Del profe del reto (prioridad máxima)
| ID | Requerimiento | Estado |
|---|---|---|
| P1 | Prototipo **funcionando** el jueves; penalización grave si los dispositivos fallan | Obligatorio |
| P2 | **Hardware**: "soluciones de página web no sirven" (8 p. m.) | ⚠️ Choca con la app de tablet: preguntar mañana |
| P3 | Pensado para la usuaria real: señora de casi 70 años, muy bajos recursos | Obligatorio |
| P4 | Problema → Pregunta → Objetivo antes de la solución | ✓ Hecho ([[02-problema]]) |
| P5 | Pitch de 3 min sin preguntas + demo breve | Obligatorio |
| P6 | La plata no es el centro | Obligatorio |

## B. Del profe Fabián (técnico; detalle en [[recomendaciones-fabian]])
| ID | Requerimiento |
|---|---|
| F1 | Laravel MVC como API REST: controladores delgados, Eloquent, migraciones |
| F2 | Endpoints y JSON definidos **antes** de programar |
| F3 | Seeders con datos realistas (nada de "prueba") |
| F4 | Un Form Request de ejemplo y errores JSON consistentes con códigos HTTP correctos |
| F5 | Sanctum solo si hace falta login (aquí no: un solo perfil) |
| F6 | docker-compose + despliegue temprano en Render |
| F7 | README, .env.example y colección de Postman |
| F8 | Git con ramas y commits pequeños; congelar funciones el miércoles a las 10 p. m.; video de respaldo |
| F9 | Hablan todos en el pitch; ensayar con cronómetro |

## C. De la usuaria y su contexto
| ID | Restricción | Origen |
|---|---|---|
| U1 | **Registro por excepción**: solo se reporta el perro que está mal; los demás quedan "bien" | Cami |
| U2 | Un solo perfil (la dueña), sin contraseñas | Cami |
| U3 | Hecho para una persona mayor: letra ≥ 22 px, toques ≥ 64 px, una cosa por pantalla, voz en vez de escribir | Cami + UX |
| U4 | Registrar algo = un toque; nada de textos largos | Encargada: "redactar textos largos me quita bastante tiempo" |
| U5 | Funciona aunque ella no esté (la información no vive en su cabeza) | Encargada |
| U6 | Costo de fabricación y de operación casi cero | Bajos recursos |
| U7 | Barrio peligroso: nada visible ni fácil de robar | Cami |
| U8 | Sin depender de internet ni de un plan de datos; aguanta cortes de luz | Derivada de U6 |
| U9 | Reparable con piezas comunes | Derivada de U6 |
| U10 | Nadie (ni ella ni los perros) carga dispositivos | Cami (desde el piloto) |
| U11 | Alertas por SMS o llamada antes que por WhatsApp | Cami + "solo contesta llamadas" |
| U12 | Datos ficticios en la demo; nada de datos reales de personas | Regla del repo |

## D. Preguntas abiertas que cambian requerimientos
1. ¿Una app de tablet cumple P2, o hace falta una pieza física? (al profe, mañana temprano)
2. ¿La dueña usaría una tablet en el refugio? ¿Se la robarían? ¿Hay señal o internet? (a la señora)
3. ¿La rúbrica de la foto es la nuestra?
