---
name: laravel-api
description: "Construye el backend en Laravel según las recomendaciones del profesor de backend: MVC con controladores delgados, API REST por recurso, Eloquent, migraciones, seeders con datos realistas, un Form Request de ejemplo, errores JSON consistentes, Sanctum solo si hace falta login, docker-compose, despliegue temprano en Render, README, .env.example y colección de Postman. Usar al crear o modificar el backend, la API, la base de datos, Docker, el despliegue o la documentación técnica."
---

# Backend Laravel (recomendaciones del profe Fabián)

Fuente: `docs/recomendaciones-fabian.md`. Contrato de datos y rutas: AGENTS.md sección 4. El backend vive en `backend/`.

## Orden de trabajo (no saltarse el 1 ni el 2)
1. **Contrato primero.** Antes de programar: lista de endpoints (`GET/POST/PATCH /api/<recurso>`) y ejemplo de cada respuesta JSON en AGENTS.md sección 4. Así el frontend arranca en paralelo con datos falsos del mismo formato.
2. **Esqueleto desplegado temprano.** Laravel + docker-compose corriendo y un primer despliegue en Render (o la máquina que gestione Javier Pinzón) la PRIMERA noche, aunque solo responda `/api/salud`. No dejar el despliegue para el final.
3. Migraciones + modelos Eloquent + relaciones.
4. Seeders con datos realistas del contexto de la fundación: nombres, lugares y valores creíbles en español. Prohibido "Dato prueba", "nombreprueba", "test", "lorem". Nunca datos reales de personas.
5. Controladores delgados (lógica en el modelo o en una clase de servicio pequeña) y rutas con `Route::apiResource` agrupadas por recurso en `routes/api.php`.
6. UN Form Request bien hecho como ejemplo de validación (el recurso principal). No validar todo con el mismo detalle.
7. Errores JSON consistentes en todo el API: `{ "mensaje": "...", "errores": { ... } }` con el código HTTP correcto (200, 201, 204, 404, 422, 500). Configurarlo en el manejador de excepciones para rutas `api/*`.
8. Autenticación SOLO si la demo necesita roles o usuarios: Laravel Sanctum, sin reinventar nada. Si no hace falta, no se construye login (AGENTS.md regla 2).
9. Documentación: `README.md` (qué hace, cómo correrlo con Docker, variables), `.env.example` completo, y colección de Postman en `backend/docs/postman.json` (o Swagger) con un ejemplo por endpoint.

## Docker
Ver [references/docker-render.md](references/docker-render.md). Meta: `git clone` + `cp .env.example .env` + `docker compose up` y funciona en cualquier computador del equipo.

## Git
Una rama por frente (`backend`, `frontend`, `docs`), commits pequeños y frecuentes, integrar a `main` antes de cada mentoría. Nunca un merge gigante el jueves.

## Antes del congelamiento (miércoles 10:00 p. m.)
- [ ] Despliegue en línea funcionando con los seeders cargados.
- [ ] `docker compose up` desde cero funciona.
- [ ] README, `.env.example` y Postman al día.
- [ ] Respaldo local: la demo también corre sin internet con Docker en el computador.
