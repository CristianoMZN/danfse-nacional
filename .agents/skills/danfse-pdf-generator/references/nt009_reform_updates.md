# Impactos da NT nº 009/2026 (Reforma Tributária — IBS/CBS) nos Campos do DANFSe

Fonte: Projeto Reforma Tributária do Consumo – Adequações NFS-e, Nota Técnica nº 009 – Versão 1.0
(04/06/2026), SE/CGNFS-e.

A NT 008 (DANFSe v2.0) foi publicada em 05/05/2026; a NT 009 foi publicada depois (04/06/2026) e
**altera nomes de campos, caminhos XML e domínios** que o DANFSe usa como fonte de dados. Ao gerar
ou validar um DANFSe, **sempre confirme qual versão de leiaute da DPS/NFS-e está sendo usada** e
aplique o mapeamento correto. Usar um nome de campo antigo é um erro silencioso de mapeamento —
o PDF pode "parecer certo" mas estar puxando o dado errado ou de um caminho que não existe mais.

## 1. CNPJ alfanumérico

- **Todos os campos CNPJ** (Prestador, Tomador, Destinatário, Intermediário, fornecedor em ajustes
  de BC etc.) passaram do tipo numérico (N) para **tipo caractere (C)**, a partir de julho/2026,
  para suportar o novo formato alfanumérico do CNPJ.
- **Implicação para o DANFSe:** não valide/formate CNPJ assumindo apenas dígitos. A máscara visual
  `nn.nnn.nnn/nnnn-nn` pode conter letras nas posições numéricas do novo formato. Não rejeite nem
  trunque um CNPJ com caracteres alfanuméricos.

## 2. Renomeações de campos que aparecem calculados no DANFSe

| Nome antigo (NT 008) | Nome novo (NT 009) | Onde aparece no DANFSe | Mudança na fórmula |
|---|---|---|---|
| `vCalcDR` | `vCalcAjusteBCISSQN` | Bloco Tributação Municipal (ISSQN), campo "Total Deduções/Reduções" | Fórmula passa a considerar deduções percentuais **e** por documento em concomitância |
| `vCalcReeRepRes` | `vCalcAjusteBCIBSCBS` | Cálculo da BC do IBS/CBS (não é campo direto do DANFSe, mas compõe `vBC`) | Passa a contemplar reembolso/repasse/ressarcimento (ex.: glosa de serviços de saúde) |
| `vCalcDedRedIBSCBS` | `vCalcAjusteBCLocImoveis` | Idem acima, específico para operações de locação/cessão/arrendamento de imóveis (subitem 99.03) | Escopo restrito a bens imóveis |
| `vDedRed` (grupo) + `gReeRepRes` (grupo) | `vAjusteBC` (grupo unificado) | Fonte de dados por trás de "Total Deduções/Reduções" | Grupos unificados; novo subgrupo `documentos/docAjusteBC` com `tpAjusteBC` (novo domínio, ver abaixo) |
| `gDedRedIBSCBS` | `gAjusteBCLocImoveis` | Fonte de dados de ajuste de BC do IBS/CBS para locação de imóveis | Campos internos renomeados: `tpDedRedIBSCBS`→`tpAjusteBCLocImoveis`, `xTpDedRedIBSCBS`→`xTpAjusteBCLocImoveis`, `vDedRedIBSCBS`→`vAjusteBCLocImoveis` |
| `gLocBensMoveis` | `bensMoveis` | Grupo de bens móveis locados (novo fato gerador) | Também passou a permitir até 1000 ocorrências (antes tinha outro limite) |

## 3. Fórmulas de base de cálculo alteradas

### BC do ISSQN (`NFSe/infNFSe/valores/vBC`)
```
vBC = vServ - descIncond - (vAjusteBCISSQN + vCalcAjusteBCISSQN) - (vRedBCBM ou vCalcBM)
```
(Antes da NT 009, a fórmula usava apenas `vCalcDR` sem a soma de `vAjusteBCISSQN`.)

### BC do IBS/CBS (`NFSe/infNFSe/IBSCBS/valores/vBC`)
```
Até 2026:
vBC = vServ - descIncond - vCalcAjusteBCIBSCBS ou vCalcAjusteBCLocImoveis - vISSQN - vPIS - vCOFINS

De 2027 até 2032:
vBC = vServ - descIncond - vCalcAjusteBCIBSCBS ou vCalcAjusteBCLocImoveis - vISSQN
```
**Implicação:** ao exibir/recalcular valores no DANFSe (ou ao validar que o valor impresso bate com
o XML), use a fórmula correspondente à competência da NFS-e (antes/depois de 2027), pois campos
como PIS/COFINS deixam de compor a BC do IBS/CBS a partir de 2027 (mesma lógica da Nota 6 —
"linha impressa apenas até o final do ano-calendário de 2026").

## 4. Notas de Ajuste de IBS/CBS (novo — pode aparecer em NFS-e de ajuste)

- Campo `finNFSe` (Finalidade, exibido no DANFSe) ganhou novo domínio:
  - `0` = NFS-e regular
  - `1` = NFS-e de crédito
  - `2` = NFS-e de débito
- Novos campos condicionais (não exibidos diretamente como campo próprio do DANFSe, mas relevantes
  para a descrição textual da Finalidade e para a lógica de Informações Complementares):
  `tpNFSeDebito` (quando finNFSe=2) e `tpNFSeCredito` (quando finNFSe=1).
- Novo grupo `gIBSCBSAjuste` (`vIBS`, `vCBS`) para valores de ajuste de IBS/CBS.
- **Implicação para o DANFSe:** ao montar o texto do campo "Finalidade", use a descrição da opção
  do novo domínio (ex.: "NFS-e de crédito", "NFS-e de débito"), não apenas "NFS-e regular" como
  único valor possível.

## 5. Simples Nacional

- `opSimpNac` ganhou a opção **`4 - Optante Pendente`** (antes só 1-3). Ajuste a descrição textual
  usada no campo "Simples Nacional na Data de Competência".
- Novo campo `regApIBSCBSSN` (Regime de Apuração Tributária pelo Simples Nacional para IBS e CBS):
  `1` = IBS e CBS apurados pelo SN; `2` = CBS apurada pelo SN e IBS pelo regime regular; `3` = IBS e
  CBS apurados pelo regime regular. Este campo é novo e pode precisar de exibição complementar em
  Informações Complementares dependendo de orientação municipal futura — **não invente uma posição
  fixa para ele**; ele não está na tabela de posições da NT 008 porque é posterior. Trate como
  informação de apoio ao cálculo, não necessariamente como campo visível novo, a menos que
  orientação normativa posterior confirme.
- Novo campo `cAtvSN` (código de atividade do Simples Nacional, LC 123/2006) — mesmo tratamento:
  suporte ao cálculo, sem posição própria definida na NT 008.
- Novo campo `vReceitaBrutaSN` (valor da receita bruta para optantes do SN):
  ```
  vReceitaBrutaSN = vServ - descIncond - vCalcAjusteBCIBSCBS - vCalcAjusteBCISSQN
                    (o termo vCalcAjusteBCISSQN só entra quando o ajuste vier de
                     docAjusteBC/tpAjusteBC = "9 - Profissional parceiro")
  ```
- Novo grupo `gTribSN` (`pIBSSN`, `vIBSSN`, `pCBSSN`, `vCBSSN`) com a composição de IBS/CBS quando
  apurados pelo Simples Nacional.
- **Importante:** em razão do Simples Nacional, os campos `vIBSTot`, `gIBSUFTot`, `gIBSMunTot`,
  `pCredPresCBS`, `vCredPresCBS` e `vCBS` **passaram de obrigatórios para opcionais** na NFS-e.
  Isso significa que o DANFSe deve tratar a ausência desses valores como válida (imprimir "-"
  conforme Nota 12 da tabela de campos), e não como erro de geração.

## 6. Reinserção do campo `indFinal`

- Campo `NFSe/infNFSe/DPS/infDPS/IBSCBS/indFinal` (0=Não, 1=Sim) indica operação de uso ou consumo
  pessoal (art. 57 da LC 214/2025). Não há posição própria definida ainda na tabela da NT 008 (que
  é anterior); trate como dado de apoio até nova orientação de leiaute visual.

## 7. Novo domínio de tipos de ajuste de BC (`tpAjusteBC`, dentro de `documentos/docAjusteBC`)

Usado para compor "Total Deduções/Reduções" (ISSQN) e os cálculos de ajuste de BC do IBS/CBS.
Valores válidos (NT 009): `1` Alimentação/bebidas-frigobar, `2` Materiais, `5` Repasse
consorciado, `6` Repasse plano de saúde, `7` Serviços, `8` Subempreitada de mão de obra, `9`
Profissional parceiro, `99` Outras deduções exclusivas do ISSQN, `101`–`105` e `199` (repasses/
reembolsos com efeito também no IBS/CBS — intermediação imobiliária, agência de turismo,
propaganda/publicidade, glosa de serviços de saúde, outros por conta e ordem de terceiro).

- Os tipos antigos `3 - Produção Externa` e `4 - Reembolso de despesas` foram **descontinuados**
  (substituídos por `103` e `103/104/199`, respectivamente). Se o software ainda gerar/aceitar
  esses códigos antigos, é um bug de conformidade a corrigir.

## 8. Bens imóveis e bens móveis (novos fatos geradores — locação/cessão/arrendamento)

- Novo grupo `gLocacao` (dentro de `imovel`) com `pCopropriedade`, `vTotOper`, `vDescIncondTot`,
  `vDescCondTot`, `dVencOrig`.
- Novo grupo `gUnidImob` (até 99 unidades imobiliárias por NFS-e) com `inscImobFisc`, `cCIB`,
  endereço do imóvel, e o subgrupo `gAjusteBCLocImoveis` (até 1000 ocorrências).
- Grupo `bensMoveis` (antigo `gLocBensMoveis`), até 1000 ocorrências.
- Regras de validação de `vServ`, `vDescIncond`, `vDescCond` mudaram: para o subitem 99.03,
  `vServ = pCopropriedade × vTotOper` (idem para os descontos). **Se o serviço for do subitem
  99.03 (locação de imóveis), confirme que o valor exibido no campo "Valor da Operação/Serviço" do
  DANFSe já reflete essa fórmula de rateio por copropriedade — não exiba `vTotOper` bruto.**

## 9. Novo grupo `gPgtoVinc` (vinculação de pagamento)

- Vincula a NFS-e a até 99 transações de pagamento (`nPag`, `idTransacao`, `tpMeioPgto`,
  `CNPJReceb`, `CNPJBasePSP`). Não possui posição definida na tabela visual da NT 008 (é
  informação de retaguarda/backend); não crie um campo visual "inventado" para isso no DANFSe sem
  confirmação normativa.

## Regra prática para quem implementa

1. **Sempre verifique a versão do leiaute da DPS/NFS-e** que originou o XML (buscar tag/atributo
   de versão do leiaute, ou a data de autorização, para saber se está pós-reforma).
2. **Para os campos do DANFSe que dependem de fórmulas de base de cálculo** (ISSQN e IBS/CBS),
   aplique a fórmula correta conforme a competência (antes/depois de 2027) e conforme o nome de
   campo vigente (novo, não o antigo).
3. **Nunca deixe um campo obrigatório do DANFSe em branco** só porque o campo de origem no XML
   ficou opcional pela NT 009 (Simples Nacional) — use o traço "-" (Nota 12).
4. Ao gerar código/testes, use os nomes de campo **da NT 009** como padrão-ouro para os grupos que
   ela alterou; use a NT 008 apenas para os campos que ela não tocou.
