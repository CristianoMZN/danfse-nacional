# Visão Geral — Arquitetura do XML do Sistema Nacional NFS-e

## Documentos fiscais eletrônicos (DF-e) cobertos por esta skill

| Documento | O que é | Quem envia | Arquivo de referência |
|---|---|---|---|
| **DPS** (Declaração de Prestação de Serviço) | Documento que o contribuinte (prestador, tomador ou intermediário) preenche e assina para declarar a prestação de um serviço. É **encapsulado dentro** do XML da NFS-e (`NFSe/infNFSe/DPS/`). | Emitente (contribuinte) | `01-campos-dps-nfse-completo.md` |
| **NFS-e** (Nota Fiscal de Serviço eletrônica) | Documento gerado a partir da DPS, após validação e cálculo dos tributos pela Sefin Nacional ou pelo sistema próprio do município. É o documento com validade fiscal. | Sefin Nacional / sistema municipal | `01-campos-dps-nfse-completo.md` |
| **Grupos IBSCBS** | Grupos adicionados ao leiaute NFS-e/DPS pela Reforma Tributária do Consumo (EC 132/2023, LC 214/2025), com informações de IBS, CBS e Imposto Seletivo. | Emitente (parte) + Sefin Nacional (parte calculada) | `02-reforma-tributaria-ibscbs.md` |
| **Evento / PedRegEvento** (Pedido de Registro de Evento) | XML usado para registrar eventos vinculados a uma NFS-e já emitida: cancelamento, cancelamento por substituição, manifestação do tomador/prestador/intermediário, bloqueio/desbloqueio por ofício, etc. | Emitente, tomador, intermediário, ou o próprio fisco (MEmis/MIncid) | `04-eventos-nfse.md` |
| **CNC** (Comunicação Nacional de Cancelamento) | XML usado por sistemas de terceiros/municípios legados para comunicar ao ADN Nacional o cancelamento de uma NFS-e emitida fora do Sistema Nacional NFS-e. | Município / sistema legado | `05-cancelamento-cnc.md` |

## Hierarquia básica do XML da NFS-e (visão simplificada)

```
NFS-e (raiz)
└─ NFSe/                          — tag raiz, atributo "versao"
   └─ infNFSe/                    — grupo com dados da NFS-e (gerados pelo autorizador)
      ├─ id (ID)                  — chave de acesso da NFS-e (53 posições)
      ├─ xLocEmi, xLocPrestacao, nNFSe, ambGer, tpEmis, procEmi, cStat, dhProc, nDFSe ...
      ├─ emit/                    — dados do emitente (prestador)
      ├─ valores/                 — totais e tributação municipal (ISSQN)
      ├─ IBSCBS/                  — [Reforma Tributária] totais de IBS/CBS/IS
      └─ DPS/                     — a DPS assinada, encapsulada
         └─ infDPS/
            ├─ tpAmb, dhEmi, verAplic, serie, nDPS, dCompet, tpEmit, cLocEmi ...
            ├─ prest/             — prestador (dados detalhados, endereço, regime tributário)
            ├─ toma/               — tomador do serviço
            ├─ interm/            — intermediário (quando houver)
            ├─ serv/              — detalhamento do serviço (cTribNac, cNBS, comExt, obra, atvEvento ...)
            ├─ valores/            — valores do serviço, deduções, tributação (trib/tribMun, trib/tribFed)
            ├─ IBSCBS/            — [Reforma Tributária] cIndOp, indDest, dest/, gIBSCBSAjuste, etc.
            └─ subst/             — dados de substituição (quando a NFS-e substitui outra)
```

> Caminhos exatos, ocorrência (`1-1`, `0-1`, `1-99` etc.), tipo e tamanho de cada campo estão no índice
> completo em `01-campos-dps-nfse-completo.md` (leiaute base) e `02-reforma-tributaria-ibscbs.md` (com IBS/CBS).

## Legenda das colunas usadas em todas as tabelas de campos

| Coluna | Significado |
|---|---|
| **Caminho no XML** | Path (path completo até o pai) onde o campo aparece na árvore do XML. |
| **Campo** | Nome da tag/atributo XML. |
| **Ele** | Tipo de elemento: `Raiz` = tag raiz · `G` = Grupo (agrupador de campos, sem valor próprio) · `CG` = Grupo de Escolha (um entre vários subgrupos possíveis, ex.: CNPJ *ou* CPF) · `E` = Elemento (campo com valor) · `CE` = Elemento de Escolha (campo dentro de um conjunto pré-determinado, ex.: `CNPJ` *ou* `CPF` do emitente) · `A` = Atributo (ex.: `versao`) · `ID` = Atributo identificador único. |
| **Tipo** | Tipo de dado: `C` = Caractere/String · `N` = Numérico · `D` = Data/Hora · `-` = não se aplica (grupo). |
| **Ocor.** | Ocorrência mínima-máxima. `1-1` = obrigatório, ocorre uma vez · `0-1` = opcional, ocorre no máximo uma vez · `1-99` = obrigatório, repetível até 99 vezes · `0-90` = opcional, repetível. |
| **Tam.** | Tamanho do campo. Quando há sufixo `V2`, indica 2 casas decimais (valor monetário/percentual). Ex.: `1-15V2` = até 15 dígitos com 2 casas decimais. |

## Convenções importantes para quem vai gerar/validar XML

1. **CNPJ é alfanumérico a partir de jul/2026 (NT 009).** No leiaute da Reforma Tributária (`02-reforma-tributaria-ibscbs.md`),
   todo campo `CNPJ` tem `Tipo = C` (Caractere), não mais `N` (Numérico) como no leiaute base v1.01. As 8 primeiras posições
   (raiz) e as 4 de ordem aceitam letras e números; os 2 dígitos verificadores continuam numéricos.
2. **Valores monetários** (`vBC`, `vISSQN`, `vLiq`, etc.) são sempre numéricos com 2 casas decimais (sufixo `V2` no tamanho).
   Nunca usar vírgula como separador decimal no XML — usar ponto (`.`).
3. **Campos de domínio fechado (SET de valores aceitos)**: veja o índice consolidado em
   `06-indice-valores-enumerados.md` — ele lista, por exemplo, que `ambGer` só aceita `1` ou `2`, que `tpAmb`
   (dentro da DPS) distingue Produção (`1`) de Homologação (`2`), etc. **Não confundir `ambGer` (ambiente
   *gerador*, define se foi o sistema próprio do município ou a Sefin Nacional que gerou a NFS-e) com `tpAmb`
   (ambiente *de operação*: Produção ou Homologação)** — são campos diferentes, em caminhos diferentes.
4. **Tabelas de domínio externas** (não cabem como enumeração simples no leiaute, são grandes) estão em
   `assets/`: municípios (código IBGE), países (ISO2), lista de serviços nacional (LC 116/2003 com desdobro
   nacional) e lista NBS (Nomenclatura Brasileira de Serviços) — usadas nos campos `cLocIncid`/`cLocPrestacao`
   (município), `cPaisResult`/país exterior, `cTribNac` (item da lista de serviços) e `cNBS`.
5. **`cIndOp`** (indicador do local da operação para IBS/CBS) tem domínio fechado e extenso, definido pelo
   Anexo VII — veja `03-tabela-codigos-indop.md`. Use sempre a versão v1.02.00 (mais recente); a v1.00.00 está
   desatualizada e não deve ser usada como referência de valores válidos.
6. **Regras de negócio (RN)** definem, para cada campo, se a informação é obrigatória (`Obrig.`) ou facultativa,
   qual o efeito de erro (`Rej.` = rejeita o documento) e o código de erro (`Ex.: E1260`). Essas regras estão
   embutidas no detalhamento de cada campo nos arquivos `01`, `02`, `04` e `05`.
