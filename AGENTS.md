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

As fontes exigidas pela NT 008/2026 §2.4 (Arial e Microsoft Sans Serif)
são fontes proprietárias. A lib distribui **Liberation Sans** (equivalente
métrico do Arial) em `src/Template/fonts/` e usa a **DejaVu Sans**
embutida no Dompdf como equivalente do Microsoft Sans Serif. Ambas são
registradas automaticamente pelo `DanfseGenerator::registerFonts()`. Não
adicionar fallback silencioso para outras famílias — se necessário mudar
a família tipográfica, ela deve continuar métrica-compatível com Arial /
MS Sans Serif e o README precisa registrar a mudança.

A "Situação da NFS-e" lida no DANFSe vem de `NFSe/infNFSe/cStat`
(enums em `src/Enums/CStat.php`), não de `tpEmis`; "Emitente da NFS-e"
vem de `NFSe/infNFSe/DPS/infDPS/tpEmit` (enums em `src/Enums/TpEmit.php`).
A marca d'água diagonal "CANCELADA" / "SUBSTITUÍDA" (NT 008 §2.5) é
acionada por esses mesmos enums. A informação "NFS-e Subst.:" vai para
o fim da linha de Informações Complementares quando aplicável.

A flag `DanfseConfig::mostrarCanhoto` (padrão `true`) controla a presença
do bloco de canhoto (NT 008 §2.3.3, Nota 11). Quando desligada, o CSS
`flex-grow: 1` da última `bordered-section` realoca a área antes ocupada
para "Descrição do Serviço" e "Informações Complementares". O rótulo
"Data de Competência" da DPS é usado para decidir se PIS/COFINS aparece
no bloco 8 (oculto a partir de 2027).

O bloco de canhoto é opcional (NT 008 §2.3.3, Nota 11). A flag
`DanfseConfig::mostrarCanhoto` (padrão `true`) controla a exibição.
Quando desligada, o espaço deve continuar sendo redistribuído para
"Descrição do Serviço" / "Informações Complementares" (garantido pelo CSS
`flex-grow: 1` da última `bordered-section`).

`DanfseGenerator::generatePdf()` lança `RuntimeException` se o Dompdf
gerar mais de uma página; a NT 008 §2.2 exige impressão em página única.
Testes que aumentem artificialmente o conteúdo (Descrição do Serviço,
Informações Complementares) precisam respeitar os limites de caracteres
da tabela em `references/field_specification.md` da skill
`danfse-pdf-generator`.

## Convenções
- **Sem comentários no código** salvo pedido explícito.
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
- `tests/xmls.local/` — fixtures de teste **privadas** (XMLs reais cujo
  prestador/tomador não autorizou divulgação no repo público). Cada
  desenvolvedor pode popular este diretório localmente; ele é varido em
  paralelo a `tests/xmls/` tanto pelo `realXmlProvider()` quanto pelo
  `test_batch_generation_all_xmls` (override por basename). Detalhes em
  `tests/xmls.local/README.md`.
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

## Commits

O agente **não** cria commits automaticamente. Commits são feitos
manualmente pelo usuário, com mensagem em **português** e respeitando
o `.gitignore`.
