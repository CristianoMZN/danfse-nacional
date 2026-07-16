# Eventos de NFS-e — Pedido de Registro de Evento (Anexo II)

Fonte: `anexo_ii-sefin_adn-pedregevt_evt-snnfse-v1-01-20260122.xlsx`.

Cobre o XML de **Pedido de Registro de Evento (PedRegEvento)**, usado para cancelamento de NFS-e, manifestação do tomador/prestador/intermediário, cancelamento por ofício, bloqueio/desbloqueio por ofício, entre outros.

## Tabela de Tipos de Evento de NFS-e

| # | Evento | Código (Categ/Autor/Amb/Seq) | Autor | Assinatura digital? | Ambiente receptor | NFS-e precisa existir? | Evento único? | Visibilidade |
|---|---|---|---|---|---|---|---|---|
| 1 | Cancelamento de NFS-e | 1 01 1 01 | Emite | Sim | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / CP / AT |
| 2 | Cancelamento de NFS-e por Substituição | 1 05 1 02 | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / CP / AT |
| 3 | Solicitação de Análise Fiscal para Cancelamento de NFS-e | 1 01 1 03 | Emite | Sim | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / AT |
| 4 | Cancelamento de NFS-e Deferido por Análise Fiscal | 1 05 1 04 | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / AT |
| 5 | Cancelamento de NFS-e Indeferido por Análise Fiscal | 1 05 1 05 | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / AT |
| 6 | Manifestação de NFS-e | 2 02 2 01 | Emite  (Prestador) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT |
| 7 |  | 2 03 2 02 | Emite (Tomador) | Não |  | Sim | Sim | EM / NE / CP / AT |
| 8 |  | 2 04 2 03 | Emite (Intermediário) | Não |  | Sim | Sim | EM / NE / CP / AT |
| 9 |  | 2 05 2 04 | MIncid | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e)  2 - ADN | Sim | Sim | EM / NE / CP / AT |
| 10 |  | 2 02 2 05 | Emite (Prestador) | Não | 2 - ADN | Sim | Sim | EM / NE / CP / AT |
| 11 |  | 2 03 2 06 | Emite (Tomador) | Não |  | Sim | Sim | EM / NE / CP / AT |
| 12 |  | 2 04 2 07 | Emite (Intermediário) | Não |  | Sim | Sim | EM / NE / CP / AT |
| 13 |  | 2 05 2 08 | MIncid | - |  | Sim | Sim | EM / NE / CP / AT |
| 14 | Cancelamento de NFS-e por Ofício | 3 05 1 01 | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Sim | EM / NE / CP / AT |
| 15 | Bloqueio de NFS-e por Ofício para:  Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício; | 3 05 1 02 | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Não | EM / AT |
| 16 | Desbloqueio de NFS-e por Ofício para:  Ev. Cancelamento de NFS-e; Ev. Cancelamento de NFS-e por Substituição; Ev. Cancelamento de NFS-e Deferido por Análise Fiscal; Ev. Cancelamento de NFS-e Indeferido por Análise Fiscal; Ev. Cancelamento de NFS-e por Ofício; | 3 05 1 03 | MEmis | - | 1 - Sistema que gerou a NFS-e (Sistema próprio do município ou Sefin Nacional NFS-e) | Sim | Não | EM / AT |
| CÓDIGO DO EVENTO:  O código identificador do evento é formado por 6 dígitos.  O 1º dígito identifica a categoria do evento; Os 2º e 3º dígitos identificam o(s) autor(es) do(s) evento(s);  O 4º dígito identifica o ambiente receptor do evento e; Os dois últimos dígitos, 5º e 6º, são números crescentes por categorias de eventos; |  | AUTOR DO PEDIDO DE REGISTRO DE EVENTO:  01 - Emite - Emitente da NFS-e; 02 - Prestador; 03 - Tomador; 04 - Intermediário; 05 - MEmis - Município Emissor; 06 - MIncid - Município de Incidência; 07 - Man - Módulo de Apuração Nacional; 08 - RespTrib - Responsável Tributário 56 - MEmis / MInci  67 - MInci / Man 99 - CGNFSe - Comitê Gestor da NFS-e | VISIBILIDADE:   EM - Emitente NFS-e; NE - Não Emitente; SP - Sujeito Passivo; CP - Consulta Pública; AT - Administração Tributária;*  * Município Emissor da NFS-e, Município(s) do(s) Não Emitente(s) da NFS-e, Município de Incidência do ISSQN e Município do local da prestação do serviço. Conforme regra de negócio a visibilidade poderá ser restrita a apenas algum(uns) desses municípios descritos que compõem a AT;  ** Somente para NFS-e cujo cStat seja "102 - NFS-e de Decisão Judicial"; |  |  |  |  |  |


---

## Índice de campos (ordem do XML)

| # | Caminho | Campo | Ele | Tipo | Ocor. | Tam. |
|---|---------|-------|-----|------|-------|------|
| 1 | `` | `evento` | Raiz | - | - | - |
| 2 | `evento/` | `versao` | A | C | 1-1 | 1-4V2 |
| 3 | `evento/` | `infEvento` | G | - | 1-1 | - |
| 4 | `evento/infEvento/` | `id` | ID | C | 1-1 | 62 |
| 5 | `evento/infEvento/` | `verAplic` | E | C | 1-1 | 1-20 |
| 6 | `evento/infEvento/` | `ambGer` | E | D | 1-1 | - |
| 7 | `evento/infEvento/` | `nSeqEvento` | E | N | 1-1 | 3 |
| 8 | `evento/infEvento/` | `dhProc` | E | D | 1-1 | - |
| 9 | `evento/infEvento/` | `nDFSe` | E | N | 1-1 | 1-13 |
| 10 | `evento/infEvento/` | `pedRegEvento` | G | G | 1-1 | - |
| 11 | `evento/pedRegEvento/` | `versao` | A | C | 1-1 | 1-4V2 |
| 12 | `evento/pedRegEvento/` | `infPedReg` | G | - | 1-1 | - |
| 13 | `evento/pedRegEvento/infPedReg/` | `id` | ID | C | 1-1 | 59 |
| 14 | `evento/pedRegEvento/infPedReg/` | `tpAmb` | E | N | 1-1 | 1 |
| 15 | `evento/pedRegEvento/infPedReg/` | `verAplic` | E | C | 1-1 | 1-20 |
| 16 | `evento/pedRegEvento/infPedReg/` | `dhEvento` | E | D | 1-1 | - |
| 17 | `evento/pedRegEvento/infPedReg/` | `CNPJAutor` | CE | N | 1-1 | 14 |
| 18 | `evento/pedRegEvento/infPedReg/` | `CPFAutor` | CE | N | 1-1 | 11 |
| 19 | `evento/pedRegEvento/infPedReg/` | `chNFSe` | CE | N | 1-1 | 50 |
| 20 | `evento/pedRegEvento/infPedReg/` | `e101101` | CG | - | 1-1 | - |
| 21 | `evento/pedRegEvento/infPedReg/e101101/` | `xDesc` | E | C | 1-1 | 5-60 |
| 22 | `evento/pedRegEvento/infPedReg/e101101/` | `cMotivo` | E | N | 1-1 | 1 |
| 23 | `evento/pedRegEvento/infPedReg/e101101/` | `xMotivo` | E | C | 1-1 | 15-255 |
| 24 | `evento/pedRegEvento/infPedReg/` | `e105102` | CG | - | 1-1 | - |
| 25 | `evento/pedRegEvento/infPedReg/e105102/` | `xDesc` | E | C | 1-1 | 5-60 |
| 26 | `evento/pedRegEvento/infPedReg/e105102/` | `cMotivo` | E | N | 1-1 | 2 |
| 27 | `evento/pedRegEvento/infPedReg/e105102/` | `xMotivo` | E | C | 0-1 | 15-255 |
| 28 | `evento/pedRegEvento/infPedReg/e105102/` | `chSubstituta` | E | N | 1-1 | 50 |
| 29 | `evento/pedRegEvento/infPedReg/` | `e101103` | CG | - | 1-1 | - |
| 30 | `evento/pedRegEvento/infPedReg/e101103/` | `xDesc` | E | C | 1-1 | 5-60 |
| 31 | `evento/pedRegEvento/infPedReg/e101103/` | `cMotivo` | E | N | 1-1 | 1 |
| 32 | `evento/pedRegEvento/infPedReg/e101103/` | `xMotivo` | E | C | 1-1 | 15-255 |
| 33 | `evento/pedRegEvento/infPedReg/` | `e105104` | CG | - | 1-1 | - |
| 34 | `evento/pedRegEvento/infPedReg/e105104/` | `xDesc` | E | C | 1-1 | 5-60 |
| 35 | `evento/pedRegEvento/infPedReg/e105104/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 36 | `evento/pedRegEvento/infPedReg/e105104/` | `nProcAdm` | E | N | 0-1 | 1-30 |
| 37 | `evento/pedRegEvento/infPedReg/e105104/` | `cMotivo` | E | N | 1-1 | 1 |
| 38 | `evento/pedRegEvento/infPedReg/e105104/` | `xMotivo` | E | C | 1-1 | 15-255 |
| 39 | `evento/pedRegEvento/infPedReg/` | `e105105` | CG | - | 1-1 | - |
| 40 | `evento/pedRegEvento/infPedReg/e105105/` | `xDesc` | E | C | 1-1 | 5-60 |
| 41 | `evento/pedRegEvento/infPedReg/e105105/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 42 | `evento/pedRegEvento/infPedReg/e105105/` | `nProcAdm` | E | N | 0-1 | 1-30 |
| 43 | `evento/pedRegEvento/infPedReg/e105105/` | `cMotivo` | E | N | 1-1 | 1 |
| 44 | `evento/pedRegEvento/infPedReg/e105105/` | `xMotivo` | E | C | 1-1 | 15-255 |
| 45 | `evento/pedRegEvento/infPedReg/` | `e202201` | CG | - | 1-1 | - |
| 46 | `evento/pedRegEvento/infPedReg/e202201/` | `xDesc` | E | C | 1-1 | 5-60 |
| 47 | `evento/pedRegEvento/infPedReg/` | `e203202` | CG | - | 1-1 | - |
| 48 | `evento/pedRegEvento/infPedReg/e203202/` | `xDesc` | E | C | 1-1 | 5-60 |
| 49 | `evento/pedRegEvento/infPedReg/` | `e204203` | CG | - | 1-1 | - |
| 50 | `evento/pedRegEvento/infPedReg/e204203/` | `xDesc` | E | C | 1-1 | 5-60 |
| 51 | `evento/pedRegEvento/infPedReg/` | `e205204` | CG | - | 1-1 | - |
| 52 | `evento/pedRegEvento/infPedReg/e205204/` | `xDesc` | E | C | 1-1 | 5-60 |
| 53 | `evento/pedRegEvento/infPedReg/` | `e202205` | CG | - | 1-1 | - |
| 54 | `evento/pedRegEvento/infPedReg/e202205/` | `xDesc` | E | C | 1-1 | 5-60 |
| 55 | `evento/pedRegEvento/infPedReg/e202205/` | `cMotivo` | E | N | 1-1 | 1 |
| 56 | `evento/pedRegEvento/infPedReg/e202205/` | `xMotivo` | E | C | 0-1 | 15-255 |
| 57 | `evento/pedRegEvento/infPedReg/` | `e203206` | CG | - | 1-1 | - |
| 58 | `evento/pedRegEvento/infPedReg/e203206/` | `xDesc` | E | C | 1-1 | 5-60 |
| 59 | `evento/pedRegEvento/infPedReg/e203206/` | `cMotivo` | E | N | 1-1 | 1 |
| 60 | `evento/pedRegEvento/infPedReg/e203206/` | `xMotivo` | E | C | 0-1 | 15-255 |
| 61 | `evento/pedRegEvento/infPedReg/` | `e204207` | CG | - | 1-1 | - |
| 62 | `evento/pedRegEvento/infPedReg/e204207/` | `xDesc` | E | C | 1-1 | 5-60 |
| 63 | `evento/pedRegEvento/infPedReg/e204207/` | `cMotivo` | E | N | 1-1 | 1 |
| 64 | `evento/pedRegEvento/infPedReg/e204207/` | `xMotivo` | E | C | 0-1 | 15-255 |
| 65 | `evento/pedRegEvento/infPedReg/` | `e205208` | CG | - | 1-1 | - |
| 66 | `evento/pedRegEvento/infPedReg/e205208/` | `xDesc` | E | C | 1-1 | 5-60 |
| 67 | `evento/pedRegEvento/infPedReg/e205208/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 68 | `evento/pedRegEvento/infPedReg/e205208/` | `idEvManifRej` | E | C | 1-1 | 59 |
| 69 | `evento/pedRegEvento/infPedReg/e205208/` | `xMotivo` | E | C | 1-1 | 15-255 |
| 70 | `evento/pedRegEvento/infPedReg/` | `e305101` | CG | - | 1-1 | - |
| 71 | `evento/pedRegEvento/infPedReg/e305101/` | `xDesc` | E | C | 1-1 | 5-60 |
| 72 | `evento/pedRegEvento/infPedReg/e305101/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 73 | `evento/pedRegEvento/infPedReg/e305101/` | `nProcAdm` | E | N | 1-1 | 30 |
| 74 | `evento/pedRegEvento/infPedReg/e305101/` | `xProcAdm` | E | C | 1-1 | 15-255 |
| 75 | `evento/pedRegEvento/infPedReg/` | `e305102` | CG | - | 1-1 | - |
| 76 | `evento/pedRegEvento/infPedReg/e305102/` | `xDesc` | E | C | 1-1 | 5-60 |
| 77 | `evento/pedRegEvento/infPedReg/e305102/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 78 | `evento/pedRegEvento/infPedReg/e305102/` | `codEvento` | E | N | 1-1 | 7 |
| 79 | `evento/pedRegEvento/infPedReg/e305102/` | `xMotivo` | E | C | 1-1 | 15-255 |
| 80 | `evento/pedRegEvento/infPedReg/` | `e305103` | CG | - | 1-1 | - |
| 81 | `evento/pedRegEvento/infPedReg/e305103/` | `xDesc` | E | C | 1-1 | 5-60 |
| 82 | `evento/pedRegEvento/infPedReg/e305103/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 83 | `evento/pedRegEvento/infPedReg/e305103/` | `idBloqOfic` | E | C | 1-1 | 59 |
| 84 | `evento/pedRegEvento/` | `Signature` | G | - | 0-1 | - |
| 85 | `evento/` | `Signature` | G | - | 1-1 | - |

---

## Detalhamento campo a campo

### `evento`

- **Campo:** `evento`
- **Elemento (ELE):** Raiz  |  **Tipo:** -  |  **Ocorrência (min-max):** -  |  **Tamanho:** -
- **Descrição:** TAG raiz

### `evento/versao`

- **Campo:** `versao`
- **Caminho no XML:** `evento/`
- **Elemento (ELE):** A  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-4V2
- **Descrição:** Versão do leiaute do evento.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1260` — O prazo de aceitação da versão do leiaute do DF-e expirou.
    - Detalhe da regra: O prazo de aceitação da versão do leiaute do DF-e ultrapassado.

### `evento/infEvento`

- **Campo:** `infEvento`
- **Caminho no XML:** `evento/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do pedido de registro do evento

### `evento/infEvento/id`

- **Campo:** `id`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** ID  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 62
- **Descrição:** O identificador do evento é composto pela concatenação de campos que constam no leiaute.  
    
  A formação deste identificador considera o literal "EVT" associado a outras 59 posições numéricas, conforme descrito abaixo:  
    
  "EVT" +   
  id do Pedido de Registo de Evento (56) +   
  Número sequencial do evento (nSeqEvento) (3)
- **Notas explicativas:** Para a formação do id do Evento, considerar o id do Pedido de Registro de Evento sem o literal "PRE".
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1802` — Conteúdo do identificador informado no identificador do evento difere da concatenação dos campos correspondentes.
    - Detalhe da regra: Campo identificador do Evento (EVT) inválido.  Identificador do evento difere da concatenação dos campos correspondentes existente no leiaute evento.  A formação deste identificador considera o literal "EVT" associado a outras 59 posições numéricas,  conforme descrito abaixo:  "EVT" +  id do Pedido de Registo de Evento (56) +  Número sequencial do evento (nSeqEvento) (3)
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1805` — Já existe um Evento com este identificador no ADN NFS-e.
    - Detalhe da regra: O id do evento compartilhado já existe no ADN.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0802` — Já existe um documento fiscal eletrônico identificado com este id no Sistema Nacional NFS-e.
    - Detalhe da regra: O id do evento gerado já existe no ADN.

### `evento/infEvento/verAplic`

- **Campo:** `verAplic`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-20
- **Descrição:** Versão do aplicativo que gerou o evento.

### `evento/infEvento/ambGer`

- **Campo:** `ambGer`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Ambiente gerador do evento:  
    
  1 - Sistema próprio do município;  
  2 - Sefin Nacional NFS-e;  
  3 - ADN NFS-e;
- **Valores aceitos (domínio identificado):**
  - `1` → Sistema próprio do município
  - `2` → Sefin Nacional NFS-e
  - `3` → ADN NFS-e
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1274` — O ambiente gerador da NFS-e não está de acordo com a definição 1 (Sistema Próprio do Município) ou 2 (Sefin Nacional).
    - Detalhe da regra: Verificar se o ambiente gerador da NFS-e está de acordo com a definição: 1- Sistema Próprio do Município, para as NFS-e compartilhadas pelo município para o ADN, ou 2 - Sefin Nacional NFS-e, para as NFS-e emitidas pela Sefin ou recepcionadas via API "Bypass".

### `evento/infEvento/nSeqEvento`

- **Campo:** `nSeqEvento`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Número sequencial do evento para o mesmo tipo de evento.  
    
  Para os eventos que ocorrem somente uma vez, como é o caso do cancelamento, o nSeqEvento = 001.   
    
  Para os eventos que possam existir mais de um evento do mesmo tipo o ambiente gerador deverá numerar de forma sequencial.

### `evento/infEvento/dhProc`

- **Campo:** `dhProc`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data/Hora do registro do evento.  
  Data e hora no formato UTC (Universal Coordinated Time):  
  AAAA-MM-DDThh:mm:ssTZD
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1278` — A data e hora do processamento (geração) do DF-e deve ser anterior ou igual à data da recepção pelo Sistema Nacional NFS-e.
    - Detalhe da regra: A data/hora do registro do evento deve ser anterior à data/hora do processamento do documento pelo Sistema Nacional NFS-e.

### `evento/infEvento/nDFSe`

- **Campo:** `nDFSe`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-13
- **Descrição:** Número sequencial do documento gerado por ambiente gerador de DFSe do município.

### `evento/infEvento/pedRegEvento`

- **Campo:** `pedRegEvento`
- **Caminho no XML:** `evento/infEvento/`
- **Elemento (ELE):** G  |  **Tipo:** G  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Leiaute do pedido de registro do evento gerado pelo autor do evento

### `evento/pedRegEvento/versao`

- **Campo:** `versao`
- **Caminho no XML:** `evento/pedRegEvento/`
- **Elemento (ELE):** A  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-4V2
- **Descrição:** Versão do leiaute do pedido de registro do evento.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1825` — Prazo de aceitação da versão do leiaute do pedido de registro de evento expirou.
    - Detalhe da regra: Prazo de aceitação da versão do leiaute do pedido de registro de evento ultrapassado.

### `evento/pedRegEvento/infPedReg`

- **Campo:** `infPedReg`
- **Caminho no XML:** `evento/pedRegEvento/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Geral do Pedido de Registro de Evento  
  Grupo de informações do pedido de registro do evento

### `evento/pedRegEvento/infPedReg/id`

- **Campo:** `id`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** ID  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 59
- **Descrição:** O identificador do pedido de registro de evento é composto pela concatenação de campos que constam no leiaute.  
    
  A formação deste identificador considera o literal "PRE" associado a outras 56 posições numéricas, conforme descrito abaixo:  
    
  "PRE" +   
  Chave de acesso da NFS-e (50) +  
  Código do evento (6)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1827` — Conteúdo do identificador informado no identificador do Pedido de Registro de Evento difere da concatenação dos campos correspondentes.
    - Detalhe da regra: Campo identificador do Pedido de Registro de Evento (PRE) inválido.  Identificador do PRE difere da concatenação dos campos correspondentes existente no leiaute do PRE.  A formação deste identificador considera o literal "PRE" associado a outras 56 posições numéricas, conforme descrito abaixo:  "PRE" +  Chave de acesso da NFS-e (50) + Código do evento (6)
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1818` — Não é permitido o compartilhamento pelo município com o ADN dos eventos de manifestação de NFS-e para confirmação ou rejeição pelos não emitentes de um NFS-e. Estes eventos devem ser emitidos pelos não emitentes da NFS-e diretamente no SEFIN NFS-e.
    - Detalhe da regra: Não é permitido o compartilhamento dos seguintes eventos pelo município com o ADN são: 202201 - Manifestação de NFS-e de Confirmação do Prestador; 203202 - Manifestação de NFS-e de Confirmação do Tomador; 204203 - Manifestação de NFS-e de Confirmação do Intermediário; 202205 - Manifestação de NFS-e de Rejeição do Prestador; 203206 - Manifestação de NFS-e de Rejeição do Tomador; 204207 - Manifestação de NFS-e de Rejeição do Intermediário;

### `evento/pedRegEvento/infPedReg/tpAmb`

- **Campo:** `tpAmb`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Tipo de ambiente:  
    
  1 - Produção;   
  2 - Homologação;
- **Valores aceitos (domínio identificado):**
  - `1` → Produção
  - `2` → Homologação
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1845` — Ambiente informado diverge do ambiente de recebimento para o qual o emitente está enviando o evento.
    - Detalhe da regra: Tipo do ambiente informado difere do ambiente utilizado.

### `evento/pedRegEvento/infPedReg/verAplic`

- **Campo:** `verAplic`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-20
- **Descrição:** Versão do aplicativo que gerou o pedido de registro de evento.

### `evento/pedRegEvento/infPedReg/dhEvento`

- **Campo:** `dhEvento`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data e hora do evento no formato AAAA-MM-DDThh:mm:ssTZD (UTC - Universal Coordinated Time, onde TZD pode ser -02:00 (Fernando de Noronha), -03:00 (Brasília) ou -04:00 (Manaus), no horário de verão serão -01:00, -02:00 e -03:00. Ex.: 2010-08-19T13:00:15-03:00.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1843` — A data de emissão do pedido do registro do evento não pode ser posterior à data de recebimento pelo Sistema Nacional NFS-e.
    - Detalhe da regra: A data de emissão do pedido do registro do evento não pode ser posterior à data de recebimento do lote  em que o Evento está sendo recebido pelo Sistema Nacional NFS-e.

### `evento/pedRegEvento/infPedReg/CNPJAutor`

- **Campo:** `CNPJAutor`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número de inscrição federal (CNPJ) do autor do evento.  
    
  CNPJ do autor do evento (parte interessada ou pessoa que figure na NFS-e.  
  O autor do evento não é o procurador).
- **Notas explicativas:** Em eventos onde o autor é o fisco, o campo deverá ser preenchido com o CNPJ da prefeitura.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0812` — O CNPJ do autor do pedido de registro de evento não corresponde à base do CNPJ informada no certificado digital da assinatura do pedido.
    - Detalhe da regra: Se o autor do pedido de registro de evento for identificado por um CNPJ este deve corresponder ao mesmo CNPJ do certificado digital da assinatura, se informada no pedido.   Verificar apenas o CNPJ base.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0813` — O CNPJ autor informado no pedido de registro de evento não corresponde ao "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" indicado na planilha "Tipo Eventos".
    - Detalhe da regra: O CNPJ autor identificado no pedido de registro de evento deve corresponder ao CNPJ conforme o "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" da planilha "Tipo Eventos".

### `evento/pedRegEvento/infPedReg/CPFAutor`

- **Campo:** `CPFAutor`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número de inscrição federal (CPF) do autor do evento.  
    
  CPF do autor do evento (parte interessada ou pessoa que figure na NFS-e como prestador, tomador, intermediário. O autor do evento poderá ser o procurador).
- **Notas explicativas:** Em eventos onde o autor é o fisco, este campo não poderá ser preenchido.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0815` — O CPF do autor do pedido de registro de evento não corresponde ao CPF informado no certificado digital da assinatura do pedido.
    - Detalhe da regra: Se o autor do pedido de registro de evento for identificado por um CPF este deve corresponder ao mesmo CPF do certificado digital da assinatura, se informada no pedido.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0816` — O CPF autor informado no pedido de registro de evento não corresponde ao "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" indicado na planilha "Tipo Eventos".
    - Detalhe da regra: O CPF autor identificado no pedido de registro de evento deve corresponder ao CPF conforme o "AUTOR DO PEDIDO DE REGISTRO DE EVENTO" da planilha "Tipo Eventos".

### `evento/pedRegEvento/infPedReg/chNFSe`

- **Campo:** `chNFSe`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 50
- **Descrição:** Identificador da NFS-e à qual o evento será vinculado.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1831` — O pedido de registro de evento não pode ser validado pois a NFS-e indicada não existe no Ambiente de Dados Nacional NFS-e.
    - Detalhe da regra: A NFS-e indicada não existe no ADN NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0822` — O prazo para o cancelamento da NFS-e expirou, conforme parametrização do município emissor da NFS-e.
    - Detalhe da regra: Não pode ocorrer cancelamento de NFS-e fora do prazo limite para o cancelamento da NFS-e, conforme parametrização do município emissor da NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0823` — Valor da NFS-e a ser cancelada acima do permitido, conforme parametrização do município emissor da NFS-e.
    - Detalhe da regra: Não pode ocorrer cancelamento de NFS-e acima de valor permitido pelo município emissor da NFS-e, conforme parametrização do município emissor da NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0824` — NFS-e sem indentificação do tomador do serviço não pode ser cancelada, conforme parametrização do município emissor da NFS-e.
    - Detalhe da regra: Não pode ocorrer o cancelamento de NFS-e que não esteja identificado o tomador de serviço, conforme parametrização do município emissor da NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0827` — Não é permitido realizar um Evento de Cancelamento para NFS-e que possua Evento de Tributos Recolhidos vinculado, conforme parametrização do município de incidência do ISSQN da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0831` — O pedido de registro deste evento de NFS-e deve ser enviado para o ambiente que gerou a NFS-e referenciada no pedido.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1833` — Somente é permitido um único evento do tipo Manifestação de NFS-e (Confirmação e Rejeição), por não emitente da NFS-e indicada no evento.
    - Detalhe da regra: Somente é permitido um único evento do tipo Manifestação de NFS-e (Confirmação e Rejeição), se o autor do evento, informado nos campos CNPJAutor ou CPFAutor, corresponder aos possíveis não emitentes da NFS-e indicada pela chave de acesso.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1835` — Somente é permitido um único evento do tipo Manifestação de NFS-e (Anulação da Rejeição) para cada Evento de Manifestação de NFS-e - Rejeição, emitido por cada possível não emitentes da NFS-e indicada pela chave de acesso.
    - Detalhe da regra: Somente é permitido um único evento do tipo Manifestação de NFS-e (Anulação da Rejeição) para cada Evento de Manifestação de NFS-e - Rejeição, emitido por cada um dos possíveis não emitentes da NFS-e indicada pela chave de acesso.

### `evento/pedRegEvento/infPedReg/e101101`

- **Campo:** `e101101`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Pedido de Registro de Evento  
  Evento Cancelamento de NFS-e
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0840` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO NFS-e, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e101101/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e101101/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:   
  Cancelamento de NFS-e

### `evento/pedRegEvento/infPedReg/e101101/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e101101/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Código de justificativa de cancelamento:  
    
  1 - Erro na Emissão;  
  2 - Serviço não Prestado;  
  9 - Outros;
- **Valores aceitos (domínio identificado):**
  - `1` → Erro na Emissão
  - `2` → Serviço não Prestado
  - `9` → Outros

### `evento/pedRegEvento/infPedReg/e101101/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e101101/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.

### `evento/pedRegEvento/infPedReg/e105102`

- **Campo:** `e105102`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Pedido de Registro de Evento  
  Cancelamento de NFS-e por Substituição
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0845` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e POR SUBSTITUIÇÃO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-e POR SUBSTITUIÇÃO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e105102/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105102/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:   
  Cancelamento de NFS-e por Substituição

### `evento/pedRegEvento/infPedReg/e105102/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105102/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código de justificativa de cancelamento substituição:  
    
  01 - Desenquadramento de NFS-e do Simples Nacional;  
  02 - Enquadramento de NFS-e no Simples Nacional;  
  03 - Inclusão Retroativa de Imunidade/Isenção para NFS-e;  
  04 - Exclusão Retroativa de Imunidade/Isenção para NFS-e;  
  05 - Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo;  
  99 - Outros;  
    
  Obtido do campo da DPS "DPS/infDPS/subst/cMotivo".
- **Valores aceitos (domínio identificado):**
  - `01` → Desenquadramento de NFS-e do Simples Nacional
  - `02` → Enquadramento de NFS-e no Simples Nacional
  - `03` → Inclusão Retroativa de Imunidade/Isenção para NFS-e
  - `04` → Exclusão Retroativa de Imunidade/Isenção para NFS-e
  - `05` → Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo
  - `99` → Outros

### `evento/pedRegEvento/infPedReg/e105102/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105102/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.  
    
  Obtido do campo da DPS "DPS/infDPS/subst/xMotivo".

### `evento/pedRegEvento/infPedReg/e105102/chSubstituta`

- **Campo:** `chSubstituta`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105102/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 50
- **Descrição:** Chave de Acesso da NFS-e substituta.

### `evento/pedRegEvento/infPedReg/e101103`

- **Campo:** `e101103`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Pedido de Registro de Evento  
  Solicitação de Análise Fiscal para Cancelamento de NFS-e
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0848` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e101103/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e101103/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Solicitação de Análise Fiscal para Cancelamento de NFS-e

### `evento/pedRegEvento/infPedReg/e101103/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e101103/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Código do motivo da solicitação de análise fiscal para cancelamento de NFS-e:  
    
  1 - Erro na Emissão;  
  2 - Serviço não Prestado;  
  9 - Outros;
- **Valores aceitos (domínio identificado):**
  - `1` → Erro na Emissão
  - `2` → Serviço não Prestado
  - `9` → Outros

### `evento/pedRegEvento/infPedReg/e101103/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e101103/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.

### `evento/pedRegEvento/infPedReg/e105104`

- **Campo:** `e105104`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Pedido de Registro de Evento  
  Cancelamento de NFS-e Deferido por Análise Fiscal
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0853` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e DEFERIDO POR ANÁLISE FISCAL pois não existe um EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e pendente para deferimento ou indeferimento.
    - Detalhe da regra: Não é permitida a recepção do deferimento de uma solicitação de cancelamento por análise fiscal sem que haja um Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e, que esteja pendente de deferimento ou indeferimento.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0852` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e DEFERIDO POR ANÁLISE FISCAL pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-e DEFERIDO POR ANÁLISE FISCAL, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e105104/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105104/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Cancelamento de NFS-e Deferido por Análise Fiscal

### `evento/pedRegEvento/infPedReg/e105104/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105104/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal que efetuou o deferimento da solicitação de análise fiscal para cancelamento de NFS-e.

### `evento/pedRegEvento/infPedReg/e105104/nProcAdm`

- **Campo:** `nProcAdm`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105104/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-30
- **Descrição:** Número do processo administrativo municipal vinculado à solicitação de análise fiscal para cancelamento de NFS-e.

### `evento/pedRegEvento/infPedReg/e105104/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105104/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Resposta da solicitação de análise fiscal para cancelamento de NFS-e:  
    
  1 - Cancelamento de NFS-e Deferido;
- **Valores aceitos (domínio identificado):**
  - `1` → Cancelamento de NFS-e Deferido

### `evento/pedRegEvento/infPedReg/e105104/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105104/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.

### `evento/pedRegEvento/infPedReg/e105105`

- **Campo:** `e105105`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Pedido de Registro de Evento  
  Cancelamento de NFS-e Indeferido por Análise Fiscal
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0856` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e INDEFERIDO POR ANÁLISE FISCAL pois não existe um EVENTO DE SOLICITAÇÃO DE ANÁLISE FISCAL PARA CANCELAMENTO DE NFS-e pendente para deferimento ou indeferimento.
    - Detalhe da regra: Não é permitida a recepção do indeferimento de uma solicitação de cancelamento por análise fiscal sem que haja um Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e, que esteja pendente de deferimento ou indeferimento.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0855` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-E INDEFERIDO POR ANÁLISE FISCAL pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-E INDEFERIDO POR ANÁLISE FISCAL, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e105105/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105105/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Cancelamento de NFS-e Indeferido por Análise Fiscal

### `evento/pedRegEvento/infPedReg/e105105/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105105/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal que efetuou o indeferimento da solicitação de análise fiscal para cancelamento de NFS-e.

### `evento/pedRegEvento/infPedReg/e105105/nProcAdm`

- **Campo:** `nProcAdm`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105105/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-30
- **Descrição:** Número do processo administrativo municipal vinculado à solicitação de análise fiscal para cancelamento de NFS-e.

### `evento/pedRegEvento/infPedReg/e105105/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105105/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Resposta da solicitação de análise fiscal para cancelamento de NFS-e:  
    
  1 - Cancelamento de NFS-e Indeferido;  
  2 - Cancelamento de NFS-e Indeferido Sem Análise de Mérito;
- **Valores aceitos (domínio identificado):**
  - `1` → Cancelamento de NFS-e Indeferido
  - `2` → Cancelamento de NFS-e Indeferido Sem Análise de Mérito

### `evento/pedRegEvento/infPedReg/e105105/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e105105/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.

### `evento/pedRegEvento/infPedReg/e202201`

- **Campo:** `e202201`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Confirmação do Prestador
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0860` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO PRESTADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO PRESTADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e202201/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e202201/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Confirmação do Prestador

### `evento/pedRegEvento/infPedReg/e203202`

- **Campo:** `e203202`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Confirmação do Tomador
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0861` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO TOMADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO TOMADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e203202/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e203202/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Confirmação do Tomador

### `evento/pedRegEvento/infPedReg/e204203`

- **Campo:** `e204203`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Confirmação do Intermediário
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0862` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO INTERMEDIÁRIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO DO INTERMEDIÁRIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e204203/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e204203/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Confirmação do Intermediário

### `evento/pedRegEvento/infPedReg/e205204`

- **Campo:** `e205204`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Confirmação Tácita
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0863` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO TÁCITA pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - CONFIRMAÇÃO TÁCITA, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e205204/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e205204/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Confirmação Tácita

### `evento/pedRegEvento/infPedReg/e202205`

- **Campo:** `e202205`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Rejeição do Prestador
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0864` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO PRESTADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO PRESTADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e202205/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e202205/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Rejeição do Prestador

### `evento/pedRegEvento/infPedReg/e202205/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e202205/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo da Rejeição da NFS-e:  
    
  1 - NFS-e em duplicidade;  
  2 - NFS-e já emitida pelo tomador;  
  3 - Não ocorrência do fato gerador;  
  4 - Erro quanto a responsabilidade tributária;  
  5 - Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador;  
  9 - Outros;
- **Valores aceitos (domínio identificado):**
  - `1` → NFS-e em duplicidade
  - `2` → NFS-e já emitida pelo tomador
  - `3` → Não ocorrência do fato gerador
  - `4` → Erro quanto a responsabilidade tributária
  - `5` → Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador
  - `9` → Outros

### `evento/pedRegEvento/infPedReg/e202205/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e202205/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1944` — A  descrição do motivo é obrigatória caso o tipo do motivo seja "9 - Outros".
    - Detalhe da regra: Se o campo cMotivo for igual a "9, - Outros", então a descrição do motivo tem preenchimento obrigatório.

### `evento/pedRegEvento/infPedReg/e203206`

- **Campo:** `e203206`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
   Manifestação de NFS-e - Rejeição do Tomador
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0866` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO TOMADOR pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO TOMADOR, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e203206/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e203206/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Rejeição do Tomador

### `evento/pedRegEvento/infPedReg/e203206/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e203206/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo da Rejeição da NFS-e:  
    
  1 - NFS-e em duplicidade;  
  2 - NFS-e já emitida pelo tomador;  
  3 - Não ocorrência do fato gerador;  
  4 - Erro quanto a responsabilidade tributária;  
  5 - Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador;  
  9 - Outros;
- **Valores aceitos (domínio identificado):**
  - `1` → NFS-e em duplicidade
  - `2` → NFS-e já emitida pelo tomador
  - `3` → Não ocorrência do fato gerador
  - `4` → Erro quanto a responsabilidade tributária
  - `5` → Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador
  - `9` → Outros

### `evento/pedRegEvento/infPedReg/e203206/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e203206/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1949` — A  descrição do motivo é obrigatória caso o tipo do motivo seja "9 - Outros".
    - Detalhe da regra: Se o campo cMotivo for igual a "9, - Outros", então a descrição do motivo tem preenchimento obrigatório.

### `evento/pedRegEvento/infPedReg/e204207`

- **Campo:** `e204207`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Rejeição do Intermediário
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0868` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO INTERMEDIÁRIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - REJEIÇÃO DO INTERMEDIÁRIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e204207/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e204207/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Rejeição do Intermediário

### `evento/pedRegEvento/infPedReg/e204207/cMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e204207/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo da Rejeição da NFS-e:  
    
  1 - NFS-e em duplicidade;  
  2 - NFS-e já emitida pelo tomador;  
  3 - Não ocorrência do fato gerador;  
  4 - Erro quanto a responsabilidade tributária;  
  5 - Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador;  
  9 - Outros;
- **Valores aceitos (domínio identificado):**
  - `1` → NFS-e em duplicidade
  - `2` → NFS-e já emitida pelo tomador
  - `3` → Não ocorrência do fato gerador
  - `4` → Erro quanto a responsabilidade tributária
  - `5` → Erro quanto ao valor do serviço, valor das deduções ou serviço prestado ou data do fato gerador
  - `9` → Outros

### `evento/pedRegEvento/infPedReg/e204207/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e204207/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1954` — A  descrição do motivo é obrigatória caso o tipo do motivo seja "9 - Outros".
    - Detalhe da regra: Se o campo cMotivo for igual a "9, - Outros", então a descrição do motivo tem preenchimento obrigatório.

### `evento/pedRegEvento/infPedReg/e205208`

- **Campo:** `e205208`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Manifestação de NFS-e - Anulação da Rejeição
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0870` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE MANIFESTAÇÃO DE NFS-e - ANULAÇÃO DA REJEIÇÃO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE MANIFESTAÇÃO DE NFS-e - ANULAÇÃO DA REJEIÇÃO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e205208/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e205208/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Manifestação de NFS-e - Anulação da Rejeição

### `evento/pedRegEvento/infPedReg/e205208/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e205208/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal que efetuou o anulação da manifestação de rejeição da NFS-e.

### `evento/pedRegEvento/infPedReg/e205208/idEvManifRej`

- **Campo:** `idEvManifRej`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e205208/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 59
- **Descrição:** Referência ao "id" do Evento de Manifestação de NFS-e - Rejeição, que originou o presente evento de anulação.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1963` — O identificador do Evento de Manifestação de NFS-e - Rejeição a ser anulado deve existir no Sistema Nacional NFS-e e corresponder a um identificador de evento de rejeição vinculada à NFS-e informada no evento.

### `evento/pedRegEvento/infPedReg/e205208/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e205208/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.

### `evento/pedRegEvento/infPedReg/e305101`

- **Campo:** `e305101`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Cancelamento de NFS-e por Ofício
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1960` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE CANCELAMENTO DE NFS-e POR OFÍCIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE CANCELAMENTO DE NFS-e POR OFÍCIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e305101/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305101/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:  
  Cancelamento de NFS-e por Ofício

### `evento/pedRegEvento/infPedReg/e305101/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305101/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal que efetuou o cancelamento por ofício de NFS-e.

### `evento/pedRegEvento/infPedReg/e305101/nProcAdm`

- **Campo:** `nProcAdm`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305101/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 30
- **Descrição:** Número do processo administrativo municipal vinculado ao cancelamento de NFS-e por ofício.

### `evento/pedRegEvento/infPedReg/e305101/xProcAdm`

- **Campo:** `xProcAdm`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305101/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo do processo administrativo municipal indicado neste evento.

### `evento/pedRegEvento/infPedReg/e305102`

- **Campo:** `e305102`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Bloqueio de NFS-e por Ofício
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1965` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE BLOQUEIO DE NFS-e POR OFÍCIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE BLOQUEIO DE NFS-e POR OFÍCIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e305102/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305102/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:   
  Bloqueio de NFS-e por Ofício

### `evento/pedRegEvento/infPedReg/e305102/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305102/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal que efetuou o bloqueio de NFS-e por ofício.

### `evento/pedRegEvento/infPedReg/e305102/codEvento`

- **Campo:** `codEvento`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305102/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Eventos que podem ser escolhidos pelo município emissor para serem rejeitados após emissão e vinculação do evento de bloqueio por ofício em uma NFS-e:  
    
  e101101 - Cancelamento de NFS-e;  
  e105102 - Cancelamento de NFS-e por Substituição;  
  e105104 - Cancelamento de NFS-e Deferido por Análise Fiscal;  
  e105105 - Cancelamento de NFS-e Indeferido por Análise Fiscal;  
  e305101 - Cancelamento de NFS-e por Ofício;
- **Notas explicativas:** Verificar em conjunto o código do Evento de Bloqueio  associado ao código do evento que está sendo bloqueado (valor do campo cEvtNFSe).  
    
  Em <tipo_evento_bloqueio_NFS-e> substituir pelo nome do evento correspondente ao código do campo cEvtNFSe.  
    
  e101101 - Cancelamento de NFS-e;  
  e105102 - Cancelamento de NFS-e por Substituição;  
  e105104 - Cancelamento de NFS-e Deferido por Análise Fiscal;  
  e105105 - Cancelamento de NFS-e Indeferido por Análise Fiscal;  
  e305101 - Cancelamento de NFS-e por Ofício;
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1967` — O sistema não pode recepcionar o Evento de Bloqueio de NFS-e por Ofício para <tipo_evento_bloqueio_NFS-e>, pois já existe o mesmo tipo de evento vinculado à NFS-e sem o Evento de Desbloqueio correpondente.
    - Detalhe da regra: O Evento de Bloqueio de NFS-e para um tipo de evento, deve ser rejeitado se já houver um evento de bloqueio de NFS-e para o mesmo tipo do evento que não esteja desbloquedo.  Obs: Verificar se para cada evento de bloqueio de NFS-e para um tipo de evento existe o correspondente desbloqueio.  Se os possíveis eventos de bloqueios de NFS-e para um tipo de evento não estiverem todos pareados com os seus respectivos desbloqueios, então o eveto de bloqueio de NFS-e do mesmo tipo que está sendo recepcionado pelo Sistema Nacional NFS-e deverá ser rejeitado.

### `evento/pedRegEvento/infPedReg/e305102/xMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305102/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição para explicitar o motivo indicado neste evento.

### `evento/pedRegEvento/infPedReg/e305103`

- **Campo:** `e305103`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Parte Específica do Evento  
  Desbloqueio de NFS-e por Ofício
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1970` — O Sistema Nacional NFS-e não pode recepecionar o EVENTO DE DESBLOQUEIO DE NFS-e POR OFÍCIO pois, o evento de <nome_evento_vinculado_a_NFS-e> já está vinculado à NFS-e indicada no evento enviado, impedindo sua recepção.
    - Detalhe da regra: O Sistema Nacional NFS-e deve responder à recepção do EVENTO DE DESBLOQUEIO DE NFS-e POR OFÍCIO, conforme indicado nas linhas da respectiva coluna deste evento na planilha "RN EVENTOSxEVENTOS - Sistema Nacional NFS-e".

### `evento/pedRegEvento/infPedReg/e305103/xDesc`

- **Campo:** `xDesc`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305103/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 5-60
- **Descrição:** Descrição do evento:   
  Desbloqueio de NFS-e por Ofício

### `evento/pedRegEvento/infPedReg/e305103/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305103/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal que efetuou o desbloqueio de NFS-e por ofício.

### `evento/pedRegEvento/infPedReg/e305103/idBloqOfic`

- **Campo:** `idBloqOfic`
- **Caminho no XML:** `evento/pedRegEvento/infPedReg/e305103/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 59
- **Descrição:** Referência ao "id" do "Bloqueio de ofício" que originou o presente evento de desbloqueio.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1976` — Não existe o identificador de bloqueio informado neste evento para desbloqueio.
    - Detalhe da regra: O evento de Evento de Desbloqueio de NFS-e deve ser rejeitado se o identificador do bloqueio de oficio, indicado neste evento, não existir.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1978` — O sistema não pode recepcionar o Evento Desbloqueio de NFS-e por Ofício, pois o Evento de Bloqueio indicado já foi desbloqueado.
    - Detalhe da regra: O Evento de Desbloqueio de NFS-e deve ser rejeitado se o identificador do bloqueio de oficio, indicado neste evento, já tiver sido desbloqueado.

### `evento/pedRegEvento/Signature`

- **Campo:** `Signature`
- **Caminho no XML:** `evento/pedRegEvento/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Assinatura do pedido de registro de evento segundo o Padrão XML Digital Signature.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1980` — Arquivo enviado com erro na assinatura.
    - Detalhe da regra: A assinatura do Pedido de Registro de Evento deve ser válida.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1983` — Certificado Digital da assinatura inválido.
    - Detalhe da regra: Certificado Digital da assintura inválido:  - Validade do Certificado (data início e data fim); - Verifica a Cadeia de Certificação; - Certificado do Transmissor revogado; - LCR indisponível ou inválida.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1986` — Certificado Digital fora do padrão estabelecido.
    - Detalhe da regra: Certificado Digital da assinatura fora do padrão estabelecido pelo projeto NFS-e:  - Versão diferente de 3; - Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC); - KeyUsage não define 'Assinatura Digital' e 'Não Recusa'; - Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1); - Certificado Raiz difere da 'ICP-Brasil'.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1989` — A assinatura é obrigatória quando for enviado para o Web Service.
    - Detalhe da regra: É obrigatória a existência da assinatura do Pedido de Registro de Evento quando for enviado para Web Service.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1991` — A assinatura deve ser feita com o certificado digital do emitente do Pedido de Registro de Evento.

### `evento/Signature`

- **Campo:** `Signature`
- **Caminho no XML:** `evento/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Assinatura do pedido de registro segundo o Padrão XML Digital Signature.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E2020` — Arquivo enviado com erro na assinatura.
    - Detalhe da regra: A assinatura do Evento deve ser válida.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E2023` — Certificado Digital da assinatura inválido.
    - Detalhe da regra: Certificado Digital da assintura inválido:  - Validade do Certificado (data início e data fim); - Verifica a Cadeia de Certificação; - Certificado do Transmissor revogado; - LCR indisponível ou inválida.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E2026` — Certificado Digital fora do padrão estabelecido.
    - Detalhe da regra: Certificado Digital da assinatura fora do padrão estabelecido pelo Sistema Nacional NFS-e:  - Versão diferente de 3; - Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC); - KeyUsage não define 'Assinatura Digital' e 'Não Recusa'; - Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1); - Certificado Raiz difere da 'ICP-Brasil'.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E2029` — A assinatura é obrigatória quando for enviado paraa API.
    - Detalhe da regra: É obrigatória a existência da assinatura do Evento quando for enviado para Web Service.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E2032` — A assinatura deve ser feita com o certificado digital do município emissor do Evento.
