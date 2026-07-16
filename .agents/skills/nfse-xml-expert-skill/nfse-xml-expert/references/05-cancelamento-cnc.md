# Comunicação Nacional de Cancelamento — CNC (Anexo III)

Fonte: `anexo_iii-cnc-snnfse-v1-00-20251216.xlsx`, abas **LEIAUTE_CNC** e **RN_LEIAUTE_CNC**.

Cobre o XML de **CNC — Comunicação Nacional de Cancelamento**, usado por sistemas de terceiros / municípios para reportar ao ADN Nacional o cancelamento de uma NFS-e emitida fora do Sistema Nacional NFS-e (ex.: sistemas próprios municipais legados que compartilham NFS-e com o ADN).


---

## Índice de campos (ordem do XML)

| # | Caminho | Campo | Ele | Tipo | Ocor. | Tam. |
|---|---------|-------|-----|------|-------|------|
| 1 | `` | `CNC` | Raiz | - | - | - |
| 2 | `CNC/` | `versao` | A | C | 1-1 | 1-4V2 |
| 3 | `CNC/` | `infCNC` | G | - | 1-1 | - |
| 4 | `CNC/infCNC/` | `Id` | ID | C | 1-1 | 26 |
| 5 | `CNC/infCNC/` | `cMun` | E | N | 1-1 | 7 |
| 6 | `CNC/infCNC/` | `cnpjMun` | E | N | 1-1 | 14 |
| 7 | `CNC/infCNC/` | `CPFAgTrib` | E | N | 1-1 | 11 |
| 8 | `CNC/infCNC/` | `tpAmb` | E | N | 1-1 | 1 |
| 9 | `CNC/infCNC/` | `verAplic` | E | C | 1-1 | 1-20 |
| 10 | `CNC/infCNC/` | `infContrib` | G | - | 1-1 | - |
| 11 | `CNC/infCNC/infContrib/` | `CNPJ` | CE | N | 1-1 | 14 |
| 12 | `CNC/infCNC/infContrib/` | `CPF` | CE | N | 1-1 | 11 |
| 13 | `CNC/infCNC/infContrib/` | `IM` | E | C | 1-1 | 15 |
| 14 | `CNC/infCNC/infContrib/` | `dIM` | E | D | 1-1 | - |
| 15 | `CNC/infCNC/infContrib/` | `xFantasia` | E | C | 0-1 | 150 |
| 16 | `CNC/infCNC/infContrib/` | `ender` | G | - | 0-1 | - |
| 17 | `CNC/infCNC/infContrib/ender/` | `CEP` | E | N | 1-1 | 8 |
| 18 | `CNC/infCNC/infContrib/ender/` | `xLgr` | E | C | 1-1 | 1-255 |
| 19 | `CNC/infCNC/infContrib/ender/` | `nro` | E | C | 1-1 | 1-60 |
| 20 | `CNC/infCNC/infContrib/ender/` | `xCpl` | E | C | 0-1 | 1-156 |
| 21 | `CNC/infCNC/infContrib/ender/` | `xBairro` | E | C | 1-1 | 1-60 |
| 22 | `CNC/infCNC/infContrib/` | `fone` | E | N | 0-1 | 9-20 |
| 23 | `CNC/infCNC/infContrib/` | `email` | E | C | 0-1 | 80 |
|  | `CNC/infCNC/infContrib/` | `dAutEmiss` | E | D | 1-1 | - |
| 24 | `CNC/infCNC/infContrib/` | `cStatEmiss` | E | N | 1-1 | 1 |
| 26 | `CNC/infCNC/infContrib/` | `cSitCNC` | E | N | 1-1 | 1 |
| 27 | `CNC/infCNC/infContrib/` | `xSitCadMun` | E | C | 0-1 | 1-150 |
| 28 | `CNC/infCNC/infContrib/` | `xMotivoSitCadMun` | E | C | 0-1 | 1-255 |

---

## Detalhamento campo a campo

### `CNC`

- **Campo:** `CNC`
- **Elemento (ELE):** Raiz  |  **Tipo:** -  |  **Ocorrência (min-max):** -  |  **Tamanho:** -
- **Descrição:** TAG raiz

### `CNC/versao`

- **Campo:** `versao`
- **Caminho no XML:** `CNC/`
- **Elemento (ELE):** A  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-4V2
- **Descrição:** Versão do leiaute.

### `CNC/infCNC`

- **Campo:** `infCNC`
- **Caminho no XML:** `CNC/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do Cadastro Nacional Complementar NFS-e

### `CNC/infCNC/Id`

- **Campo:** `Id`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** ID  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 26
- **Descrição:** "CNC" + Cód.Mun.(7) + Tipo de Ambiente(1) + IM(15)
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3341` — O código do município do id não está de acordo com a informação do campo cMun do leiaute.
    - Detalhe da regra: Verificar se o código do município está de acordo com o campo cMun do leiaute CNC.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3342` — O tipo de ambiente do id não está de acordo com a informação do campo tpAmb do leiaute.
    - Detalhe da regra: Verificar se o tipo de ambiente está de acordo com o campo tpAmb do leiaute CNC.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3343` — A inscrição municipal do id não está de acordo com a informação do campo IM do leiaute.
    - Detalhe da regra: Verificar se a inscrição municipal está de acordo com o campo IM do leiaute CNC.

### `CNC/infCNC/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código IBGE do município do contribuinte.
- **Notas explicativas:** Conforme AnexoA-Tabelas_ISO2Paises_MunIBGE_Rodovias-SNNFSe.
- **Regras de negócio associadas:**
  - [Nível Conforme AnexoA-Tabelas_ISO2Paises_MunIBGE_Rodovias-SNNFSe.] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3336` — O código do município não existe no cadastro de convênio municipal do sistema nacional.
    - Detalhe da regra: O código do município deve estar associado ao CNPJ de transmissão e existir no cadastro de convênio municipal do sistema nacional.

### `CNC/infCNC/cnpjMun`

- **Campo:** `cnpjMun`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** CNPJ do Município.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3338` — O CNPJ do município informado não corresponde ao CNPJ de transmissão.
    - Detalhe da regra: O CNPJ do município deve corresponder ao CNPJ de transmissão.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3333` — O CNPJ do município informado não existe no cadastro de convênio municipal do sistema nacional ou não está conveniado.
    - Detalhe da regra: O CNPJ do município deve estar registrado no cadastro de convênio municipal do sistema nacional e estar "CADASTRADO", "PARAMETRIZADO" ou "ATIVO".
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3334` — O código do município informado existe, mas está suspenso no convênio municipal.
    - Detalhe da regra: O CNPJ do município existe no cadastro de convênio municipal do sistema nacional, mas está suspenso.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3335` — O código do município informado existe, mas não está ativo há mais de <número de dias> dias no cadastro de convênio municipal.
    - Detalhe da regra: O CNPJ do município existe no cadastro de convênio municipal do sistema nacional, mas está inativo.

### `CNC/infCNC/CPFAgTrib`

- **Campo:** `CPFAgTrib`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** CPF do agente da administração tributária municipal quer enviou o registro do contribuinte do município para o CNC.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3330` — CPF do agente tributário informado é inválido.
    - Detalhe da regra: CPF informado é inválido (verificar DV).
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3353` — O CPF do Agente Tributário deve corresponder ao CPF de um Gestor Municipal ATIVO do município que está realizando o registro complementar no CNC NFS-e.

### `CNC/infCNC/tpAmb`

- **Campo:** `tpAmb`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Tipo de ambiente:  
    
  1 - Produção;   
  2 - Homologação;
- **Valores aceitos (domínio identificado):**
  - `1` → Produção
  - `2` → Homologação
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3331` — Ambiente informado diverge do ambiente de recebimento para o qual o município enviou o movimento CNC.
    - Detalhe da regra: Ambiente informado diverge do ambiente de recebimento para o qual o município enviou o movimento.

### `CNC/infCNC/verAplic`

- **Campo:** `verAplic`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-20
- **Descrição:** Versão do aplicativo que gerou a Movimentação.

### `CNC/infCNC/infContrib`

- **Campo:** `infContrib`
- **Caminho no XML:** `CNC/infCNC/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do Contribuinte
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3348` — Para qualquer registro complementar de um contribuinte o município deve informar IDFed + IM + pelo menos mais uma informação complementar
    - Detalhe da regra: É obrigatório informar pelo menos um dado complementar do contribuinte para qualquer registro pelo município no CNC NFS-e.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3351` — Não é permitido realizar movimentações em um registro de contribuinte do CNC NFS-e inativo.
    - Detalhe da regra: Não é permitido realizar movimentações em um registro de contribuinte do CNC NFS-e inativo (cSitCNC = 0).

### `CNC/infCNC/infContrib/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição federal (CNPJ) do contribuinte da NFS-e.
- **Notas explicativas:** Um mesmo IDFed pode ser registrado mais de uma por um mesmo município desde que cada um destes registros realizados pelo município tenham IMs diferentes entre si.  
    
  Para um município, a chave para cadastro e manutenção do CNC é IDFederal (CNPJ/CPF) + Identificador Municipal (IM) (IDFed + IM são sempre obrigatórios).
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3339` — CNPJ do contribuinte informado é inválido.
    - Detalhe da regra: CNPJ informado é inválido (verificar DV).

### `CNC/infCNC/infContrib/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição federal (CPF) do contribuinte da NFS-e.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3340` — CPF do contribuinte informado é inválido.
    - Detalhe da regra: CPF informado é inválido (verificar DV).

### `CNC/infCNC/infContrib/IM`

- **Campo:** `IM`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 15
- **Descrição:** Número do identificador municipal do contribuinte da NFS-e.

### `CNC/infCNC/infContrib/dIM`

- **Campo:** `dIM`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** A data em que foi criada o indicador municipal do contribuinte AAAA-MM-DD.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `3356` — A data do indicador municipal deve ser posterior ou igual à data de inscrição do contribuinte nos cadastros RFB.
    - Detalhe da regra: Esta data deve ser posterior ou igual à data de inscrição do contribuinte nos cadastros RFB.

### `CNC/infCNC/infContrib/xFantasia`

- **Campo:** `xFantasia`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 150
- **Descrição:** Nome fantasia do contribuinte.

### `CNC/infCNC/infContrib/ender`

- **Campo:** `ender`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do contribuinte do município
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3352` — É obrigatório informar o grupo de informações complementares de endereço quando o município do endereço, nos cadastros RFB para o contribuinte informado, for diferente do município que está registrando informações complementares para o contribuinte no CNC NFS-e.
    - Detalhe da regra: Verificar se o município no endereço dos cadastros RFB (CNPJ/CPF) para o CNPJ ou CPF do contribuinte que se está complementando informações no CNC NFS-e, corresponde ao mesmo município (cMun) que está enviando este registro.  Se os municípios forem diferentes, então é obrigatório registrar o grupo de informações complementares de endereço (ender).

### `CNC/infCNC/infContrib/ender/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `CNC/infCNC/infContrib/ender/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Número do CEP do endereço do contribuinte.  
  (Informar os zeros não significativos)
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3313` — O CEP informado para o endereço do contribuinte não existe ou não pertence ao município. Informe um CEP existente e que pertença ao município que está enviando a informação do contribuinte.
    - Detalhe da regra: O CEP informado deve existir e pertencer ao município correspondente ao código do município (cMun) que está enviando a informação do contribuinte.

### `CNC/infCNC/infContrib/ender/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `CNC/infCNC/infContrib/ender/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro da localização do endereço do contribuinte.

### `CNC/infCNC/infContrib/ender/nro`

- **Campo:** `nro`
- **Caminho no XML:** `CNC/infCNC/infContrib/ender/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número do imóvel do endereço do contribuinte.

### `CNC/infCNC/infContrib/ender/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `CNC/infCNC/infContrib/ender/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do contribuinte.

### `CNC/infCNC/infContrib/ender/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `CNC/infCNC/infContrib/ender/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do contribuinte.

### `CNC/infCNC/infContrib/fone`

- **Campo:** `fone`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 9-20
- **Descrição:** Número do telefone do contribuinte.  
  (Preencher com o Código DDD + número do telefone.   
  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `CNC/infCNC/infContrib/email`

- **Campo:** `email`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 80
- **Descrição:** E-mail do contribuinte.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3332` — Email informado no documento inválido.
    - Detalhe da regra: Email deve ser informado conforme estrutura (conter @, ponto etc.).

### `CNC/infCNC/infContrib/dAutEmiss`

- **Campo:** `dAutEmiss`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data inicial de autorização do contribuinte para emissão de NFS-e nos emissores públicos do Sistema Nacional NFS-e.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3354` — A data de autorização de uso dos emissores públicos deve ser posterior ou igual à data do indicador municipal.
    - Detalhe da regra: A data de autorização de uso dos emissores públicos deve ser posterior ou igual à data do indicador municipal. O contribuinte poderá emitir novos documentos fiscais a partir desta data de autorização de uso dos emissores públicos ou a partir da data de início de vigência do convênio municipal, prevalecendo a maior data.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E3355` — A data de autorização de uso dos emissores públicos não pode ser alterada se for menor ou igual que a data atual da alteracão.

### `CNC/infCNC/infContrib/cStatEmiss`

- **Campo:** `cStatEmiss`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Status para emissão de NFS-e:  
    
  0 - Suspenso;  
  1 - Autorizado;
- **Notas explicativas:** Por padrão todos os contribuintes com endereço em um município pelos cadastros RFB (CNPJ e CPF) estão habilitados a emitirem NFS-e pelos Emissores Públicos Nacionais.  
    
  Para desabilitar um contribuinte a emitir NFS-e pelo município, este deve registra o complemento no CNC (IDFed + IM + cStatEmiss = 0).
- **Valores aceitos (domínio identificado):**
  - `0` → Suspenso
  - `1` → Autorizado

### `CNC/infCNC/infContrib/cSitCNC`

- **Campo:** `cSitCNC`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Situação do registro no CNC NFS-e:  
    
  0 - Inativo;  
  1 - Ativo;
- **Notas explicativas:** Exclusão lógica do registro no CNC.
- **Valores aceitos (domínio identificado):**
  - `0` → Inativo
  - `1` → Ativo

### `CNC/infCNC/infContrib/xSitCadMun`

- **Campo:** `xSitCadMun`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-150
- **Descrição:** Descrição Situação Cadastral no Município.

### `CNC/infCNC/infContrib/xMotivoSitCadMun`

- **Campo:** `xMotivoSitCadMun`
- **Caminho no XML:** `CNC/infCNC/infContrib/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-255
- **Descrição:** Motivo da Situação Cadastral no Município.
