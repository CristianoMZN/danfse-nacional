# Anexo III — Cadastro Nacional Complementar (CNC) — SNNFSe

> Reestruturação em Markdown da planilha `anexo_iii-cnc-snnfse-v1-00-20251216(1).xlsx`, preservando os dados técnicos e explicitando relações que, na planilha, são transmitidas por posição, agrupamento e células mescladas.

## 1. Identificação e organização da fonte

- **Arquivo de origem:** `anexo_iii-cnc-snnfse-v1-00-20251216(1).xlsx`
- **Identificação inferida do nome do arquivo:** Anexo III — CNC — SNNFSe — versão 1.00 — 2025-12-16.
- **Planilhas presentes:**
  - `RN_RECEPCAO_LEIAUTE_CNC`: regras de negócio aplicadas no recebimento do documento, principalmente validações de certificado e esquema XML.
  - `LEIAUTE_CNC`: estrutura do leiaute XML do CNC, com campos, tipos, ocorrências, tamanhos, descrições e notas.
  - `RN_LEIAUTE_CNC`: regras de negócio associadas aos campos do leiaute.

### 1.1. Como as relações da planilha foram convertidas

- Células mescladas de **caminho/campo** foram expandidas logicamente: quando uma linha de regra deixa essas células em branco porque pertencem à mesma célula mesclada da linha anterior, o Markdown repete o campo-alvo resolvido.
- A nota do identificador federal que aparece visualmente mesclada sobre **CNPJ, CPF e IM** foi tratada como uma regra contextual compartilhada entre esses campos.
- A linha `Validação do Certificado de Transmissão` da planilha de recepção foi interpretada como um **grupo de validações**, do qual as regras seguintes são integrantes.
- Lacunas e inconsistências de numeração da coluna `#` foram **preservadas**; linhas sem número são marcadas como `sem nº na origem`.
- O código de erro `3356` foi mantido exatamente como aparece na planilha, **sem acrescentar o prefixo `E`**.
- Textos de mensagens de erro e grafias foram preservados conforme a origem, inclusive eventuais erros de digitação.
- O valor `-` é mantido quando a planilha o utiliza explicitamente; `—` no Markdown representa célula vazia/não preenchida na origem.

## 2. Convenções do leiaute

A planilha usa as colunas `ELE`, `TIPO`, `OCOR.` e `TAM.` para caracterizar cada item. Os códigos abaixo são reproduzidos conforme a origem:

- **ELE:** `Raiz`, `A`, `G`, `ID`, `E`, `CE`.
- **TIPO:** `C`, `N`, `D` ou `-`.
- **OCOR.:** cardinalidade do item, principalmente `1-1` (uma ocorrência obrigatória) e `0-1` (zero ou uma ocorrência).
- **TAM.:** tamanho fixo ou intervalo conforme informado pela planilha, por exemplo `14`, `1-20`, `1-255` ou `1-4V2`.

> **Observação sobre `CNPJ` e `CPF`:** ambos estão marcados com `ELE = CE` e são tratados nas notas como `IDFederal (CNPJ/CPF)`. Isso indica que eles formam as alternativas do identificador federal do contribuinte; o cadastro/manutenção é referenciado pela combinação `IDFederal + IM`.

## 3. Hierarquia reconstruída do XML

```text
CNC [Raiz]
├── versao [A]
└── infCNC [G]
    ├── Id [ID]
    ├── cMun [E]
    ├── cnpjMun [E]
    ├── CPFAgTrib [E]
    ├── tpAmb [E]
    ├── verAplic [E]
    └── infContrib [G]
        ├── CNPJ [CE] ─┐
        ├── CPF  [CE] ─┴─ IDFederal
        ├── IM [E]
        ├── dIM [E]
        ├── xFantasia [E]
        ├── ender [G]
        │   ├── CEP [E]
        │   ├── xLgr [E]
        │   ├── nro [E]
        │   ├── xCpl [E]
        │   └── xBairro [E]
        ├── fone [E]
        ├── email [E]
        ├── dAutEmiss [E]
        ├── cStatEmiss [E]
        ├── cSitCNC [E]
        ├── xSitCadMun [E]
        └── xMotivoSitCadMun [E]
```

## 4. Leiaute completo do CNC

A coluna **Caminho completo** abaixo foi reconstruída combinando `CAMINHO NO XML` + `CAMPO` da planilha. As demais informações são transcritas da origem.

| # origem | Caminho completo | Caminho pai na origem | Campo | ELE | TIPO | OCOR. | TAM. | Descrição | Notas explicativas |
|---:|---|---|---|---|---|---|---|---|---|
| 1 | CNC | — | CNC | Raiz | - | - | - | TAG raiz | - |
| 2 | CNC/versao | CNC/ | versao | A | C | 1-1 | 1-4V2 | Versão do leiaute. | - |
| 3 | CNC/infCNC | CNC/ | infCNC | G | - | 1-1 | - | Grupo de informações do Cadastro Nacional Complementar NFS-e | - |
| 4 | CNC/infCNC/Id | CNC/infCNC/ | Id | ID | C | 1-1 | 26 | "CNC" + Cód.Mun.(7) + Tipo de Ambiente(1) + IM(15) | - |
| 5 | CNC/infCNC/cMun | CNC/infCNC/ | cMun | E | N | 1-1 | 7 | Código IBGE do município do contribuinte. | Conforme AnexoA-Tabelas_ISO2Paises_MunIBGE_Rodovias-SNNFSe. |
| 6 | CNC/infCNC/cnpjMun | CNC/infCNC/ | cnpjMun | E | N | 1-1 | 14 | CNPJ do Município. | - |
| 7 | CNC/infCNC/CPFAgTrib | CNC/infCNC/ | CPFAgTrib | E | N | 1-1 | 11 | CPF do agente da administração tributária municipal quer enviou o registro do contribuinte do município para o CNC. | - |
| 8 | CNC/infCNC/tpAmb | CNC/infCNC/ | tpAmb | E | N | 1-1 | 1 |  Tipo de ambiente:<br><br>1 - Produção; <br>2 - Homologação; | - |
| 9 | CNC/infCNC/verAplic | CNC/infCNC/ | verAplic | E | C | 1-1 | 1-20 | Versão do aplicativo que gerou a Movimentação. | - |
| 10 | CNC/infCNC/infContrib | CNC/infCNC/ | infContrib | G | - | 1-1 | - | Grupo de informações do Contribuinte | - |
| 11 | CNC/infCNC/infContrib/CNPJ | CNC/infCNC/infContrib/ | CNPJ | CE | N | 1-1 | 14 | Número da inscrição federal (CNPJ) do contribuinte da NFS-e. | Um mesmo IDFed pode ser registrado mais de uma por um mesmo município desde que cada um destes registros realizados pelo município tenham IMs diferentes entre si.<br><br>Para um município, a chave para cadastro e manutenção do CNC é IDFederal (CNPJ/CPF) + Identificador Municipal (IM) (IDFed + IM são sempre obrigatórios). |
| 12 | CNC/infCNC/infContrib/CPF | CNC/infCNC/infContrib/ | CPF | CE | N | 1-1 | 11 | Número da inscrição federal (CPF) do contribuinte da NFS-e. | Compartilha a nota mesclada de CNPJ/CPF/IM apresentada logo abaixo desta tabela. |
| 13 | CNC/infCNC/infContrib/IM | CNC/infCNC/infContrib/ | IM | E | C | 1-1 | 15 | Número do identificador municipal do contribuinte da NFS-e. | Compartilha a nota mesclada de CNPJ/CPF/IM apresentada logo abaixo desta tabela. |
| 14 | CNC/infCNC/infContrib/dIM | CNC/infCNC/infContrib/ | dIM | E | D | 1-1 | - | A data em que foi criada o indicador municipal do contribuinte AAAA-MM-DD.  | - |
| 15 | CNC/infCNC/infContrib/xFantasia | CNC/infCNC/infContrib/ | xFantasia | E | C | 0-1 | 150 | Nome fantasia do contribuinte. | - |
| 16 | CNC/infCNC/infContrib/ender | CNC/infCNC/infContrib/ | ender | G | - | 0-1 | - | Grupo de informações do endereço do contribuinte do município | - |
| 17 | CNC/infCNC/infContrib/ender/CEP | CNC/infCNC/infContrib/ender/ | CEP | E | N | 1-1 | 8 | Número do CEP do endereço do contribuinte.<br>(Informar os zeros não significativos) | - |
| 18 | CNC/infCNC/infContrib/ender/xLgr | CNC/infCNC/infContrib/ender/ | xLgr | E | C | 1-1 | 1-255 | Tipo e nome do logradouro da localização do endereço do contribuinte. | - |
| 19 | CNC/infCNC/infContrib/ender/nro | CNC/infCNC/infContrib/ender/ | nro | E | C | 1-1 | 1-60 | Número do imóvel do endereço do contribuinte. | - |
| 20 | CNC/infCNC/infContrib/ender/xCpl | CNC/infCNC/infContrib/ender/ | xCpl | E | C | 0-1 | 1-156 | Complemento do endereço do contribuinte. | - |
| 21 | CNC/infCNC/infContrib/ender/xBairro | CNC/infCNC/infContrib/ender/ | xBairro | E | C | 1-1 | 1-60 | Bairro do endereço do contribuinte. | - |
| 22 | CNC/infCNC/infContrib/fone | CNC/infCNC/infContrib/ | fone | E | N | 0-1 | 9-20 | Número do telefone do contribuinte.<br>(Preencher com o Código DDD + número do telefone. <br>Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone) | - |
| 23 | CNC/infCNC/infContrib/email | CNC/infCNC/infContrib/ | email | E | C | 0-1 | 80 | E-mail do contribuinte. | - |
| sem nº na origem | CNC/infCNC/infContrib/dAutEmiss | CNC/infCNC/infContrib/ | dAutEmiss | E | D | 1-1 | - | Data inicial de autorização do contribuinte para emissão de NFS-e nos emissores públicos do Sistema Nacional NFS-e. | - |
| 24 | CNC/infCNC/infContrib/cStatEmiss | CNC/infCNC/infContrib/ | cStatEmiss | E | N | 1-1 | 1 | Status para emissão de NFS-e:<br><br>0 - Suspenso;<br>1 - Autorizado; | Por padrão todos os contribuintes com endereço em um município pelos cadastros RFB (CNPJ e CPF) estão habilitados a emitirem NFS-e pelos Emissores Públicos Nacionais.<br><br>Para desabilitar um contribuinte a emitir NFS-e pelo município, este deve registra o complemento no CNC (IDFed + IM + cStatEmiss = 0). |
| 26 | CNC/infCNC/infContrib/cSitCNC | CNC/infCNC/infContrib/ | cSitCNC | E | N | 1-1 | 1 | Situação do registro no CNC NFS-e:<br><br>0 - Inativo;<br>1 - Ativo; | Exclusão lógica do registro no CNC. |
| 27 | CNC/infCNC/infContrib/xSitCadMun | CNC/infCNC/infContrib/ | xSitCadMun | E | C | 0-1 | 1-150 | Descrição Situação Cadastral no Município. | - |
| 28 | CNC/infCNC/infContrib/xMotivoSitCadMun | CNC/infCNC/infContrib/ | xMotivoSitCadMun | E | C | 0-1 | 1-255 | Motivo da Situação Cadastral no Município. | - |

### 4.1. Nota compartilhada — CNPJ, CPF e IM

A planilha apresenta uma única célula de notas mesclada cobrindo os campos `CNPJ`, `CPF` e `IM`. O conteúdo é:

> Um mesmo IDFed pode ser registrado mais de uma por um mesmo município desde que cada um destes registros realizados pelo município tenham IMs diferentes entre si.
>
> Para um município, a chave para cadastro e manutenção do CNC é IDFederal (CNPJ/CPF) + Identificador Municipal (IM) (IDFed + IM são sempre obrigatórios).

### 4.2. Domínios e valores explícitos no leiaute

- `tpAmb`:
  - `1` = Produção
  - `2` = Homologação
- `cStatEmiss`:
  - `0` = Suspenso
  - `1` = Autorizado
- `cSitCNC`:
  - `0` = Inativo
  - `1` = Ativo

### 4.3. Regras contextuais importantes do leiaute

- Para desabilitar a emissão de NFS-e de um contribuinte pelo município, a nota da origem orienta registrar o complemento no CNC com `IDFed + IM + cStatEmiss = 0`.
- Por padrão, os contribuintes com endereço no município segundo os cadastros RFB (CNPJ e CPF) estão habilitados a emitir NFS-e pelos Emissores Públicos Nacionais.
- `cSitCNC = 0` representa exclusão lógica/inativação do registro no CNC.
- O telefone deve ser informado com DDD + número; em operações com exterior, é permitido país + localidade + número.
- O `CEP` deve conter oito dígitos, incluindo zeros não significativos.

## 5. Regras de negócio de recepção

### 5.1. Grupo: Validação do Certificado de Transmissão

Na origem, o item `#1` funciona como título do grupo e não possui aplicação, efeito ou código de erro próprios.

| # origem | Regra / validação | Aplic. | Efeito | Cód. erro | Mensagem de erro | Notas |
|---:|---|---|---|---|---|---|
| 1 | Validação do Certificado de Transmissão | - | - | - | - | - |
| 2 | Certificado de Transmissor Inválido:<br>- Certificado de Transmissor inexistente na mensagem<br>- Versão difere "3"<br>- Se informado o Basic Constraint deve ser true (não pode ser Certificado de AC)<br>- KeyUsage não define "Autenticação Cliente" | Obrig. | Rej. | E3316 | Certificado de Transmissão Inválido | - |
| 3 | Validade do Certificado (data início e data fim) | Obrig. | Rej. | E3317 | Certificado de Transmissão expirado | - |
| 4 | Verifica a Cadeia de Certificação:<br>- Certificado da AC emissora não cadastrado na RFB<br>- Certificado de AC revogado<br>- Certificado não assinado pela AC emissora do Certificado | Obrig. | Rej. | E3321 | Certificado de Transmissão - Erro Cadeira de Certificação | - |
| 5 | LCR do Certificado de Transmissor<br>- Falta o endereço da LCR (CRL DistributionPoint)<br>- LCR indisponível<br>- LCR inválida | Obrig. | Rej. | E3319 | Certificado de Transmissão - Erro de acesso a LCR | - |
| 6 | Certificado do Transmissor revogado | Obrig. | Rej. | E3320 | Certificado de Transmissão revogado | - |
| 7 | Certificado Raiz difere da "ICP-Brasil" | Obrig. | Rej. | E3322 | Certificado de Transmissão difere da ICP - Brasil | - |
| 8 | Falta a extensão de CNPJ no Certificado (OtherName - OID=2.16.76.1.3.3) | Obrig. | Rej. | E3318 | Certificado de Transmissão sem CNPJ | - |
| 9 | Verificar se o CNPJ do município informado corresponde ao CNPJ de transmissão. | Obrig. | Rej. | E3338 | O CNPJ do município informado não corresponde ao CNPJ de transmissão. | - |
| 10 | Falha no esquema XML. | Obrig. | Rej. | E3344 | Falha no esquema XML. | - |

## 6. Regras de negócio associadas ao leiaute

As células mescladas de `CAMINHO NO XML` e `CAMPO` foram resolvidas por herança visual. Assim, cada linha abaixo indica explicitamente o mesmo campo-alvo ao qual a regra pertence.

| # origem | Caminho completo resolvido | Regra de negócio | Aplic. | Efeito | Cód. erro | Mensagem de erro | Notas explicativas |
|---:|---|---|---|---|---|---|---|
| 1 | CNC | — | — | — | — | — | - |
| 2 | CNC/versao | Prazo de aceitação da versão do leiaute CNC ultrapassado. | Obrig. | Rej. | E3329 | O prazo de aceitação da versão do leiaute da CNC expirou. | - |
| 3 | CNC/infCNC | — | — | — | — | — | - |
| 4 | CNC/infCNC/Id | Verificar se o código do município está de acordo com o campo cMun do leiaute CNC. | Obrig. | Rej. | E3341 | O código do município do id não está de acordo com a informação do campo cMun do leiaute. | — |
| 5 | CNC/infCNC/Id | Verificar se o tipo de ambiente está de acordo com o campo tpAmb do leiaute CNC. | Obrig. | Rej. | E3342 | O tipo de ambiente do id não está de acordo com a informação do campo tpAmb do leiaute. | — |
| 6 | CNC/infCNC/Id | Verificar se a inscrição municipal está de acordo com o campo IM do leiaute CNC. | Obrig. | Rej. | E3343 | A inscrição municipal do id não está de acordo com a informação do campo IM do leiaute. | — |
| 7 | CNC/infCNC/cMun | O código do município deve estar associado ao CNPJ de transmissão e existir no cadastro de convênio municipal do sistema nacional. | Obrig. | Rej. | E3336 | O código do município não existe no cadastro de convênio municipal do sistema nacional. | Conforme AnexoA-Tabelas_ISO2Paises_MunIBGE_Rodovias-SNNFSe. |
| 8 | CNC/infCNC/cnpjMun | O CNPJ do município deve corresponder ao CNPJ de transmissão. | Obrig. | Rej. | E3338 | O CNPJ do município informado não corresponde ao CNPJ de transmissão. | — |
| 9 | CNC/infCNC/cnpjMun | O CNPJ do município deve estar registrado no cadastro de convênio municipal do sistema nacional e estar "CADASTRADO", "PARAMETRIZADO" ou "ATIVO". | Obrig. | Rej. | E3333 | O CNPJ do município informado não existe no cadastro de convênio municipal do sistema nacional ou não está conveniado. | — |
| 10 | CNC/infCNC/cnpjMun | O CNPJ do município existe no cadastro de convênio municipal do sistema nacional, mas está suspenso. | Obrig. | Rej. | E3334 | O código do município informado existe, mas está suspenso no convênio municipal. | — |
| 11 | CNC/infCNC/cnpjMun | O CNPJ do município existe no cadastro de convênio municipal do sistema nacional, mas está inativo. | Obrig. | Rej. | E3335 | O código do município informado existe, mas não está ativo há mais de <número de dias> dias no cadastro de convênio municipal. | — |
| 12 | CNC/infCNC/CPFAgTrib | CPF informado é inválido (verificar DV). | Obrig. | Rej. | E3330 | CPF do agente tributário informado é inválido. | - |
| sem nº na origem | CNC/infCNC/CPFAgTrib | O CPF do Agente Tributário deve corresponder ao CPF de um Gestor Municipal ATIVO do município que está realizando o registro complementar no CNC NFS-e. | Obrig. | Rej. | E3353 | O CPF do Agente Tributário deve corresponder ao CPF de um Gestor Municipal ATIVO do município que está realizando o registro complementar no CNC NFS-e. | — |
| 13 | CNC/infCNC/tpAmb | Ambiente informado diverge do ambiente de recebimento para o qual o município enviou o movimento. | Obrig. | Rej. | E3331 | Ambiente informado diverge do ambiente de recebimento para o qual o município enviou o movimento CNC. | - |
| 15 | CNC/infCNC/verAplic | - | - | - | - | - | - |
| 16 | CNC/infCNC/infContrib | É obrigatório informar pelo menos um dado complementar do contribuinte para qualquer registro pelo município no CNC NFS-e. | Obrig. | Rej. | E3348 | Para qualquer registro complementar de um contribuinte o município deve informar IDFed + IM + pelo menos mais uma informação complementar | - |
| 17 | CNC/infCNC/infContrib | Não é permitido realizar movimentações em um registro de contribuinte do CNC NFS-e inativo (cSitCNC = 0). | Obrig. | Rej. | E3351 | Não é permitido realizar movimentações em um registro de contribuinte do CNC NFS-e inativo. | — |
| 18 | CNC/infCNC/infContrib/CNPJ | CNPJ informado é inválido (verificar DV). | Obrig. | Rej. | E3339 | CNPJ do contribuinte informado é inválido. | - |
| 19 | CNC/infCNC/infContrib/CPF | CPF informado é inválido (verificar DV). | Obrig. | Rej. | E3340 | CPF do contribuinte informado é inválido. | - |
| 20 | CNC/infCNC/infContrib/IM | - | - | - | - | - | - |
| 21 | CNC/infCNC/infContrib/dIM | Esta data deve ser posterior ou igual à data de inscrição do contribuinte nos cadastros RFB. | Obrig. | Rej. | 3356 | A data do indicador municipal deve ser posterior ou igual à data de inscrição do contribuinte nos cadastros RFB. | - |
| 22 | CNC/infCNC/infContrib/xFantasia | - | - | - | - | - | - |
| 23 | CNC/infCNC/infContrib/ender | Verificar se o município no endereço dos cadastros RFB (CNPJ/CPF) para o CNPJ ou CPF do contribuinte que se está complementando informações no CNC NFS-e, corresponde ao mesmo município (cMun) que está enviando este registro. <br>Se os municípios forem diferentes, então é obrigatório registrar o grupo de informações complementares de endereço (ender). | Obrig. | Rej. | E3352 | É obrigatório informar o grupo de informações complementares de endereço quando o município do endereço, nos cadastros RFB para o contribuinte informado, for diferente do município que está registrando informações complementares para o contribuinte no CNC NFS-e. | — |
| 24 | CNC/infCNC/infContrib/ender/CEP | O CEP informado deve existir e pertencer ao município correspondente ao código do município (cMun) que está enviando a informação do contribuinte. | Obrig. | Rej. | E3313 | O CEP informado para o endereço do contribuinte não existe ou não pertence ao município. Informe um CEP existente e que pertença ao município que está enviando a informação do contribuinte. | - |
| 25 | CNC/infCNC/infContrib/ender/xLgr | - | - | - | - | - | - |
| 26 | CNC/infCNC/infContrib/ender/nro | - | - | - | - | - | - |
| 27 | CNC/infCNC/infContrib/ender/xCpl | - | - | - | - | - | - |
| 28 | CNC/infCNC/infContrib/ender/xBairro | - | - | - | - | - | - |
| 29 | CNC/infCNC/infContrib/fone | - | - | - | - | - | - |
| 30 | CNC/infCNC/infContrib/email | Email deve ser informado conforme estrutura (conter @, ponto etc.). | Obrig. | Rej. | E3332 | Email informado no documento inválido. | - |
| sem nº na origem | CNC/infCNC/infContrib/dAutEmiss | A data de autorização de uso dos emissores públicos deve ser posterior ou igual à data do indicador municipal. O contribuinte poderá emitir novos documentos fiscais a partir desta data de autorização de uso dos emissores públicos ou a partir da data de início de vigência do convênio municipal, prevalecendo a maior data. | Obrig. | Rej. | E3354 | A data de autorização de uso dos emissores públicos deve ser posterior ou igual à data do indicador municipal. | — |
| sem nº na origem | CNC/infCNC/infContrib/dAutEmiss | A data de autorização de uso dos emissores públicos não pode ser alterada se for menor ou igual que a data atual da alteracão. | Obrig. | Rej. | E3355 | A data de autorização de uso dos emissores públicos não pode ser alterada se for menor ou igual que a data atual da alteracão. | — |
| 31 | CNC/infCNC/infContrib/cStatEmiss | - | - | - | - | - | - |
| 34 | CNC/infCNC/infContrib/cSitCNC | - | - | - | - | - | - |
| 35 | CNC/infCNC/infContrib/xSitCadMun | - | - | - | - | - | - |
| 36 | CNC/infCNC/infContrib/xMotivoSitCadMun | - | - | - | - | - | — |

## 7. Regras críticas por campo

Esta seção reorganiza as regras da tabela anterior em relações semânticas, facilitando consulta por humanos e por modelos de IA.

### `CNC/versao`
- A versão do leiaute é rejeitada quando o prazo de aceitação estiver ultrapassado (`E3329`).

### `CNC/infCNC/Id`
- O código do município embutido no `Id` deve coincidir com `cMun` (`E3341`).
- O tipo de ambiente embutido no `Id` deve coincidir com `tpAmb` (`E3342`).
- A inscrição municipal embutida no `Id` deve coincidir com `IM` (`E3343`).
- O próprio leiaute define a composição do `Id` como: `"CNC" + Cód.Mun.(7) + Tipo de Ambiente(1) + IM(15)`.

### `CNC/infCNC/cMun` e `CNC/infCNC/cnpjMun`
- `cMun` deve existir no cadastro de convênio municipal do Sistema Nacional e estar associado ao CNPJ de transmissão (`E3336`).
- `cnpjMun` deve corresponder ao CNPJ de transmissão (`E3338`).
- O município deve estar em situação `CADASTRADO`, `PARAMETRIZADO` ou `ATIVO` (`E3333`).
- Município suspenso gera `E3334`; município inativo gera `E3335`.

### `CNC/infCNC/CPFAgTrib`
- O CPF deve ser válido quanto ao dígito verificador (`E3330`).
- O CPF deve corresponder a um Gestor Municipal **ATIVO** do município que realiza o registro complementar (`E3353`).

### `CNC/infCNC/tpAmb`
- O ambiente informado deve corresponder ao ambiente de recebimento do movimento CNC (`E3331`).

### `CNC/infCNC/infContrib`
- Todo registro complementar exige `IDFed + IM + pelo menos mais uma informação complementar` (`E3348`).
- Não é permitido movimentar registro de contribuinte inativo (`cSitCNC = 0`) (`E3351`).

### `CNC/infCNC/infContrib/CNPJ` e `CPF`
- CNPJ inválido quanto ao DV: `E3339`.
- CPF inválido quanto ao DV: `E3340`.

### `CNC/infCNC/infContrib/dIM`
- A data deve ser posterior ou igual à data de inscrição do contribuinte nos cadastros RFB.
- **Código da origem:** `3356` (sem prefixo `E` na planilha).

### `CNC/infCNC/infContrib/ender` e `CEP`
- Se o município do endereço do contribuinte nos cadastros RFB for diferente de `cMun`, o grupo `ender` torna-se obrigatório (`E3352`).
- O `CEP` deve existir e pertencer ao município indicado por `cMun` (`E3313`).

### `CNC/infCNC/infContrib/email`
- O e-mail deve respeitar uma estrutura válida, incluindo `@` e ponto (`E3332`).

### `CNC/infCNC/infContrib/dAutEmiss`
- Deve ser posterior ou igual a `dIM`; a emissão pode ocorrer a partir da maior data entre a autorização e o início de vigência do convênio municipal (`E3354`).
- A data de autorização não pode ser alterada se for menor ou igual à data atual da alteração (`E3355`).

## 8. Índice rápido de códigos de erro

| Código | Mensagem da origem |
|---|---|
| E3316 | Certificado de Transmissão Inválido |
| E3317 | Certificado de Transmissão expirado |
| E3321 | Certificado de Transmissão - Erro Cadeira de Certificação |
| E3319 | Certificado de Transmissão - Erro de acesso a LCR |
| E3320 | Certificado de Transmissão revogado |
| E3322 | Certificado de Transmissão difere da ICP - Brasil |
| E3318 | Certificado de Transmissão sem CNPJ |
| E3338 | O CNPJ do município informado não corresponde ao CNPJ de transmissão. |
| E3344 | Falha no esquema XML. |
| E3329 | O prazo de aceitação da versão do leiaute da CNC expirou. |
| E3341 | O código do município do id não está de acordo com a informação do campo cMun do leiaute. |
| E3342 | O tipo de ambiente do id não está de acordo com a informação do campo tpAmb do leiaute. |
| E3343 | A inscrição municipal do id não está de acordo com a informação do campo IM do leiaute. |
| E3336 | O código do município não existe no cadastro de convênio municipal do sistema nacional. |
| E3333 | O CNPJ do município informado não existe no cadastro de convênio municipal do sistema nacional ou não está conveniado. |
| E3334 | O código do município informado existe, mas está suspenso no convênio municipal. |
| E3335 | O código do município informado existe, mas não está ativo há mais de <número de dias> dias no cadastro de convênio municipal. |
| E3330 | CPF do agente tributário informado é inválido. |
| E3353 | O CPF do Agente Tributário deve corresponder ao CPF de um Gestor Municipal ATIVO do município que está realizando o registro complementar no CNC NFS-e. |
| E3331 | Ambiente informado diverge do ambiente de recebimento para o qual o município enviou o movimento CNC. |
| E3348 | Para qualquer registro complementar de um contribuinte o município deve informar IDFed + IM + pelo menos mais uma informação complementar |
| E3351 | Não é permitido realizar movimentações em um registro de contribuinte do CNC NFS-e inativo. |
| E3339 | CNPJ do contribuinte informado é inválido. |
| E3340 | CPF do contribuinte informado é inválido. |
| 3356 | A data do indicador municipal deve ser posterior ou igual à data de inscrição do contribuinte nos cadastros RFB. |
| E3352 | É obrigatório informar o grupo de informações complementares de endereço quando o município do endereço, nos cadastros RFB para o contribuinte informado, for diferente do município que está registrando informações complementares para o contribuinte no CNC NFS-e. |
| E3313 | O CEP informado para o endereço do contribuinte não existe ou não pertence ao município. Informe um CEP existente e que pertença ao município que está enviando a informação do contribuinte. |
| E3332 | Email informado no documento inválido. |
| E3354 | A data de autorização de uso dos emissores públicos deve ser posterior ou igual à data do indicador municipal. |
| E3355 | A data de autorização de uso dos emissores públicos não pode ser alterada se for menor ou igual que a data atual da alteracão. |

## 9. Observações de fidelidade

- O documento acima não corrige códigos, numeração ou mensagens da planilha; ele apenas reorganiza o conteúdo.
- A numeração original contém lacunas (por exemplo, linhas sem `#` e saltos de índice). Isso foi mantido para permitir rastreabilidade com o XLSX.
- A mensagem `Certificado de Transmissão - Erro Cadeira de Certificação` foi mantida com a palavra `Cadeira`, exatamente como aparece na origem.
- A descrição de `CPFAgTrib` também foi preservada conforme a redação original.
- Nenhum XSD foi inferido ou criado a partir da planilha; a hierarquia apresentada é uma reconstrução documental baseada exclusivamente nos caminhos e grupos declarados no arquivo.

---

**Fim da documentação reestruturada.**