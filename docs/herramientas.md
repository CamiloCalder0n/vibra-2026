---
tags: [vibra, herramientas]
---
# Herramientas, skills y quién usa qué

## Herramientas
| Herramienta | Para qué | Quién | Nota |
|---|---|---|---|
| Obsidian | Ver y escribir notas, decisiones, flujos | Todo el equipo | Abrir `vibra-2026` como bóveda. Sin plugins |
| Claude Code | Construir con subagentes en paralelo e integrar | Camilo | Lee CLAUDE.md (importa AGENTS.md) y `.claude/skills/` |
| agy (Antigravity CLI) | Investigación, notas y pitch en `docs/` | Biomédicos | Lee AGENTS.md y `.agents/skills/` sin configurar nada. `/skills` las lista |
| OpenCode | Respaldo si se acaba el uso de Claude | Camilo | Lee AGENTS.md, `.agents/skills/` y `.opencode/agents/` |
| Git | Guardar cada avance; integrar antes de cada mentoría | Camilo | `bitacora.md` usa `merge=union` |

## Las 11 skills, en el orden del reto
| # | Skill | Fase | Se activa | Escribe en |
|---|---|---|---|---|
| 1 | entrevista-empatia | Empatizar | Sola, al preparar preguntas o procesar notas | [[notas-fundacion]] |
| 2 | definir-problema | Definir | Sola, al hablar del problema o restricciones | [[restricciones]], AGENTS.md sección 3 |
| 3 | idear | Idear | Sola, al puntuar o elegir ideas (se detiene si no hay restricciones) | [[decisiones]], AGENTS.md sección 4 |
| 4 | aporte-biomedica | Idear y probar | Sola, al hablar de propuesta de valor o prueba con usuarios | [[aporte-biomedica]] |
| 5 | plan-demo | Antes de construir | Sola, al planear o cuando alguien quiere agregar algo | [[flujos]] |
| 6 | laravel-api | Construir | Sola, al tocar backend, API, base de datos, Docker o despliegue | `backend/` |
| 7 | prototipo-hardware | Construir | Sola, al hablar de sensores, Arduino, ESP32, Wokwi | [[hardware]], `firmware/` |
| 8 | verificar-cifras | Todo el evento | Sola, ante cualquier número, precio o cita | [[fuentes]] |
| 9 | pitch | Pitch | Sola o con `/pitch` | [[pitch]] |
| 10 | checkpoint | Cierre de cada fase | **Solo manual:** `/checkpoint N` | [[bitacora]], [[00-inicio]] |
| 11 | demo-check | Antes de mentorías y del pitch | **Solo manual:** `/demo-check` | [[demo-check]] |

Todas se pueden llamar a mano con `/nombre` en Claude Code.

## Subagentes (Claude Code en `.claude/agents/`, OpenCode en `.opencode/agents/`)
| Subagente | Para qué | Skills que precarga |
|---|---|---|
| investigador | Datos, literatura, normativa, precios | verificar-cifras, entrevista-empatia |
| ux-flujos | Especificación de la demo | plan-demo, aporte-biomedica |
| constructor | Construir una pieza en su carpeta | plan-demo, laravel-api, prototipo-hardware |
| pitch | Guion y preguntas del jurado | pitch, verificar-cifras |
| qa-demo | Revisar la demo como jurado (no edita código) | demo-check |

## Dónde vive cada cosa
```
AGENTS.md                      reglas (fuente única)
CLAUDE.md                      @AGENTS.md + notas solo de Claude Code
.agents/skills/<skill>/        skills (fuente única; las leen agy y OpenCode)
.claude/skills/<skill>  →      symlink a .agents/skills/<skill> (para Claude Code)
.claude/agents/                subagentes de Claude Code
.opencode/agents/              los mismos subagentes para OpenCode
docs/                          bóveda de Obsidian
```
Para cambiar una skill, editar SOLO la de `.agents/skills/`.

## Comprobar que cargaron
- Claude Code: escribir `/` y buscar las 11 en el menú.
- agy: `/skills` o `agy inspect`.
- OpenCode: pedir "lista las skills disponibles". Puede verlas dos veces (lee `.claude/skills/` y `.agents/skills/`); es el mismo archivo, no hay problema.

## Opcional: solo si la demo será una app web
Skill `webapp-testing` de Anthropic (Apache-2.0), para que la IA pruebe la app con un navegador:
```bash
git clone --depth 1 https://github.com/anthropics/skills /tmp/anthropic-skills
cp -R /tmp/anthropic-skills/skills/webapp-testing .agents/skills/
ln -sfn ../../.agents/skills/webapp-testing .claude/skills/webapp-testing
python3 -m pip install playwright && python3 -m playwright install chromium
```
Instalarla ANTES del martes, no durante el evento.

## Qué NO instalar (evaluado)
| Qué | Por qué no |
|---|---|
| Spec Kit (GitHub) | Mismo flujo que ya tenemos, con más ceremonia |
| obra/superpowers completo | Su hook obliga a usar todas sus skills y TDD: se come el tiempo |
| Colecciones de 100+ subagentes (VoltAgent, wshobson/agents) | Mucho contexto; ninguno sabe de design thinking ni de la fundación |
| antigravity-awesome-skills (2.000+ skills) | Sobrecarga extrema |
| Hooks propios | Otro punto de falla; no hacen falta en 48 h |
