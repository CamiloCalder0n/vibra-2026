---
tags: [vibra, comandos]
---
# Comandos a la mano

Todo se corre en Warp, dentro de `~/Proyectos/vibra-2026`.

## 0. Antes de empezar (una vez, hoy) — según el chequeo del 27-oct 10:00
```bash
# 1) Liberar espacio (había 8,2 GB libres; la meta es 20 GB o más)
docker system prune -f            # imágenes y contenedores que no se usan
npm cache clean --force
rm -rf ~/Library/Caches/*         # cachés de apps (se regeneran solas)
df -h /                           # revisar cuánto quedó

# 2) Actualizar solo lo pequeño (Docker Desktop NO se actualiza hoy)
claude update                     # Claude Code (estaba en 2.1.311)
npm i -g @opencode/cli@latest     # OpenCode 2.1.4 → 2.2.0
composer self-update              # Composer

# 3) Descargar imágenes de Docker con el wifi de la casa (no depender del de la U)
open -a Docker
docker pull php:8.3-cli && docker pull mysql:8.0 && docker pull node:22-alpine

# 4) Volver a revisar
bash scripts/chequeo-mac.sh
```
Estado OK del chequeo: git, Node 24, PHP 8.4, Composer, Laravel Installer 5.31, Docker 29.8 + Compose v5.6, agy 1.4.6, GitHub CLI (sesión iniciada), Python 3.14, Obsidian 1.14.5, batería 100%, puertos 8000/3306/5432/5173 libres.
Pendiente: Homebrew no aparece en la terminal (no se necesita para el evento).

## 1. Abrir el entorno
```bash
cd ~/Proyectos/vibra-2026 && claude  # pestaña 1: Claude Code
open -a Obsidian                     # bóveda vibra-2026 → abrir [[00-inicio]]
```

## 2. Flujo del martes, en orden
| Momento | Qué escribir en Claude Code |
|---|---|
| Antes de la apertura | `usa la skill entrevista-empatia y prepárame las preguntas de la apertura` |
| Después de la apertura (pasar notas a [[notas-fundacion]]) | `sintetiza las notas de la fundación` |
| 5:30 p. m. | `/definir-problema` |
| Al aprobar el problema | `/checkpoint 2` |
| 6:00 p. m. | `/idear` |
| Al escoger la idea | `/aporte-biomedica` y luego `/plan-demo` |
| Antes de programar | `define los endpoints y el JSON en AGENTS.md sección 4` |
| Al cerrar la ideación | `/checkpoint 3` |

## 3. Construir en paralelo (desde las 8:00 p. m.)
```bash
claude --worktree backend     # pestaña 2: backend Laravel (skill laravel-api)
claude --worktree frontend    # pestaña 3: frontend
```
Dentro de cada una: `usa el agente constructor; te toca backend/ (o frontend/)`.
Integrar antes de cada mentoría (pestaña 1, en main):
```bash
git add -A && git commit -m "avance" && git merge worktree-backend worktree-frontend
```

## 4. Laravel + Docker
```bash
cd backend
cp .env.example .env
docker compose up -d                          # levantar
docker compose exec app php artisan migrate:fresh --seed   # datos de demo desde cero
docker compose logs -f app                    # ver errores
docker compose down                           # apagar
```

## 5. Investigación y cifras (pestaña de agy o Claude)
| Para | Escribir |
|---|---|
| Buscar datos del problema | `usa el agente investigador: busca cifras de [tema] en Colombia` |
| Revisar cifras antes del pitch | `/verificar-cifras` |
| Hardware | `/prototipo-hardware` |

agy (biomédicos): `cd ~/Proyectos/vibra-2026 && agy` y luego `/skills` para ver las mismas skills.

## 6. Cierre y pitch
| Momento | Escribir |
|---|---|
| Cada 3–4 h y antes de cada mentoría | `/checkpoint N` |
| Antes de mentorías y el jueves | `/demo-check` |
| Miércoles noche y jueves | `/pitch` (o `/pitch comentarios del mentor`) |

## 7. Git de emergencia
```bash
git status                   # qué cambió
git log --oneline | head     # últimos commits
git stash                    # guardar cambios a un lado
git checkout -- archivo      # deshacer cambios de un archivo
```
