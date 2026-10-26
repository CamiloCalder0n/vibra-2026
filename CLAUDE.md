@AGENTS.md

## Solo para Claude Code
- Claude Code no lee AGENTS.md por sí solo: por eso esta importación. No dupliques reglas aquí.
- Agentes en `.claude/agents/`, comandos en `.claude/commands/`.
- Usa subagentes para investigar o revisar, así el contexto pesado no se queda en la sesión principal.
- Trabajo en paralelo: un worktree o pestaña por agente, cada uno en su carpeta.
- Entre tareas distintas: `/clear`.
