#!/bin/bash
# Revisa versiones y estado de las herramientas del equipo. Guarda el resultado en docs/evento/chequeo-mac.txt
cd "$(dirname "$0")/.."
OUT=docs/evento/chequeo-mac.txt
v() { printf "%-16s " "$1"; shift; ( "$@" 2>&1 | head -1 ) || echo "NO INSTALADO"; }
{
echo "Chequeo: $(TZ=America/Bogota date '+%Y-%m-%d %H:%M')"
v macOS sw_vers -productVersion
v chip uname -m
v git git --version
v brew brew --version
v node node -v
v npm npm -v
v php php -v
v composer composer --version
v laravel laravel --version
v docker docker --version
v compose docker compose version
printf "%-16s " "docker-activo"; docker info >/dev/null 2>&1 && echo "SI" || echo "NO (abrir Docker Desktop)"
v claude claude --version
v agy agy --version
v opencode opencode --version
v gh gh --version
printf "%-16s " "gh-login"; gh auth status >/dev/null 2>&1 && echo "SI" || echo "NO"
v python3 python3 --version
printf "%-16s " "obsidian"; [ -d /Applications/Obsidian.app ] && defaults read /Applications/Obsidian.app/Contents/Info CFBundleShortVersionString || echo "NO ENCONTRADO"
printf "%-16s " "warp"; [ -d /Applications/Warp.app ] && echo "SI" || echo "NO"
printf "%-16s " "disco-libre"; df -h / | awk 'NR==2{print $4}'
printf "%-16s " "bateria"; pmset -g batt | grep -o '[0-9]*%' | head -1
printf "%-16s " "puertos"; for p in 8000 3306 5432 5173; do lsof -i :$p >/dev/null 2>&1 && printf "%s:OCUPADO " $p || printf "%s:libre " $p; done; echo
echo "--- Actualizaciones pendientes (brew) ---"
brew outdated 2>/dev/null | head -20 || echo "brew no disponible"
echo "--- Último npm global ---"
npm outdated -g --depth=0 2>/dev/null | head -10
} > "$OUT" 2>&1
cat "$OUT"
