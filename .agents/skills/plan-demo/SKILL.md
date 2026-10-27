---
name: plan-demo
description: "Escribe la especificación de la demo antes de programar en docs/evento/flujos.md: principios de diseño, usuarios, historia de demo de 90 segundos, pantallas, qué está dentro, qué se simula, qué queda fuera y tareas de 30 a 60 minutos con responsable. Usar antes de construir, al planificar o priorizar tareas, al definir el MVP, o cuando alguien proponga agregar una funcionalidad, librería o infraestructura nueva."
---

# Plan de demo (especificación antes del código)

## Regla de oro
Si el jurado no lo ve en la demo o no cambia la historia del usuario, NO se construye.
Fuera por defecto: service worker / modo offline avanzado, login y cuentas, despliegue en la nube, arquitectura "escalable", panel de administración, pruebas exhaustivas.
Excepción: que una restricción de `docs/evento/restricciones.md` lo exija; citarla.

## Llenar `docs/evento/flujos.md`
1. Principios de diseño (siempre: diseño por excepción, nadie llena formularios largos, sin jerga).
2. Usuarios (principal, secundario, quien mantiene la información) y cuántas personas hay por turno.
3. Historia de demo en 5–7 pasos visibles: quién, qué hace, qué ve el jurado.
4. Pantallas o piezas, con los textos reales.
5. Dentro (máximo 5 funciones, cada una ligada a un paso visible).
6. Simulado (sensor, mensaje, datos): se dice en el pitch.
7. Fuera / Después del hackathon.
8. Salidas de emergencia: ¿qué pasa si el usuario no puede cumplir un paso obligatorio?
9. Tareas de 30–60 min: tarea | responsable | carpeta o worktree | "hecho" visible.
10. Congelamiento: miércoles 28, 10:00 p. m. Después solo correcciones de errores y preparación de la presentación.
11. Guion de demo: qué se muestra y en qué orden, con tiempo por paso, para que no se acaben los minutos sin mostrar lo importante.
12. Endpoints y JSON de cada pantalla (si hay backend): se pasan a AGENTS.md sección 4 antes de programar, para que frontend y backend avancen en paralelo.
Lo que no dijo la fundación va marcado *(supuesto)*.

## Guardián de alcance
Ante un pedido nuevo: ¿está en "Dentro"? Si no, responder con costo en minutos, qué paso visible mejora y qué se saca a cambio. Va a "Fuera" salvo decisión de Camilo registrada en `docs/evento/decisiones.md`.

## Trabajo en paralelo
Un worktree o rama por frente (requiere al menos un commit): `claude --worktree backend`, `claude --worktree frontend`, `claude --worktree hardware`. Commits pequeños y frecuentes. Cada uno trabaja solo en su carpeta e integra a `main` al cerrar cada tarea.
