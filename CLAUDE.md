@AGENTS.md

## Solo para Claude Code
- Claude Code no lee AGENTS.md por sí solo: por eso esta importación. No dupliques reglas aquí.
- Skills: `.claude/skills/` son symlinks a `.agents/skills/` (fuente única). Para editar una skill, edita la de `.agents/skills/`.
- Subagentes en `.claude/agents/` (precargan sus skills con el campo `skills`).
- Usa subagentes para investigar o revisar, así el contexto pesado no se queda en la sesión principal.
- Trabajo en paralelo: `claude --worktree <nombre>` (app, hardware, pitch), cada uno en su carpeta.
- Entre tareas distintas: `/clear`.
