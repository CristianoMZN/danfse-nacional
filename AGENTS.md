# Instruções para o agente (opencode)

## Sobre o projeto
Biblioteca PHP 8.1+ (`DanfseNacional\`) para a NFS-e Nacional,
distribuída via Packagist/Composer. Entrega três pilares de mesmo nível:
**geração de PDF** do DANFSe a partir do XML autorizado, **parser tipado**
do XML (XML→array e XML→DTO) e **visualizador HTML** do DANFSe. Suporta
o XML v1.01 (com ou sem bloco IBS/CBS) e o DANFSe v2.0 (NT 008/2026,
layout com seção IBS/CBS). PSR-4; sem dependência de framework — integra
em qualquer framework PHP ou em scripts PHP puros. Detalhes e exemplos
de uso público em `README.md` (também em português).

## Comandos essenciais
- Instalar dependências: `composer install`
- Rodar a suíte de testes: `./vendor/bin/phpunit` (atalho: `composer test`)
- Servidor de desenvolvimento para visualização manual:
  `php -S localhost:8000` e abrir
  `http://localhost:8000/?key=<basename-do-xml-em-schemas>`
  (ex.: `?key=43118092203119050000180000000000087726078443655568`)
  - Acrescentar `?html=1` devolve o HTML intermediário em vez do
    `var_dump` do DTO.

Não há linter, formatador, typecheck ou CI configurado. **A única
verificação automática é o `phpunit`.**

## Mapa do código (`src/`)
- `DanfseGenerator.php` — facade principal:
  `generateFromXml`, `parseXml`, `generateHtml`, `generatePdf`.
- `XmlToArray.php` — converte XML em array; conhece o namespace
  `http://www.sped.fazenda.gov.br/nfse` e descarta a assinatura
  digital. É uma das duas saídas do parser (a outra é o DTO, via
  `DanfseGenerator::parseXml()`).
- `Config/DanfseConfig.php`, `Config/MunicipalityBranding.php` —
  configuração imutável (`readonly`).
- `Dto/` — DTOs `readonly`/nullable espelhando o XML. Campos opcionais
  do esquema são `?string` (ou string vazia) — acessos nunca lançam
  por campo ausente.
- `Enums/` — enums da NFS-e (`TpAmb`, `FinNFSe`, `RegTrib`, ...).
- `Data/Municipios.php` — tabela IBGE; `Municipios::lookup($cLocIncid)`.
- `Template/DanfseTemplate.php` + `Template/danfse.php` — HTML
  consumido pelo dompdf. Alimenta tanto o `generatePdf()` quanto o
  visualizador HTML (`generateHtml()`).
- `Formatter.php` — formatadores (datas, valores).

A logo NFS-e fica **embutida em `src/Config/DefaultLogo.php`** (constante
`DATA_URI`) e é parte fixa e obrigatória do DANFSe. O consumidor **não
pode** substituí-la nem desativá-la — tentativas via `DanfseConfig` (1.x)
deixam de compilar em 2.0.0. `assets/logo-nfse.png` é mantido apenas como
fonte/referência para regenerar a constante, não é lido em runtime. O
único logo configurável é o do ente emitente (empresa ou brasão), via
`MunicipalityBranding::logoDataUri` ou `::logoPath`.

## Convenções
- **Sem comentários no código** salvo pedido explícito. A descrição da
  mudança vai na mensagem do commit.
- DTOs novos devem ser `readonly`, com campos opcionais como `?string`
  (ou string vazia), seguindo o padrão dos DTOs existentes.
- `README.md` é a referência de uso público. Mudanças em classes
  públicas, assinaturas ou exemplos exigem atualização do README na
  mesma alteração.
- Mensagens de commit em **português**.

## Arquivos que NÃO devem ser commitados
Respeitar o `.gitignore` (risco real de vazar ou poluir o repo):
- `vendor/`, `composer.lock`
- `tests/output/*` — PDFs gerados pelos testes
- `anex` — item solto no `.gitignore`

Os XMLs de exemplo em `examples/` e os fixtures em `tests/xmls/`
**são** versionados: tratam-se de notas reais do próprio autor da
biblioteca, publicadas como amostra. O mesmo vale para os PDFs/HTMLs
gerados por `examples/example.php` (`examples/danfse_simples_*.pdf`,
`examples/danfse_com_config_*.pdf`, `examples/danfse_com_config_*.html`).

O diretório `schemas/` é fixture local usado pelo `index.php`
(`schemas/{key}.xml`); não tratar como artefato de produção nem
commitar a menos que tenha sido explicitamente criado durante o
trabalho atual.

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
   `tests/output/*`, etc.). Respeitar o `.gitignore`.
7. **NÃO** commitar se não houver nada para commitar
   (`git status --porcelain` vazio). Apenas encerrar a ação.
8. Manter-se na branch `main`. Não criar branches para o commit
   automático.
