---
name: nfse-xml-expert
description: Expertise on the Brazilian Sistema Nacional NFS-e XML standard — the DPS (Declaração de Prestação de Serviço) and NFS-e (Nota Fiscal de Serviço eletrônica) layouts, versions 1.0 and 1.01, plus the new IBS/CBS/Imposto Seletivo fields introduced by the Reforma Tributária do Consumo (LC 214/2025, NT 009/2026), NFS-e events (cancellation, manifestação), CNC (cancellation communication), and the domain/lookup tables (municípios IBGE, países ISO2, lista de serviços nacional, NBS, indOp). Use this skill whenever the user is generating, parsing, validating, debugging, or explaining an NFS-e/DPS XML document, an evento/PedRegEvento XML, a CNC XML, asks what a specific XML field/tag means or which values it accepts (e.g. "o que é o campo ambGer", "quais valores tpAmb aceita", "por que minha NFS-e foi rejeitada com erro E1274"), asks about IBS/CBS/cIndOp fields, or needs to map a service code, NBS code, municipality code, or country code used in the standard. Always consult this skill's reference files before answering questions about specific NFS-e XML field names, paths, or accepted values, instead of guessing from general knowledge — the exact domain values, error codes, and business rules are large and easy to get wrong from memory.
---

# NFS-e Nacional — Especialista em XML (DPS / NFS-e / Reforma Tributária / Eventos / CNC)

Esta skill dá acesso a um índice completo, campo a campo, do padrão XML do **Sistema Nacional NFS-e**
(Nota Fiscal de Serviço eletrônica), extraído diretamente dos anexos técnicos oficiais (planilhas do
Comitê Gestor da NFS-e — CGNFS-e). Cobre o leiaute base (v1.01 / "1.0"), os novos campos da **Reforma
Tributária do Consumo** (IBS, CBS, Imposto Seletivo — NT 009/2026), os XMLs de **Evento** e de
**Comunicação Nacional de Cancelamento (CNC)**, e as tabelas de domínio (municípios, países, serviços,
NBS, indOp).

## Como usar esta skill

**Sempre comece por `references/00-visao-geral-arquitetura.md`** se a tarefa envolver entender a estrutura
geral do XML, a hierarquia de grupos, ou a legenda das colunas `Ele`/`Tipo`/`Ocor.` — isso evita interpretar
mal um campo.

Depois, escolha o arquivo de referência certo conforme o que o usuário precisa:

| Pergunta / tarefa do usuário | Arquivo a consultar |
|---|---|
| "O que significa o campo X?" / "Quais valores o campo X aceita?" / preencher ou validar um XML de NFS-e ou DPS "comum" (sem IBS/CBS) | `references/01-campos-dps-nfse-completo.md` |
| Qualquer coisa envolvendo **IBS, CBS, Imposto Seletivo, `cIndOp`, `indDest`, `gIBSCBSAjuste`, notas de ajuste de débito/crédito, CNPJ alfanumérico** — ou seja, campos da Reforma Tributária | `references/02-reforma-tributaria-ibscbs.md` (traz também a lista dos campos que **só existem** na versão com reforma) |
| O campo `cIndOp` especificamente: qual código usar para qual tipo de operação, e qual o local de referência (fornecedor/imóvel/adquirente/destinatário) | `references/03-tabela-codigos-indop.md` |
| Cancelamento de NFS-e, manifestação do tomador/prestador/intermediário, bloqueio/desbloqueio por ofício — qualquer XML de **evento** | `references/04-eventos-nfse.md` |
| XML de **CNC** (comunicação de cancelamento por sistemas legados/municipais) | `references/05-cancelamento-cnc.md` |
| "Preciso de uma lista rápida de todos os campos que têm um conjunto fechado de valores (tipo enum)" | `references/06-indice-valores-enumerados.md` |
| Precisa resolver um **código** (município, país, item de serviço, NBS) para texto, ou vice-versa | `assets/*.csv` (ver seção "Tabelas de domínio" abaixo) |

Cada arquivo de referência em `references/` é grande (o leiaute completo tem ~400-430 campos) — não carregue
todos de uma vez; abra apenas o(s) arquivo(s) relevante(s) para a pergunta feita. Dentro de cada arquivo há
um índice em tabela (ordem do XML) seguido do detalhamento campo a campo — use busca de texto (grep/Ctrl+F)
pelo nome exato do campo (ex.: `ambGer`, `cIndOp`, `tpAmb`) para ir direto ao ponto.

## O que cada campo detalhado traz

Para cada campo do leiaute, os arquivos `01`, `02`, `04` e `05` trazem:

- **Caminho completo no XML** e nome do campo/tag.
- **Ele / Tipo / Ocorrência / Tamanho** (ver legenda em `00-visao-geral-arquitetura.md`).
- **Descrição** oficial do campo.
- **Notas explicativas**, quando existentes.
- **Valores aceitos (domínio identificado)** — quando a descrição define um conjunto fechado de opções
  (ex.: `ambGer`: `1` = Sistema Próprio do Município, `2` = Sefin Nacional NFS-e), extraído automaticamente.
  ⚠️ Nem todo domínio de valores está em formato de lista simples na planilha original — quando a descrição
  do campo referenciar uma tabela externa (ex.: "conforme Tabela de Municípios do IBGE"), consulte a tabela
  correspondente em `assets/`.
- **Regras de negócio associadas**: nível da regra, obrigatoriedade (`Obrig.`/opcional), efeito
  (`Rej.` = rejeita o documento inteiro se violada), código de erro (ex.: `E1274`) e mensagem de erro oficial.

## Tabelas de domínio (`assets/`)

Estas são listas grandes demais para caber como enumeração no corpo do leiaute — são referenciadas pelos
campos de código correspondentes:

| Arquivo | Conteúdo | Campo(s) do XML que usam |
|---|---|---|
| `assets/municipios_ibge.csv` | UF, nome do município, código IBGE de 7 dígitos (5.570 municípios) | `cLocEmi`, `cLocPrestacao`, `cLocIncid`, `cMun`, e demais campos de código de município |
| `assets/paises_iso2.csv` | Código ISO2 do país e nome | Campos de país no exterior (endereço no exterior, comércio exterior) |
| `assets/lista_servico_nacional.csv` | Código de Tributação Nacional, item/subitem da LC 116/2003, desdobro nacional, descrição | `cTribNac` |
| `assets/lista_nbs_v2.csv` | Código NBS (Nomenclatura Brasileira de Serviços) e descrição | `cNBS` |

Essas tabelas são grandes (até ~5.500 linhas); ao consultar, prefira `grep`/busca por código ou por trecho
do nome em vez de carregar o arquivo inteiro no contexto.

## Convenções que valem para toda a skill (não repetir engano comum)

- `ambGer` (ambiente **gerador**: Sistema Próprio do Município `1` vs. Sefin Nacional `2`) é um campo
  diferente de `tpAmb` (ambiente **de operação**: Produção `1` vs. Homologação `2`, dentro da DPS). São
  frequentemente confundidos — confira sempre o caminho completo do campo, não só o nome.
- No leiaute com Reforma Tributária (`02-reforma-tributaria-ibscbs.md`), todo campo `CNPJ` é do **tipo C
  (Caractere)**, não `N` — mudança feita para suportar o CNPJ alfanumérico (a partir de jul/2026). No leiaute
  base v1.01 sem reforma (`01-campos-dps-nfse-completo.md`), `CNPJ` ainda aparece como `N`.
- Valores monetários/percentuais têm sempre 2 casas decimais (sufixo `V2` no tamanho) e usam **ponto**, não
  vírgula, como separador decimal.
- Ao validar/depurar um XML real, primeiro identifique o **caminho exato** do campo com erro, depois busque
  esse caminho (não apenas o nome do campo, que pode se repetir em vários grupos) no arquivo de referência
  correspondente para pegar a regra de negócio e o código de erro certos.
- As versões "1.0" e "1.01" mencionadas pelo usuário correspondem, respectivamente, ao leiaute-base
  (`ANEXO_I`) e a esse mesmo leiaute já com pequenos ajustes de v1.01 (consolidados no arquivo `01`); os
  campos específicos da Reforma Tributária vêm de uma revisão adicional (`ANEXO_VI`, NT 009/2026) que
  incorpora os grupos IBSCBS sobre essa mesma base — por isso o arquivo `02` é o leiaute **completo e mais
  atual**, incluindo tanto os campos "clássicos" quanto os novos.

## Fontes originais

Todos os dados desta skill vêm dos anexos técnicos oficiais do Comitê Gestor da NFS-e:
- `ANEXO_I` (SEFIN/ADN — DPS/NFS-e, v1.01)
- `ANEXO_II` (SEFIN/ADN — Pedido de Registro de Evento, v1.01)
- `ANEXO_III` (CNC, v1.00)
- `ANEXO_VI` (Leiautes/RN da Reforma Tributária — IBS/CBS, v1.04.00, NT 009/2026)
- `ANEXO_VII` (Códigos indOp/IBS/CBS, v1.02.00 — versão vigente; v1.00.00 é anterior/desatualizada)
- `ANEXO_A` (municípios IBGE / países ISO2)
- `ANEXO_B` (lista de serviços nacional / NBS)

Se surgir uma nova Nota Técnica ou nova versão de algum desses anexos, os dados aqui podem estar
desatualizados — nesse caso, sinalize isso ao usuário e sugira reprocessar os anexos novos.
