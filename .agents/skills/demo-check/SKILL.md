---
name: demo-check
description: "Ensayo técnico de la demo: arranque desde cero, recorrido completo de la historia de docs/evento/flujos.md, prueba sin internet, plan B grabado, logística y prueba con alguien de afuera; deja la lista de fallos priorizada en docs/evento/demo-check.md. Usar cuando el usuario invoque /demo-check o pida ensayar o revisar la demo antes de presentarla."
disable-model-invocation: true
---

# Demo check

Si existe el subagente qa-demo, delegarle la revisión del código y el recorrido.

## Checklist (copiar en docs/evento/demo-check.md y marcar)
- [ ] Arranque en frío: `git clone` + `cp .env.example .env` + `docker compose up` siguiendo solo el README; cronometrar hasta la primera pantalla.
- [ ] Despliegue en línea (Render u otro) funcionando con los seeders cargados; abrirlo 5 min antes para que no esté dormido.
- [ ] Colección de Postman (o Swagger) al día: cada endpoint responde con JSON consistente y el código HTTP correcto.
- [ ] Datos precargados realistas (seeders), sin "prueba" ni "test".
- [ ] Recorrer los pasos de la historia de demo de `docs/evento/flujos.md` uno por uno, 3 veces seguidas, con captura de cada pantalla (en Claude Code sirve /verify; si está instalada la skill webapp-testing, usarla).
- [ ] "Reiniciar demo" deja todo listo para empezar otra vez.
- [ ] Sin wifi: ¿qué se rompe? ¿Hay datos locales de respaldo?
- [ ] Datos de demo realistas en español (sin "test", sin "lorem", sin datos de personas reales).
- [ ] Textos y botones que confundan a alguien no técnico.
- [ ] Tablet: cargada, brillo al máximo, la app abierta en pantalla completa; el Mac como respaldo con Docker local.
- [ ] Resembrar el día de la demo para que las fechas queden en "hoy".
- [ ] Plan B: video de 60–90 s de la demo completa, guardado en el computador y en la nube; capturas en las diapositivas.
- [ ] Logística: cargadores, adaptador HDMI o USB-C, hotspot del celular, letra legible en el proyector.
- [ ] Prueba con alguien de fuera del equipo sin explicarle nada: ¿entiende qué pasa?
- [ ] Pitch cronometrado en 3:00 exactos, la demo en 90 s, y los 5 hablan.
- [ ] Git: todo integrado en `main`, sin ramas pendientes ni conflictos.

## Salida
Fallos priorizados: bloqueante / molesto / cosmético, cada uno con responsable. Después del congelamiento (miércoles 10:00 p. m.) solo se corrigen los bloqueantes.
