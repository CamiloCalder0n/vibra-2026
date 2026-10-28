---
tags: [evento, flujos, app-tablet]
---
# Especificación de la demo: app de tablet del Refugio Yesenia

Decidido el 27 oct a las 10:05 p. m.: **solución a, app de tablet** ([[decisiones]]). Problema: [[02-problema]]. Requerimientos: [[restricciones]]. Diseño: [[00-sistema-diseno]].

## 1. Principios
1. **Registro por excepción** (U1): solo se reporta el perro que está mal; los demás quedan "bien".
2. **Un solo perfil**, el de la dueña, sin contraseñas (U2, F5: no hay Sanctum).
3. **Para una señora de casi 70** (U3): letra ≥ 22 px, toques ≥ 64 px, una cosa por pantalla, voz en vez de escribir, botón "Léame en voz alta".
4. **Un toque para registrar** (U4) y "Deshacer" en vez de "¿Está segura?". La doble dosis se bloquea.
5. Sin jerga: se usan las palabras de [[contenido]].

## 2. Usuarios
- Principal: la dueña (única que usa la tablet).
- Secundarios: quienes ayudan (ven la tablet en el refugio) y el veterinario (recibe el resumen).
- Quién mantiene la información: la dueña, con un toque cuando algo pasa.

## 3. Historia de la demo (90 s)
1. **Hoy**: "Hoy hay 3 peluditos que la necesitan". Nube primero. "Los otros 32 están bien".
2. **Un perro está mal**: toca a Nube → "Comió poco" + "Está decaída" → Guardar lo de Nube. Su ficha muestra 3 días seguidos y el aviso "Llame al veterinario". *(caso Nube)*
3. **Medicinas**: "Ya se la di" a Rocco → "Dada a las 8:02 a. m.". Alguien la toca otra vez → "Rocco ya se tomó la cefalexina a las 8:02 a. m. La próxima es a las 8:00 p. m." *(caso Rocco)*
4. **Mis perros → Toby**: "No se la lleva bien con otros machos". *(caso Toby)*
5. **Llegó un perro**: Bruno en 5 toques.
6. **Para el veterinario**: el resumen de la semana en una pantalla.

## 4. Pantallas
Las 7 de [[contenido]] (con sus textos exactos): Hoy · Un perro está mal · Medicinas · Mis perros · Ficha · Llegó un perro · Para el veterinario. Navegación: barra lateral fija.

## 5. Dentro (máximo 5)
1. Reportar a un perro con síntomas de un toque y que los demás queden "bien" (pasos 1–2).
2. Alerta automática con 3 días seguidos de reportes (paso 2).
3. Medicinas del día con bloqueo de doble dosis (paso 3).
4. Ficha con cuidados, vacunas y últimos 7 días (paso 4).
5. Agregar un perro nuevo en 5 pasos + resumen para el veterinario (pasos 5–6).

## 6. Simulado (se dice en el pitch)
- Los días anteriores: seeders con 35 perros, tratamientos y reportes de la última semana.
- La voz: texto a voz y dictado del navegador.
- "Mandar por WhatsApp": abre WhatsApp con el texto armado (enlace wa.me).
- Fotos: fotos de ejemplo hasta tener permiso de usar las del refugio.

## 7. Fuera (después del hackathon)
Varios usuarios, adopciones, donaciones, notificaciones por SMS, modo sin internet completo.
*Si sobra tiempo:* que la app se instale con ícono (manifest) y guarde los reportes en la tablet cuando no hay señal (U8).

## 8. Salidas de emergencia
- Si se equivocó al reportar: "Deshacer" por 8 s, o "Me equivoqué, borrar" en la ficha.
- Si dio una medicina y no la marcó: "Ya se la di" sirve también tarde (guarda la hora real).
- Si no sabe un dato del perro nuevo: siempre existe "No sé".

## 9. Tareas (30–60 min cada una)
| # | Tarea | Responsable | Carpeta / worktree | "Hecho" visible |
|---|---|---|---|---|
| 1 | Contrato de endpoints y JSON en AGENTS.md sección 4 | Camilo + Claude | docs | ✓ (hecho con esta nota) |
| 2 | Laravel + docker-compose + `/api/salud` | Camilo | `backend/` | `docker compose up` responde |
| 3 | Despliegue en Render | Camilo | `backend/` | URL pública responde `/api/salud` |
| 4 | Migraciones, modelos y seeders del refugio | Camilo (datos: Biomédica) | `backend/` | `GET /api/perros` devuelve 35 perros |
| 5 | Endpoints de Hoy, perros y reportes | Camilo | `backend/` | Postman: reportar a Nube cambia Hoy |
| 6 | Medicinas y dosis con bloqueo (409) | Camilo | `backend/` | Postman: dar dos veces → 409 |
| 7 | Frontend: Hoy + Un perro está mal | Camilo (subagente constructor) | `frontend/` (worktree) | Se ve en la tablet |
| 8 | Frontend: Medicinas + Ficha | Camilo (subagente) | `frontend/` | Caso Rocco y caso Nube en la tablet |
| 9 | Frontend: Mis perros, Llegó un perro, Veterinario | Camilo (subagente) | `frontend/` | Flujo completo |
| 10 | Datos realistas para los seeders (perros, medicinas, síntomas) | Biomédica | `docs/` | Tabla en [[contenido]] ampliada a 35 |
| 11 | Aporte de Biomédica: seguridad en la medicación (los "5 correctos"), signos de alarma y regla de 3 días | Biomédica | [[aporte-biomedica]] | Nota llena |
| 12 | Prueba con usuaria (SUS) y ajustes de textos | Biomédica | [[aporte-biomedica]] | Puntaje y cambios |
| 13 | Pitch de 3 min + guion de demo | Biomédica + Camilo | [[pitch]] | Ensayado 3 veces |

## 10. Congelamiento
Miércoles 28 a las 10:00 p. m. Después solo errores, video y pitch.

## 11. Guion de demo (después del pitch de 3 min)
| Tiempo | Qué se muestra |
|---|---|
| 0:00–0:15 | Hoy: 3 necesitan, 32 bien |
| 0:15–0:40 | Reportar a Nube y ver el aviso de 3 días |
| 0:40–1:00 | Rocco: dar la medicina y el bloqueo de la doble dosis |
| 1:00–1:15 | Toby y Bruno |
| 1:15–1:30 | Resumen para el veterinario |

## 12. Endpoints
En AGENTS.md sección 4 (contrato único).
