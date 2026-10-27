---
name: prototipo-hardware
description: "Guía un prototipo con Arduino o ESP32 partiendo del inventario real de materiales: elección de sensor, conexión, código mínimo lectura-umbral-salida visible, y simulación en Wokwi cuando no hay piezas, con reglas de seguridad eléctrica. Usar cuando se hable de sensores, Arduino, ESP32, circuito, firmware, prototipo físico, Wokwi o simulación de hardware."
---

# Prototipo de hardware

Recordatorio de AGENTS.md: el hardware siempre es OPCIONAL. La solución tiene que funcionar sin él.

1. Inventario: pedir la lista o foto de lo que REALMENTE hay y registrarla en `docs/evento/hardware.md`. No asumir componentes.
2. Escoger camino y anotarlo en `docs/evento/decisiones.md`:
   (a) físico con lo disponible · (b) simulado en Wokwi (https://wokwi.com — Arduino, ESP32, sensores, pantallas, WiFi) · (c) maqueta física + comportamiento simulado.
3. Seguridad: solo baja tensión (USB o baterías); nunca a la red eléctrica; nada conectado al cuerpo de participantes; el prototipo no diagnostica.
4. Código mínimo: leer sensor → regla o umbral simple → salida VISIBLE (LED, buzzer, pantalla o mensaje en la app). Primero por monitor serial, luego integrar con la app según el contrato de AGENTS.md sección 4.
5. Si el sensor no existe en Wokwi: reemplazarlo por potenciómetro o botón y decirlo en el pitch como simulado.
6. Guardar en `firmware/` el código, el enlace de Wokwi y `diagram.json`; grabar un video corto como plan B.
7. Umbrales y rangos fisiológicos: pasan por la skill verificar-cifras.
8. Si en 60 minutos no funciona lo físico, pasar a Wokwi o al botón simulado. No quemar la noche en hardware.
