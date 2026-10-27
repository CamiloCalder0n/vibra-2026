#!/bin/bash
# Crea .claude/skills/<skill> como enlace a .agents/skills/<skill> (fuente única).
# Correr desde la raíz del repo cada vez que se agregue una skill nueva.
set -e
cd "$(dirname "$0")/.."
mkdir -p .claude/skills
for d in .agents/skills/*/; do
  n=$(basename "$d")
  ln -sfn "../../.agents/skills/$n" ".claude/skills/$n"
done
ok=0; for l in .claude/skills/*; do [ -f "$l/SKILL.md" ] && ok=$((ok+1)) || echo "ROTO: $l"; done
echo "Skills enlazadas: $ok"
