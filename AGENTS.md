# Instruções para o agente (opencode)

## Commits automáticos durante o build

Sempre que estiver no **modo de gravação** (write/recording) e terminar
de aplicar alterações (edições, criações ou remoções) neste repositório,
o agente deve:

1. Verificar o que mudou com `git status` e `git diff --stat`.
2. Adicionar **todos** os arquivos modificados e criados ao stage:
   `git add -A`
3. Garantir que o autor e o e-mail do commit estejam configurados
   localmente (usar `git config user.name`/`user.email` somente neste
   repositório se ainda não estiverem). Valores sugeridos:
   - `user.name = CristianoMZN`
   - `user.email = cristiano@local`
4. Criar um commit local com mensagem em **português**, no formato:
   ```
   build: <resumo curto do que foi alterado>

   - <alteração 1>
   - <alteração 2>
   - <alteração 3>
   ```
   O resumo e a lista devem descrever de forma fiel o que o agente
   acabou de fazer (arquivos tocados, propósito da mudança).
5. **NÃO** executar `git push`. Os commits permanecem apenas locais.
6. **NÃO** commitar arquivos ignorados (`vendor/`, `composer.lock`,
   `tests/output/*`, `tests/xmls/*`, `examples/danfse_*.*`, etc.).
   Respeitar o `.gitignore`.
7. **NÃO** commitar se não houver nada para commitar
   (`git status --porcelain` vazio). Apenas encerrar a ação.
8. Manter-se na branch `main`. Não criar branches para o commit
   automático.
