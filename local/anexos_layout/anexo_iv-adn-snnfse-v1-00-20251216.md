# Anexo IV — ADN — Sistema Nacional NFS-e

> Conversão estruturada da planilha `anexo_iv-adn-snnfse-v1-00-20251216(1).xlsx` para Markdown.
>
> O objetivo desta versão é tornar o conteúdo compreensível por modelos de IA sem suporte nativo a XLS/XLSX e, ao mesmo tempo, manter uma leitura humana clara. A conversão explicita relações que no Excel eram representadas por células mescladas, cabeçalhos em múltiplos níveis, cores e continuidade visual entre linhas.

## Metadados da origem

- **Arquivo de origem:** `anexo_iv-adn-snnfse-v1-00-20251216(1).xlsx`
- **Versão inferida do nome do arquivo:** `v1-00`
- **Data inferida do nome do arquivo:** `2025-12-16`
- **Abas encontradas:**
  1. `RN_RECEPCAO_LOTE_DF-e`
  2. `ADN-GERACAO_NSU_DFe`
  3. `ADN-RN_DISTRIB_MUN_CONTRIB`
- **Dependências por fórmulas:** não há regras de negócio calculadas por fórmulas. As fórmulas existentes são auxiliares de numeração de linhas. As relações semânticas relevantes estão principalmente na disposição/mesclagem das células e foram explicitadas neste documento.

## Convenções preservadas e interpretadas

- `Obrig.` = validação obrigatória.
- `Rej.` = rejeição quando a validação falha.
- Códigos como `E1200`, `E2001`, `E2305` etc. são mantidos exatamente como na planilha.
- Placeholders/parâmetros, inclusive `<<prazo para a inativação>>`, são preservados literalmente.
- A origem contém o texto `<<limite>` com fechamento aparentemente incompleto; esta grafia também foi mantida literalmente na regra correspondente.
- Nas tabelas de regras, linhas que no Excel funcionavam como divisores/agrupadores visuais foram transformadas em **hierarquia de seções**.
- Na matriz de geração de NSU:
  - `V` = cenário marcado com `V`; pela estrutura da aba, indica cenário contemplado para geração/distribuição de NSU.
  - `X` = cenário marcado com `X`; pela estrutura da aba, indica cenário não contemplado para geração/distribuição de NSU.
  - `Contemplado` = representação introduzida neste Markdown para células em que a planilha não usa `V`/`X`, mas uma explicação mesclada informa que o NSU já está coberto por outra relação.
- A interpretação operacional de `V`/`X` é inferida do título **GERAÇÃO DE NSU**, dos cabeçalhos, das cores e das notas da própria planilha.
- Mensagens de erro e grafias do conteúdo técnico foram mantidas conforme a origem, inclusive quando há aparentes erros tipográficos.

## Aba `RN_RECEPCAO_LOTE_DF-e`

Esta aba contém regras de validação da recepção de lotes de DF-e. As faixas coloridas/células de seção do Excel foram convertidas em títulos, de forma que cada regra abaixo fique explicitamente ligada ao seu grupo.

### Seção 1 — Validação do Certificado de Transmissão

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Notas explicativas |
|---:|---|---|---|---|---|---|
| 2 | Certificado de Transmissor Inválido:<br>- Certificado de Transmissor inexistente na mensagem<br>- Versão difere "3"<br>- Se informado o Basic Constraint deve ser true (não pode ser Certificado de AC)<br>- KeyUsage não define "Autenticação Cliente" | Obrig. | Rej. | E1200 | Certificado de Transmissão Inválido | - |
| 3 | Validade do Certificado (data início e data fim) | Obrig. | Rej. | E1203 | Certificado de Transmissão expirado | - |
| 4 | Verifica a Cadeia de Certificação:<br>- Certificado da AC emissora não cadastrado na RFB<br>- Certificado de AC revogado<br>- Certificado não assinado pela AC emissora do Certificado | Obrig. | Rej. | E1205 | Certificado de Transmissão - Erro Cadeira de Certificação | - |
| 5 | LCR do Certificado de Transmissor<br>- Falta o endereço da LCR (CRL DistributionPoint)<br>- LCR indisponível<br>- LCR inválida | Obrig. | Rej. | E1206 | Certificado de Transmissão - Erro de acesso a LCR | - |
| 6 | Certificado do Transmissor revogado | Obrig. | Rej. | E1207 | Certificado de Transmissão revogado | - |
| 7 | Certificado Raiz difere da "ICP-Brasil" | Obrig. | Rej. | E1208 | Certificado de Transmissão difere da ICP - Brasil | - |
| 8 | Falta a extensão de CNPJ no Certificado (OtherName - OID=2.16.76.1.3.3) | Obrig. | Rej. | E1209 | Certificado de Transmissão sem CNPJ | - |
| 9 | CNPJ do certificado de transmissão do lote de DF-e não está autorizado a realizar a transmissão de DF-e pelo municipio conveniado. | Obrig. | Rej. | E1262 | CNPJ não autorizado a compartilhar DF-e pelo município conveniado ao Sistema Nacional NFS-e. | - |
| 10 | Certificado da assinatura do lote sem CNPJ. | Obrig. | Rej. | E1245 | Certificado da assinatura do lote sem CNPJ. | - |
| 11 | Certificado da assinatura do lote - Erro na cadeia de certificação. | Obrig. | Rej. | E1246 | Certificado da assinatura do lote - Erro na cadeia de certificação. | - |

### Seção 12 — Validação Inicial da Mensagem na API

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Notas explicativas |
|---:|---|---|---|---|---|---|
| 13 | Verifica se o servidor de processamento está paralisado para manutenção | Obrig. | Rej. | E1217 | Serviço paralisado para manutenção | - |
| 14 | Número de documentos do lote maior do que o <<limite>. | Obrig. | Rej. | E1219 | Número de documentos maior do que o limite definido para a aplicação. | - |

### Seção 15 — Validação da Área de Dados

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Notas explicativas |
|---:|---|---|---|---|---|---|
| 16 | Falha na descompactado da base 64. | Obrig. | Rej. | E1225 | Falha na decodificação da base 64 da área de dados | - |
| 17 | Estrutura descompactada mal formada. | Obrig. | Rej. | E1226 | Estrutura descompactada mal formada. | - |

### Seção 18 — Validação dos Tipos de Documentos

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Notas explicativas |
|---:|---|---|---|---|---|---|
| 19 | Validar os tipos de DF-e tratados pelo Sistema Nacional NFS-e. | Obrig. | Rej. | E1242 | Tipo DF-e não tratado pelo Sistema Nacional NFS-e. | - |
| 20 | Uso de prefixo de namespace não permitido na área de dados descompactada. | Obrig. | Rej. | E1228 | Uso de prefixo de namespace não permitido na área de dados descompactada. | - |
| 21 | XML não está utilizando codificação UTF8. | Obrig. | Rej. | E1229 | XML não está utilizando codificação UTF8. | - |
| 22 | Falha no esquema XML do DF-e. | Obrig. | Rej. | E1235 | Falha no esquema XML do DF-e. | - |
| 23 | Assinatura difere do calculado | Obrig. | Rej. | E1250 | Assinatura difere do calculado | - |


## Aba `ADN-GERACAO_NSU_DFe`

### Finalidade

Esta aba define, para cada tipo de DF-e/evento, em quais contextos deve existir geração/distribuição de NSU. No Excel, o significado de cada coluna dependia de uma árvore de cabeçalhos mesclados. Abaixo essa árvore foi convertida em identificadores explícitos (`C01` a `C16`).

### Dicionário dos cenários de geração/distribuição

| ID | Caminho hierárquico original explicitado |
|---|---|
| `C01` | Administração Tributária > RFB > Geral |
| `C02` | Administração Tributária > Município Emissor (`cLocEmi`) > Recepção > DF-e emitido na Sefin Nacional |
| `C03` | Administração Tributária > Município Emissor (`cLocEmi`) > Recepção > DF-e emitido no Sistema Próprio do Município e compartilhado com ADN |
| `C04` | Administração Tributária > Município Emissor (`cLocEmi`) > Distribuição > Município existente e ativo > DF-e emitido na Sefin Nacional |
| `C05` | Administração Tributária > Município Emissor (`cLocEmi`) > Distribuição > Município existente e ativo > DF-e emitido no Sistema Próprio do Município e compartilhado com ADN |
| `C06` | Administração Tributária > Município Emissor (`cLocEmi`) > Distribuição > Município existente e não ativo |
| `C07` | Administração Tributária > Município Emissor (`cLocEmi`) > Distribuição > Município inexistente |
| `C08` | Administração Tributária > Município do Emitente (P/T/I) > Distribuição |
| `C09` | Administração Tributária > Município do Não Emitente (P/T/I) > Distribuição (1) |
| `C10` | Administração Tributária > Município da Prestação > Distribuição (2) |
| `C11` | Administração Tributária > Município de Incidência > Distribuição |
| `C12` | CGNFS-e > Para os Municípios do Prestador, Tomador, Intermediário, Emissor da NFS-e e Local da Prestação > MEI (`CSTAT = 107`) > Município inexistente ou existente INATIVO no SN NFS-e |
| `C13` | CGNFS-e > Para os Municípios do Prestador, Tomador, Intermediário, Emissor da NFS-e e Local da Prestação > MEI (`CSTAT = 107`) > Município existente diferente de INATIVO no SN NFS-e |
| `C14` | CGNFS-e > CGNFS-e > BYPASS (`CSTAT = 102`) |
| `C15` | Atores da NFS-e > Emitente (P/T/I) > Distribuição |
| `C16` | Atores da NFS-e > Não Emitente (P/T/I) > Distribuição |

### Relações que estavam representadas por células mescladas

**C08 — Município do Emitente (P/T/I):** a planilha não repete `V` em cada linha. Em vez disso, usa uma explicação mesclada informando que o NSU de distribuição do DF-e para o Município do Emitente já está contemplado porque o Município do Emitente (P/T/I) é o Município Emissor, dependendo do tipo de emitente da NFS-e.

**C11 — Município de Incidência:** a planilha também usa uma explicação mesclada. O NSU de distribuição para o Município de Incidência do ISSQN já está contemplado porque o Município de Incidência é um dos seguintes:
1. Município do Prestador;
2. Município do Tomador; ou
3. Município da Prestação do Serviço.

### Matriz normalizada

Para tornar a relação legível por IA, os valores das células mescladas de `C08` e `C11` são representados como `Contemplado` em todas as linhas às quais a explicação se aplica.

| # | DF-e / evento | `C01` | `C02` | `C03` | `C04` | `C05` | `C06` | `C07` | `C08` | `C09` | `C10` | `C11` | `C12` | `C13` | `C14` | `C15` | `C16` |
|---:|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| 1 | NFS-e | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 2 | Cancelamento de NFS-e | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 3 | Cancelamento de NFS-e por Substituição | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 4 | Solicitação de Análise Fiscal para Cancelamento de NFS-e | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 5 | Cancelamento de NFS-e Deferido por Análise Fiscal | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 6 | Cancelamento de NFS-e Indeferido por Análise Fiscal | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 7 | Manifestação de NFS-e — Confirmação do Prestador | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 8 | Manifestação de NFS-e — Confirmação do Tomador | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 9 | Manifestação de NFS-e — Confirmação do Intermediário | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 10 | Manifestação de NFS-e — Confirmação Tácita | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 11 | Manifestação de NFS-e — Rejeição do Prestador | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 12 | Manifestação de NFS-e — Rejeição do Tomador | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 13 | Manifestação de NFS-e — Rejeição do Intermediário | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 14 | Manifestação de NFS-e — Anulação da Rejeição | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 15 | Cancelamento de NFS-e por Ofício | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | V |
| 16 | Bloqueio de NFS-e<br>por Ofício — Cancelamento de NFS-e | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 17 | Bloqueio de NFS-e<br>por Ofício — Cancelamento de NFS-e<br>por Substituição | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 18 | Bloqueio de NFS-e<br>por Ofício — Cancelamento de NFS-e<br>Deferido por Análise Fiscal | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 19 | Bloqueio de NFS-e<br>por Ofício — Cancelamento de NFS-e<br>Indeferido por Análise Fiscal | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 20 | Bloqueio de NFS-e<br>por Ofício — Cancelamento de NFS-e por Ofício | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 21 | Desbloqueio de NFS-e por Ofício — Cancelamento de NFS-e | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 22 | Desbloqueio de NFS-e por Ofício — Cancelamento de NFS-e<br>por Substituição | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 23 | Desbloqueio de NFS-e por Ofício — Cancelamento de NFS-e<br>Deferido por Análise Fiscal | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 24 | Desbloqueio de NFS-e por Ofício — Cancelamento de NFS-e<br>Indeferido por Análise Fiscal | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |
| 25 | Desbloqueio de NFS-e por Ofício — Cancelamento de NFS-e por Ofício | V | X | V | X | V | X | X | Contemplado | V | V | Contemplado | V | X | V | V | X |

### Padrões observados na matriz

- Os eventos **1 a 15** compartilham exatamente o mesmo padrão de `V`/`X` e relações `Contemplado`.
- Os eventos **16 a 25** mantêm esse mesmo padrão, com uma diferença: `C16` (**Ator Não Emitente (P/T/I) > Distribuição**) passa de `V` para `X`.
- Em todos os 25 eventos, `C08` e `C11` são relações já contempladas por outras regras de município, e não decisões independentes de `V`/`X`.

### Notas da matriz

As notas abaixo foram preservadas da planilha e se relacionam aos cenários indicados pelos números entre parênteses nos cabeçalhos:

- **(1)** Gerar NSU de Distribuição somente se o Município do Não Emitente for diferente do Município do Emitente.
- **(2)** Gerar NSU de Distribuição somente se o Município da Prestação for diferente do Município do Emitente E do Município do Não Emitente.
- **(3)** Os NSU são gerados para qualquer Município, ativos ou não ativos no Sistema Nacional NFS-e. Todos os DF-e podem ser solicitados na API de distribuição, exceto quando o município for inexistente ou existente inativo ou suspenso.
- **(4)** Gerar NSU de Distribuição somente se o Município do Destinatário for diferente do Município do Tomador .
- **(5)** Gerar NSU de Distribuição somente se o Destinatário for diferente do Tomador .
- **Marcador `*`:** EXISTENTE no cadastro de municípios conveniados ao Sistema Nacional NFS-e
- **Marcador `**`:** INEXISTENTE no cadastro de municípios conveniados ao Sistema Nacional NFS-e

#### Observação sobre as referências `(4)` e `(5)`

As notas `(4)` e `(5)` existem na planilha, mas não há, na matriz visível desta versão, um cabeçalho/cenário marcado com `(4)` ou `(5)`. Elas foram mantidas para não perder informação técnica.


## Aba `ADN-RN_DISTRIB_MUN_CONTRIB`

Esta aba define regras para distribuição/consulta de DF-e por NSU e por chave de acesso. A continuidade visual da planilha foi convertida em três contextos explícitos: **NSU Geral**, **NSU do Município** e **NSU dos Atores da NFS-e**.

### Contexto A — Distribuição para NSU Geral

#### Seção 1 — Validação da Distribuição para NSU Geral

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 2 | CNPJ do transmissor deve estar cadastrado para um Órgão no convênio do sistema nacional. | Obrig. | Rej. | E2301 | CNPJ não cadastrado. | - |

#### Seção 3 — Distriuição a partir de um NSU

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 4 | Verificar se existem DF-e a partir do NSU informado pelo o Órgão solicitante. | Obrig. | Rej. | E2305 | Nenhum documento localizado – não existem documentos fiscais a partir do NSU informado. | - |

#### Seção 5 — Consulta por NSU

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 6 | Verificar se existe DF-e para o NSU informado pelo Órgão solicitante. | Obrig. | Rej. | E2306 | Nenhum documento localizado – não existe documento fiscal para o NSU informado. | - |

### Contexto B — Distribuição para NSU do Município

#### Seção 7 — Validação da Distribuição para NSU do Municipio

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 8 | Validações do Certificado da Transmissão. | Obrig. | Rej. | E2000 | Erro no Certificado de transmissão. | - |
| 9 | CNPJ do transmissor deve estar cadastrado para um Município no convênio municipal do sistema nacional. | Obrig. | Rej. | E2001 | CNPJ não cadastrado para nenhum Município conveniado. | - |
| 10 | O código do Município informado deve existir e estar com a situação CADASTRADO no cadastro de convênio municipal. | Obrig. | Rej. | E2003 | O código do município informado existe, mas está suspenso no convênio municipal. | - |
| 11 | O código do Município informado deve existir e estar inativo a menos de <<prazo para a inativação>> dias no cadastro de convênio municipal. | Obrig. | Rej. | E2004 | O código do município informado existe, mas não está ativo há mais de <<prazo para a inativação>> dias no cadastro de convênio municipal. | - |

#### Seção 12 — Distriuição a partir de um NSU

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 13 | Verificar se existem DF-e a partir do NSU informado pelo o município solicitante. | Obrig. | Rej. | E2020 | Nenhum documento localizado – não existem documentos fiscais para o Município a partir do NSU informado. | - |

#### Seção 14 — Consulta por NSU

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 15 | Verificar se existe DF-e para o NSU informado pelo municipio solicitante. | Obrig. | Rej. | E2040 | Nenhum documento localizado – não existe documento fiscal para o Município com o NSU informado. | - |

#### Seção 16 — Consulta por Chave de Acesso

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 17 | Chave de acesso não localizada. | Obrig. | Rej. | E2060 | Nenhum documento localizado – não existe documentos fiscal para a chave de acesso informada. | - |
| 18 | Chave de acesso não referencia o Município solicitante. | Obrig. | Rej. | E2061 | Chave de acesso da NFS-e não referencia o Município solicitante e por isso não pode ser compartilhado. | - |

#### Seção 19 — Recuperação de Backup - Município Emissor

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 20 | NSU (NSU de recepção) não localizado para o Município solicitante. | Obrig. | Rej. | E2070 | Nenhum documento localizado – não existem documentos fiscais recebidos para o Município a partir do NSU de recepção informado. | - |

### Contexto C — Distribuição para NSU dos Atores da NFS-e

> Na planilha, o cabeçalho **Validação da Distribuição para NSU dos Atores da NFS-e** aparece sem número na coluna `#`; ele funciona como agrupador das seções 22, 24 e 26.

#### Seção 22 — Distriuição a partir de um NSU

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 23 | Verificar se existem DF-e a partir do NSU informado pelo o contribuinte solicitante. | Obrig. | Rej. | E2215 | Nenhum documento localizado – não existem documentos fiscais para o Contribuinte a partir do NSU informado. | - |

#### Seção 24 — Consulta por NSU

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 25 | Verificar se existe DF-e para o NSU informado pelo contribuinte solicitante. | Obrig. | Rej. | E2230 | Nenhum documento localizado – não existe documento fiscal para o Contribuinte com o NSU informado. | - |

#### Seção 26 — Consulta por Chave de Acesso

| # | Regra de negócio | Aplic. | Efeito | Cód. erro | Msg. erro | Observações de negócio |
|---:|---|---|---|---|---|---|
| 27 | Chave de acesso não localizada. | Obrig. | Rej. | E2240 | Nenhum documento localizado – não existe documentos fiscal para a chave de acesso informada. | - |
| 28 | Chave de acesso não referencia o Contribuinte solicitante. | Obrig. | Rej. | E2241 | Chave de acesso da NFS-e não referencia o Contribuinte solicitante e por isso não pode ser compartilhado. | - |


## Modelo semântico resumido para uso por IA

Ao interpretar este documento:

1. Trate cada **contexto/seção** das abas de regras como um agrupador; as regras pertencem ao agrupador explicitado imediatamente acima.
2. Uma regra com `Aplic. = Obrig.` e `Efeito = Rej.` representa uma validação obrigatória cujo descumprimento resulta em rejeição com o código/mensagem informados.
3. Na aba de geração de NSU, cada linha representa um **tipo de DF-e/evento** e cada `Cxx` representa um **contexto de destinatário, administração tributária, município, status ou ator**.
4. `C08` e `C11` não são decisões independentes na planilha: são relações declaradas como **já contempladas** por outros municípios/atores.
5. As notas `(1)`, `(2)` e `(3)` restringem ou explicam a geração/disponibilidade dos NSUs relacionados aos respectivos cabeçalhos.
6. As notas `(4)` e `(5)` devem ser preservadas como regras auxiliares, embora a matriz atual não exiba um cabeçalho que as referencie.
7. Não substitua `<<limite>` nem `<<prazo para a inativação>>` por valores arbitrários; a parametrização correspondente não é fornecida nesta planilha.
8. Preserve códigos de erro e mensagens literais ao implementar validações, logs, testes ou documentação derivada.

## Integridade da conversão

- Todas as 3 abas com conteúdo foram consideradas.
- A hierarquia visual dos cabeçalhos foi convertida para caminhos textuais explícitos.
- Células mescladas com efeito semântico foram transformadas em relações textuais explícitas.
- Grupos de eventos que dependiam de células mescladas foram expandidos para que cada linha tenha um nome completo de evento.
- Os códigos de erro, mensagens, indicadores `V`/`X`, notas e placeholders foram preservados.
