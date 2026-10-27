---
tags: [vibra, mentor]
fuente: correo del profesor Fabián Enrique Suárez Carvajal (backend, UNAB), 26-oct-2026
---
# Recomendaciones del profe Fabián (prioridad alta)

## 1. Arquitectura
- Laravel con MVC: ya lo conocemos.
- Controladores delgados, rutas de la API agrupadas por recurso, Eloquent, migraciones y seeders.
- Seeders con datos realistas del negocio (nada de "Datoprueba" o "nombreprueba").
- Definir desde el inicio endpoints y formato JSON, para que frontend y backend avancen en paralelo.

## 2. MVP
- Solo lo esencial que ataca la problemática. Si no se ve en la demo, puede esperar.
- Congelamiento de funcionalidades horas antes del cierre: después solo errores y presentación.

## 3. Autenticación, validaciones y errores
- Autenticación: no reinventar; usar lo de Laravel (Sanctum).
- Validaciones: un buen ejemplo con Form Requests y seguir.
- Errores: respuestas JSON consistentes y códigos HTTP correctos.

## 4. Despliegue y documentación
- Docker: un docker-compose con el que cualquiera levanta el proyecto en minutos.
- Desplegar en Render o pedir máquina a Javier Pinzón. Desplegar TEMPRANO.
- README claro (qué hace, cómo correrlo, variables con .env.example) + colección de Postman o Swagger.

## 5. Presentación
- Hablan todos.
- Primero que el jurado entienda el problema; luego cómo lo resolvemos, combinando lo técnico con lo funcional.
- Ensayar con cronómetro al menos dos veces.

## 6. Errores comunes que él ha visto
- Se acaban los minutos sin mostrar todo → guion de demo con orden.
- La demo en vivo falla (internet, servidor, datos) → video corto de respaldo y datos precargados.
- Conflictos de Git a última hora → ramas, commits pequeños y frecuentes, integrar seguido.
- Roles mal divididos → quién hace qué desde el principio.
- Querer hacer demasiado → MVP pequeño que funcione.
- No descansar → equipo agotado comete errores al final.

Él va a pasar a ver cómo vamos: mostrarle el repo, el docker-compose y el despliegue.
