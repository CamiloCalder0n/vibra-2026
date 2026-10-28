---
tags: [vibra, comandos]
---
# Comandos a la mano

Todo se corre en Warp, dentro de `~/Proyectos/vibra-2026`.

## 0. Estado del entorno
Mac revisado el 27 oct: Docker, PHP 8.4, Composer, Node, Claude Code y GitHub al día. API en línea: https://refugio-yesenia-api.onrender.com/api/salud

## 1. Abrir el entorno
```bash
cd ~/Proyectos/vibra-2026 && claude  # pestaña 1: Claude Code
open -a Obsidian                     # bóveda vibra-2026 → abrir [[00-inicio]]
```

## 2. Git del día a día (ramas reales: `backend`, `frontend`, `main`)
```bash
git switch backend                           # trabajar el backend
git add -p && git commit -m "backend: qué se hizo"   # commits pequeños
git push                                     # Render redespliega solo
git switch main && git merge --no-ff backend -m "Integrar backend: tarea N" && git push && git switch backend   # antes de cada mentoría
```

## 3. Frontend en paralelo
```bash
claude --worktree frontend      # crea la rama worktree-frontend en .claude/worktrees/
```
Dentro: `usa el subagente constructor; te toca frontend/ con la skill app-tablet`.
Integrar: `git switch main && git merge --no-ff worktree-frontend -m "Integrar frontend: tarea N" && git push`

## 4. Laravel + Docker
```bash
cd backend
cp .env.example .env
docker compose up -d --build -V               # levantar (con -V si cambiaron paquetes)
docker compose exec app php artisan refugio:sembrar --de-nuevo   # datos de demo con fechas de hoy
docker compose logs -f app                    # ver errores
docker compose down                           # apagar
```

## 5. Investigación y cifras (pestaña de agy o Claude)
| Para | Escribir |
|---|---|
| Buscar datos del problema | `usa el agente investigador: busca cifras de [tema] en Colombia` |
| Revisar cifras antes del pitch | `/verificar-cifras` |

agy (biomédicos): `cd ~/Proyectos/vibra-2026 && agy` y luego `/skills` para ver las mismas skills.

## 6. Cierre y pitch
| Momento | Escribir |
|---|---|
| Cada 3–4 h y antes de cada mentoría | `/checkpoint N` |
| Antes de cada mentoría | `usa el subagente qa-demo y revisa la demo` |
| Antes de mentorías y el jueves | `/demo-check` |
| Miércoles noche y jueves | `/pitch` (o `/pitch comentarios del mentor`) |

## 7. Git de emergencia
```bash
git status                   # qué cambió
git log --oneline | head     # últimos commits
git stash                    # guardar cambios a un lado
git checkout -- archivo      # deshacer cambios de un archivo
```
