---
source_file: "anexo_ii-sefin_adn-pedregevt_evt-snnfse-v1-01-20260122(1).xlsx"
format: "Markdown técnico reconstruído de XLSX"
language: "pt-BR"
version_in_filename: "1.01"
date_in_filename: "2026-01-22"
workbook_modified_utc: "2026-01-17T18:03:52Z"
---

# Anexo II — PEDREGEVT / EVT — Sistema Nacional NFS-e

> Documentação técnica reconstruída a partir da planilha XLSX. A estrutura foi reorganizada para tornar explícitas as relações que, no Excel, dependiam de células mescladas, posição visual, continuidade de linhas, matriz bidimensional e comentários de células.

## 0. Como interpretar este Markdown

- **Rastreabilidade:** referências como `LEIAUTE EVENTO_PED.REG.EVENTO!linha 23` indicam a linha de origem na planilha.
- **Caminho XML completo:** quando a planilha separa `CAMINHO NO XML` e `CAMPO`, este documento também fornece o caminho lógico completo pela concatenação dos dois.
- **Continuidade de regras:** na aba de regras de negócio, linhas com caminho/campo vazios são tratadas como regras adicionais do último caminho/campo explicitado, preservando a relação visual da planilha.
- **Células mescladas:** valores de contexto (grupo, categoria, ambiente receptor etc.) foram propagados semanticamente para cada registro afetado.
- **Matriz de eventos:** a relação entre um evento já existente e um novo pedido é preservada como uma matriz com IDs estáveis de linha (`Rxx`) e coluna (`Ixx`).
- **Comentários de células:** condições adicionais ligadas a células `X/V` foram extraídas e relacionadas às células originais.
- **`V` / `X` / `X/V`:** `V` = permitido; `X` = não permitido; `X/V` = resultado condicional, detalhado nas condições de célula quando houver comentário associado.
- **`-`:** significa ausência de conteúdo/regra específica no documento-fonte; não deve ser interpretado como zero, vazio lógico ou `false` sem contexto.
- Os códigos abreviados de `ELE` (`A`, `CE`, `CG`, `E`, `G`, `ID`, `Raiz`) e `TIPO` (`C`, `D`, `G`, `N`, `-`) são preservados exatamente como no XLSX. A planilha não traz uma legenda textual completa para essas abreviações.

### Planilhas-fonte

| Ordem | Aba | Dimensão lógica | Papel na documentação |
|---:|---|---|---|
| 1 | TIPO EVENTOS DE NFSe | `A1:M18` | Catálogo e propriedades dos tipos de evento. |
| 2 | RN EVENTOSxEVENTOS | `A1:AB29` | Matriz de permissões/rejeições conforme eventos pré-existentes. |
| 3 | LEIAUTE EVENTO_PED.REG.EVENTO | `A1:I86` | Leiaute XML do Evento e do Pedido de Registro de Evento. |
| 4 | RN EVENTO_PED.REG.EVENTO | `A1:O111` | Regras de negócio, códigos/mensagens de erro e contextos de execução. |

## 1. Catálogo de tipos de eventos de NFS-e

### 1.1 Formação do código do evento

CÓDIGO DO EVENTO:<br><br>O código identificador do evento é formado por 6 dígitos. <br>O 1º dígito identifica a categoria do evento;<br>Os 2º e 3º dígitos identificam o(s) autor(es) do(s) evento(s); <br>O 4º dígito identifica o ambiente receptor do evento e;<br>Os dois últimos dígitos, 5º e 6º, são números crescentes por categorias de eventos;

### 1.2 Legenda de autores do Pedido de Registro de Evento

AUTOR DO PEDIDO DE REGISTRO DE EVENTO:<br><br>01 - Emite - Emitente da NFS-e;<br>02 - Prestador;<br>03 - Tomador;<br>04 - Intermediário;<br>05 - MEmis - Município Emissor;<br>06 - MIncid - Município de Incidência;<br>07 - Man - Módulo de Apuração Nacional;<br>08 - RespTrib - Responsável Tributário<br>56 - MEmis \| MInci <br>67 - MInci \| Man<br>99 - CGNFSe - Comitê Gestor da NFS-e

### 1.3 Legenda de visibilidade

VISIBILIDADE: <br><br>EM - Emitente NFS-e;<br>NE - Não Emitente;<br>SP - Sujeito Passivo;<br>CP - Consulta Pública;<br>AT - Administração Tributária;*<br><br>* Município Emissor da NFS-e, Município(s) do(s) Não Emitente(s) da NFS-e, Município de Incidência do ISSQN e Município do local da prestação do serviço. Conforme regra de negócio a visibilidade poderá ser restrita a apenas algum(uns) desses municípios descritos que compõem a AT;<br><br>** Somente para NFS-e cujo cStat seja "102 - NFS-e de Decisão Judicial";

### 1.4 Eventos

| # | Código segmentado | Código normalizado | Categoria | Grupo | Evento | Autor | Assinatura digital no PEDREGEVT | Ambiente receptor | NFS-e precisa existir no ADN? | Evento único? | Visibilidade | Origem |
|---:|---|---:|---|---|---|---|---|---|---|---|---|---|
| 1 | `1 01 1 01` | `101101` | NFS-e | 1 - Cancelamentos | Cancelamento de NFS-e | Emite | Sim | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 2` |
| 2 | `1 05 1 02` | `105102` | NFS-e | 1 - Cancelamentos | Cancelamento de NFS-e por Substituição | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 3` |
| 3 | `1 01 1 03` | `101103` | NFS-e | 1 - Cancelamentos | Solicitação de Análise Fiscal para Cancelamento de NFS-e | Emite | Sim | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / AT | `TIPO EVENTOS DE NFSe!linha 4` |
| 4 | `1 05 1 04` | `105104` | NFS-e | 1 - Cancelamentos | Cancelamento de NFS-e Deferido por Análise Fiscal | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / AT | `TIPO EVENTOS DE NFSe!linha 5` |
| 5 | `1 05 1 05` | `105105` | NFS-e | 1 - Cancelamentos | Cancelamento de NFS-e Indeferido por Análise Fiscal | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / AT | `TIPO EVENTOS DE NFSe!linha 6` |
| 6 | `2 02 2 01` | `202201` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Confirmação do Prestador | Emite (Prestador) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 7` |
| 7 | `2 03 2 02` | `203202` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Confirmação do Tomador | Emite (Tomador) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 8` |
| 8 | `2 04 2 03` | `204203` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Confirmação do Intermediário | Emite (Intermediário) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 9` |
| 9 | `2 05 2 04` | `205204` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Confirmação Tácita | MIncid | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 10` |
| 10 | `2 02 2 05` | `202205` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Rejeição do Prestador | Emite (Prestador) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 11` |
| 11 | `2 03 2 06` | `203206` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Rejeição do Tomador | Emite (Tomador) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 12` |
| 12 | `2 04 2 07` | `204207` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Rejeição do Intermediário | Emite (Intermediário) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 13` |
| 13 | `2 05 2 08` | `205208` | NFS-e | 2 - Manifestações | Manifestação de NFS-e — Anulação da Rejeição | MIncid | - | 2 - ADN | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 14` |
| 14 | `3 05 1 01` | `305101` | NFS-e | 3 - Ofícios | Cancelamento de NFS-e por Ofício | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / CP / AT | `TIPO EVENTOS DE NFSe!linha 15` |
| 15 | `3 05 1 02` | `305102` | NFS-e | 3 - Ofícios | Bloqueio de NFS-e por Ofício para: Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício; | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Não | EM / AT | `TIPO EVENTOS DE NFSe!linha 16` |
| 16 | `3 05 1 03` | `305103` | NFS-e | 3 - Ofícios | Desbloqueio de NFS-e por Ofício para: Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício; | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Não | EM / AT | `TIPO EVENTOS DE NFSe!linha 17` |
### 1.5 Relação código ↔ grupo XML específico

Nos grupos específicos do leiaute, o código normalizado do evento aparece com o prefixo `e`. Exemplo: o código `101101` corresponde ao grupo XML `e101101`.

| Código | Grupo XML | Evento |
|---:|---|---|
| `101101` | `e101101` | Cancelamento de NFS-e |
| `105102` | `e105102` | Cancelamento de NFS-e por Substituição |
| `101103` | `e101103` | Solicitação de Análise Fiscal para Cancelamento de NFS-e |
| `105104` | `e105104` | Cancelamento de NFS-e Deferido por Análise Fiscal |
| `105105` | `e105105` | Cancelamento de NFS-e Indeferido por Análise Fiscal |
| `202201` | `e202201` | Manifestação de NFS-e — Confirmação do Prestador |
| `203202` | `e203202` | Manifestação de NFS-e — Confirmação do Tomador |
| `204203` | `e204203` | Manifestação de NFS-e — Confirmação do Intermediário |
| `205204` | `e205204` | Manifestação de NFS-e — Confirmação Tácita |
| `202205` | `e202205` | Manifestação de NFS-e — Rejeição do Prestador |
| `203206` | `e203206` | Manifestação de NFS-e — Rejeição do Tomador |
| `204207` | `e204207` | Manifestação de NFS-e — Rejeição do Intermediário |
| `205208` | `e205208` | Manifestação de NFS-e — Anulação da Rejeição |
| `305101` | `e305101` | Cancelamento de NFS-e por Ofício |
| `305102` | `e305102` | Bloqueio de NFS-e por Ofício para: Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício; |
| `305103` | `e305103` | Desbloqueio de NFS-e por Ofício para: Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício; |

## 2. Regras de coexistência entre eventos (`RN EVENTOSxEVENTOS`)

Esta seção representa a matriz da planilha **RN EVENTOSxEVENTOS**. A pergunta lógica de cada célula é:

> **Dado um estado em que determinado evento já está relacionado à NFS-e, um novo Pedido de Registro de Evento pode ser aceito?**

**Redação estrutural preservada da planilha:**

- **Eixo de linhas:** PEDIDOS DE REGISTRO DOS EVENTOS DE NFS-e RECEPCIONADOS NO SISTEMA AUTORIZADOR APÓS UM EVENTO PRÉ-EXISTENTE JÁ ESTAR RELACIONADO À UMA NFS-e
- **Regra da matriz:** AO RECEBER OS POSSÍVEIS PEDIDOS DE REGISTROS DOS EVENTOS ABAIXO, O SISTEMA NACIONAL NFS-e PODE ACEITAR OU REJEITAR O PEDIDO DE REGISTRO DE EVENTO RECEBIDO OU EVENTO COMPARTILHADO, CONFORME INDICADO PELOS SINAIS V (Permitir) OU X (Não é Permitido), RESPECTIVAMENTE

A planilha define `V` como permitido e `X` como não permitido. Valores `X/V` dependem de uma condição adicional; quando essa condição está registrada em comentário de célula, ela é preservada na seção 2.4.

### 2.1 Colunas da matriz: evento recebido/compartilhado

| ID | Coluna XLSX | Código do evento recebido | Evento recebido | Detalhe/alvo |
|---|---|---:|---|---|
| `I01` | `E` | `101101` | Cancelamento de NFS-e | — |
| `I02` | `F` | `105102` | Cancelamento de NFS-e por Substituição | — |
| `I03` | `G` | `101103` | Solicitação de Análise Fiscal para Cancelamento de NFS-e | — |
| `I04` | `H` | `105104` | Cancelamento de NFS-e Deferido por Análise Fiscal | — |
| `I05` | `I` | `105105` | Cancelamento de NFS-e Indeferido por Análise Fiscal | — |
| `I06` | `J` | `202201` | Manifestação de NFS-e - Confirmação do Prestador | — |
| `I07` | `K` | `203202` | Manifestação de NFS-e - Confirmação do Tomador | — |
| `I08` | `L` | `204203` | Manifestação de NFS-e - Confirmação do Intermediário | — |
| `I09` | `M` | `205204` | Manifestação de NFS-e - Confirmação Tácita | — |
| `I10` | `N` | `202205` | Manifestação de NFS-e - Rejeição do Prestador | — |
| `I11` | `O` | `203206` | Manifestação de NFS-e - Rejeição do Tomador | — |
| `I12` | `P` | `204207` | Manifestação de NFS-e - Rejeição do Intermediário | — |
| `I13` | `Q` | `205208` | Manifestação de NFS-e - Anulação da Rejeição | — |
| `I14` | `R` | `305101` | Cancelamento de NFS-e por Ofício | — |
| `I15` | `S` | `305102` | Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e | alvo 101101 — Cancelamento de NFS-e |
| `I16` | `T` | `305102` | Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e por Substituição | alvo 105102 — Cancelamento de NFS-e por Substituição |
| `I17` | `U` | `305102` | Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e Deferido por Análise Fiscal | alvo 105104 — Cancelamento de NFS-e Deferido por Análise Fiscal |
| `I18` | `V` | `305102` | Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e Indeferido por Análise Fiscal | alvo 105105 — Cancelamento de NFS-e Indeferido por Análise Fiscal |
| `I19` | `W` | `305102` | Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e por Ofício | alvo 305101 — Cancelamento de NFS-e por Ofício |
| `I20` | `X` | `305103` | Desbloqueio de NFS-e por Ofício (É permitido SOMENTE se houver um bloqueio pendente e se o desbloqueio corresponder exatamente ao identificador do bloqueio) — Cancelamento de NFS-e | alvo 101101 — Cancelamento de NFS-e |
| `I21` | `Y` | `305103` | Desbloqueio de NFS-e por Ofício (É permitido SOMENTE se houver um bloqueio pendente e se o desbloqueio corresponder exatamente ao identificador do bloqueio) — Cancelamento de NFS-e por Substituição | alvo 105102 — Cancelamento de NFS-e por Substituição |
| `I22` | `Z` | `305103` | Desbloqueio de NFS-e por Ofício (É permitido SOMENTE se houver um bloqueio pendente e se o desbloqueio corresponder exatamente ao identificador do bloqueio) — Cancelamento de NFS-e Deferido por Análise Fiscal | alvo 105104 — Cancelamento de NFS-e Deferido por Análise Fiscal |
| `I23` | `AA` | `305103` | Desbloqueio de NFS-e por Ofício (É permitido SOMENTE se houver um bloqueio pendente e se o desbloqueio corresponder exatamente ao identificador do bloqueio) — Cancelamento de NFS-e Indeferido por Análise Fiscal | alvo 105105 — Cancelamento de NFS-e Indeferido por Análise Fiscal |
| `I24` | `AB` | `305103` | Desbloqueio de NFS-e por Ofício (É permitido SOMENTE se houver um bloqueio pendente e se o desbloqueio corresponder exatamente ao identificador do bloqueio) — Cancelamento de NFS-e por Ofício | alvo 305101 — Cancelamento de NFS-e por Ofício |

### 2.2 Linhas da matriz: evento pré-existente

| ID | Linha XLSX | Evento/estado já relacionado à NFS-e |
|---|---:|---|
| `R01` | 5 | NENHUM EVENTO PRÉ-EXISTENTE |
| `R02` | 6 | Cancelamento de NFS-e |
| `R03` | 7 | Cancelamento de NFS-e por Substituição |
| `R04` | 8 | Solicitação de Análise Fiscal para Cancelamento de NFS-e |
| `R05` | 9 | Cancelamento de NFS-e Deferido por Análise Fiscal |
| `R06` | 10 | Cancelamento de NFS-e Indeferido por Análise Fiscal |
| `R07` | 11 | Manifestação de NFS-e - Confirmação do Prestador |
| `R08` | 12 | Manifestação de NFS-e - Confirmação do Tomador |
| `R09` | 13 | Manifestação de NFS-e - Confirmação do Intermediário |
| `R10` | 14 | Manifestação de NFS-e - Confirmação Tácita |
| `R11` | 15 | Manifestação de NFS-e - Rejeição do Prestador |
| `R12` | 16 | Manifestação de NFS-e - Rejeição do Tomador |
| `R13` | 17 | Manifestação de NFS-e - Rejeição do Intermediário |
| `R14` | 18 | Manifestação de NFS-e - Anulação Rejeição |
| `R15` | 19 | Cancelamento de NFS-e por Ofício |
| `R16` | 20 | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e |
| `R17` | 21 | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e por Substituição |
| `R18` | 22 | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e Deferido por Análise Fiscal |
| `R19` | 23 | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e Indeferido por Análise Fiscal |
| `R20` | 24 | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e por Ofício |
| `R21` | 25 | Desbloqueio de NFS-e por Ofício de: — Ev. de Cancelamento de NFS-e |
| `R22` | 26 | Desbloqueio de NFS-e por Ofício de: — Ev. de Cancelamento de NFS-e por Substituição |
| `R23` | 27 | Desbloqueio de NFS-e por Ofício de: — Ev. de Cancelamento de NFS-e Deferido por Análise Fiscal |
| `R24` | 28 | Desbloqueio de NFS-e por Ofício de: — Ev. de Cancelamento de NFS-e Indeferido por Análise Fiscal |
| `R25` | 29 | Desbloqueio de NFS-e por Ofício de: — Ev. de Cancelamento de NFS-e por Ofício |

### 2.3 Matriz de decisão

Para manter a tabela legível, as colunas usam os IDs `I01` a `I24` definidos na seção 2.1.

| Estado pré-existente | `I01` | `I02` | `I03` | `I04` | `I05` | `I06` | `I07` | `I08` | `I09` | `I10` | `I11` | `I12` | `I13` | `I14` | `I15` | `I16` | `I17` | `I18` | `I19` | `I20` | `I21` | `I22` | `I23` | `I24` |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| `R01` | V | V | V | X | X | V | V | V | V | V | V | V | V | V | V | V | V | V | V | X | X | X | X | X |
| `R02` | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X |
| `R03` | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X |
| `R04` | X | X | X | V | V | V | V | V | V | V | V | V | V | X | V | V | V | V | V | V | V | V | V | V |
| `R05` | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X |
| `R06` | X | X | X | X | X | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V |
| `R07` | X | V | X | X | X | X | X/V | X/V | X | V | X/V | X/V | V | V | V | V | V | V | V | V | V | V | V | V |
| `R08` | X | V | X | X | X | X/V | X | X/V | X | X/V | V | X/V | V | V | V | V | V | V | V | V | V | V | V | V |
| `R09` | X | V | X | X | X | X/V | X/V | X | X | X/V | X/V | V | V | V | V | V | V | V | V | V | V | V | V | V |
| `R10` | X | V | V | V | V | X | X | X | X | X | X | X | X | V | V | V | V | V | V | V | V | V | V | V |
| `R11` | V | V | V | V | V | V | X/V | X/V | X | X | X/V | X/V | V | V | V | V | V | V | V | V | V | V | V | V |
| `R12` | V | V | V | V | V | X/V | V | X/V | X | X/V | X | X/V | V | V | V | V | V | V | V | V | V | V | V | V |
| `R13` | V | V | V | V | V | X/V | X/V | V | X | X/V | X/V | X | V | V | V | V | V | V | V | V | V | V | V | V |
| `R14` | X | V | V | V | V | V | V | V | V | X/V | X/V | X/V | X | V | V | V | V | V | V | V | V | V | V | V |
| `R15` | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X | X |
| `R16` | X/V | V | V | V | V | V | V | V | V | V | V | V | V | V | X/V | V | V | V | V | V | V | V | V | V |
| `R17` | V | X/V | V | V | V | V | V | V | V | V | V | V | V | V | V | X/V | V | V | V | V | V | V | V | V |
| `R18` | V | V | V | X/V | V | V | V | V | V | V | V | V | V | V | V | V | X/V | V | V | V | V | V | V | V |
| `R19` | V | V | V | V | X/V | V | V | V | V | V | V | V | V | V | V | V | V | X/V | V | V | V | V | V | V |
| `R20` | V | V | V | V | V | V | V | V | V | V | V | V | V | X/V | V | V | V | V | X/V | V | V | V | V | V |
| `R21` | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | X | V | V | V | V |
| `R22` | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | X | V | V | V |
| `R23` | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | X | V | V |
| `R24` | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | X | V |
| `R25` | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | V | X |

### 2.4 Condições e comentários vinculados à matriz

Os comentários do Excel são semanticamente relevantes porque explicam quando uma célula marcada `X/V` deve ser interpretada como `X` ou `V`.

#### 2.4.1 Definições de condição

| ID | Condição extraída do comentário da célula |
|---|---|
| `COND-01` | X: Se o tomador for o emitente;<br><br>V: Se o tomador for o não emitente; |
| `COND-02` | X: Se o intermediário for o emitente;<br><br>V: Se o intermediário for o não emitente; |
| `COND-03` | X: Se o prestador for o emitente;<br><br>V: Se o prestador for o não emitente; |
| `COND-04` | X: Se o Evento de Manif. de  Rejeição do não emitente prestador já foi anulada;<br><br>V: Se o Evento de Manif. de  Rejeição do não emitente prestador não foi anulada; |
| `COND-05` | X: Se o Evento de Manif. de  Rejeição do não emitente tomador já foi anulada;<br><br>V: Se o Evento de Manif. de  Rejeição do não emitente tomador não foi anulada; |
| `COND-06` | X: Se o Evento de Manif. de  Rejeição do não emitente intermediário já foi anulada;<br><br>V: Se o Evento de Manif. de  Rejeição do não emitente intermediário não foi anulada; |
| `COND-07` | Depende do motivo<br>	-Gustavo Jubé<br>ok<br>	-Adriano Guedes<br>----<br>Depende do motivo<br>	-Gustavo Jubé<br>ok<br>	-Adriano Guedes |
| `COND-08` | X: Se não houver um desbloqueio para este evento;<br><br>V: Se houver um desbloqueio para este evento; |
| `COND-09` | V: Se NFS-e identificada no Bloqueio que está chegando, já possuir um bloqueio anterior para o mesmo tipo de evento COM o respectivo desbloqueio;<br><br>X: Se NFS-e identificada no Bloqueio que está chegando, já possuir um bloqueio anterior para o mesmo tipo de evento SEM o respectivo desbloqueio; |

#### 2.4.2 Células às quais cada condição se aplica

| Célula XLSX | Valor da célula | Linha/estado pré-existente | Coluna/evento recebido | Condição |
|---|---|---|---|---|
| `K11` | X/V | Manifestação de NFS-e - Confirmação do Prestador | `I07` — Manifestação de NFS-e - Confirmação do Tomador | `COND-01` |
| `L11` | X/V | Manifestação de NFS-e - Confirmação do Prestador | `I08` — Manifestação de NFS-e - Confirmação do Intermediário | `COND-02` |
| `O11` | X/V | Manifestação de NFS-e - Confirmação do Prestador | `I11` — Manifestação de NFS-e - Rejeição do Tomador | `COND-01` |
| `P11` | X/V | Manifestação de NFS-e - Confirmação do Prestador | `I12` — Manifestação de NFS-e - Rejeição do Intermediário | `COND-02` |
| `J12` | X/V | Manifestação de NFS-e - Confirmação do Tomador | `I06` — Manifestação de NFS-e - Confirmação do Prestador | `COND-03` |
| `L12` | X/V | Manifestação de NFS-e - Confirmação do Tomador | `I08` — Manifestação de NFS-e - Confirmação do Intermediário | `COND-02` |
| `N12` | X/V | Manifestação de NFS-e - Confirmação do Tomador | `I10` — Manifestação de NFS-e - Rejeição do Prestador | `COND-03` |
| `P12` | X/V | Manifestação de NFS-e - Confirmação do Tomador | `I12` — Manifestação de NFS-e - Rejeição do Intermediário | `COND-02` |
| `J13` | X/V | Manifestação de NFS-e - Confirmação do Intermediário | `I06` — Manifestação de NFS-e - Confirmação do Prestador | `COND-03` |
| `K13` | X/V | Manifestação de NFS-e - Confirmação do Intermediário | `I07` — Manifestação de NFS-e - Confirmação do Tomador | `COND-01` |
| `N13` | X/V | Manifestação de NFS-e - Confirmação do Intermediário | `I10` — Manifestação de NFS-e - Rejeição do Prestador | `COND-03` |
| `O13` | X/V | Manifestação de NFS-e - Confirmação do Intermediário | `I11` — Manifestação de NFS-e - Rejeição do Tomador | `COND-01` |
| `K15` | X/V | Manifestação de NFS-e - Rejeição do Prestador | `I07` — Manifestação de NFS-e - Confirmação do Tomador | `COND-01` |
| `L15` | X/V | Manifestação de NFS-e - Rejeição do Prestador | `I08` — Manifestação de NFS-e - Confirmação do Intermediário | `COND-02` |
| `O15` | X/V | Manifestação de NFS-e - Rejeição do Prestador | `I11` — Manifestação de NFS-e - Rejeição do Tomador | `COND-01` |
| `P15` | X/V | Manifestação de NFS-e - Rejeição do Prestador | `I12` — Manifestação de NFS-e - Rejeição do Intermediário | `COND-02` |
| `J16` | X/V | Manifestação de NFS-e - Rejeição do Tomador | `I06` — Manifestação de NFS-e - Confirmação do Prestador | `COND-03` |
| `L16` | X/V | Manifestação de NFS-e - Rejeição do Tomador | `I08` — Manifestação de NFS-e - Confirmação do Intermediário | `COND-02` |
| `N16` | X/V | Manifestação de NFS-e - Rejeição do Tomador | `I10` — Manifestação de NFS-e - Rejeição do Prestador | `COND-03` |
| `P16` | X/V | Manifestação de NFS-e - Rejeição do Tomador | `I12` — Manifestação de NFS-e - Rejeição do Intermediário | `COND-02` |
| `J17` | X/V | Manifestação de NFS-e - Rejeição do Intermediário | `I06` — Manifestação de NFS-e - Confirmação do Prestador | `COND-03` |
| `K17` | X/V | Manifestação de NFS-e - Rejeição do Intermediário | `I07` — Manifestação de NFS-e - Confirmação do Tomador | `COND-01` |
| `N17` | X/V | Manifestação de NFS-e - Rejeição do Intermediário | `I10` — Manifestação de NFS-e - Rejeição do Prestador | `COND-03` |
| `O17` | X/V | Manifestação de NFS-e - Rejeição do Intermediário | `I11` — Manifestação de NFS-e - Rejeição do Tomador | `COND-01` |
| `N18` | X/V | Manifestação de NFS-e - Anulação Rejeição | `I10` — Manifestação de NFS-e - Rejeição do Prestador | `COND-04` |
| `O18` | X/V | Manifestação de NFS-e - Anulação Rejeição | `I11` — Manifestação de NFS-e - Rejeição do Tomador | `COND-05` |
| `P18` | X/V | Manifestação de NFS-e - Anulação Rejeição | `I12` — Manifestação de NFS-e - Rejeição do Intermediário | `COND-06` |
| `C20` | Bloqueio de NFS-e por Ofício para: | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e | Comentário em célula estrutural/descrição | `COND-07` |
| `E20` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e | `I01` — Cancelamento de NFS-e | `COND-08` |
| `S20` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e | `I15` — Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e | `COND-09` |
| `F21` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e por Substituição | `I02` — Cancelamento de NFS-e por Substituição | `COND-08` |
| `T21` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e por Substituição | `I16` — Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e por Substituição | `COND-09` |
| `H22` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e Deferido por Análise Fiscal | `I04` — Cancelamento de NFS-e Deferido por Análise Fiscal | `COND-08` |
| `U22` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e Deferido por Análise Fiscal | `I17` — Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e Deferido por Análise Fiscal | `COND-09` |
| `I23` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e Indeferido por Análise Fiscal | `I05` — Cancelamento de NFS-e Indeferido por Análise Fiscal | `COND-08` |
| `V23` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e Indeferido por Análise Fiscal | `I18` — Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e Indeferido por Análise Fiscal | `COND-09` |
| `R24` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e por Ofício | `I14` — Cancelamento de NFS-e por Ofício | `COND-08` |
| `W24` | X/V | Bloqueio de NFS-e por Ofício para: — Ev. de Cancelamento de NFS-e por Ofício | `I19` — Bloqueio de NFS-e por Ofício (É permitido SOMENTE para eventos que ainda não tenham sido bloqueados ou que já foram desbloqueados) — Cancelamento de NFS-e por Ofício | `COND-09` |

## 3. Leiaute XML — `EVENTO_PED.REG.EVENTO`

### 3.1 Campos comuns e estrutura-base

| # | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|
| 1 | `evento` | Raiz | - | - | - | TAG raiz | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 2` |
| 2 | `evento/versao` | A | C | 1-1 | 1-4V2 | Versão do leiaute do evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 3` |
| 3 | `evento/infEvento` | G | - | 1-1 | - | Grupo de informações do pedido de registro do evento | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 4` |
| 4 | `evento/infEvento/id` | ID | C | 1-1 | 62 | O identificador do evento é composto pela concatenação de campos que constam no leiaute.<br><br>A formação deste identificador considera o literal "EVT" associado a outras 59 posições numéricas, conforme descrito abaixo:<br><br>"EVT" + <br>id do Pedido de Registo de Evento (56) + <br>Número sequencial do evento (nSeqEvento) (3) | Para a formação do id do Evento, considerar o id do Pedido de Registro de Evento sem o literal "PRE". | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 5` |
| 5 | `evento/infEvento/verAplic` | E | C | 1-1 | 1-20 | Versão do aplicativo que gerou o evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 6` |
| 6 | `evento/infEvento/ambGer` | E | D | 1-1 | - | Ambiente gerador do evento:<br><br>1 - Sistema próprio do município;<br>2 - Sefin Nacional NFS-e;<br>3 - ADN NFS-e; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 7` |
| 7 | `evento/infEvento/nSeqEvento` | E | N | 1-1 | 3 | Número sequencial do evento para o mesmo tipo de evento.<br><br>Para os eventos que ocorrem somente uma vez, como é o caso do cancelamento, o nSeqEvento = 001. <br><br>Para os eventos que possam existir mais de um evento do mesmo tipo o ambiente gerador deverá numerar de forma sequencial. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 8` |
| 8 | `evento/infEvento/dhProc` | E | D | 1-1 | - | Data/Hora do registro do evento.<br>Data e hora no formato UTC (Universal Coordinated Time):<br>AAAA-MM-DDThh:mm:ssTZD | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 9` |
| 9 | `evento/infEvento/nDFSe` | E | N | 1-1 | 1-13 | Número sequencial do documento gerado por ambiente gerador de DFSe do município. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 10` |
| 10 | `evento/infEvento/pedRegEvento` | G | G | 1-1 | - | Leiaute do pedido de registro do evento gerado pelo autor do evento | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 11` |
| 11 | `evento/pedRegEvento/versao` | A | C | 1-1 | 1-4V2 | Versão do leiaute do pedido de registro do evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 12` |
| 12 | `evento/pedRegEvento/infPedReg` | G | - | 1-1 | - | Parte Geral do Pedido de Registro de Evento<br>Grupo de informações do pedido de registro do evento | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 13` |
| 13 | `evento/pedRegEvento/infPedReg/id` | ID | C | 1-1 | 59 | O identificador do pedido de registro de evento é composto pela concatenação de campos que constam no leiaute.<br><br>A formação deste identificador considera o literal "PRE" associado a outras 56 posições numéricas, conforme descrito abaixo:<br><br>"PRE" + <br>Chave de acesso da NFS-e (50) +<br>Código do evento (6) | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 14` |
| 14 | `evento/pedRegEvento/infPedReg/tpAmb` | E | N | 1-1 | 1 | Tipo de ambiente:<br><br>1 - Produção; <br>2 - Homologação; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 15` |
| 15 | `evento/pedRegEvento/infPedReg/verAplic` | E | C | 1-1 | 1-20 | Versão do aplicativo que gerou o pedido de registro de evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 16` |
| 16 | `evento/pedRegEvento/infPedReg/dhEvento` | E | D | 1-1 | - | Data e hora do evento no formato AAAA-MM-DDThh:mm:ssTZD (UTC - Universal Coordinated Time, onde TZD pode ser -02:00 (Fernando de Noronha), -03:00 (Brasília) ou -04:00 (Manaus), no horário de verão serão -01:00, -02:00 e -03:00. Ex.: 2010-08-19T13:00:15-03:00. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 17` |
| 17 | `evento/pedRegEvento/infPedReg/CNPJAutor` | CE | N | 1-1 | 14 | Número de inscrição federal (CNPJ) do autor do evento.<br><br>CNPJ do autor do evento (parte interessada ou pessoa que figure na NFS-e.<br>O autor do evento não é o procurador). | Em eventos onde o autor é o fisco, o campo deverá ser preenchido com o CNPJ da prefeitura. | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 18` |
| 18 | `evento/pedRegEvento/infPedReg/CPFAutor` | CE | N | 1-1 | 11 | Número de inscrição federal (CPF) do autor do evento.<br><br>CPF do autor do evento (parte interessada ou pessoa que figure na NFS-e como prestador, tomador, intermediário. O autor do evento poderá ser o procurador). | Em eventos onde o autor é o fisco, este campo não poderá ser preenchido. | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 19` |
| 19 | `evento/pedRegEvento/infPedReg/chNFSe` | CE | N | 1-1 | 50 | Identificador da NFS-e à qual o evento será vinculado. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 20` |

### 3.2 Grupos específicos por tipo de evento

Cada grupo abaixo é uma alternativa específica dentro de `evento/pedRegEvento/infPedReg/`. O nome do grupo (`eNNNNNN`) corresponde diretamente ao código normalizado do evento.

#### `e101101` — Cancelamento de NFS-e

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e101101`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Pedido de Registro de Evento<br>Evento Cancelamento de NFS-e
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 21`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 21 | `xDesc` | `evento/pedRegEvento/infPedReg/e101101/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento: <br>Cancelamento de NFS-e | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 22` |
| 22 | `cMotivo` | `evento/pedRegEvento/infPedReg/e101101/cMotivo` | E | N | 1-1 | 1 | Código de justificativa de cancelamento:<br><br>1 - Erro na Emissão;<br>2 - Serviço não Prestado;<br>9 - Outros; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 23` |
| 23 | `xMotivo` | `evento/pedRegEvento/infPedReg/e101101/xMotivo` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 24` |

#### `e105102` — Cancelamento de NFS-e por Substituição

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e105102`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Pedido de Registro de Evento<br>Cancelamento de NFS-e por Substituição
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 25`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 25 | `xDesc` | `evento/pedRegEvento/infPedReg/e105102/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento: <br>Cancelamento de NFS-e por Substituição | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 26` |
| 26 | `cMotivo` | `evento/pedRegEvento/infPedReg/e105102/cMotivo` | E | N | 1-1 | 2 | Código de justificativa de cancelamento substituição:<br><br>01 - Desenquadramento de NFS-e do Simples Nacional;<br>02 - Enquadramento de NFS-e no Simples Nacional;<br>03 - Inclusão Retroativa de Imunidade/Isenção para NFS-e;<br>04 - Exclusão Retroativa de Imunidade/Isenção para NFS-e;<br>05 - Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo;<br>99 - Outros;<br><br>Obtido do campo da DPS "DPS/infDPS/subst/cMotivo". | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 27` |
| 27 | `xMotivo` | `evento/pedRegEvento/infPedReg/e105102/xMotivo` | E | C | 0-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento.<br><br>Obtido do campo da DPS "DPS/infDPS/subst/xMotivo". | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 28` |
| 28 | `chSubstituta` | `evento/pedRegEvento/infPedReg/e105102/chSubstituta` | E | N | 1-1 | 50 | Chave de Acesso da NFS-e substituta. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 29` |

#### `e101103` — Solicitação de Análise Fiscal para Cancelamento de NFS-e

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e101103`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Pedido de Registro de Evento<br>Solicitação de Análise Fiscal para Cancelamento de NFS-e
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 30`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 30 | `xDesc` | `evento/pedRegEvento/infPedReg/e101103/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Solicitação de Análise Fiscal para Cancelamento de NFS-e | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 31` |
| 31 | `cMotivo` | `evento/pedRegEvento/infPedReg/e101103/cMotivo` | E | N | 1-1 | 1 | Código do motivo da solicitação de análise fiscal para cancelamento de NFS-e:<br><br>1 - Erro na Emissão;<br>2 - Serviço não Prestado;<br>9 - Outros; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 32` |
| 32 | `xMotivo` | `evento/pedRegEvento/infPedReg/e101103/xMotivo` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 33` |

#### `e105104` — Cancelamento de NFS-e Deferido por Análise Fiscal

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e105104`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Pedido de Registro de Evento<br>Cancelamento de NFS-e Deferido por Análise Fiscal
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 34`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 34 | `xDesc` | `evento/pedRegEvento/infPedReg/e105104/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Cancelamento de NFS-e Deferido por Análise Fiscal | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 35` |
| 35 | `CPFAgTrib` | `evento/pedRegEvento/infPedReg/e105104/CPFAgTrib` | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal que efetuou o deferimento da solicitação de análise fiscal para cancelamento de NFS-e. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 36` |
| 36 | `nProcAdm` | `evento/pedRegEvento/infPedReg/e105104/nProcAdm` | E | N | 0-1 | 1-30 | Número do processo administrativo municipal vinculado à solicitação de análise fiscal para cancelamento de NFS-e. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 37` |
| 37 | `cMotivo` | `evento/pedRegEvento/infPedReg/e105104/cMotivo` | E | N | 1-1 | 1 | Resposta da solicitação de análise fiscal para cancelamento de NFS-e:<br><br>1 - Cancelamento de NFS-e Deferido; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 38` |
| 38 | `xMotivo` | `evento/pedRegEvento/infPedReg/e105104/xMotivo` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 39` |

#### `e105105` — Cancelamento de NFS-e Indeferido por Análise Fiscal

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e105105`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Pedido de Registro de Evento<br>Cancelamento de NFS-e Indeferido por Análise Fiscal
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 40`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 40 | `xDesc` | `evento/pedRegEvento/infPedReg/e105105/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Cancelamento de NFS-e Indeferido por Análise Fiscal | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 41` |
| 41 | `CPFAgTrib` | `evento/pedRegEvento/infPedReg/e105105/CPFAgTrib` | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal que efetuou o indeferimento da solicitação de análise fiscal para cancelamento de NFS-e. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 42` |
| 42 | `nProcAdm` | `evento/pedRegEvento/infPedReg/e105105/nProcAdm` | E | N | 0-1 | 1-30 | Número do processo administrativo municipal vinculado à solicitação de análise fiscal para cancelamento de NFS-e. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 43` |
| 43 | `cMotivo` | `evento/pedRegEvento/infPedReg/e105105/cMotivo` | E | N | 1-1 | 1 | Resposta da solicitação de análise fiscal para cancelamento de NFS-e:<br><br>1 - Cancelamento de NFS-e Indeferido;<br>2 - Cancelamento de NFS-e Indeferido Sem Análise de Mérito; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 44` |
| 44 | `xMotivo` | `evento/pedRegEvento/infPedReg/e105105/xMotivo` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 45` |

#### `e202201` — Manifestação de NFS-e — Confirmação do Prestador

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e202201`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Confirmação do Prestador
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 46`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 46 | `xDesc` | `evento/pedRegEvento/infPedReg/e202201/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Confirmação do Prestador | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 47` |

#### `e203202` — Manifestação de NFS-e — Confirmação do Tomador

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e203202`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Confirmação do Tomador
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 48`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 48 | `xDesc` | `evento/pedRegEvento/infPedReg/e203202/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Confirmação do Tomador | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 49` |

#### `e204203` — Manifestação de NFS-e — Confirmação do Intermediário

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e204203`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Confirmação do Intermediário
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 50`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 50 | `xDesc` | `evento/pedRegEvento/infPedReg/e204203/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Confirmação do Intermediário | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 51` |

#### `e205204` — Manifestação de NFS-e — Confirmação Tácita

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e205204`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Confirmação Tácita
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 52`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 52 | `xDesc` | `evento/pedRegEvento/infPedReg/e205204/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Confirmação Tácita | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 53` |

#### `e202205` — Manifestação de NFS-e — Rejeição do Prestador

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e202205`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Rejeição do Prestador
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 54`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 54 | `xDesc` | `evento/pedRegEvento/infPedReg/e202205/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Rejeição do Prestador | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 55` |
| 55 | `cMotivo` | `evento/pedRegEvento/infPedReg/e202205/cMotivo` | E | N | 1-1 | 1 | Motivo da Rejeição da NFS-e:<br><br>1 - NFS-e em duplicidade;<br>2 - NFS-e já emitida pelo tomador;<br>3 - Não ocorrência do fato gerador;<br>4 - Erro quanto a responsabilidade tributária;<br>5 - Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador;<br>9 - Outros; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 56` |
| 56 | `xMotivo` | `evento/pedRegEvento/infPedReg/e202205/xMotivo` | E | C | 0-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 57` |

#### `e203206` — Manifestação de NFS-e — Rejeição do Tomador

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e203206`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br> Manifestação de NFS-e - Rejeição do Tomador
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 58`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 58 | `xDesc` | `evento/pedRegEvento/infPedReg/e203206/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Rejeição do Tomador | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 59` |
| 59 | `cMotivo` | `evento/pedRegEvento/infPedReg/e203206/cMotivo` | E | N | 1-1 | 1 | Motivo da Rejeição da NFS-e:<br><br>1 - NFS-e em duplicidade;<br>2 - NFS-e já emitida pelo tomador;<br>3 - Não ocorrência do fato gerador;<br>4 - Erro quanto a responsabilidade tributária;<br>5 - Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador;<br>9 - Outros; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 60` |
| 60 | `xMotivo` | `evento/pedRegEvento/infPedReg/e203206/xMotivo` | E | C | 0-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 61` |

#### `e204207` — Manifestação de NFS-e — Rejeição do Intermediário

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e204207`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Rejeição do Intermediário
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 62`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 62 | `xDesc` | `evento/pedRegEvento/infPedReg/e204207/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Rejeição do Intermediário | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 63` |
| 63 | `cMotivo` | `evento/pedRegEvento/infPedReg/e204207/cMotivo` | E | N | 1-1 | 1 | Motivo da Rejeição da NFS-e:<br><br>1 - NFS-e em duplicidade;<br>2 - NFS-e já emitida pelo tomador;<br>3 - Não ocorrência do fato gerador;<br>4 - Erro quanto a responsabilidade tributária;<br>5 - Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador;<br>9 - Outros; | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 64` |
| 64 | `xMotivo` | `evento/pedRegEvento/infPedReg/e204207/xMotivo` | E | C | 0-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 65` |

#### `e205208` — Manifestação de NFS-e — Anulação da Rejeição

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e205208`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Manifestação de NFS-e - Anulação da Rejeição
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 66`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 66 | `xDesc` | `evento/pedRegEvento/infPedReg/e205208/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Manifestação de NFS-e - Anulação da Rejeição | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 67` |
| 67 | `CPFAgTrib` | `evento/pedRegEvento/infPedReg/e205208/CPFAgTrib` | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal que efetuou o anulação da manifestação de rejeição da NFS-e. | — | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 68` |
| 68 | `idEvManifRej` | `evento/pedRegEvento/infPedReg/e205208/idEvManifRej` | E | C | 1-1 | 59 | Referência ao "id" do Evento de Manifestação de NFS-e - Rejeição, que originou o presente evento de anulação. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 69` |
| 69 | `xMotivo` | `evento/pedRegEvento/infPedReg/e205208/xMotivo` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 70` |

#### `e305101` — Cancelamento de NFS-e por Ofício

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e305101`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Cancelamento de NFS-e por Ofício
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 71`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 71 | `xDesc` | `evento/pedRegEvento/infPedReg/e305101/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento:<br>Cancelamento de NFS-e por Ofício | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 72` |
| 72 | `CPFAgTrib` | `evento/pedRegEvento/infPedReg/e305101/CPFAgTrib` | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal que efetuou o cancelamento por ofício de NFS-e. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 73` |
| 73 | `nProcAdm` | `evento/pedRegEvento/infPedReg/e305101/nProcAdm` | E | N | 1-1 | 30 | Número do processo administrativo municipal vinculado ao cancelamento de NFS-e por ofício. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 74` |
| 74 | `xProcAdm` | `evento/pedRegEvento/infPedReg/e305101/xProcAdm` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo do processo administrativo municipal indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 75` |

#### `e305102` — Bloqueio de NFS-e por Ofício para: Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício;

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e305102`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Bloqueio de NFS-e por Ofício
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 76`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 76 | `xDesc` | `evento/pedRegEvento/infPedReg/e305102/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento: <br>Bloqueio de NFS-e por Ofício | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 77` |
| 77 | `CPFAgTrib` | `evento/pedRegEvento/infPedReg/e305102/CPFAgTrib` | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal que efetuou o bloqueio de NFS-e por ofício. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 78` |
| 78 | `codEvento` | `evento/pedRegEvento/infPedReg/e305102/codEvento` | E | N | 1-1 | 7 | Eventos que podem ser escolhidos pelo município emissor para serem rejeitados após emissão e vinculação do evento de bloqueio por ofício em uma NFS-e:<br><br>e101101 - Cancelamento de NFS-e;<br>e105102 - Cancelamento de NFS-e por Substituição;<br>e105104 - Cancelamento de NFS-e Deferido por Análise Fiscal;<br>e105105 - Cancelamento de NFS-e Indeferido por Análise Fiscal;<br>e305101 - Cancelamento de NFS-e por Ofício; | Verificar em conjunto o código do Evento de Bloqueio  associado ao código do evento que está sendo bloqueado (valor do campo cEvtNFSe).<br><br>Em <tipo_evento_bloqueio_NFS-e> substituir pelo nome do evento correspondente ao código do campo cEvtNFSe.<br><br>e101101 - Cancelamento de NFS-e;<br>e105102 - Cancelamento de NFS-e por Substituição;<br>e105104 - Cancelamento de NFS-e Deferido por Análise Fiscal;<br>e105105 - Cancelamento de NFS-e Indeferido por Análise Fiscal;<br>e305101 - Cancelamento de NFS-e por Ofício; | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 79` |
| 79 | `xMotivo` | `evento/pedRegEvento/infPedReg/e305102/xMotivo` | E | C | 1-1 | 15-255 | Descrição para explicitar o motivo indicado neste evento. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 80` |

#### `e305103` — Desbloqueio de NFS-e por Ofício para: Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício;

- **Caminho do grupo:** `evento/pedRegEvento/infPedReg/e305103`
- **Ocorrência:** `1-1`
- **Descrição-fonte:** Parte Específica do Evento<br>Desbloqueio de NFS-e por Ofício
- **Origem:** `LEIAUTE EVENTO_PED.REG.EVENTO!linha 81`

| # | Campo | Caminho XML completo | ELE | TIPO | Ocorrência | Tamanho | Descrição | Observações de negócio | Origem |
|---:|---|---|---|---|---|---|---|---|---|
| 81 | `xDesc` | `evento/pedRegEvento/infPedReg/e305103/xDesc` | E | C | 1-1 | 5-60 | Descrição do evento: <br>Desbloqueio de NFS-e por Ofício | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 82` |
| 82 | `CPFAgTrib` | `evento/pedRegEvento/infPedReg/e305103/CPFAgTrib` | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal que efetuou o desbloqueio de NFS-e por ofício. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 83` |
| 83 | `idBloqOfic` | `evento/pedRegEvento/infPedReg/e305103/idBloqOfic` | E | C | 1-1 | 59 | Referência ao "id" do "Bloqueio de ofício" que originou o presente evento de desbloqueio. | - | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 84` |

### 3.3 Assinaturas XML

| # | Caminho XML completo | ELE | TIPO | Ocorrência | Descrição | Origem |
|---:|---|---|---|---|---|---|
| 84 | `evento/pedRegEvento/Signature` | G | - | 0-1 | Assinatura do pedido de registro de evento segundo o Padrão XML Digital Signature. | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 85` |
| 85 | `evento/Signature` | G | - | 1-1 | Assinatura do pedido de registro segundo o Padrão XML Digital Signature. | `LEIAUTE EVENTO_PED.REG.EVENTO!linha 86` |

## 4. Regras de negócio do Evento / Pedido de Registro de Evento

### 4.1 Níveis de regra

Nível 1 - Regras de negócio para consistência do Leiaute NFS-e<br><br>Nível 2 - Regras de Negócio gerais para todos os municípios aderentes ao SN NFS-e<br><br>Nível 3 - Regras de Negócio específicas conforme legislação municipal do município parametrizada no SN NFS-e

### 4.2 Contextos de execução das regras

| Coluna resumida neste Markdown | Coluna original | Significado conforme cabeçalho da planilha |
|---|---|---|
| `EP` | K | RNs EXECUTADAS NA RECEPÇÃO DE PEDREGEVT EVIADOS PELOS EMITENTES (V),<br>RNs EXECUTADAS NA GERAÇÃO DAS INFORMAÇÕES DE EVENTOS PELOS EMISSORES PÚBLICOS NACIONAIS (V) E<br>RNs NÃO EXECUTADAS (X) |
| `EP-102` | L | EVENTOS EMITIDOS SOB CONDIÇÕES DE <br>DECISÃO JUDICIAL OU ADMINISTRATIVA (cStat = 102)<br>RNs EXECUTADAS NA GERAÇÃO DE EVENTOS PELOS<br>EMISSORES PÚBLICOS NACIONAIS (SEFIN, WEB, APP)<br>RNs EXECUTADAS (V)<br>RNs NÃO EXECUTADAS (X) |
| `ADN` | M | RNs EXECUTADAS <br>NA RECEPÇÃO DE EVENTOS COMPARTILHADOS <br>PELOS MUNICÍPIOS COM O <br>ADN NFS-e (V) <br>E<br>RNs NÃO EXECUTADAS (X) |
| `ADN-102` | N | EVENTOS EMITIDOS SOB CONDIÇÕES DE <br>DECISÃO JUDICIAL OU ADMINISTRATIVA (cStat = 102)<br>RNs EXECUTADAS NA GERAÇÃO DE EVENTOS PELOS<br>EMISSORES PÚBLICOS NACIONAIS (SEFIN, WEB, APP)<br>RNs EXECUTADAS (V)<br>RNs NÃO EXECUTADAS (X) |

Nas colunas acima, `V` indica que a regra é executada no contexto e `X` indica que não é executada. O texto é preservado conforme o cabeçalho original, inclusive quando a redação é repetida entre contextos.

### 4.3 Regras agrupadas pelo alvo XML

#### `evento`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 1 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 4` |

#### `evento/versao`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 2 | O prazo de aceitação da versão do leiaute do DF-e ultrapassado. | Obrig. | Rej. | E1260 | O prazo de aceitação da versão do leiaute do DF-e expirou. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 5` |

#### `evento/infEvento`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 3 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 6` |

#### `evento/infEvento/id`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 4 | Campo identificador do Evento (EVT) inválido.<br><br>Identificador do evento difere da concatenação dos campos correspondentes existente no leiaute evento.<br><br>A formação deste identificador considera o literal "EVT" associado a outras 59 posições numéricas, <br>conforme descrito abaixo:<br><br>"EVT" + <br>id do Pedido de Registo de Evento (56) + <br>Número sequencial do evento (nSeqEvento) (3) | Obrig. | Rej. | E1802 | Conteúdo do identificador informado no identificador do evento difere da concatenação dos campos correspondentes. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 7` |
| 5 | O id do evento compartilhado já existe no ADN. | Obrig. | Rej. | E1805 | Já existe um Evento com este identificador no ADN NFS-e. | 1 | X | X | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 8` |
| 6 | O id do evento gerado já existe no ADN. | Obrig. | Rej. | E0802 | Já existe um documento fiscal eletrônico identificado com este id no Sistema Nacional NFS-e. | — | V | V | X | X | - | `RN EVENTO_PED.REG.EVENTO!linha 9` |

#### `evento/infEvento/verAplic`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 7 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 10` |

#### `evento/infEvento/ambGer`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 8 | Verificar se o ambiente gerador da NFS-e está de acordo com a definição:<br>1- Sistema Próprio do Município, para as NFS-e compartilhadas pelo município para o ADN, ou<br>2 - Sefin Nacional NFS-e, para as NFS-e emitidas pela Sefin ou recepcionadas via API "Bypass". | Obrig. | Rej. | E1274 | O ambiente gerador da NFS-e não está de acordo com a definição 1 (Sistema Próprio do Município) ou 2 (Sefin Nacional). | 1 | X | X | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 11` |

#### `evento/infEvento/nSeqEvento`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 9 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 12` |

#### `evento/infEvento/dhProc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 10 | A data/hora do registro do evento deve ser anterior à data/hora do processamento do documento pelo Sistema Nacional NFS-e. | Obrig. | Rej. | E1278 | A data e hora do processamento (geração) do DF-e deve ser anterior ou igual à data da recepção pelo Sistema Nacional NFS-e. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 13` |

#### `evento/infEvento/nDFSe`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 11 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 14` |

#### `evento/infEvento/pedRegEvento`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 12 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 15` |

#### `evento/pedRegEvento/versao`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 13 | Prazo de aceitação da versão do leiaute do pedido de registro de evento ultrapassado. | Obrig. | Rej. | E1825 | Prazo de aceitação da versão do leiaute do pedido de registro de evento expirou. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 16` |

#### `evento/pedRegEvento/infPedReg`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 14 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 17` |

#### `evento/pedRegEvento/infPedReg/id`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 15 | Campo identificador do Pedido de Registro de Evento (PRE) inválido.<br><br>Identificador do PRE difere da concatenação dos campos correspondentes existente no leiaute do PRE.<br><br>A formação deste identificador considera o literal "PRE" associado a outras 56 posições numéricas, conforme descrito abaixo:<br><br>"PRE" + <br>Chave de acesso da NFS-e (50) +<br>Código do evento (6) | Obrig. | Rej. | E1827 | Conteúdo do identificador informado no identificador do Pedido de Registro de Evento difere da concatenação dos campos correspondentes. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 18` |
| 16 | Não é permitido o compartilhamento dos seguintes eventos pelo município com o ADN são:<br>202201 - Manifestação de NFS-e de Confirmação do Prestador;<br>203202 - Manifestação de NFS-e de Confirmação do Tomador;<br>204203 - Manifestação de NFS-e de Confirmação do Intermediário;<br>202205 - Manifestação de NFS-e de Rejeição do Prestador;<br>203206 - Manifestação de NFS-e de Rejeição do Tomador;<br>204207 - Manifestação de NFS-e de Rejeição do Intermediário; | Obrig. | Rej. | E1818 | Não é permitido o compartilhamento pelo município com o ADN dos eventos de manifestação de NFS-e para confirmação ou rejeição pelos não emitentes de um NFS-e. Estes eventos devem ser emitidos pelos não emitentes da NFS-e diretamente no SEFIN NFS-e. | 1 | X | X | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 19` |

#### `evento/pedRegEvento/infPedReg/tpAmb`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 17 | Tipo do ambiente informado difere do ambiente utilizado. | Obrig. | Rej. | E1845 | Ambiente informado diverge do ambiente de recebimento para o qual o emitente está enviando o evento. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 20` |

#### `evento/pedRegEvento/infPedReg/verAplic`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 18 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 21` |

#### `evento/pedRegEvento/infPedReg/dhEvento`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 19 | A data de emissão do pedido do registro do evento não pode ser posterior à data de recebimento do lote <br>em que o Evento está sendo recebido pelo Sistema Nacional NFS-e. | Obrig. | Rej. | E1843 | A data de emissão do pedido do registro do evento não pode ser posterior à data de recebimento pelo Sistema Nacional NFS-e. | 1 | X | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 22` |

#### `evento/pedRegEvento/infPedReg/CNPJAutor`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 20 | Se o autor do pedido de registro de evento for identificado por um CNPJ este deve corresponder ao mesmo CNPJ do certificado digital da assinatura, se informada no pedido. <br><br>Verificar apenas o CNPJ base. | Obrig. | Rej. | E0812 | O CNPJ do autor do pedido de registro de evento não corresponde à base do CNPJ informada no certificado digital da assinatura do pedido. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 23` |
| 21 | O CNPJ autor identificado no pedido de registro de evento deve corresponder ao CNPJ conforme o "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" da planilha "Tipo Eventos". | Obrig. | Rej. | E0813 | O CNPJ autor informado no pedido de registro de evento não corresponde ao "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" indicado na planilha "Tipo Eventos". | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 24` |

#### `evento/pedRegEvento/infPedReg/CPFAutor`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 22 | Se o autor do pedido de registro de evento for identificado por um CPF este deve corresponder ao mesmo CPF do certificado digital da assinatura, se informada no pedido. | Obrig. | Rej. | E0815 | O CPF do autor do pedido de registro de evento não corresponde ao CPF informado no certificado digital da assinatura do pedido. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 25` |
| 23 | O CPF autor identificado no pedido de registro de evento deve corresponder ao CPF conforme o "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" da planilha "Tipo Eventos". | Obrig. | Rej. | E0816 | O CPF autor informado no pedido de registro de evento não corresponde ao "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" indicado na planilha "Tipo Eventos". | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 26` |

#### `evento/pedRegEvento/infPedReg/chNFSe`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 24 | A NFS-e indicada não existe no ADN NFS-e. | Obrig. | Rej. | E1831 | O pedido de registro de evento não pode ser validado pois a NFS-e indicada não existe no Ambiente de Dados Nacional NFS-e. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 27` |
| 25 | Não pode ocorrer cancelamento de NFS-e fora do prazo limite para o cancelamento da NFS-e, conforme parametrização do município emissor da NFS-e. | Obrig. | Rej. | E0822 | O prazo para o cancelamento da NFS-e expirou, conforme parametrização do município emissor da NFS-e. | 3 | V | V | X | X | - | `RN EVENTO_PED.REG.EVENTO!linha 28` |
| 26 | Não pode ocorrer cancelamento de NFS-e acima de valor permitido pelo município emissor da NFS-e, conforme parametrização do município emissor da NFS-e. | Obrig. | Rej. | E0823 | Valor da NFS-e a ser cancelada acima do permitido, conforme parametrização do município emissor da NFS-e. | 3 | V | V | X | X | - | `RN EVENTO_PED.REG.EVENTO!linha 29` |
| 27 | Não pode ocorrer o cancelamento de NFS-e que não esteja identificado o tomador de serviço, conforme parametrização do município emissor da NFS-e. | Obrig. | Rej. | E0824 | NFS-e sem indentificação do tomador do serviço não pode ser cancelada, conforme parametrização do município emissor da NFS-e. | 3 | V | V | X | X | - | `RN EVENTO_PED.REG.EVENTO!linha 30` |
| 28 | Não é permitido realizar um Evento de Cancelamento para NFS-e que possua Evento de Tributos Recolhidos vinculado, conforme parametrização do município de incidência do ISSQN da NFS-e. | Obrig. | Rej. | E0827 | Não é permitido realizar um Evento de Cancelamento para NFS-e que possua Evento de Tributos Recolhidos vinculado, conforme parametrização do município de incidência do ISSQN da NFS-e. | 3 | V | V | X | X | - | `RN EVENTO_PED.REG.EVENTO!linha 31` |
| 29 | O pedido de registro deste evento de NFS-e deve ser enviado para o ambiente que gerou a NFS-e referenciada no pedido. | Obrig. | Rej. | E0831 | O pedido de registro deste evento de NFS-e deve ser enviado para o ambiente que gerou a NFS-e referenciada no pedido. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 32` |
| 30 | Somente é permitido um único evento do tipo Manifestação de NFS-e (Confirmação e Rejeição), se o autor do evento, informado nos campos CNPJAutor ou CPFAutor, corresponder aos possíveis não emitentes da NFS-e indicada pela chave de acesso. | Obrig. | Rej. | E1833 | Somente é permitido um único evento do tipo Manifestação de NFS-e (Confirmação e Rejeição), por não emitente da NFS-e indicada no evento. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 33` |
| 31 | Somente é permitido um único evento do tipo Manifestação de NFS-e (Anulação da Rejeição) para cada Evento de Manifestação de NFS-e - Rejeição, emitido por cada um dos possíveis não emitentes da NFS-e indicada pela chave de acesso. | Obrig. | Rej. | E1835 | Somente é permitido um único evento do tipo Manifestação de NFS-e (Anulação da Rejeição) para cada Evento de Manifestação de NFS-e - Rejeição, emitido por cada possível não emitentes da NFS-e indicada pela chave de acesso. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 34` |

#### `evento/pedRegEvento/infPedReg/e101101`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 32 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO NFS-e, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0840 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 35` |

#### `evento/pedRegEvento/infPedReg/e101101/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 33 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 36` |

#### `evento/pedRegEvento/infPedReg/e101101/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 34 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 37` |

#### `evento/pedRegEvento/infPedReg/e101101/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 35 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 38` |

#### `evento/pedRegEvento/infPedReg/e105102`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 36 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-e POR SUBSTITUIÇÃO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0845 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e POR SUBSTITUIÇÃO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 39` |

#### `evento/pedRegEvento/infPedReg/e105102/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 37 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 40` |

#### `evento/pedRegEvento/infPedReg/e105102/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 38 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 41` |

#### `evento/pedRegEvento/infPedReg/e105102/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 39 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 42` |

#### `evento/pedRegEvento/infPedReg/e105102/chSubstituta`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 40 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 43` |

#### `evento/pedRegEvento/infPedReg/e101103`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 41 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0848 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 44` |

#### `evento/pedRegEvento/infPedReg/e101103/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 42 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 45` |

#### `evento/pedRegEvento/infPedReg/e101103/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 43 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 46` |

#### `evento/pedRegEvento/infPedReg/e101103/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 44 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 47` |

#### `evento/pedRegEvento/infPedReg/e105104`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 45 | Não é permitida a recepção do deferimento de uma solicitação de cancelamento por análise fiscal sem que haja um Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e, que esteja pendente de deferimento ou indeferimento. | Obrig. | Rej. | E0853 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e DEFERIDO POR ANÁLISE FISCAL pois não existe um EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e pendente para deferimento ou indeferimento. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 48` |
| 46 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-e DEFERIDO POR ANÁLISE FISCAL, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0852 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e DEFERIDO POR ANÁLISE FISCAL pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 49` |

#### `evento/pedRegEvento/infPedReg/e105104/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 47 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 50` |

#### `evento/pedRegEvento/infPedReg/e105104/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 48 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 51` |

#### `evento/pedRegEvento/infPedReg/e105104/nProcAdm`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 49 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 52` |

#### `evento/pedRegEvento/infPedReg/e105104/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 50 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 53` |

#### `evento/pedRegEvento/infPedReg/e105104/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 51 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 54` |

#### `evento/pedRegEvento/infPedReg/e105105`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 52 | Não é permitida a recepção do indeferimento de uma solicitação de cancelamento por análise fiscal sem que haja um Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e, que esteja pendente de deferimento ou indeferimento. | Obrig. | Rej. | E0856 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e INDEFERIDO POR ANÁLISE FISCAL pois não existe um EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e pendente para deferimento ou indeferimento. | 1 | V | - | V | - | - | `RN EVENTO_PED.REG.EVENTO!linha 55` |
| 53 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-E INDEFERIDO POR ANÁLISE FISCAL, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0855 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-E INDEFERIDO POR ANÁLISE FISCAL pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 56` |

#### `evento/pedRegEvento/infPedReg/e105105/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 54 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 57` |

#### `evento/pedRegEvento/infPedReg/e105105/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 55 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 58` |

#### `evento/pedRegEvento/infPedReg/e105105/nProcAdm`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 56 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 59` |

#### `evento/pedRegEvento/infPedReg/e105105/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 57 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 60` |

#### `evento/pedRegEvento/infPedReg/e105105/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 58 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 61` |

#### `evento/pedRegEvento/infPedReg/e202201`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 59 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO PRESTADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0860 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO PRESTADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 62` |

#### `evento/pedRegEvento/infPedReg/e202201/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 60 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 63` |

#### `evento/pedRegEvento/infPedReg/e203202`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 61 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO TOMADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0861 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO TOMADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 64` |

#### `evento/pedRegEvento/infPedReg/e203202/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 62 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 65` |

#### `evento/pedRegEvento/infPedReg/e204203`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 63 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO INTERMEDIÁRIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0862 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO INTERMEDIÁRIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 66` |

#### `evento/pedRegEvento/infPedReg/e204203/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 64 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 67` |

#### `evento/pedRegEvento/infPedReg/e205204`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 65 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO TÁCITA, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0863 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO TÁCITA pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 68` |

#### `evento/pedRegEvento/infPedReg/e205204/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 66 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 69` |

#### `evento/pedRegEvento/infPedReg/e205204/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 67 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 70` |

#### `evento/pedRegEvento/infPedReg/e202205`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 68 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO PRESTADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0864 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO PRESTADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 71` |

#### `evento/pedRegEvento/infPedReg/e202205/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 69 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 72` |

#### `evento/pedRegEvento/infPedReg/e202205/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 70 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 73` |

#### `evento/pedRegEvento/infPedReg/e202205/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 71 | Se o campo cMotivo for igual a "9, - Outros", então a descrição do motivo tem preenchimento obrigatório. | Obrig. | Rej. | E1944 | A  descrição do motivo é obrigatória caso o tipo do motivo seja "9 - Outros". | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 74` |

#### `evento/pedRegEvento/infPedReg/e203206`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 72 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO TOMADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0866 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO TOMADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 75` |

#### `evento/pedRegEvento/infPedReg/e203206/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 73 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 76` |

#### `evento/pedRegEvento/infPedReg/e203206/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 74 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 77` |

#### `evento/pedRegEvento/infPedReg/e203206/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 75 | Se o campo cMotivo for igual a "9, - Outros", então a descrição do motivo tem preenchimento obrigatório. | Obrig. | Rej. | E1949 | A  descrição do motivo é obrigatória caso o tipo do motivo seja "9 - Outros". | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 78` |

#### `evento/pedRegEvento/infPedReg/e204207`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 76 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO INTERMEDIÁRIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0868 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO INTERMEDIÁRIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 79` |

#### `evento/pedRegEvento/infPedReg/e204207/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 77 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 80` |

#### `evento/pedRegEvento/infPedReg/e204207/cMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 78 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 81` |

#### `evento/pedRegEvento/infPedReg/e204207/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 79 | Se o campo cMotivo for igual a "9, - Outros", então a descrição do motivo tem preenchimento obrigatório. | Obrig. | Rej. | E1954 | A  descrição do motivo é obrigatória caso o tipo do motivo seja "9 - Outros". | - | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 82` |

#### `evento/pedRegEvento/infPedReg/e205208`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 80 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - ANULAÇÃO DA REJEIÇÃO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E0870 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - ANULAÇÃO DA REJEIÇÃO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 83` |

#### `evento/pedRegEvento/infPedReg/e205208/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 81 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 84` |

#### `evento/pedRegEvento/infPedReg/e205208/idEvManifRej`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 82 | O identificador do Evento de Manifestação de NFS-e - Rejeição a ser anulado deve existir no Sistema Nacional NFS-e e corresponder a um identificador de evento de rejeição vinculada à NFS-e informada no evento. | Obrig. | Rej. | E1963 | O identificador do Evento de Manifestação de NFS-e - Rejeição a ser anulado deve existir no Sistema Nacional NFS-e e corresponder a um identificador de evento de rejeição vinculada à NFS-e informada no evento. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 85` |

#### `evento/pedRegEvento/infPedReg/e205208/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 83 | - | - | - | — | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 86` |

#### `evento/pedRegEvento/infPedReg/e305101`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 84 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-e POR OFÍCIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E1960 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e POR OFÍCIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 87` |

#### `evento/pedRegEvento/infPedReg/e305101/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 85 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 88` |

#### `evento/pedRegEvento/infPedReg/e305101/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 86 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 89` |

#### `evento/pedRegEvento/infPedReg/e305101/nProcAdm`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 87 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 90` |

#### `evento/pedRegEvento/infPedReg/e305101/xProcAdm`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 88 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 91` |

#### `evento/pedRegEvento/infPedReg/e305102`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 89 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE BLOQUEIO DE NFS-e POR OFÍCIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E1965 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE BLOQUEIO DE NFS-e POR OFÍCIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 92` |

#### `evento/pedRegEvento/infPedReg/e305102/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 90 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 93` |

#### `evento/pedRegEvento/infPedReg/e305102/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 91 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 94` |

#### `evento/pedRegEvento/infPedReg/e305102/xMotivo`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 92 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 95` |

#### `evento/pedRegEvento/infPedReg/e305102/codEvento`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 93 | O Evento de Bloqueio de NFS-e para um tipo de evento, deve ser rejeitado se já houver um evento de bloqueio de NFS-e para o mesmo tipo do evento que não esteja desbloquedo.<br><br>Obs: Verificar se para cada evento de bloqueio de NFS-e para um tipo de evento existe o correspondente desbloqueio.<br><br>Se os possíveis eventos de bloqueios de NFS-e para um tipo de evento não estiverem todos pareados com os seus respectivos desbloqueios, então o eveto de bloqueio de NFS-e do mesmo tipo que está sendo recepcionado pelo Sistema Nacional NFS-e deverá ser rejeitado. | Obrig. | Rej. | E1967 | O sistema não pode recepcionar o Evento de Bloqueio de NFS-e por Ofício para <tipo_evento_bloqueio_NFS-e>, pois já existe o mesmo tipo de evento vinculado à NFS-e sem o Evento de Desbloqueio correpondente. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 96` |

#### `evento/pedRegEvento/infPedReg/e305103`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 94 | O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE DESBLOQUEIO DE NFS-e POR OFÍCIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e". | Obrig. | Rej. | E1970 | O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE DESBLOQUEIO DE NFS-e POR OFÍCIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 97` |

#### `evento/pedRegEvento/infPedReg/e305103/xDesc`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 95 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 98` |

#### `evento/pedRegEvento/infPedReg/e305103/CPFAgTrib`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 96 | - | - | - | - | - | - | - | - | - | - | - | `RN EVENTO_PED.REG.EVENTO!linha 99` |

#### `evento/pedRegEvento/infPedReg/e305103/idBloqOfic`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 97 | O evento de Evento de Desbloqueio de NFS-e deve ser rejeitado se o identificador do bloqueio de oficio, indicado neste evento, não existir. | Obrig. | Rej. | E1976 | Não existe o identificador de bloqueio informado neste evento para desbloqueio. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 100` |
| 98 | O Evento de Desbloqueio de NFS-e deve ser rejeitado se o identificador do bloqueio de oficio, indicado neste evento, já tiver sido desbloqueado. | Obrig. | Rej. | E1978 | O sistema não pode recepcionar o Evento Desbloqueio de NFS-e por Ofício, pois o Evento de Bloqueio indicado já foi desbloqueado. | 1 | V | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 101` |

#### `evento/pedRegEvento/Signature`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 99 | A assinatura do Pedido de Registro de Evento deve ser válida. | Obrig. | Rej. | E1980 | Arquivo enviado com erro na assinatura. | 1 | V | V | X | V | - | `RN EVENTO_PED.REG.EVENTO!linha 102` |
| 100 | Certificado Digital da assintura inválido:<br><br>- Validade do Certificado (data início e data fim);<br>- Verifica a Cadeia de Certificação;<br>- Certificado do Transmissor revogado;<br>- LCR indisponível ou inválida. | Obrig. | Rej. | E1983 | Certificado Digital da assinatura inválido. | 1 | V | V | X | V | - | `RN EVENTO_PED.REG.EVENTO!linha 103` |
| 101 | Certificado Digital da assinatura fora do padrão estabelecido pelo projeto NFS-e:<br><br>- Versão diferente de 3;<br>- Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC);<br>- KeyUsage não define 'Assinatura Digital' e 'Não Recusa';<br>- Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1);<br>- Certificado Raiz difere da 'ICP-Brasil'. | Obrig. | Rej. | E1986 | Certificado Digital fora do padrão estabelecido. | 1 | V | V | X | V | - | `RN EVENTO_PED.REG.EVENTO!linha 104` |
| 102 | É obrigatória a existência da assinatura do Pedido de Registro de Evento quando for enviado para Web Service. | Obrig. | Rej. | E1989 | A assinatura é obrigatória quando for enviado para o Web Service. | 1 | V | V | X | V | - | `RN EVENTO_PED.REG.EVENTO!linha 105` |
| 103 | A assinatura deve ser feita com o certificado digital do emitente do Pedido de Registro de Evento. | Obrig. | Rej. | E1991 | A assinatura deve ser feita com o certificado digital do emitente do Pedido de Registro de Evento. | 1 | V | V | X | V | - | `RN EVENTO_PED.REG.EVENTO!linha 106` |

#### `evento/Signature`

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Nível | EP | EP-102 | ADN | ADN-102 | Observações | Origem |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|
| 104 | A assinatura do Evento deve ser válida. | Obrig. | Rej. | E2020 | Arquivo enviado com erro na assinatura. | 1 | X | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 107` |
| 105 | Certificado Digital da assintura inválido:<br><br>- Validade do Certificado (data início e data fim);<br>- Verifica a Cadeia de Certificação;<br>- Certificado do Transmissor revogado;<br>- LCR indisponível ou inválida. | Obrig. | Rej. | E2023 | Certificado Digital da assinatura inválido. | 1 | X | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 108` |
| 106 | Certificado Digital da assinatura fora do padrão estabelecido pelo Sistema Nacional NFS-e:<br><br>- Versão diferente de 3;<br>- Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC);<br>- KeyUsage não define 'Assinatura Digital' e 'Não Recusa';<br>- Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1);<br>- Certificado Raiz difere da 'ICP-Brasil'. | Obrig. | Rej. | E2026 | Certificado Digital fora do padrão estabelecido. | 1 | X | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 109` |
| 107 | É obrigatória a existência da assinatura do Evento quando for enviado para Web Service. | Obrig. | Rej. | E2029 | A assinatura é obrigatória quando for enviado paraa API. | 1 | X | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 110` |
| 108 | A assinatura deve ser feita com o certificado digital do município emissor do Evento. | Obrig. | Rej. | E2032 | A assinatura deve ser feita com o certificado digital do município emissor do Evento. | 1 | X | V | V | V | - | `RN EVENTO_PED.REG.EVENTO!linha 111` |

## 5. Relações entre as quatro partes da documentação

### 5.1 Como identificar o leiaute específico de um evento

1. Localize o evento na seção **1.4** e obtenha seu código normalizado de 6 dígitos.
2. Prefixe o código com `e` para obter o grupo XML específico. Exemplo: `101101` → `e101101`.
3. Localize esse grupo na seção **3.2** para conhecer os campos específicos do pedido.

### 5.2 Como validar um Pedido de Registro de Evento

Para uma validação completa, um consumidor desta documentação deve combinar:

- o **catálogo do evento** (autor permitido, assinatura, ambiente receptor, unicidade e visibilidade);
- os **campos comuns** de `evento`, `infEvento`, `pedRegEvento` e `infPedReg`;
- o **grupo XML específico** `eNNNNNN` do evento;
- todas as **regras de negócio** associadas ao caminho/campo em questão;
- a **matriz de coexistência** para verificar se o novo evento pode ser aceito diante dos eventos já relacionados à NFS-e;
- as **condições de comentários** quando a matriz indicar `X/V`.

### 5.3 Relação especial de bloqueio e desbloqueio por ofício

O evento de **Bloqueio de NFS-e por Ofício** (`305102` / `e305102`) não é avaliado apenas pelo tipo de evento: a matriz diferencia o **evento-alvo do bloqueio**. O mesmo vale para o **Desbloqueio de NFS-e por Ofício** (`305103` / `e305103`). Por isso, as colunas `I15`–`I19` e `I20`–`I24` mantêm explicitamente o alvo.

### 5.4 Identificadores compostos

- O `id` de `evento/infEvento` usa o literal `EVT` e a concatenação descrita no leiaute/regras.
- O `id` de `evento/pedRegEvento/infPedReg` usa o literal `PRE` e a concatenação descrita no leiaute/regras.
- O grupo específico do evento é determinado pelo código de 6 dígitos descrito na seção 1.

## 6. Controle de fidelidade da conversão

- Eventos de catálogo convertidos: **16**.
- Estados/linhas da matriz convertidos: **25**.
- Tipos de entrada/colunas da matriz convertidos: **24**.
- Células da matriz representadas: **600**.
- Comentários de células preservados: **38** em **9** condições textuais distintas.
- Células `X/V` na matriz: **37**; todas as **37** possuem comentário condicional associado no XLSX.
- Linhas de leiaute convertidas: **85**.
- Linhas de regras de negócio convertidas: **108**.
- Metadado interno do XLSX — última modificação: `2026-01-17T18:03:52Z`; último modificador: Adriano Guedes da Silva.

> Observação de fidelidade: o conteúdo técnico foi preservado; quebras de linha foram convertidas para `<br>` dentro de tabelas Markdown, e relações implícitas por mesclagem/continuidade foram tornadas explícitas.