# Campos da Reforma Tributária (IBS/CBS/IS) — Leiaute DPS/NFS-e RT (Anexo VI, NT 009/2026)

Fonte: `anexovi-leiautesrn_rtc_ibscbs-v1-04-00-2013-nt009.xlsx` (NT 009/2026), aba **LEIAUTE DPS_NFS-e - RT**, que é o leiaute DPS/NFS-e **consolidado com os grupos da Reforma Tributária do Consumo** (IBS, CBS e Imposto Seletivo), conforme LC 214/2025 e EC 132/2023.

Este documento traz **o leiaute completo** (430 campos) já com os grupos novos embutidos na posição correta da árvore XML. Abaixo, uma lista dos **98 campos que NÃO existem no leiaute base v1.01** (i.e., são específicos da Reforma Tributária / grupos IBSCBS, gLocBensMoveis, gIBSCBSAjuste, comExt, indOp, etc.), seguida do detalhamento campo a campo do leiaute inteiro.

**Atenção:** todos os campos `CNPJ` passaram do tipo `N` (Numérico) para `C` (Caractere) nesta versão, para suportar o CNPJ alfanumérico previsto a partir de julho/2026.

## Campos exclusivos da Reforma Tributária (não existem no leiaute base v1.01)

| Caminho | Campo | Ele | Tipo | Ocor. | Descrição resumida |
|---|---|---|---|---|---|
| `NFSe/infNFSe/valores/` | `vCalcAjusteBCISSQN` | E | N | 0-1 | Valor monetário (R$) do ajuste (dedução/redução) da base de cálculo (BC) do ISSQN. |
| `NFSe/infNFSe/IBSCBS/valores/` | `vCalcAjusteBCIBSCBS` | E | N | 0-1 | Valor monetário (R$) total relativo a glosa de serviços de saúde ou a operações de terceiros, objeto de reembolso, repasse ou ressarcimento  |
| `NFSe/infNFSe/IBSCBS/valores/` | `vCalcAjusteBCLocImoveis` | E | N | 0-1 | Valor monetário (R$) total relativo aos valores de ajuste (dedução/redução) da Base de Cálculo do IBS e da CBS referentes às operações de lo |
| `NFSe/infNFSe/IBSCBS/valores/` | `vReceitaBrutaSN` | E | N | 0-1 | Valor da Receita Bruta para os Optantes do Simples Nacional. |
| `NFSe/infNFSe/IBSCBS/totCIBS/` | `gTribSN` | G | - | 0-1 | Grupo de informações da composição do valor do IBS e da CBS para o Simples Nacional |
| `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `pIBSSN` | E | N | 0-1 | Alíquota do IBS Total calculada apenas para os Optantes do Simples Nacional. |
| `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `vIBSSN` | E | N | 0-1 | Valor do IBS para os Optantes do Simples Nacional |
| `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `pCBSSN` | E | N | 1-1 | Alíquota da CBS apenas para os Optantes do Simples Nacional. |
| `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `vCBSSN` | E | N | 1-1 | Valor da CBS para os Optantes do Simples Nacional |
| `NFSe/infNFSe/DPS/infDPS/` | `finNFSe` | E | N | 1-1 | Indicador da finalidade da emissão de NFS-e  |
| `NFSe/infNFSe/DPS/infDPS/` | `tpNFSeDebito` | E | N | 0-1 | Indicador do tipo de NFS-e de Ajuste de Débito (indicado apenas quando finNFSe = 2) |
| `NFSe/infNFSe/DPS/infDPS/` | `tpNFSeCredito` | E | N | 0-1 | Indicador do tipo de NFS-e de Ajuste de Crédito (indicado apenas quando finNFSe = 1) |
| `NFSe/infNFSe/DPS/infDPS/prest/regTrib/` | `regApIBSCBSSN` | E | N | 0-1 | Regime de Apuração Tributária pelo Simples Nacional para IBS e CBS. |
| `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `cAtvSN` | E | N | 0-1 | Código da atividade do Simples Nacional, conforme a Lei Complementar nº 123/2006: |
| `NFSe/infNFSe/DPS/infDPS/valores/` | `vAjusteBC` | G | - | 0-1 | Grupo de informações relativas ao valores para ajuste dos valores de base de cálculo. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/` | `pAjusteBCISSQN` | E | N | 0-1 | Valor percentual padrão para ajuste dos valores de base de cálculo do ISSQN. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/` | `vAjusteBCISSQN` | E | N | 0-1 | Valor monetário padrão para ajuste dos valores de base de cálculo do ISSQN |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/` | `documentos` | G | - | 0-1 | Grupo de informações de documento utilizado para ajuste dos valores de base de cálculo (ISSQN e/ou IBS/CBS). |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos` | `docAjusteBC` | G | - | 1-1000 | Grupo de informações de documento utilizado para ajuste dos valores de base de cálculo (ISSQN e/ou IBS/CBS). |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `tpAjusteBC` | E | N | 1-1 | Tipo de Ajuste: |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `xTpAjusteBC` | E | C | 0-1 | Descrição do ajuste quando o tipo informado (tpAjusteBC) é "99 – Outras deduções exclusivas do ISSQN" |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `vTotDoc` | E | N | 1-1 | Valor monetário total do documento informado (R$). |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `vAjuteAplic` | E | N | 1-1 | Valor monetário efetivamente utilizado para ajuste de base(s) de cálculo do valor do serviço da NFS-e que está sendo emitida (R$). |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `dtEmiDoc` | E | D | 0-1 | Data da emissão do documento dedutível. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `dtCompDoc` | E | D | 0-1 | Data da competência do documento dedutível. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `dFeNacional` | CG | CG | 1-1 | Grupo de informações de documentos fiscais eletrônicos que se encontram no repositório nacional. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/` | `tipoChaveDFe` | E | N | 1-1 | Documento fiscal a que se refere a chaveDfe que seja um dos documentos do Repositório Nacional: |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/` | `xTipoChaveDFe` | E | C | 0-1 | Descrição da DF-e a que se refere a chaveDfe que seja um dos documentos do Repositório Nacional. Deve ser preenchido apenas quando tipoChave |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/` | `chaveDFe` | E | C | 1-1 | Chave do Documento Fiscal eletrônico do repositório nacional referenciado para os casos de operações já tributadas. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `docFiscalOutro` | CG | CG | 1-1 | Grupo de informações de documento fiscais, eletrônicos ou não, que não se encontram no repositório nacional. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/` | `cMunDocFiscal` | E | N | 1-1 | Código do município emissor do documento fiscal que não se encontra no repositório nacional |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/` | `nDocFiscal` | E | C | 1-1 | Número do documento fiscal que não se encontra no repositório nacional |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/` | `xDocFiscal` | E | C | 1-1 | Descrição do documento fiscal |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `docOutro` | CG | CG | 1-1 | Grupo de informações de documento não fiscal. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/` | `nDoc` | E | C | 1-1 | Número do documento não fiscal. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/` | `xDoc` | E | C | 1-1 | Descrição do documento não fiscal. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `fornec` | G | - | 0-1 | Grupo de informações do fornecedor do serviço prestado |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `CNPJ` | CE | C | 1-1 | Número da inscrição federal (CNPJ) do fornecedor de serviço. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `CPF` | CE | N | 1-1 | Número da inscrição federal (CPF) do fornecedor do serviço. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `NIF` | CE | C | 1-1 | Este elemento só deverá ser preenchido para fornecedores não residentes no Brasil. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `cNaoNIF` | CE | N | 1-1 | Motivo para não informação do NIF: |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xNome` | E | C | 1-1 | Nome / Razão Social do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `end` | G | - | 0-1 | Grupo de informações do endereço do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/` | `endNac` | CG | - | 1-1 | Grupo de informações do endereço nacional. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/` | `cMun` | E | N | 1-1 | Código do município do endereço do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/` | `CEP` | E | C | 1-1 | Código numérico do Endereçamento Postal nacional (CEP) |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/` | `endExt` | CG | - | 1-1 | Grupo de informações do endereço no exterior. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `cPais` | E | C | 1-1 | Código do país do endereço do prestador do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `cEndPost` | E | C | 1-1 | Código alfanumérico do Endereçamento Postal no exterior do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `xCidade` | E | C | 1-1 | Nome da cidade no exterior do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `xEstProvReg` | E | C | 1-1 | Estado, província ou região da cidade no exterior do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xLgr` | E | C | 1-1 | Tipo e nome do logradouro do endereço do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `nro` | E | C | 1-1 | Número no logradouro do endereço do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xCpl` | E | C | 0-1 | Complemento do endereço do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xBairro` | E | C | 1-1 | Bairro do endereço do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `fone` | E | N | 0-1 | Número do telefone do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `email` | E | C | 0-1 | E-mail do fornecedor. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `indZFMALC` | E | N | 0-1 | Indicador da operação de fornecimento favorecido com alíquota zero de CBS (conforme art. 451 e art. 466 da Lei Complementar nº 214/2025) |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `indDoacao` | E | N | 0-1 | Indica uma Operação de Doação |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/` | `cMun` | E | N | 1-1 | Código do município do endereço do imóvel |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/` | `gLocacao` | G | - | 0-1 | Grupo de informações relativas às operações de locação, cessão onerosa ou arrendamento de bens imóveis |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `pCopropriedade` | E | N | 1-1 | Percentual de Copropriedade |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `vTotOper` | E | N | 1-1 | Valor total da operação com bem imóvel |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `vDescIncondTot` | E | N | 0-1 | Valor total do Desconto Incondicionado |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `vDescCondTot` | E | N | 0-1 | Valor total do Desconto Condicionado |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `dVencOrig` | E | D | 0-1 | Data de vencimento original |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/` | `gUnidImob` | G | - | 0-99 | Grupo de informações relativas às unidades imobiliárias objeto da operação |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `inscImobFisc` | E | C | 0-1 | Inscrição imobiliária fiscal |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `cCIB` | CE | C | 1-1 | Código do Cadastro Imobiliário Brasileiro - CIB |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `end` | CG | - | 1-1 | Grupo de informações do endereço do imóvel. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end/` | `CEP` | E | N | 1-1 | Código numérico do Endereçamento Postal nacional (CEP) do endereço do imóvel. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `xLgr` | E | C | 1-1 | Tipo e nome do logradouro do endereço do imóvel. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `nro` | E | C | 1-1 | Número no logradouro do endereço do imóvel. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `xCpl` | E | C | 0-1 | Complemento do endereço do imóvel. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `xBairro` | E | C | 0-1 | Bairro do endereço do imóvel. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `gAjusteBCLocImoveis` | G | - | 0-1000 | Grupo de informações relativas a valores de ajuste (dedução/redução) da Base de Cálculo do IBS e da CBS referentes às operações de locação,  |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/` | `tpAjusteBCLocImoveis` | E | N | 1-1 | Tipo de parcela não integrante da base de cálculo do IBS e da CBS |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/` | `xTpAjusteBCLocImoveis` | E | C | 0-1 | Descrição do tipo de parcela não integrante da base de cálculo do IBS e da CBS quando a opção for "99  = Outras parcelas inclusas no aluguel |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/` | `vAjusteBCLocImoveis` | E | N | 1-1 | Valor monetário utilizado para não inclusão na base de cálculo do IBS e da CBS da NFS-e que está sendo emitida (R$). |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `bensMoveis` | G | - | 0-1000 | Grupo de informações relativas aos bens móveis objetos de locação |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/` | `cNCMBemMovel` | E | N | 1-1 | Código da Nomenclatura Comum do Mercosul (NCM) do bem móvel objeto da locação. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/` | `xNCMBemMovel` | E | C | 1-1 | Descrição do Bem Móvel objeto da locação. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/` | `qtdNCMBemMovel` | E | N | 1-1 | Quantidade do Bem Móvel objeto da locação. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/` | `gIBSCBSAjuste` | G | - | 0-1 | Grupo de informações para as Notas de Ajuste |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/` | `vIBS` | E | N | 1-1 | Valor do IBS a ser ajustado. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/` | `vCBS` | E | N | 1-1 | Valor da CBS a ser ajustado. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `gEstornoCred` | G | - | 0-1 | Grupo de informações relacionadas aos estornos de créditos do IBS e da CBS. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/` | `vIBSEstCred` | E | N | 1-1 | Valor do IBS a ser estornado. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/` | `vCBSEstCred` | E | N | 1-1 | Valor da CBS a ser estornado. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `gPagAntecipado` | G | - | 0-1 | Grupo de referenciamento das NFS-e de pagamento antecipado para abatimento. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gPagAntecipado/` | `refNFSe` | E | C | 1-99 | Chave da NFS-e de pagamento antecipado referenciada. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `gPgtoVinc` | G | - | 0-1 | Grupo de informações da vinculação com a transação de pagamento |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/` | `pgto` | G | - | 1-99 | Dados dos pagamentos vinculados à NFS-e |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `nPag` | E | N | 1-1 | Numerador único de cada pagamento |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `idTransacao` | E | C | 1-1 | Identificador específico da transação financeira, de acordo com o pagamento. |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `tpMeioPgto` | E | N | 1-1 | Código do meio de pagamento utilizado: |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `CNPJReceb` | E | C | 1-1 | CNPJ completo do recebedor do pagamento (fornecedor, plataforma, ou outra entidade que receba o pagamento do adquirente). |
| `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `CNPJBasePSP` | E | C | 1-1 | CNPJ base da instituição financeira ou de pagamento utilizada pelo recebedor do pagamento (fornecedor, plataforma, ou outra entidade que |


---

## Índice de campos (ordem do XML)

| # | Caminho | Campo | Ele | Tipo | Ocor. | Tam. |
|---|---------|-------|-----|------|-------|------|
| 1 | `-` | `NFS-e` | Raiz | - | - | - |
| 2 | `NFSe/` | `versao` | A | C | 1-1 | 1-4V2 |
| 3 | `NFSe/` | `infNFSe` | G | - | 1-1 | - |
| 4 | `NFSe/infNFSe/` | `id` | ID | C | 1-1 | 53 |
| 5 | `NFSe/infNFSe/` | `xLocEmi` | E | C | 1-1 | 150 |
| 6 | `NFSe/infNFSe/` | `xLocPrestacao` | E | C | 0-1 | 150 |
| 7 | `NFSe/infNFSe/` | `nNFSe` | E | N | 1-1 | 13 |
| 8 | `NFSe/infNFSe/` | `cLocIncid` | E | N | 0-1 | 7 |
| 9 | `NFSe/infNFSe/` | `xLocIncid` | E | C | 0-1 | 150 |
| 10 | `NFSe/infNFSe/` | `xTribNac` | E | C | 0-1 | 600 |
| 11 | `NFSe/infNFSe/` | `xTribMun` | E | C | 0-1 | 600 |
| 12 | `NFSe/infNFSe/` | `xNBS` | E | C | 0-1 | 600 |
| 13 | `NFSe/infNFSe/` | `verAplic` | E | C | 1-1 | 1-20 |
| 14 | `NFSe/infNFSe/` | `ambGer` | E | N | 1-1 | 1 |
| 15 | `NFSe/infNFSe/` | `tpEmis` | E | N | 1-1 | 1 |
| 16 | `NFSe/infNFSe/` | `procEmi` | E | N | 0-1 | 1 |
| 17 | `NFSe/infNFSe/` | `cStat` | E | N | 1-1 | 3 |
| 18 | `NFSe/infNFSe/` | `dhProc` | E | D | 1-1 | - |
| 19 | `NFSe/infNFSe/` | `nDFSe` | E | N | 1-1 | 1-13 |
| 20 | `NFSe/infNFSe/` | `emit` | G | - | 1-1 | - |
| 21 | `NFSe/infNFSe/emit/` | `CNPJ` | CE | C | 1-1 | 14 |
| 22 | `NFSe/infNFSe/emit/` | `CPF` | CE | N | 1-1 | 11 |
| 23 | `NFSe/infNFSe/emit/` | `IM` | E | C | 0-1 | 15 |
| 24 | `NFSe/infNFSe/emit/` | `xNome` | E | C | 1-1 | 150 |
| 25 | `NFSe/infNFSe/emit/` | `xFant` | E | C | 0-1 | 150 |
| 26 | `NFSe/infNFSe/emit/` | `enderNac` | G | - | 1-1 | - |
| 27 | `NFSe/infNFSe/emit/enderNac/` | `xLgr` | E | C | 1-1 | 1-255 |
| 28 | `NFSe/infNFSe/emit/enderNac/` | `nro` | E | C | 1-1 | 1-60 |
| 29 | `NFSe/infNFSe/emit/enderNac/` | `xCpl` | E | C | 0-1 | 1-156 |
| 30 | `NFSe/infNFSe/emit/enderNac/` | `xBairro` | E | C | 1-1 | 1-60 |
| 31 | `NFSe/infNFSe/emit/enderNac/` | `cMun` | E | N | 1-1 | 7 |
| 32 | `NFSe/infNFSe/emit/enderNac/` | `UF` | E | C | 1-1 | 2 |
| 33 | `NFSe/infNFSe/emit/enderNac/` | `CEP` | E | N | 1-1 | 8 |
| 34 | `NFSe/infNFSe/emit/` | `fone` | E | N | 0-1 | 9-20 |
| 35 | `NFSe/infNFSe/emit/` | `email` | E | C | 0-1 | 80 |
| 36 | `NFSe/infNFSe/` | `valores` | G | - | 0-1 | - |
| 37 | `NFSe/infNFSe/valores/` | `vCalcAjusteBCISSQN` | E | N | 0-1 | 1-15V2 |
| 38 | `NFSe/infNFSe/valores/` | `tpBM` | E | C | 0-1 | 40 |
| 39 | `NFSe/infNFSe/valores/` | `vCalcBM` | E | N | 0-1 | 1-15V2 |
| 40 | `NFSe/infNFSe/valores/` | `vBC` | E | N | 0-1 | 1-15V2 |
| 41 | `NFSe/infNFSe/valores/` | `pAliqAplic` | E | N | 0-1 | 1-2V2 |
| 42 | `NFSe/infNFSe/valores/` | `vISSQN` | E | N | 0-1 | 1-15V2 |
| 43 | `NFSe/infNFSe/valores/` | `vTotalRet` | E | N | 0-1 | 1-15V2 |
| 44 | `NFSe/infNFSe/valores/` | `vLiq` | E | N | 1-1 | 1-15V2 |
| 45 | `NFSe/infNFSe/` | `xOutInf` | E | C | 0-1 | 2000 |
| 46 | `NFSe/infNFSe/` | `IBSCBS` | G | - | 0-1 | - |
| 47 | `NFSe/infNFSe/IBSCBS/` | `cLocalidadeIncid` | E | N | 0-1 | 7 |
| 48 | `NFSe/infNFSe/IBSCBS/` | `xLocalidadeIncid` | E | C | 0-1 | 600 |
| 49 | `NFSe/infNFSe/IBSCBS/` | `pRedutor` | E | N | 0-1 | 1-2V2 |
| 50 | `NFSe/infNFSe/IBSCBS/` | `valores` | G | - | 0-1 | - |
| 51 | `NFSe/infNFSe/IBSCBS/valores/` | `vBC` | E | N | 1-1 | 1-15V2 |
| 52 | `NFSe/infNFSe/IBSCBS/valores/` | `vCalcAjusteBCIBSCBS` | E | N | 0-1 | 1-15V2 |
| 53 | `NFSe/infNFSe/IBSCBS/valores/` | `vCalcAjusteBCLocImoveis` | E | N | 0-1 | 1-15V2 |
| 54 | `NFSe/infNFSe/IBSCBS/valores/` | `vReceitaBrutaSN` | E | N | 0-1 | 1-15V2 |
| 55 | `NFSe/infNFSe/IBSCBS/valores/` | `uf` | G | - | 1-1 | - |
| 56 | `NFSe/infNFSe/IBSCBS/valores/uf/` | `pIBSUF` | E | N | 1-1 | 1-2V2 |
| 57 | `NFSe/infNFSe/IBSCBS/valores/uf/` | `pRedAliqUF` | E | N | 0-1 | 1-3V2 |
| 58 | `NFSe/infNFSe/IBSCBS/valores/uf/` | `pAliqEfetUF` | E | N | 1-1 | 1-2V2 |
| 59 | `NFSe/infNFSe/IBSCBS/valores/` | `mun` | G | - | 1-1 | - |
| 60 | `NFSe/infNFSe/IBSCBS/valores/mun/` | `pIBSMun` | E | N | 1-1 | 1-2V2 |
| 61 | `NFSe/infNFSe/IBSCBS/valores/mun/` | `pRedAliqMun` | E | N | 0-1 | 1-3V2 |
| 62 | `NFSe/infNFSe/IBSCBS/valores/mun/` | `pAliqEfetMun` | E | N | 1-1 | 1-2V2 |
| 63 | `NFSe/infNFSe/IBSCBS/valores/` | `fed` | G | - | 1-1 | - |
| 64 | `NFSe/infNFSe/IBSCBS/valores/fed/` | `pCBS` | E | N | 1-1 | 1-2V2 |
| 65 | `NFSe/infNFSe/IBSCBS/valores/fed/` | `pRedAliqCBS` | E | N | 0-1 | 1-3V2 |
| 66 | `NFSe/infNFSe/IBSCBS/valores/fed/` | `pAliqEfetCBS` | E | N | 1-1 | 1-2V2 |
| 67 | `NFSe/infNFSe/IBSCBS/` | `totCIBS` | G | - | 1-1 | - |
| 68 | `NFSe/infNFSe/IBSCBS/totCIBS/` | `vTotNF` | E | N | 1-1 | 1-15V2 |
| 69 | `NFSe/infNFSe/IBSCBS/totCIBS/` | `gIBS` | G | - | 1-1 | - |
| 70 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/` | `vIBSTot` | E | N | 0-1 | 1-15V2 |
| 71 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/` | `gIBSCredPres` | G | - | 0-1 | - |
| 72 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/` | `pCredPresIBS` | E | N | 1-1 | 1-2V2 |
| 73 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/` | `vCredPresIBS` | E | N | 1-1 | 1-15V2 |
| 74 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/` | `gIBSUFTot` | G | - | 0-1 | - |
| 75 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/` | `vDifUF` | E | N | 0-1 | 1-15V2 |
| 76 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/` | `vIBSUF` | E | N | 1-1 | 1-15V2 |
| 77 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/` | `gIBSMunTot` | G | - | 0-1 | - |
| 78 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/` | `vDifMun` | E | N | 0-1 | 1-15V2 |
| 79 | `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/` | `vIBSMun` | E | N | 1-1 | 1-15V2 |
| 80 | `NFSe/infNFSe/IBSCBS/totCIBS/` | `gCBS` | G | - | 1-1 | - |
| 81 | `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/` | `gCBSCredPres` | G | - | 0-1 | - |
| 82 | `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/` | `pCredPresCBS` | E | N | 0-1 | 1-2V2 |
| 83 | `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/` | `vCredPresCBS` | E | N | 0-1 | 1-15V2 |
| 84 | `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/` | `vDifCBS` | E | N | 0-1 | 1-15V2 |
| 85 | `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/` | `vCBS` | E | N | 0-1 | 1-15V2 |
| 86 | `NFSe/infNFSe/IBSCBS/totCIBS/` | `gTribRegular` | G | - | 0-1 | - |
| 87 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/` | `pAliqEfeRegIBSUF` | E | N | 1-1 | 1-2V2 |
| 88 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/` | `vTribRegIBSUF` | E | N | 1-1 | 1-15V2 |
| 89 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/` | `pAliqEfeRegIBSMun` | E | N | 1-1 | 1-2V2 |
| 90 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/` | `vTribRegIBSMun` | E | N | 1-1 | 1-15V2 |
| 91 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/` | `pAliqEfeRegCBS` | E | N | 1-1 | 1-2V2 |
| 92 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/` | `vTribRegCBS` | E | N | 1-1 | 1-15V2 |
| 93 | `NFSe/infNFSe/IBSCBS/totCIBS/` | `gTribCompraGov` | G | - | 0-1 | - |
| 94 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov` | `pIBSUF` | E | N | 1-1 | 1-2V2 |
| 95 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov` | `vIBSUF` | E | N | 1-1 | 1-15V2 |
| 96 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov` | `pIBSMun` | E | N | 1-1 | 1-2V2 |
| 97 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov` | `vIBSMun` | E | N | 1-1 | 1-15V2 |
| 98 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov` | `pCBS` | E | N | 1-1 | 1-2V2 |
| 99 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov` | `vCBS` | E | N | 1-1 | 1-15V2 |
| 100 | `NFSe/infNFSe/IBSCBS/totCIBS/` | `gTribSN` | G | - | 0-1 | - |
| 101 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `pIBSSN` | E | N | 0-1 | 1-2V2 |
| 102 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `vIBSSN` | E | N | 0-1 | 1-15V2 |
| 103 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `pCBSSN` | E | N | 1-1 | 1-2V2 |
| 104 | `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/` | `vCBSSN` | E | N | 1-1 | 1-15V2 |
| 105 | `NFSe/infNFSe/` | `DPS` | G | - | 1-1 | - |
| 106 | `NFSe/infNFSe/DPS/` | `versao` | A | C | 1-1 | 1-4V2 |
| 107 | `NFSe/infNFSe/DPS/` | `infDPS` | G | - | 1-1 | - |
| 108 | `NFSe/infNFSe/DPS/infDPS/` | `id` | ID | C | 1-1 | 45 |
| 109 | `NFSe/infNFSe/DPS/infDPS/` | `tpAmb` | E | N | 1-1 | 1 |
| 110 | `NFSe/infNFSe/DPS/infDPS/` | `dhEmi` | E | D | 1-1 | - |
| 111 | `NFSe/infNFSe/DPS/infDPS/` | `verAplic` | E | C | 1-1 | 1-20 |
| 112 | `NFSe/infNFSe/DPS/infDPS/` | `serie` | E | N | 1-1 | 1-5 |
| 113 | `NFSe/infNFSe/DPS/infDPS/` | `nDPS` | E | N | 1-1 | 1-15 |
| 114 | `NFSe/infNFSe/DPS/infDPS/` | `dCompet` | E | D | 1-1 | - |
| 115 | `NFSe/infNFSe/DPS/infDPS/` | `tpEmit` | E | N | 1-1 | 1 |
| 116 | `NFSe/infNFSe/DPS/infDPS/` | `cMotivoEmisTI` | E | N | 0-1 | 1 |
| 117 | `NFSe/infNFSe/DPS/infDPS/` | `finNFSe` | E | N | 1-1 | 1 |
| 118 | `NFSe/infNFSe/DPS/infDPS/` | `tpNFSeDebito` | E | N | 0-1 | 2 |
| 119 | `NFSe/infNFSe/DPS/infDPS/` | `tpNFSeCredito` | E | N | 0-1 | 2 |
| 117 | `NFSe/infNFSe/DPS/infDPS/` | `chNFSeRej` | E | N | 0-1 | 50 |
| 121 | `NFSe/infNFSe/DPS/infDPS/` | `cLocEmi` | E | N | 1-1 | 7 |
| 122 | `NFSe/infNFSe/DPS/infDPS/` | `subst` | G | - | 0-1 | - |
| 123 | `NFSe/infNFSe/DPS/infDPS/subst` | `chSubstda` | E | C | 1-1 | 50 |
| 124 | `NFSe/infNFSe/DPS/infDPS/subst` | `cMotivo` | E | N | 1-1 | 2 |
| 125 | `NFSe/infNFSe/DPS/infDPS/subst` | `xMotivo` | E | C | 0-1 | 15-255 |
| 126 | `NFSe/infNFSe/DPS/infDPS/` | `prest` | G | - | 1-1 | - |
| 127 | `NFSe/infNFSe/DPS/infDPS/prest/` | `CNPJ` | CE | C | 1-1 | 14 |
| 128 | `NFSe/infNFSe/DPS/infDPS/prest/` | `CPF` | CE | N | 1-1 | 11 |
| 129 | `NFSe/infNFSe/DPS/infDPS/prest/` | `NIF` | CE | C | 1-1 | 40 |
| 130 | `NFSe/infNFSe/DPS/infDPS/prest/` | `cNaoNIF` | CE | N | 1-1 | 1 |
| 131 | `NFSe/infNFSe/DPS/infDPS/prest/` | `CAEPF` | E | N | 0-1 | 14 |
| 132 | `NFSe/infNFSe/DPS/infDPS/prest/` | `IM` | E | C | 0-1 | 15 |
| 133 | `NFSe/infNFSe/DPS/infDPS/prest/` | `xNome` | E | C | 0-1 | 150 |
| 134 | `NFSe/infNFSe/DPS/infDPS/prest/` | `end` | G | - | 0-1 | - |
| 135 | `NFSe/infNFSe/DPS/infDPS/prest/end/` | `endNac` | CG | - | 1-1 | - |
| 136 | `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/` | `cMun` | E | N | 1-1 | 7 |
| 137 | `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/` | `CEP` | E | C | 1-1 | 8 |
| 138 | `NFSe/infNFSe/DPS/infDPS/prest/end/` | `endExt` | CG | - | 1-1 | - |
| 139 | `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/` | `cPais` | E | C | 1-1 | 2 |
| 140 | `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/` | `cEndPost` | E | C | 1-1 | 1-11 |
| 141 | `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 142 | `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 143 | `NFSe/infNFSe/DPS/infDPS/prest/end/` | `xLgr` | E | C | 1-1 | 1-255 |
| 144 | `NFSe/infNFSe/DPS/infDPS/prest/end/` | `nro` | E | C | 1-1 | 1-60 |
| 145 | `NFSe/infNFSe/DPS/infDPS/prest/end/` | `xCpl` | E | C | 0-1 | 1-156 |
| 146 | `NFSe/infNFSe/DPS/infDPS/prest/end/` | `xBairro` | E | C | 1-1 | 1-60 |
| 147 | `NFSe/infNFSe/DPS/infDPS/prest/` | `fone` | E | N | 0-1 | 6-20 |
| 148 | `NFSe/infNFSe/DPS/infDPS/prest/` | `email` | E | C | 0-1 | 1-80 |
| 149 | `NFSe/infNFSe/DPS/infDPS/prest/` | `regTrib` | G | - | 1-1 | - |
| 150 | `NFSe/infNFSe/DPS/infDPS/prest/regTrib/` | `opSimpNac` | E | N | 1-1 | 1 |
| 151 | `NFSe/infNFSe/DPS/infDPS/prest/regTrib/` | `regApTribSN` | E | N | 0-1 | 1 |
| 152 | `NFSe/infNFSe/DPS/infDPS/prest/regTrib/` | `regApIBSCBSSN` | E | N | 0-1 | 1 |
| 153 | `NFSe/infNFSe/DPS/infDPS/prest/regTrib/` | `regEspTrib` | E | N | 0-1 | 1 |
| 154 | `NFSe/infNFSe/DPS/infDPS/` | `toma` | G | - | 0-1 | - |
| 155 | `NFSe/infNFSe/DPS/infDPS/toma/` | `CNPJ` | CE | C | 1-1 | 14 |
| 156 | `NFSe/infNFSe/DPS/infDPS/toma/` | `CPF` | CE | N | 1-1 | 11 |
| 157 | `NFSe/infNFSe/DPS/infDPS/toma/` | `NIF` | CE | C | 1-1 | 40 |
| 158 | `NFSe/infNFSe/DPS/infDPS/toma/` | `cNaoNIF` | CE | N | 1-1 | 1 |
| 159 | `NFSe/infNFSe/DPS/infDPS/toma/` | `CAEPF` | E | N | 0-1 | 14 |
| 160 | `NFSe/infNFSe/DPS/infDPS/toma/` | `IM` | E | C | 0-1 | 15 |
| 161 | `NFSe/infNFSe/DPS/infDPS/toma/` | `xNome` | E | C | 1-1 | 150 |
| 162 | `NFSe/infNFSe/DPS/infDPS/toma/` | `end` | G | - | 0-1 | - |
| 163 | `NFSe/infNFSe/DPS/infDPS/toma/end/` | `endNac` | CG | - | 1-1 | - |
| 164 | `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/` | `cMun` | E | N | 1-1 | 7 |
| 165 | `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/` | `CEP` | E | C | 1-1 | 8 |
| 166 | `NFSe/infNFSe/DPS/infDPS/toma/end/` | `endExt` | CG | - | 1-1 | - |
| 167 | `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/` | `cPais` | E | C | 1-1 | 2 |
| 168 | `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/` | `cEndPost` | E | C | 1-1 | 1-11 |
| 169 | `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 170 | `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 171 | `NFSe/infNFSe/DPS/infDPS/toma/end/` | `xLgr` | E | C | 1-1 | 1-255 |
| 172 | `NFSe/infNFSe/DPS/infDPS/toma/end/` | `nro` | E | C | 1-1 | 1-60 |
| 173 | `NFSe/infNFSe/DPS/infDPS/toma/end/` | `xCpl` | E | C | 0-1 | 1-156 |
| 174 | `NFSe/infNFSe/DPS/infDPS/toma/end/` | `xBairro` | E | C | 1-1 | 1-60 |
| 175 | `NFSe/infNFSe/DPS/infDPS/toma/` | `fone` | E | N | 0-1 | 6-20 |
| 176 | `NFSe/infNFSe/DPS/infDPS/toma/` | `email` | E | C | 0-1 | 1-80 |
| 177 | `NFSe/infNFSe/DPS/infDPS/` | `interm` | G | - | 0-1 | - |
| 178 | `NFSe/infNFSe/DPS/infDPS/interm/` | `CNPJ` | CE | C | 1-1 | 14 |
| 179 | `NFSe/infNFSe/DPS/infDPS/interm/` | `CPF` | CE | N | 1-1 | 11 |
| 180 | `NFSe/infNFSe/DPS/infDPS/interm/` | `NIF` | CE | C | 1-1 | 40 |
| 181 | `NFSe/infNFSe/DPS/infDPS/interm/` | `cNaoNIF` | CE | N | 1-1 | 1 |
| 182 | `NFSe/infNFSe/DPS/infDPS/interm/` | `CAEPF` | E | N | 0-1 | 14 |
| 183 | `NFSe/infNFSe/DPS/infDPS/interm/` | `IM` | E | C | 0-1 | 15 |
| 184 | `NFSe/infNFSe/DPS/infDPS/interm/` | `xNome` | E | C | 1-1 | 150 |
| 185 | `NFSe/infNFSe/DPS/infDPS/interm/` | `end` | G | - | 0-1 | - |
| 186 | `NFSe/infNFSe/DPS/infDPS/interm/end/` | `endNac` | CG | - | 1-1 | - |
| 187 | `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/` | `cMun` | E | N | 1-1 | 7 |
| 188 | `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/` | `CEP` | E | C | 1-1 | 8 |
| 189 | `NFSe/infNFSe/DPS/infDPS/interm/end/` | `endExt` | CG | - | 1-1 | - |
| 190 | `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/` | `cPais` | E | C | 1-1 | 2 |
| 191 | `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/` | `cEndPost` | E | C | 1-1 | 1-11 |
| 192 | `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 193 | `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 194 | `NFSe/infNFSe/DPS/infDPS/interm/end/` | `xLgr` | E | C | 1-1 | 1-255 |
| 195 | `NFSe/infNFSe/DPS/infDPS/interm/end/` | `nro` | E | C | 1-1 | 1-60 |
| 196 | `NFSe/infNFSe/DPS/infDPS/interm/end/` | `xCpl` | E | C | 0-1 | 1-156 |
| 197 | `NFSe/infNFSe/DPS/infDPS/interm/end/` | `xBairro` | E | C | 1-1 | 1-60 |
| 198 | `NFSe/infNFSe/DPS/infDPS/interm/` | `fone` | E | N | 0-1 | 6-20 |
| 199 | `NFSe/infNFSe/DPS/infDPS/interm/` | `email` | E | C | 0-1 | 1-80 |
| 200 | `NFSe/infNFSe/DPS/infDPS/` | `serv` | G | - | 0-1 | - |
| 201 | `NFSe/infNFSe/DPS/infDPS/serv/` | `locPrest` | G | - | 1-1 | - |
| 202 | `NFSe/infNFSe/DPS/infDPS/serv/locPrest/` | `cLocPrestacao` | CE | N | 1-1 | 7 |
| 203 | `NFSe/infNFSe/DPS/infDPS/serv/locPrest/` | `cPaisPrestacao` | CE | C | 1-1 | 2 |
| 204 | `NFSe/infNFSe/DPS/infDPS/serv/` | `cServ` | G | - | 1-1 | - |
| 205 | `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `cTribNac` | E | N | 1-1 | 6 |
| 206 | `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `cTribMun` | E | N | 0-1 | 3 |
| 207 | `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `cNBS` | E | N | 0-1 | 9 |
| 208 | `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `cAtvSN` | E | N | 0-1 | 2 |
| 209 | `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `cIntContrib` | E | C | 0-1 | 20 |
| 210 | `NFSe/infNFSe/DPS/infDPS/serv/cServ/` | `xDescServ` | E | C | 1-1 | 1000 |
| 211 | `NFSe/infNFSe/DPS/infDPS/serv/` | `comExt` | G | - | 0-1 | - |
| 212 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `mdPrestacao` | E | N | 1-1 | 1 |
| 213 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `vincPrest` | E | N | 1-1 | 1 |
| 214 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `tpMoeda` | E | N | 1-1 | 3 |
| 215 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `vServMoeda` | E | N | 1-1 | 1-15V2 |
| 216 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `mecAFComexP` | E | N | 1-1 | 2 |
| 217 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `mecAFComexT` | E | N | 1-1 | 2 |
| 218 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `movTempBens` | E | N | 1-1 | 1 |
| 219 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `nDI` | E | C | 0-1 | 1-12 |
| 220 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `nRE` | E | C | 0-1 | 12 |
| 221 | `NFSe/infNFSe/DPS/infDPS/serv/comExt/` | `mdic` | E | N | 1-1 | 1 |
| 222 | `NFSe/infNFSe/DPS/infDPS/serv` | `obra` | G | - | 0-1 | - |
| 223 | `NFSe/infNFSe/DPS/infDPS/serv/obra/` | `inscImobFisc` | E | C | 0-1 | 1-30 |
| 224 | `NFSe/infNFSe/DPS/infDPS/serv/obra/` | `cObra` | CE | C | 1-1 | 1-30 |
| 225 | `NFSe/infNFSe/DPS/infDPS/serv/obra/` | `cCIB` | CE | C | 1-1 | 8 |
| 226 | `NFSe/infNFSe/DPS/infDPS/serv/obra/` | `end` | CG | - | 1-1 | - |
| 227 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/` | `CEP` | CE | C | 1-1 | 8 |
| 228 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/` | `endExt` | CG | - | 1-1 | - |
| 229 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/` | `cEndPost` | E | C | 1-1 | 1-11 |
| 230 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 231 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 232 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/` | `xLgr` | E | C | 1-1 | 1-255 |
| 233 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/` | `nro` | E | C | 1-1 | 1-60 |
| 234 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/` | `xCpl` | E | C | 0-1 | 1-156 |
| 235 | `NFSe/infNFSe/DPS/infDPS/serv/obra/end/` | `xBairro` | E | C | 1-1 | 1-60 |
| 236 | `NFSe/infNFSe/DPS/infDPS/serv/` | `atvEvento` | G | - | 0-1 | - |
| 237 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/` | `xNome` | E | C | 1-1 | 255 |
| 238 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/` | `dtIni` | E | D | 1-1 | - |
| 239 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/` | `dtFim` | E | D | 1-1 | - |
| 240 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/` | `idAtvEvt` | CE | C | 1-1 | 1-30 |
| 241 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/` | `end` | CG | - | 1-1 | - |
| 242 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/` | `CEP` | CE | C | 1-1 | 8 |
| 243 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/` | `endExt` | CG | - | 1-1 | - |
| 244 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/` | `cEndPost` | E | C | 1-1 | 11 |
| 245 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 246 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 247 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/` | `xLgr` | E | C | 1-1 | 1-255 |
| 248 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/` | `nro` | E | C | 1-1 | 1-60 |
| 249 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/` | `xCpl` | E | C | 0-1 | 1-156 |
| 250 | `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/` | `xBairro` | E | C | 1-1 | 1-60 |
| 251 | `NFSe/infNFSe/DPS/infDPS/serv` | `infoCompl` | G | - | 0-1 | - |
| 252 | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/` | `idDocTec` | E | C | 0-1 | 1-40 |
| 253 | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/` | `docRef` | E | C | 0-1 | 1-255 |
| 254 | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/` | `xPed` | E | C | 0-1 | 1-60 |
| 255 | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/` | `gItemPed` | G | - | 0-1 | - |
| 256 | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/gItemPed/` | `xItemPed` | E | C | 1-99 | 1-60 |
| 257 | `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/` | `xInfComp` | E | C | 0-1 | 2000 |
| 258 | `NFSe/infNFSe/DPS/infDPS/` | `valores` | G | - | 0-1 | - |
| 259 | `NFSe/infNFSe/DPS/infDPS/valores/` | `vServPrest` | G | - | 1-1 | - |
| 260 | `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/` | `vReceb` | E | N | 0-1 | 1-15V2 |
| 261 | `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/` | `vServ` | E | N | 1-1 | 1-15V2 |
| 262 | `NFSe/infNFSe/DPS/infDPS/valores/` | `vDescCondIncond` | G | - | 0-1 | - |
| 263 | `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/` | `vDescIncond` | E | N | 0-1 | 1-15V2 |
| 264 | `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/` | `vDescCond` | E | N | 0-1 | 1-15V2 |
| 265 | `NFSe/infNFSe/DPS/infDPS/valores/` | `vAjusteBC` | G | - | 0-1 | - |
| 266 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/` | `pAjusteBCISSQN` | E | N | 0-1 | 1-3V2 |
| 267 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/` | `vAjusteBCISSQN` | E | N | 0-1 | 1-15V2 |
| 268 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/` | `documentos` | G | - | 0-1 | - |
| 269 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos` | `docAjusteBC` | G | - | 1-1000 | - |
| 270 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `tpAjusteBC` | E | N | 1-1 | 1-3 |
| 271 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `xTpAjusteBC` | E | C | 0-1 | 0-150 |
| 272 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `vTotDoc` | E | N | 1-1 | 1-15V2 |
| 273 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `vAjuteAplic` | E | N | 1-1 | 1-15V2 |
| 274 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `dtEmiDoc` | E | D | 0-1 | - |
| 275 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `dtCompDoc` | E | D | 0-1 | - |
| 276 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `dFeNacional` | CG | CG | 1-1 | - |
| 277 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/` | `tipoChaveDFe` | E | N | 1-1 | 1 |
| 278 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/` | `xTipoChaveDFe` | E | C | 0-1 | 1-255 |
| 279 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/` | `chaveDFe` | E | C | 1-1 | 1-50 |
| 280 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `docFiscalOutro` | CG | CG | 1-1 | - |
| 281 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/` | `cMunDocFiscal` | E | N | 1-1 | 7 |
| 282 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/` | `nDocFiscal` | E | C | 1-1 | 1-255 |
| 283 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/` | `xDocFiscal` | E | C | 1-1 | 1-255 |
| 284 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `docOutro` | CG | CG | 1-1 | - |
| 285 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/` | `nDoc` | E | C | 1-1 | 1-255 |
| 286 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/` | `xDoc` | E | C | 1-1 | 1-255 |
| 287 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/` | `fornec` | G | - | 0-1 | - |
| 288 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `CNPJ` | CE | C | 1-1 | 14 |
| 289 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `CPF` | CE | N | 1-1 | 11 |
| 290 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `NIF` | CE | C | 1-1 | 40 |
| 291 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `cNaoNIF` | CE | N | 1-1 | 1 |
| 292 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xNome` | E | C | 1-1 | 150 |
| 293 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `end` | G | - | 0-1 | - |
| 294 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/` | `endNac` | CG | - | 1-1 | - |
| 295 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/` | `cMun` | E | N | 1-1 | 7 |
| 296 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/` | `CEP` | E | C | 1-1 | 8 |
| 297 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/` | `endExt` | CG | - | 1-1 | - |
| 298 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `cPais` | E | C | 1-1 | 2 |
| 299 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `cEndPost` | E | C | 1-1 | 1-11 |
| 300 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 301 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 302 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xLgr` | E | C | 1-1 | 1-255 |
| 303 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `nro` | E | C | 1-1 | 1-60 |
| 304 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xCpl` | E | C | 0-1 | 1-156 |
| 305 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `xBairro` | E | C | 1-1 | 1-60 |
| 306 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `fone` | E | N | 0-1 | 6-20 |
| 307 | `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/` | `email` | E | C | 0-1 | 1-80 |
| 308 | `NFSe/infNFSe/DPS/infDPS/valores/` | `trib` | G | - | 0-1 | - |
| 309 | `NFSe/infNFSe/DPS/infDPS/valores/trib/` | `tribMun` | G | - | 1-1 | - |
| 310 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `tribISSQN` | E | N | 1-1 | 1 |
| 311 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `cPaisResult` | E | C | 0-1 | 2 |
| 312 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `tpImunidade` | E | N | 0-1 | 1 |
| 313 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `exigSusp` | G | - | 0-1 | - |
| 314 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/` | `tpSusp` | E | N | 1-1 | 1 |
| 315 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/` | `nProcesso` | E | C | 1-1 | 30 |
| 316 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `BM` | G | - | 0-1 | - |
| 317 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/` | `nBM` | E | N | 1-1 | 14 |
| 318 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/` | `vRedBCBM` | E | N | 0-1 | 1-15V2 |
| 319 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/` | `pRedBCBM` | E | N | 0-1 | 1-3V2 |
| 320 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `tpRetISSQN` | E | N | 1-1 | 1 |
| 321 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/` | `pAliq` | E | N | 0-1 | 1V2 |
| 322 | `NFSe/infNFSe/DPS/infDPS/valores/trib/` | `tribFed` | G | - | 0-1 | - |
| 323 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/` | `piscofins` | G | - | 0-1 | - |
| 324 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `CST` | E | N | 1-1 | 2 |
| 325 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `vBCPisCofins` | E | N | 0-1 | 1-15V2 |
| 326 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `pAliqPis` | E | N | 0-1 | 1-2V2 |
| 327 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `pAliqCofins` | E | N | 0-1 | 1-2V2 |
| 328 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `vPis` | E | N | 0-1 | 1-15V2 |
| 329 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `vCofins` | E | N | 0-1 | 1-15V2 |
| 330 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/` | `tpRetPisCofins` | E | N | 0-1 | 1 |
| 331 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/` | `vRetCP` | E | N | 0-1 | 1-15V2 |
| 332 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/` | `vRetIRRF` | E | N | 0-1 | 1-15V2 |
| 333 | `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/` | `vRetCSLL` | E | N | 0-1 | 1-15V2 |
| 334 | `NFSe/infNFSe/DPS/infDPS/valores/trib/` | `totTrib` | G | - | 1-1 | - |
| 335 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/` | `vTotTrib` | CG | - | 1-1 | - |
| 336 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/` | `vTotTribFed` | E | N | 1-1 | 1-15V2 |
| 337 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/` | `vTotTribEst` | E | N | 1-1 | 1-15V2 |
| 338 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/` | `vTotTribMun` | E | N | 1-1 | 1-15V2 |
| 339 | `NFSe/infNFSe/DPS/infDPS/valorestrib/totTrib/` | `pTotTrib` | CG | - | 1-1 | - |
| 340 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/` | `pTotTribFed` | E | N | 1-1 | 1-2V2 |
| 341 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/` | `pTotTribEst` | E | N | 1-1 | 1-2V2 |
| 342 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/` | `pTotTribMun` | E | N | 1-1 | 1-2V2 |
| 343 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/` | `indTotTrib` | CE | N | 1-1 | 1 |
| 344 | `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/` | `pTotTribSN` | CE | N | 1-1 | 1-2V2 |
| 345 | `NFSe/infNFSe/DPS/infDPS/` | `IBSCBS` | G | - | 0-1 | - |
| 120 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `indFinal` | E | N | 0-1 | 1 |
| 347 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `cIndOp` | E | N | 0-1 | 6 |
| 348 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `indZFMALC` | E | N | 0-1 | 1 |
| 349 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `tpOper` | E | N | 0-1 | 1 |
| 350 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `gRefNFSe` | G | - | 0-1 | - |
| 351 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gRefNFSe/` | `refNFSe` | E | C | 1-99 | 50 |
| 352 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `tpEnteGov` | E | N | 0-1 | 1 |
| 353 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `indDoacao` | E | N | 0-1 | 1 |
| 354 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `indDest` | E | N | 1-1 | 1 |
| 355 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `dest` | G | - | 0-1 | - |
| 356 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `CNPJ` | CE | C | 1-1 | 14 |
| 357 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `CPF` | CE | N | 1-1 | 11 |
| 358 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `NIF` | CE | C | 1-1 | 40 |
| 359 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `cNaoNIF` | CE | N | 1-1 | 1 |
| 360 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `xNome` | E | C | 1-1 | 1-150 |
| 361 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `end` | G | - | 0-1 | - |
| 362 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/` | `endNac` | CG | - | 1-1 | - |
| 363 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/` | `cMun` | E | N | 1-1 | 7 |
| 364 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/` | `CEP` | E | N | 1-1 | 8 |
| 365 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/` | `endExt` | CG | - | 1-1 | - |
| 366 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/` | `cPais` | E | C | 1-1 | 2 |
| 367 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/` | `cEndPost` | E | C | 1-1 | 1-11 |
| 368 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/` | `xCidade` | E | C | 1-1 | 1-60 |
| 369 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/` | `xEstProvReg` | E | C | 1-1 | 1-60 |
| 370 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/` | `xLgr` | E | C | 1-1 | 1-255 |
| 371 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/` | `nro` | E | C | 1-1 | 1-60 |
| 372 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/` | `xCpl` | E | C | 0-1 | 1-156 |
| 373 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/` | `xBairro` | E | C | 1-1 | 1-60 |
| 374 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `fone` | E | N | 0-1 | 6-20 |
| 375 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/` | `email` | E | C | 0-1 | 1-80 |
| 376 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `imovel` | G | - | 0-1 | - |
| 377 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/` | `cMun` | E | N | 1-1 | 7 |
| 378 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/` | `gLocacao` | G | - | 0-1 | - |
| 379 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `pCopropriedade` | E | N | 1-1 | 1-2V2 |
| 380 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `vTotOper` | E | N | 1-1 | 1-15V2 |
| 381 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `vDescIncondTot` | E | N | 0-1 | 1-15V2 |
| 382 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `vDescCondTot` | E | N | 0-1 | 1-15V2 |
| 383 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/` | `dVencOrig` | E | D | 0-1 | - |
| 384 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/` | `gUnidImob` | G | - | 0-99 | - |
| 385 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `inscImobFisc` | E | C | 0-1 | 1-30 |
| 386 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `cCIB` | CE | C | 1-1 | 8 |
| 387 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `end` | CG | - | 1-1 | - |
| 388 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end/` | `CEP` | E | N | 1-1 | 8 |
| 389 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `xLgr` | E | C | 1-1 | 1-255 |
| 390 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `nro` | E | C | 1-1 | 1-60 |
| 391 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `xCpl` | E | C | 0-1 | 1-156 |
| 392 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end` | `xBairro` | E | C | 0-1 | 1-60 |
| 393 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/` | `gAjusteBCLocImoveis` | G | - | 0-1000 | - |
| 394 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/` | `tpAjusteBCLocImoveis` | E | N | 1-1 | 2 |
| 395 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/` | `xTpAjusteBCLocImoveis` | E | C | 0-1 | 0-150 |
| 396 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/` | `vAjusteBCLocImoveis` | E | N | 1-1 | 1-15V2 |
| 397 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `bensMoveis` | G | - | 0-1000 | - |
| 398 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/` | `cNCMBemMovel` | E | N | 1-1 | 8 |
| 399 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/` | `xNCMBemMovel` | E | C | 1-1 | 1-150 |
| 400 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/` | `qtdNCMBemMovel` | E | N | 1-1 | 3 |
| 401 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `valores` | G | - | 1-1 | - |
| 402 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/` | `trib` | G | - | 1-1 | - |
| 403 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/` | `gIBSCBS` | G | - | 1-1 | - |
| 404 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `CST` | E | N | 1-1 | 3 |
| 405 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `cClassTrib` | E | N | 1-1 | 6 |
| 406 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `cCredPres` | E | N | 0-1 | 2 |
| 407 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/` | `gIBSCBSAjuste` | G | - | 0-1 | - |
| 408 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/` | `vIBS` | E | N | 1-1 | 1-15V2 |
| 409 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/` | `vCBS` | E | N | 1-1 | 1-15V2 |
| 410 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `gTribRegular` | G | - | 0-1 | - |
| 411 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/` | `CSTReg` | E | N | 1-1 | 3 |
| 412 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/` | `cClassTribReg` | E | N | 1-1 | 6 |
| 413 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `gDif` | G | - | 0-1 | - |
| 414 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/` | `pDifUF` | E | N | 1-1 | 1-3V2 |
| 415 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/` | `pDifMun` | E | N | 1-1 | 1-3V2 |
| 416 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/` | `pDifCBS` | E | N | 1-1 | 1-3V2 |
| 417 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `gEstornoCred` | G | - | 0-1 | - |
| 418 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/` | `vIBSEstCred` | E | N | 1-1 | 1-15V2 |
| 419 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/` | `vCBSEstCred` | E | N | 1-1 | 1-15V2 |
| 420 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/` | `gPagAntecipado` | G | - | 0-1 | - |
| 421 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gPagAntecipado/` | `refNFSe` | E | C | 1-99 | 50 |
| 422 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` | `gPgtoVinc` | G | - | 0-1 | - |
| 423 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/` | `pgto` | G | - | 1-99 | - |
| 424 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `nPag` | E | N | 1-1 | 3 |
| 425 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `idTransacao` | E | C | 1-1 | 2-35 |
| 426 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `tpMeioPgto` | E | N | 1-1 | 2 |
| 427 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `CNPJReceb` | E | C | 1-1 | 14 |
| 428 | `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/` | `CNPJBasePSP` | E | C | 1-1 | 8 |
| 429 | `NFSe/infNFSe/DPS/infDPS/` | `Signature` | G | - | 0-1 | - |
| 430 | `NFSe/` | `Signature` | G | - | 1-1 | - |

---

## Detalhamento campo a campo

### `-NFS-e`

- **Campo:** `NFS-e`
- **Caminho no XML:** `-`
- **Elemento (ELE):** Raiz  |  **Tipo:** -  |  **Ocorrência (min-max):** -  |  **Tamanho:** -
- **Descrição:** -

### `NFSe/versao`

- **Campo:** `versao`
- **Caminho no XML:** `NFSe/`
- **Elemento (ELE):** A  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-4V2
- **Descrição:** Versão do leiaute da NFS-e.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1260` — O prazo de aceitação da versão do leiaute da NFS-e expirou.
    - Detalhe da regra: Prazo de aceitação da versão do leiaute NFS-e ultrapassado.

### `NFSe/infNFSe`

- **Campo:** `infNFSe`
- **Caminho no XML:** `NFSe/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da NFS-e

### `NFSe/infNFSe/id`

- **Campo:** `id`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** ID  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 53
- **Descrição:** Informar o identificador precedido do literal ‘ID’.  
     
  A formação do identificador de 53 posições da NFS-e é:  
    
  "NFS" +   
  Cód.Mun. (7) +   
  Amb.Ger. (1) +   
  Tipo de Inscrição Federal (1) +   
  Inscrição Federal (14 - CPF completar com 000 à esquerda) +   
  nNFSe (13) +  
  AnoMes Emis. (4) +   
  Cód.Num. (9) +   
  DV (1)  
    
  Código numérico de 9 Posições numérico, aleatório, gerado automaticamente pelo sistema gerador da NFS-e.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1263` — Conteúdo informado no identificador da NFS-e difere da concatenação dos campos correspondentes que formam o identificador.
    - Detalhe da regra: O identificador da NFS-e é formado conforme a concatenação dos seguintes campos: "NFS" + Cód.Mun. (7) + Amb.Ger. (1) + Tipo de Inscrição Federal (1) + Inscrição Federal (14 - CPF completar com 000 à esquerda) + nNFSe (13) + AnoMes Emis. (4) + Cód.Num. (9) + DV (1)  Verificar se tipo de inscrição e inscrição, informados no identificador da NFS-e, estão corretamente correspondidos conforme o seguinte:  Tipo de inscrição Federal = 1 / Inscrição Federal = CPF emitente da NFS-e; Tipo de inscrição Federal = 2 / Inscrição Federal = CNPJ emitente da NFS-e;  Cód.Mun.Emi. é o código do município do endereço do emitente da NFS-e."
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1268` — Chave de acesso informada para a NFS-e já foi compartilhada com o ADN.
    - Detalhe da regra: Chave a acesso da NFS-e enviada já existe no ADN.

### `NFSe/infNFSe/xLocEmi`

- **Campo:** `xLocEmi`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 150
- **Descrição:** Descrição do código de 7 dígitos da localidade emissora da NFS-e.
- **Notas explicativas:** Descrição do nome do município emissor da NFS-e correspondente ao Código da Localidade de Emissão da DPS (cLocEmi).

### `NFSe/infNFSe/xLocPrestacao`

- **Campo:** `xLocPrestacao`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 150
- **Descrição:** Descrição do código de 7 dígitos referente ao local da prestação do serviço.
- **Notas explicativas:** Descrição do nome do município emissor da NFS-e correspondente ao Código do Local da Prestação de Serviço da DPS (cLocPrestacao).

### `NFSe/infNFSe/nNFSe`

- **Campo:** `nNFSe`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 13
- **Descrição:** Número da NFS-e (Sequencial pelo emitente e tipo de emitente da NFS-e)
- **Notas explicativas:** Número sequencial por emitente da NFS-e.  
  A Sefin Nacional NFS-e irá gerar o número da NFS-e de forma sequencial por emitente.   
  Por se tratar de um ambiente altamente transacional, a Sefin Nacional NFS-e não irá reutilizar números inutilizados durante a geração da NFS-e.  
  Obrigatoriamente o campo deve conter 13 dígitos pois faz parte do identificador da NFS-e.  
  Valores possiveis de 0000000000000 até 9999999999999

### `NFSe/infNFSe/cLocIncid`

- **Campo:** `cLocIncid`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 7
- **Descrição:** Código de 7 dígitos da localidade de incidência do ISSQN.
- **Notas explicativas:** O Sistema Nacional NFS-e identifica a localidade de incidência do ISSQN conforme regras estabelecidas na LC 116/03.  
     
   Existem exceções em que o Sistema Nacional NFS-e não identifica a localidade de incidência nem haverá destaque do ISSQN na emissão da NFS-e:  
     
   1) Em caso de imunidade não existe localidade de incidência para o ISSQN;  
     
   2) Em caso de exportação de serviço não existe localidade de incidência para o ISSQN;  
     
   3) Em caso de serviços sem a incidência de ISSQN (cTribNac igual a 990101), não existe localidade de incidência para o ISSQN;  
     
   4) Em caso de operação tributável deve existir localidade de incidência para o ISSQN.  
    
  OBS 1: Para serviços prestados para o subitem 03.04, o município de incidência será o município do local de prestação de serviço informado na DPS, conforme TAB.MUN_IBGE.   
     
  OBS 2: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1301` — Não é permitido informar o código do local de incidência quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - Detalhe da regra: Não é permitido informar o código do local de incidência quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1305` — É obrigatório informar  o código do local de incidência quando o campo referente à tributação do ISSQN indicar Operação Tributável.
    - Detalhe da regra: É obrigatório informar o código do local de incidência quando o serviço prestado for uma operação tributável, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "1 - Operação Tributável", (tribISSQN = 1).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1309` — O código do local de incidência do ISSQN não existe conforme a tabela de municípios IBGE ou tabela de concessões de rodovia ou tabela de localidade geral no ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
    - Detalhe da regra: Se o código da localidade de incidência for informado na NFS-e, então ele deve existir nas tabelas de municípios do IBGE ou tabela de concessões de rodovia ou  tabela de localidade geral do arquivo  ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1313` — A localidade de incidência para o ISSQN deve corresponder ao município do estabelecimento/domicílio do prestador do serviço, quando não for informado o código de tributação nacional (cTribNac) 200101, da lista nacional de serviços do Sistema Nacional NFS-e, e a localidade de prestação do serviço corresponder a "Águas Marítimas" (0000000).
    - Detalhe da regra: Se o código de tributação nacional (cTribNac) corresponder a um subitem diferente de 200101 e  o local da prestação do serviço (cLocPrestacao) "Águas Marítmas" (código 0000000),  então o local de incidência (cLocIncid) deve ser igual ao código do município do endereço do prestador do serviço  (NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1317` — O local de incidência do ISSQN deve ser igual ao município da prestação do serviço (NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao)
 do serviço informado na NFS-e compartilhada pelo município, quando informado qualquer código de tributação nacional cuja regra de incidência indique o local da prestação, conforme a tabela MUN.INCID_INFO.SERV. do ANEXO_I-SEFIN_ADN-DPS_NFSe-SNNFSe.
    - Detalhe da regra: Se o código de tributação nacional informado corresponder a um dos seguintes códigos:  030401, 030402, 030403, 030501, 070201, 070202, 070401, 070501, 070502, 070901, 070902, 071001, 071002, 071101, 071102, 071201, 071601, 071701, 071801, 071901, 110101, 110102, 110201, 110301, 110401, 110402, 120101, 120201, 120301, 120401, 120501, 120601, 120701, 120801, 120901, 120902, 120903, 121001, 121101, 121201, 121401, 121501, 121601, 121701, 160101, 160102, 160103, 160104, 160201, 171001, 171002, 220101, então o codigo da localidade de  incidência do ISSQN deve ser igual ao código do local de prestação do serviço informado na NFS-e pelo município.  Exceto para os casos de Imunidade, Exportação de Serviço e Não Incidência (tribISSQN = 2, 3 ou 4).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1321` — O local de incidência do ISSQN deve ser igual ao município do endereço do tomador do serviço informado na NFS-e compartilhada pelo município (NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun).
    - Detalhe da regra: Se o código de tributação nacional informado corresponder a um dos seguintes códigos:  170501,  então o codigo do local de incidência do ISSQN deve ser igual ao código do município do endereço do tomador  (NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun)   do serviço informado na NFS-e compartilhada pelo município.  Exceto para os casos de Imunidade, Exportação de Serviço e Não Incidência (tribISSQN = 2, 3 ou 4).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1325` — O local de incidência do ISSQN deve ser igual ao município do endereço do prestador (NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun)
do serviço informado na NFS-e compartilhada pelo município, quando informado qualquer código de tributação nacional cuja regra de incidência indique o município do estabelecimento do prestador, conforme a tabela MUN.INCID_INFO.SERV. do ANEXO_I-SEFIN_ADN-DPS_NFSe-SNNFSe.
    - Detalhe da regra: Excetuados os códigos de tributação nacional: 030401, 030402, 030403, 030501, 070201, 070202, 070401, 070501, 070502, 070901, 070902, 071001, 071002, 071101, 071102, 071201, 071601, 071701, 071801, 071901, 110101, 110102, 110201, 110301, 110401, 110402, 120101, 120201, 120301, 120401, 120501, 120601, 120701, 120801, 120901, 120902, 120903, 121001, 121101, 121201, 121401, 121501, 121601, 121701, 160101, 160102, 160103, 160104, 160201, 171001, 171002, 170501, 220101 e 990101, para os demais códigos de tributação, de acordo com a tabela MUN.INCID_INFO.SERV. do ANEXO_I-SEFIN_ADN-DPS_NFSe-SNNFSe,  o codigo da localidade de incidência do ISSQN deve ser igual ao código do município do endereço do emitente da NFS-e (NFSe/infNFSe/emit/endNac/cMun),  quanto o emitente for o prestador do serviço (tpEmit = 1),  ou código do município do endereço do prestador do serviço da DPS (NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun), quando o emitente da NFS-e for o tomador ou intermediário (tpEmit = 2 ou 3).   Exceto para os casos de Imunidade, Exportação de Serviço e Não Incidência (tribISSQN = 2, 3 ou 4).

### `NFSe/infNFSe/xLocIncid`

- **Campo:** `xLocIncid`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 150
- **Descrição:** Descrição da localidade de incidência do ISSQN.
- **Notas explicativas:** Descrição do nome da localidade de incidência do ISSQN na NFS-e correspondente ao código da Localidade de incidência do ISSQN (cLocIncid).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1327` — É obrigatório informar a descrição do local de incidência quando o código do local de incidência (cLocIncid) for informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1329` — Não é permitido informar a descrição do local de incidência quando o código do local de incidência (cLocIncid) não for informado.

### `NFSe/infNFSe/xTribNac`

- **Campo:** `xTribNac`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 600
- **Descrição:** Descrição do código de tributação nacional do ISSQN.
- **Notas explicativas:** A descrição do código de tributação nacional utilizada pelo Sistema Nacional NFS-e, para "traduzir" o código de serviço nacional, enviado pelo emitente na DPS, é a descrição dos subitens da lista de serviços do "Anexo III - Lista Nacional de Serviços", que consta ao final do Manual de Orientação ao Contribuinte do ISSQN para a Sefin Nacional NFS-e.  
  A lista nacional utilizada é uma derivação direta da lista de serviços anexa à LC 116/03. A diferença entre as duas listas é que a lista nacional possui alguns subitens "desdobrados" nos mesmos grupamentos de itens.   
  Os desdobros foram necessários para que alguns subitens do anexo à LC 116/03 fossem divididos em dois ou mais subitens, preservando a mesma lógica da lista original. A separação dos termos que compõem um subitem do anexo da lei para cada novo subitem na nova lista nacional não muda em essência a legislação vigente e permite atender tanto à legislação específica de pequenos, médios e grandes municípios que aderirem ao Sistema Nacional NFS-e.

### `NFSe/infNFSe/xTribMun`

- **Campo:** `xTribMun`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 600
- **Descrição:** Descrição do código de tributação municipal do ISSQN.

### `NFSe/infNFSe/xNBS`

- **Campo:** `xNBS`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 600
- **Descrição:** Descrição do código da NBS.

### `NFSe/infNFSe/verAplic`

- **Campo:** `verAplic`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-20
- **Descrição:** Versão da aplicação que gerou a NFS-e.

### `NFSe/infNFSe/ambGer`

- **Campo:** `ambGer`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Ambiente gerador da NFS-e:  
    
  1- Sistema Próprio do Município;  
  2- Sefin Nacional NFS-e;
- **Notas explicativas:** NFS-e compartilhada pelo município para o ADN NFS-e sempre tem ambGer = 1.  
    
  NFS-e emitidas pelo Sistema Nacional NFS-e sempre tem ambGer = 2.
- **Valores aceitos (domínio identificado):**
  - `1` → Sistema Próprio do Município
  - `2` → Sefin Nacional NFS-e
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1274` — O ambiente gerador da NFS-e não está de acordo com a definição 1 (Sistema Próprio do Município) ou 2 (Sefin Nacional).
    - Detalhe da regra: Verificar se o ambiente gerador da NFS-e está de acordo com a definição: 1- Sistema Próprio do Município, para as NFS-e compartilhadas pelo município para o ADN, ou 2 - Sefin Nacional NFS-e, para as NFS-e emitidas pela Sefin ou recepcionadas via API "Bypass".

### `NFSe/infNFSe/tpEmis`

- **Campo:** `tpEmis`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Tipo de emissão da NFS-e:  
    
  1 - Emissão direta no modelo da NFS-e Nacional;  
  2 - Emissão original em leiaute próprio do município com transcrição para o modelo da NFS-e Nacional.
- **Notas explicativas:** O sistema municipal pode emitir a NFS-e seguindo o XML do modelo da NFS-e Nacional ou pode manter seu próprio modelo, diferente do modelo padrão nacional.  
    
  Caso mantenha seu próprio modelo, o município deverá transcrever as informações das suas NFS-e para o modelo da NFS-e nacional e assinar o documento para depois compartilhar as NFS-e transcritas para o ADN NFS-e. Neste caso, tpEmis = 2.  
  Caso o município emita suas NFS-e já no modelo da NFS-e padrão nacional o tpEmis = 1.  
    
  Notas emitidas pela Sistema Nacional NFS-e sempre tem tpEmis = 1.
- **Valores aceitos (domínio identificado):**
  - `1` → Emissão direta no modelo da NFS-e Nacional
  - `2` → Emissão original em leiaute próprio do município com transcrição para o modelo da NFS-e Nacional.

### `NFSe/infNFSe/procEmi`

- **Campo:** `procEmi`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Processo de Emissão da DPS:  
    
  1 - Emissão com aplicativo do contribuinte (via API);  
  2 - Emissão com aplicativo disponibilizado pelo fisco (Web);  
  3 - Emissão com aplicativo disponibilizado pelo fisco (App);
- **Notas explicativas:** Esta informação deve ser preenchida somente em NFS-e emitidas pelo Sistema Nacional NFS-e.  
    
  Municipios com emissores próprios não podem informar este campo na transcrição de suas NFS-e para o compartilhamento com o ADN.
- **Valores aceitos (domínio identificado):**
  - `1` → Emissão com aplicativo do contribuinte (via API)
  - `2` → Emissão com aplicativo disponibilizado pelo fisco (Web)
  - `3` → Emissão com aplicativo disponibilizado pelo fisco (App)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1276` — A informação do processo de emissão de NFS-e é exclusiva para notas emitidas pela Sefin Nacional NFS-e. O município não deve informar este campo nas NFS-e compartilhadas com o ADN NFS-e.
    - Detalhe da regra: Os emissores públicos nacionais devem gerar a NFS-e informando qual o processo de emissão:  1 - Emissão com aplicativo do contribuinte (via Web Service); 2 - Emissão com aplicativo disponibilizado pelo fisco (Web); 3 - Emissão com aplicativo disponibilizado pelo fisco (App);  Verificar se a NFS-e compartilhada pelo município preencheu alguma informação para o processo de emissão.  Este campo não deve ser informado em NFS-e compartilhada com o ADN NFS-e.

### `NFSe/infNFSe/cStat`

- **Campo:** `cStat`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Código de Situações da NFS-e:  
    
  100 - NFS-e Gerada;  
  102 - NFS-e de Decisão Judicial ou Administrativa;  
  103 - NFS-e Avulsa;  
  107 - NFS-e MEI;
- **Valores aceitos (domínio identificado):**
  - `100` → NFS-e Gerada
  - `102` → NFS-e de Decisão Judicial ou Administrativa
  - `103` → NFS-e Avulsa
  - `107` → NFS-e MEI

### `NFSe/infNFSe/dhProc`

- **Campo:** `dhProc`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data/Hora do processamento (geração) NFS-e.  
  Data e hora no formato UTC (Universal Coordinated Time):  
  AAAA-MM-DDThh:mm:ssTZD
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1278` — A data e hora do processamento (geração) da NFS-e deve ser anterior ou igual à data da recepção pelo Sistema Nacional NFS-e.
    - Detalhe da regra: A data e hora do processamento (geração) da NFS-e deve ser anterior ou igual à data e hora da sua recepção pelo Sistema Nacional NFS-e.

### `NFSe/infNFSe/nDFSe`

- **Campo:** `nDFSe`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-13
- **Descrição:** Número sequencial do documento gerado por ambiente gerador de DFe do múnicípio.
- **Notas explicativas:** Valores possiveis 0 até 9999999999999

### `NFSe/infNFSe/emit`

- **Campo:** `emit`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da DPS relativas ao emitente da NFS-e

### `NFSe/infNFSe/emit/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição federal (CNPJ) do emitente da NFS-e.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1280` — CNPJ informado para o emitente da NFS-e é inválido (verificar DV).
    - Detalhe da regra: Verificar se o CNPJ informado para o emitente da NFS-e é válido (verificar DV).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1282` — O CNPJ do emitente não corresponde ao CNPJ do informado conforme o tipo de emitente informado na DPS.
    - Detalhe da regra: Verificar se o CNPJ do emitente corresponde ao CNPJ informado para prestador ou tomador ou intermediário, conforme o valor do campo tpEmit informado na DPS. tpemit = 1 - Prestador, tpemit = 2 - Tomador, tpemit = 3 - Intermediário,

### `NFSe/infNFSe/emit/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição federal (CPF) do emitente da NFS-e.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1284` — CPF informado para o emitente da NFS-e é inválido (verificar DV).
    - Detalhe da regra: Verificar se o CPF informado para o emitente da NFS-e é válido (verificar DV).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1285` — O CPF do emitente não corresponde ao CPF do informado conforme o tipo de emitente informado na DPS.
    - Detalhe da regra: Verificar se o CPF do emitente corresponde ao CPF informado para prestador ou tomador ou intermediário, conforme o valor do campo tpEmit informado na DPS. tpemit = 1 - Prestador, tpemit = 2 - Tomador, tpemit = 3 - Intermediário,

### `NFSe/infNFSe/emit/IM`

- **Campo:** `IM`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15
- **Descrição:** Número do indicador municipal do emitente da NFS-e.

### `NFSe/infNFSe/emit/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 150
- **Descrição:** Nome / Razão Social do emitente.

### `NFSe/infNFSe/emit/xFant`

- **Campo:** `xFant`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 150
- **Descrição:** Nome / Fantasia do emitente.

### `NFSe/infNFSe/emit/enderNac`

- **Campo:** `enderNac`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço nacional do Emitente da NFS-e

### `NFSe/infNFSe/emit/enderNac/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro da localização do endereço do emitente.

### `NFSe/infNFSe/emit/enderNac/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número do imóvel do endereço do emitente.

### `NFSe/infNFSe/emit/enderNac/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do emitente.

### `NFSe/infNFSe/emit/enderNac/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do emitente.

### `NFSe/infNFSe/emit/enderNac/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do emitente.  
  (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1286` — O código do município do emitente da NFS-e difere do código do municipio emissor informado na NFS-e.
    - Detalhe da regra: Verificar se o código do município do emitente da NFS-e corresponde ao código do município emissor (cLocEmi) informado na NFS-e.

### `NFSe/infNFSe/emit/enderNac/UF`

- **Campo:** `UF`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Sigla da unidade da federação do município do endereço do emitente.

### `NFSe/infNFSe/emit/enderNac/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/emit/enderNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Número do CEP do endereço do emitente.  
  (Informar os zeros não significativos)

### `NFSe/infNFSe/emit/fone`

- **Campo:** `fone`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 9-20
- **Descrição:** Número do telefone do emitente.  
  (Preencher com o Código DDD + número do telefone.   
  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `NFSe/infNFSe/emit/email`

- **Campo:** `email`
- **Caminho no XML:** `NFSe/infNFSe/emit/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 80
- **Descrição:** E-mail do emitente.

### `NFSe/infNFSe/valores`

- **Campo:** `valores`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes ao serviço prestado
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1302` — Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores para prestador de serviço optante do simples nacional do tipo MEI.
    - Detalhe da regra: Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o prestador é optante do simples nacional do tipo MEI (opSimpNac = 2).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1303` — Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - Detalhe da regra: Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1307` — Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o prestador de serviço possui algum regime especial de tributação.
    - Detalhe da regra: Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5 ou 6).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1311` — Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando a exigibilidade da tributação do ISSQN estiver suspensa por decisão judicial ou administrativa.
    - Detalhe da regra: Exceto para o campo vLiq, não é permitido informar os demais campos do grupo valores quando estiver indicado na DPS que a tributação do ISSQN está com sua exigibilidade suspensa, seja administrativamente ou judicialmente, ou seja, o campo que indica a suspensão da exigibilidade está informado na DPS (tpSUSP = 1 ou 2).
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este grupo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este grupo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este grupo deve ser informado
    - Detalhe da regra: Este grupo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/valores/vCalcAjusteBCISSQN`

- **Campo:** `vCalcAjusteBCISSQN`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário (R$) do ajuste (dedução/redução) da base de cálculo (BC) do ISSQN.
- **Notas explicativas:** vCalcAjusteBCISSQN é:  
    
  O valor monetário calculado a partir do percentual de ajuste (dedução/redução) da BC do ISSQN, informado pelo emitente no campo pAjusteBCISSQN da DPS. Este percentual é calculado sobre valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e;  
  e/ou  
  A soma dos valores de ajuste (dedução/redução) da BC do ISSQN, informados no campo vAjusteAplic, relativo a um ou mais documentos informados nos campos do grupo docAjusteBC pelo emitente na DPS. Neste caso, o resultado do somatório é o valor deste campo do leiaute NFS-e quando os tipos dos documentos não forem (105 - "Glosa de Serviços de Saúde");
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1287` — O valor calculado de ajuste (dedução/redução) não corresponde aos valores de (valor do serviço x percentual de ajuste (dedução/redução)), quando pAjusteBCISSQN é informado na DPS e/ou ao somatório dos valores do campo vAjusteBC, quando um ou mais documentos são informados para ajuste (dedução/redução) da base de cálculo do ISSQN.
    - Detalhe da regra: vCalcAjusteBCISSQN é o valor monetário calculado a partir do percentual de ajuste (dedução/redução) da BC do ISSQN, informado pelo emitente no campo pAjusteBCISSQN da DPS. Este percentual é calculado sobre valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e e/ou A soma dos valores de ajuste (dedução/redução) da BC do ISSQN informados no campo vAjusteAplic, relativo a um ou mais documentos informados nos campos do grupo docAjusteBC pelo emitente na DPS. Neste caso, o resultado do somatório é o valor deste campo do leiaute NFS-e quando os tipos dos documentos não forem (105 - "Glosa de Serviços de Saúde").

### `NFSe/infNFSe/valores/tpBM`

- **Campo:** `tpBM`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 40
- **Descrição:** Tipo Benefício Municipal (BM):  
    
  1 ) "Isenção";  
  2) "Redução da BC em 'ppBM' %";  
  3) "Redução da BC em R$ 'vInfoBM' ";  
  4) "Alíquota Diferenciada de 'aliqDifBM' %";
- **Notas explicativas:** Onde, nos itens abaixo:  
    
   3) ppBM é o percentual parametrizado pelo município de incidência para redução da base de cálculo do benefício municipal concedido;  
    
  4) vInfoBM é o valor informado na DPS da redução da base de cálculo do benefício municipal concedido;  
    
  5) aliqDifBM é o percentual parametrizado pelo município de incidência para alíquota diferenciada do benefício municipal concedido;

### `NFSe/infNFSe/valores/vCalcBM`

- **Campo:** `vCalcBM`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário (R$) do percentual de redução da base de cálculo (BC) do ISSQN devido a um benefício municipal (BM).
- **Notas explicativas:** Este valor é:  
    
  o cálculo do valor de redução da BC do ISSQN, quando um percentual é parametrizado pelo município de incidência na lei de BM, que foi informada pelo emitente na DPS. Neste caso o percentual parametrizado é aplicado sobre o valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e;
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1288` — O valor calculado do percentual de redução da base de cálculo por Benefício Municipal não corresponde aos valores de (valor do serviço x percentual de benefício municipal), quando pRedBCBM é informado na DPS.
    - Detalhe da regra: vCalcBM é o valor mmonetário calculado a partir do percentual  de BM, que foi informada no campo pRedBCBM da DPS. Neste caso o percentual é aplicado sobre o valor do serviço informado na DPS e o resultado calculado é o valor deste campo do leiaute NFS-e.

### `NFSe/infNFSe/valores/vBC`

- **Campo:** `vBC`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da Base de Cálculo do ISSQN (R$) = Valor do Serviço - Desconto Incondicionado - Ajustes (Deduções/Reduções) - Benefício Municipal  
     
   vBC = vServ - descIncond - (vAjusteBCISSQN + vCalcAjusteBCISSQN) - (vRedBCBM ou VCalcBM)
- **Notas explicativas:** A Base de Cálculo do ISSQN é igual a valor do serviço menos a soma dos seguintes valores: desconto incondicionado, total de ajustes (deduções/reduções) e benefício municipal.  
     
   Sendo que:  
   1 - Quando o valor do ajuste (dedução/redução) for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado.  
     
   2 - Quando o valor do benefício municipal for apurado a partir de um percentual parametrizado para redução da base de cálculo, aplicar o percentual parametrizado sobre o valor do serviço já abatidos os valores do desconto incondicionado e de ajuste (dedução/redução).  
    
  OBS: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) são formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via.
- **Valores aceitos (domínio identificado):**
  - `1` → Quando o valor do ajuste (dedução/redução) for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1295` — Valor da Base de cálculo para ISSQN incorreto.
    - Detalhe da regra: O valor da base de cálculo do ISSQN (vBC) é calculado a partir de valores informados na NFS-e:  Valor da BC = Valor do serviço - Desconto incondicionado - Valores monetário de ajuste (Dedução/Redução) do ISSQN - Valor monetário de Benerfício Municipal.  vBC = vServ - vDescIncond - (vAjusteBCISSQN + vCalcAjusteBCISSQN) - (vRedBCBM ou vCalcBM)
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1297` — O valor BC calculado não pode estar reduzida de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - Detalhe da regra: O valor BC calculado não pode estar reduzida de forma que resulte para valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços: 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.

### `NFSe/infNFSe/valores/pAliqAplic`

- **Campo:** `pAliqAplic`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota aplicada sobre a base de cálculo para apuração do ISSQN.
- **Notas explicativas:** A - O valor percentual da aliquota aplicada (%) poderá ser:  
     
   1) o percentual de alíquota informado pelo emitente, referente ao código de serviço, que foi informado na DPS do município de incidência do ISSQN, que identificado pelo sistema, mas que não é conveniado ao Sistema Nacional NFS-e;  
     
   2) o percentual de alíquota previamente parametrizado pelo município de incidência no código de serviço, que foi indicado pelo emitente na DPS, quando o município de incidência do ISSQN identificado pelo sistema é conveniado ao Sistema Nacional NFS-e;  
     
   3) o percentual de alíquota diferenciada, previamente parametrizada pelo município de incidência do ISSQN, no benefício municipal que foi indicado pelo emitente na DPS (quando este benefício municipal referir-se a uma alíquota diferenciada e forem satisfeitas as condições de aplicabilidade deste benefício municipal às informações prestadas pelo emitente na DPS;  
     
   *A ordem de prioridade para a utilização da aliquota aplicada é decrescente conforme itens acima.   
   Um alíquota parametrizada sobrepõem uma alíquota informada na DPS e uma alíquota diferenciada, proveniente de um benefício municipal indicado na DPS, satisfeitas as condições de aplicabilidade deste benefício municipal às informações prestadas pelo emitente na DPS, sobrepõem uma alíquota parametrizada pelo município no código de tributação nacional ou municipal (se for o caso).  
     
   *Considerar data de competência informada na DPS para recuperar a alíquota em qualquer um dos casos.  
     
   B - Se o emitente informar na DPS para o campo Regime Especial de Tributação, "Profissional Autônomo" ou "Sociedade de Profissionais", e para o campo Exigibilidade, "Exigível", não há destaque de ISSQN na NFS-e. Os campos pAliqAplic, vISSQN da NFS-e não contém valor.  
    
   OBS: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1300` — Não é permitido informar alíquota aplicada superior a 5%.

### `NFSe/infNFSe/valores/vISSQN`

- **Campo:** `vISSQN`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do ISSQN (R$) = Valor da Base de Cálculo x Alíquota  
    
  vISSQN = vBC x pAliqAplic
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1289` — O produto do valor da base de cálculo pela alíquota aplicada, ambos informados na NFS-e compartilhada, não está de acordo com o resultado cálculado pelo sistema (vBC x pAliAplic).
    - Detalhe da regra: O valor do ISSQN informado na NFS-e (vISSQN) deve ser igual ao produto da base de cálculo pela alíquota aplicada (vBC x pAliqAPlic).

### `NFSe/infNFSe/valores/vTotalRet`

- **Campo:** `vTotalRet`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor total das retenções de tributos da NFS-e.  
    
  Valor total de retenções (R$) = Σ(vRetCP + vRetIRRF+ vRetCSLL + ISSQN*)
- **Notas explicativas:** Os tributos Contribuição Patronal (vRetCP), Imposto de Renda Retido na Fonte (vRetIRRF) e Contribuição Social  (vRetCSLL)  
    
  *Para o resultado do valor total de retenções o ISSQN somente será somado quando for retido.  
  ISSQN pode não sofrer retenção.  
  (verificar o campo tpRetISSQN. Se for igual a 1 então valor do ISSQN não deverá ser somado a vTotalRet.   
  Se for igual a 2 ou 3 deverá ser somado ao valor de vTotalRet).  
    
  **Para o resultado do valor total de retenções Pis/Cofins somente serão somados quando forem retidos.  
  Pis/Cofins podem não sofrer retenção.  
  Somar os valores de Pis/Cofins a vTotalRet conforme os possíveis valores para o campo tpRetPisCofins informado na DPS  
  1 - PIS/COFINS Retido;  
  2 - PIS/COFINS Não Retido;  
  3 - PIS Retido/COFINS Não Retido;  
  4 - PIS Não Retido/COFINS Retido;
- **Valores aceitos (domínio identificado):**
  - `1` → PIS/COFINS Retido
  - `2` → PIS/COFINS Não Retido
  - `3` → PIS Retido/COFINS Não Retido
  - `4` → PIS Não Retido/COFINS Retido
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1506` — Valor total de tributos retidos da NFS-e incorreto.
    - Detalhe da regra: O valor total da retenção da NFS-e não pode ser inferior a zero.  O valor total da retenção da NFS-e é calculado a partir de valores que constam na DPS através do seguinte cálculo:  Valor total de retenções (R$) = Σ(vRetCP + vRetIRRF+ vRetCSLL + ISSQN*)  vTotalRet = vRetCP + vRetIRRF + vRetCSLL + vISSQN*

### `NFSe/infNFSe/valores/vLiq`

- **Campo:** `vLiq`
- **Caminho no XML:** `NFSe/infNFSe/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor líquido da NFS-e.  
    
  Valor líquido (R$) = Valor do serviço - Desconto condicionado - Desconto incondicionado - Valores retidos (vTotalRet)
- **Notas explicativas:** *Para o resultado do Valor Líquido o CP, IRRF e CSLL serão sempre subtraídos, se constarem na DPS, pois sempre são retidos.  
    
  **Para o resultado do Valor Líquido o ISSQN, PIS e COFINS somente serão subtraídos quando forem retidos.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1508` — Valor líquido da NFS-e incorreto.
    - Detalhe da regra: O valor líquido da NFS-e não pode ser inferior a zero.  O valor líquido da NFS-e é calculado a partir de valores que constam na DPS através do seguinte cálculo:  Valor líquido (R$) = Valor do serviço - Desconto condicionado - Desconto incondicionado - Valores retidos     VLiq = vServ – vDescIncond – vDescCond – vTotalRet

### `NFSe/infNFSe/xOutInf`

- **Campo:** `xOutInf`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2000
- **Descrição:** Uso da Administração Tributária Municipal.
- **Notas explicativas:** O Sistema Nacional NFS-e deverá incluir estas mensagens quando:  
    
  1) ocorrer os cenários 28 e 34, conforme a planilha "COMEX - EXPORTAÇÃO DE SERVIÇO" do AnexoI-LeiautesRN_DPS_NFSe-SNNFSe.  
    
  "Por não se tratar de um caso de Exportação de serviço ou Imunidade tributária, então, para este cenário em que foi informado que o tomador do serviço está no exterior e o serviço prestado é devido no local do estabelecimento do tomador, o sujeito passivo será o prestador do serviço e o local de incidência do ISSQN será o local da prestação do serviço, conforme os parágrafos 1º e 2º do Art. 127 do CTN."

### `NFSe/infNFSe/IBSCBS`

- **Campo:** `IBSCBS`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações geradas pelo sistema referentes ao IBS e à CBS
- **Notas explicativas:** Para optantes dos Simples Nacional, os grupos IBSCBS só serão obrigatórios a partir de 2027.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1515` — É obrigatório informar o grupo de informações de IBS/CBS da NFS-e quando o grupo de informações de IBS/CBS da DPS for informado.
    - Detalhe da regra: Se o grupo de informações de IBS/CBS da DPS (NFSe/infNFSe/DPS/infDPS/IBSCBS/) for informado,  então o grupo de informações de IBS/CBS da NFS-e deve ser informado obrigatoriamente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1517` — Não é permitido informar o grupo de informações de IBS/CBS da NFS-e quando o grupo de informações de IBS/CBS da DPS não for informado.
    - Detalhe da regra: Se o grupo de informações de IBS/CBS da DPS (NFSe/infNFSe/DPS/infDPS/IBSCBS/) não for informado,  então não é permitido informar o grupo de informações de IBS/CBS da NFS-e.

### `NFSe/infNFSe/IBSCBS/cLocalidadeIncid`

- **Campo:** `cLocalidadeIncid`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 7
- **Descrição:** Código IBGE da localidade de incidência do IBS/CBS (local da operação).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1521` — Código da localidade de incidência diverge do que deveria ser informado de acordo com a tabela de indicador da operação.
    - Detalhe da regra: O código da localidade de incidência informado deve estar de acordo com o código de indicador da operação. A tabela de indicadores das operações deve ser observada. (Anexo B). Para os casos de endereço no exterior, deve ser igual a "999999"
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/IBSCBS/xLocalidadeIncid`

- **Campo:** `xLocalidadeIncid`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 600
- **Descrição:** Nome da localidade de incidência do IBS/CBS.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/IBSCBS/pRedutor`

- **Campo:** `pRedutor`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-2V2
- **Descrição:** Percentual de redução de aliquota em compra governamental.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1522` — O percentual redutor para compras governamentais (IBS/CBS) não deve ser informado.
    - Detalhe da regra: O percentual redutor para compras governamentais só deve ser informando se tpEnteGov foi informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1523` — O percentual redutor para compras governamentais (IBS/CBS) deve ser informado.
    - Detalhe da regra: O percentual redutor para compras governamentais deve ser informado se tpEnteGov foi informado na DPS.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado.
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O percentual de redução de alíquota em compra governamental não deve ser informado quando o prestador de serviços for optante do regime do simples nacional.
    - Detalhe da regra: O percentual de redução de alíquota em compra governamental não deve ser informado se opSimpNac <> 1 (Não Optante).

### `NFSe/infNFSe/IBSCBS/valores`

- **Campo:** `valores`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores brutos referentes ao IBS / CBS
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/IBSCBS/valores/vBC`

- **Campo:** `vBC`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da base de cálculo (BC) do IBS/CBS antes das reduções para cálculo do tributo bruto.   
    
  vBC = vServ - descIncond – (vCalcAjusteBCIBSCBS ou vCalcAjusteBCLocImoveis) – vISSQN – vPIS - vCOFINS (até 2026)  
    
  ou  
    
  vBC = vServ - descIncond – (vCalcAjusteBCIBSCBS ou vCalcAjusteBCLocImoveis) – vISSQN (a partir de 2027 até 2032)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1530` — Valor da Base de cálculo para IBS/CBS incorreto.
    - Detalhe da regra: O valor da base de cálculo do IBS/CBS (vBC) é calculado a partir de valores informados na NFS-e:  (de 01/01/2026 até 31/12/2026) vBC = vServ - descIncond – vCalcAjusteBCIBSCBS – vISSQN – vPIS - vCOFINS (até 2026) ou (de 01/01/2027 até 31/12/2032) vBC = vServ - descIncond – vCalcAjusteBCIBSCBS - vISSQN (a partir de 2027 até 2032)  ou  Para códigos de tributação nacional do subitem 99.03:  vBC = vServ - descIncond – vCalcAjusteBCLocImoveis – vISSQN – vPIS - vCOFINS (até 2026)  ou  vBC = vServ - descIncond – vCalcAjusteBCLocImoveis - vISSQN (a partir de 2027 até 2032)
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 04 ou 06, este campo deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 01, este campo deve ser informado.

### `NFSe/infNFSe/IBSCBS/valores/vCalcAjusteBCIBSCBS`

- **Campo:** `vCalcAjusteBCIBSCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário (R$) total relativo a glosa de serviços de saúde ou a operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor, devidamente referenciados, e que não integram da base de cálculo (BC) do IBS e da CBS.
- **Notas explicativas:** vCalcAjusteBCIBSCBS é:  
    
  A soma dos valores de ajuste da BC do IBS e da CBS, quando um ou mais documentos são informados nos campos vAjusteBC pelo emitente na DPS. Neste caso, o resultado do somatório é o valor deste campo do leiaute NFS-e quando os tipos dos documentos forem relacionados a glosa de serviços de saúde ou operações de terceiros, objeto de reembolso, repasse ou ressarcimento pelo recebedor, correspondentes aos códigos 105 a 199 em tpAjusteBC;
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1531` — O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) não deve ser informado.
    - Detalhe da regra: O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) não deve ser informado se o grupo de documentos referenciados que irão compor o valor não foi informado na DPS (vAjusteBC) ou se os tipos informados em tpAjusteBC forem (2, 5, 6, 7, 8, 9 e 99)
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1533` — O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) deve ser informado.
    - Detalhe da regra: O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) deve ser informado se o grupo de documentos referenciados que irão compor o valor foi informado na DPS e se houver algum documento com tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1534` — O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) deve ser menor que o valor do serviço prestado.
    - Detalhe da regra: O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) deve ser menor que o valor do serviço informado na DPS.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1535` — O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) incorreto.
    - Detalhe da regra: O valor objeto de reembolso, repasse ou ressarcimento já tributados que não integram da base de cálculo do ISSQN, do IBS e da CBS (vCalcAjusteBCIBSCBS) deve ser igual à soma dos valores de documentos referenciados informados na DPS e que possuem tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.

### `NFSe/infNFSe/IBSCBS/valores/vCalcAjusteBCLocImoveis`

- **Campo:** `vCalcAjusteBCLocImoveis`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário (R$) total relativo aos valores de ajuste (dedução/redução) da Base de Cálculo do IBS e da CBS referentes às operações de locação, cessão onerosa ou arrendamento de bens imóveis. Apenas para os subitens 99.03.
- **Notas explicativas:** Campo é o somatório dos ajustes (deduções/reduções) do grupo gAjusteBCLocImoveis multiplicado pelo pCopropriedade.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de dedução/redução do IBS e da CBS (vCalcAjusteBCLocImoveis) não deve ser informado.
    - Detalhe da regra: O valor calculado de ajuste (dedução/redução) do IBS e da CBS (vCalcAjusteBCLocImoveis) não deve ser informado se o grupo de informações que irá compor o valor (gAjusteBCLocImoveis) não foi informado na DPS.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de dedução/redução do IBS e da CBS (vCalcAjusteBCLocImoveis) deve ser informado.
    - Detalhe da regra: O valor calculado de ajuste (dedução/redução) do IBS e da CBS (vCalcAjusteBCLocImoveis) deve ser informado se o grupo de informações que irá compor o valor (gAjusteBCLocImoveis) foi informado na DPS.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de dedução/redução do IBS e da CBS (vCalcAjusteBCLocImoveis) deve ser menor que o valor do serviço prestado.
    - Detalhe da regra: O valor calculado de ajuste (dedução/redução) do IBS e da CBS (vCalcAjusteBCLocImoveis) deve ser menor ou igual ao valor do serviço informado na DPS (vServ = pCopropriedade x vTotOper).
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de dedução/redução do IBS e da CBS (vCalcAjusteBCLocImoveis) está incorreto.
    - Detalhe da regra: O valor calculado de ajuste (dedução/redução) do IBS e da CBS (vCalcAjusteBCLocImoveis) deve ser igual à soma dos valores informados na DPS (gAjusteBCLocImoveis) x o percentual de copropriedade (pCopropriedade).
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de dedução/redução do IBS e da CBS (vCalcAjusteBCLocImoveis) não deve ser informado.
    - Detalhe da regra: O valor calculado de dedução/redução do IBS e da CBS (vCalcAjusteBCLocImoveis) não deve ser informado se opSimpNac = 2 ou 3.

### `NFSe/infNFSe/IBSCBS/valores/vReceitaBrutaSN`

- **Campo:** `vReceitaBrutaSN`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da Receita Bruta para os Optantes do Simples Nacional.  
    
  vReceitaBrutaSN = vServ - descIncond - vCalcAjusteBCIBSCBS - vCalcAjusteBCISSQN*  
    
  *apenas quando o valor calculado se referir à soma a partir de docAjusteBC/tpAjusteBC do tipo = "9 - Profissional parceiro"
- **Notas explicativas:** Segregação entre Receita Interna e Externa pelo cClassTrib.  
  O Valor da Receita Bruta será externa quando o cClassTrib for 410004, 410027 ou 200001.  
    
  Deve-se deduzir da receita bruta os valores informados pelo salão quando tpAjusteBC = 9 ("Profissional parceiro")
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de receita bruta para os optantes do simples nacional não deve ser informado.
    - Detalhe da regra: O valor calculado de receita bruta para os optantes do simples nacional não deve ser informado se opSimpNac = 1.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de receita bruta para os optantes do simples nacional deve ser informado.
    - Detalhe da regra: O valor calculado de receita bruta para os optantes do simples nacional deve ser informado se opSimpNac = 2, 3 ou 4.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de receita bruta para os optantes do simples nacional deve considerar (subtrair) os valores informados em vCalcAjusteBCISSQN quando cTribNac igual a 6.01 ou 6.02, tpAjusteBC igual a 9 (Profissional Parceiro) e regApIBSCBSSN igual a 1 ou 2 (CBS e/ou IBS apurados pelo SN).
    - Detalhe da regra: Quando o código de tributação nacional (cTribNac) = 6.01 ou 6.02 e o tipo da ajuste por documentos (tpAjusteBC) = 9 (Profissional Parceiro) e o regime de apuração tributária pelo simples nacional (regApIBSCBSSN) = 1 ou 2 (CBS e/ou IBS apurados pelo SN), o vReceitaBrutaSN = vServ - descIncond - vCalcAjusteBCIBSCBS - vCalcAjusteBCISSQN
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor calculado de receita bruta para os optantes do simples nacional não deve considerar (subtrair) os valores informados em vCalcAjusteBCISSQN quando cTribNac igual a 6.01 ou 6.02, tpAjusteBC igual a 9 (Profissional Parceiro) e regApIBSCBSSN igual a 3 (IBS/CBS apurados pelo Reg. Regular).
    - Detalhe da regra: Quando o código de tributação nacional (cTribNac) = 6.01 ou 6.02 e o tipo do ajuste por documentos (tpAjusteBC) = 9 (Profissional Parceiro) e o regime de apuração tributária pelo simples nacional (regApIBSCBSSN) = 3 (IBS/CBS apurados pelo Reg. regular), o vReceitaBrutaSN = vServ - descIncond - vCalcAjusteBCIBSCBS

### `NFSe/infNFSe/IBSCBS/valores/uf`

- **Campo:** `uf`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de Informações relativas aos valores do IBS Estadual

### `NFSe/infNFSe/IBSCBS/valores/uf/pIBSUF`

- **Campo:** `pIBSUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/uf/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota da UF para IBS da localidade de incidência parametrizada no sistema.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1539` — Alíquota da UF para IBS incorreta.
    - Detalhe da regra: A alíquota da UF para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSUF/pIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/uf/pRedAliqUF`

- **Campo:** `pRedAliqUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/uf/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-3V2
- **Descrição:** Percentual de redução de alíquota estadual.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1540` — O percentual redutor de alíquota para o IBS estadual não deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS estadual não deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS não possuir essa indicação.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1541` — O percentual redutor de alíquota para o IBS estadual deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS estadual deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS possuir essa indicação.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1543` — O percentual redutor de alíquota para o IBS estadual informado difere do indicado para o o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS estadual informado deve ser o mesmo indicado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1557` — Percentual redutor de alíquota para o IBS estadual incorreto.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS estadual deve ser igual ao valor IBSCBS/gIBSCBS/gIBSUF/gRed/pRedAliq retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/uf/pAliqEfetUF`

- **Campo:** `pAliqEfetUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/uf/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** pAliqEfetUF = pIBSUF x (1 - pRedAliqUF) x (1 - pRedutor)  
    
  Se pRedAliqUF não for informado na DPS, então pAliqEfetUF é a própria pIBSUF.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1577` — Alíquota efetiva da UF para IBS incorreta.
    - Detalhe da regra: A alíquota efetiva da UF para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSUF/gRed/pAliqEfet retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/mun`

- **Campo:** `mun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de Informações relativas aos valores do IBS Municipal

### `NFSe/infNFSe/IBSCBS/valores/mun/pIBSMun`

- **Campo:** `pIBSMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/mun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do Município para IBS da localidade de incidência parametrizada   
  no sistema.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1578` — Alíquota do Município para IBS incorreta.
    - Detalhe da regra: A alíquota do Município para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSMun/pIBSMun retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/mun/pRedAliqMun`

- **Campo:** `pRedAliqMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/mun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-3V2
- **Descrição:** Percentual de redução de alíquota municipal.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1545` — O percentual redutor de alíquota para o IBS municipal não deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS municipal não deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS não possuir essa indicação.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1546` — O percentual redutor de alíquota para o IBS municipal deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS municipal deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS possuir essa indicação.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1547` — O percentual redutor de alíquota para o IBS municipal informado difere do indicado para o o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para o IBS municipal informado deve ser o mesmo indicado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1548` — Percentual de redução de alíquota municipal incorreto.
    - Detalhe da regra: O percentual de redução de alíquota municipal deve ser igual ao valor IBSCBS/gIBSCBS/gIBSMun/gRed/pRedAliq retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/mun/pAliqEfetMun`

- **Campo:** `pAliqEfetMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/mun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** pAliqEfetMun = pIBSMun x (1 - pRedAliqMun) x (1 - pRedutor)  
    
  Se pRedAliqMun não for informado na DPS, então pAliqEfetMun é a própria pIBSMun.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1549` — Alíquota efetiva do Município para IBS incorreta.
    - Detalhe da regra: A alíquota efetiva do Município para IBS deve ser igual ao valor IBSCBS/gIBSCBS/gIBSMun/gRed/pAliqEfet retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/fed`

- **Campo:** `fed`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de Informações relativas aos valores da CBS

### `NFSe/infNFSe/IBSCBS/valores/fed/pCBS`

- **Campo:** `pCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/fed/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota da União para CBS parametrizada no sistema.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1558` — Alíquota da União para CBS incorreta.
    - Detalhe da regra: A alíquota da União para CBS deve ser igual ao valor IBSCBS/gIBSCBS/gCBS/pCBS retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/fed/pRedAliqCBS`

- **Campo:** `pRedAliqCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/fed/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-3V2
- **Descrição:** Percentual da redução de alíquota da CBS.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1550` — O percentual redutor de alíquota para a CBS não deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para a CBS não deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS não possuir essa indicação.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1551` — O percentual redutor de alíquota para a CBS deve ser informado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para a CBS deve ser informado se o código da classificação tributária - cClassTribIBSCBS informado na DPS possuir essa indicação.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1552` — O percentual redutor de alíquota para a CBS informado difere do indicado para o o código da classificação tributária - cClassTribIBSCBS informado na DPS.
    - Detalhe da regra: O percentual redutor de alíquota para a CBS informado deve ser o mesmo indicado para o código da classificação tributária - cClassTribIBSCBS informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1553` — Percentual redutor de alíquota para a CBS incorreto.
    - Detalhe da regra: O percentual redutor de alíquota para a CBS deve ser igual ao valor IBSCBS/gIBSCBS/gCBS/gRed/pRedAliq retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/valores/fed/pAliqEfetCBS`

- **Campo:** `pAliqEfetCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/valores/fed/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** pAliqEfetCBS = pCBS x (1 - pRedAliqCBS) x (1 - pRedutor)  
    
  Se pRedAliqCBS não for informado na DPS, então pAliqEfetCBS é a própria pCBS.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1554` — Alíquota efetiva da União para CBS incorreta.
    - Detalhe da regra: A alíquota efetiva da União para CBS deve ser igual ao valor IBSCBS/gIBSCBS/gCBS/gRed/pAliqEfet retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS`

- **Campo:** `totCIBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de Totalizadores

### `NFSe/infNFSe/IBSCBS/totCIBS/vTotNF`

- **Campo:** `vTotNF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor Total da NF considerando os impostos por fora: IBS e CBS.  
  O IBS e a CBS são por fora, por isso seus valores devem ser adicionados ao valor total da NF.  
    
   vTotNF = vLiq (em 2026)  
    
   vTotNF = vLiq + vCBS + vIBSTot (a partir de 2027)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1555` — Valor total da NFS-e está incorreto.
    - Detalhe da regra: Quando opSimpNac = 1 (Não Optante ) ou 4 (Pendente); ou 3 (ME/EPP) e regApIBSCBSSN = 3 (CBS/IBS pelo Reg. Regular), o valor total da NFS-e considerando os impostos por fora (IBS e CBS) é calculado a partir dos valores informados na NFS-e: vTotNF = vLiq (em 2026) vTotNF = vLiq + vCBS + vIBSTot (a partir de 2027)  ou  Quando opSimpNac = 3 (ME/EPP) e regApIBSCBSSN = 1 (CBS/IBS pelo SN), o valor total da NFS-e considerando o IBS e CBS calculados na forma do Simples Nacional é calculado a partir dos valores informados na NFS-e: vTotNF = vLiq (em 2026 e a partir de 2027)  ou  Quando opSimpNac = 3 (ME/EPP) e regApIBSCBSSN = 2 (CBS pelo SN e IBS pelo Reg. Regular), o valor total da NFS-e considerando a CBS calculado na forma do Simples Nacional e o IBS na forma do regime regular é calculado a partir dos valores informados na NFS-e: vTotNF = vLiq (em 2026) vTotNF = vLiq + vIBSTot (a partir de 2027).

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS`

- **Campo:** `gIBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes ao IBS

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/vIBSTot`

- **Campo:** `vIBSTot`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor total do IBS.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1556` — Valor total do IBS incorreto.
    - Detalhe da regra: O valor total do IBS deve ser igual ao valor total/IBSCBSTot/vIBS retornado pela Calculadora
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor total do IBS incorreto.
    - Detalhe da regra: Quando opSimpNac = 1 (Não Optante ) ou 4 (Pendente); ou 3 (ME/EPP) e regApIBSCBSSN = 2 (CBS pelo SN e IBS pelo Reg. Regular) ou 3 (CBS/IBS pelo Reg. Regular)  o valor total do IBS deve ser igual ao valor total/IBSCBSTot/vIBS retornado pela Calculadora (soma de vIBSUF + vIBSMun)
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor total do IBS não deve ser informado quando o prestador de serviço for optante pelo regime do Simples Nacional.
    - Detalhe da regra: Quando opSimpNac = 3 (ME/EPP) e regApIBSCBSSN = 1 (CBS/IBS pelo SN), o valor total do IBS não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor do ajuste do IBS deve ser informado ser igual ao vIBSTot.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não será retornado pela Calculadora, mas definido pelo valor informado em NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vIBS
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor do ajuste do IBS deve ser informado ser igual ao vIBSTot.
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não será retornado pela Calculadora, mas definido pelo valor informado em NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vIBS.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor total do IBS incorreto.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 04 ou 06; ou Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 01, este campo será igual ao valor total/IBSCBSTot/vIBS retornado pela Calculadora.

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres`

- **Campo:** `gIBSCredPres`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes ao crédito presumido para IBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1560` — Grupo crédito presumido para IBS não deve ser informado.
    - Detalhe da regra: O grupo de crédito presumido para IBS não deve ser informado se o código do crédito presumido - cCredPres não foi informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1561` — Grupo crédito presumido para IBS deve ser informado.
    - Detalhe da regra: O grupo de crédito presumido para IBS deve ser informado se o código do crédito presumido - cCredPres foi informado na DPS.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/pCredPresIBS`

- **Campo:** `pCredPresIBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do crédito presumido para o IBS

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/vCredPresIBS`

- **Campo:** `vCredPresIBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSCredPres/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do Crédito Presumido para o IBS  
    
  vCredPresIBS = vBC x pCredPresIBS

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot`

- **Campo:** `gIBSUFTot`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes ao IBS Estadual
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/vDifUF`

- **Campo:** `vDifUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Total do Diferimento do IBS estadual.  
    
  vDifUF = vIBSUF x pDifUF
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1565` — Valor do diferimento para o IBS estadual não deve ser informado.
    - Detalhe da regra: O valor do diferimento para o IBS estadual não deve ser informado se não foi informada, na DPS, a alíquota para o diferimento do IBS estadual - pDifUF.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1566` — Valor do diferimento para o IBS estadual deve ser informado.
    - Detalhe da regra: O valor do diferimento para o IBS estadual deve ser informado se foi informada, na DPS, a alíquota para o diferimento do IBS estadual - pDifUF.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1567` — Valor do diferimento para o IBS estadual incorreto.
    - Detalhe da regra: O valor do diferimento para o IBS estadual deve ser igual ao valor total/IBSCBSTot/gIBSUF/vDif retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/vIBSUF`

- **Campo:** `vIBSUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSUFTot/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Total valor do IBS estadual.  
    
  vIBSUF = vBC x (pIBSUF ou pAliqEfetUF)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1568` — Valor total do IBS estadual incorreto.
    - Detalhe da regra: O valor total do IBS estadual deve ser igual ao valor total/IBSCBSTot/gIBSUF/vIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot`

- **Campo:** `gIBSMunTot`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes ao IBS Municipal
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/vDifMun`

- **Campo:** `vDifMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Total do Diferimento do IBS municipal.  
    
  vDifMun = vIBSMun x pDifMun
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1569` — Valor do diferimento para o IBS municipal não deve ser informado.
    - Detalhe da regra: O valor do diferimento para o IBS municipal não deve ser informado se não foi informada, na DPS, a alíquota para o diferimento do IBS municipal - pDifMun.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1570` — Valor do diferimento para o IBS municipal deve ser informado.
    - Detalhe da regra: O valor do diferimento para o IBS municipal deve ser informado se foi informada, na DPS, a alíquota para o diferimento do IBS municipal - pDifMun.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1571` — Valor do diferimento para o IBS municipal incorreto.
    - Detalhe da regra: O valor do diferimento para o IBS municipal deve ser igual ao valor total/IBSCBSTot/gIBSMun/vDif retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/vIBSMun`

- **Campo:** `vIBSMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gIBS/gIBSMunTot/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Total valor do IBS municipal.  
    
  vIBSMun = vBC x (pIBSMun ou pAliqEfetMun)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1572` — Valor total do IBS municipal incorreto.
    - Detalhe da regra: O valor total do IBS municipal deve ser igual ao valor total/IBSCBSTot/gIBSMun/vIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gCBS`

- **Campo:** `gCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes à CBS

### `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres`

- **Campo:** `gCBSCredPres`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de valores referentes ao crédito presumido para CBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1575` — Grupo crédito presumido para CBS não deve ser informado.
    - Detalhe da regra: O grupo de crédito presumido para CBS não deve ser informado se o código do crédito presumido - cCredPres não foi informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1576` — Grupo crédito presumido para CBS deve ser informado.
    - Detalhe da regra: O grupo de crédito presumido para CBS deve ser informado se o código do crédito presumido - cCredPres também foi informado na DPS.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/pCredPresCBS`

- **Campo:** `pCredPresCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do crédito presumido para a CBS

### `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/vCredPresCBS`

- **Campo:** `vCredPresCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/gCBSCredPres/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do Crédito Presumido da CBS.  
    
  vCredPresCBS = vBC x pCredPresCBS

### `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/vDifCBS`

- **Campo:** `vDifCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Total do Diferimento CBS.  
    
  vDifCBS = vCBS x pDifCBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1570` — Valor do diferimento para a CBS não deve ser informado.
    - Detalhe da regra: O valor do diferimento para a CBS não deve ser informado se foi não informada, na DPS, a alíquota para o diferimento da CBS - pDifCBS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1580` — Valor do diferimento para a CBS deve ser informado.
    - Detalhe da regra: O valor do diferimento para a CBS deve ser informado se foi informada, na DPS, a alíquota para o diferimento da CBS - pDifCBS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1581` — Valor do diferimento para a CBS incorreto.
    - Detalhe da regra: O valor do diferimento para a CBS deve ser igual ao valor total/IBSCBSTot/gCBS/vDif retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/vCBS`

- **Campo:** `vCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Total valor da CBS da União.
- **Notas explicativas:** vCBS = vBC x (pCBS ou pAliqEfetCBS).  
  Nota de Ajuste: vCBS = NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vCBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1582` — Valor total da CBS da União incorreto.
    - Detalhe da regra: O valor total da CBS da União deve ser igual ao valor total/IBSCBSTot/gCBS/vCBS retornado pela Calculadora
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor total da CBS da União incorreto.
    - Detalhe da regra: Quando opSimpNac = 1 (Não Optante ) ou 4 (Pendente); ou 3 (ME/EPP) e regApIBSCBSSN = 3 (CBS/IBS pelo Reg. Regular)  o valor total do CBS da União deve ser igual ao valor total/IBSCBSTot/gCBS/vCBS retornado pela Calculadora.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor total da CBS da União não deve ser informado quando o prestador de serviço for optante pelo regime do Simples Nacional.
    - Detalhe da regra: Quando opSimpNac = 3 (ME/EPP) e regApIBSCBSSN = 1 (CBS/IBS pelo SN) ou 2 (CBS pelo SN e IBS pelo Reg. Regular), o valor total da CBS da União não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor do ajuste da CBS deve ser informado e ser igual ao valor total da CBS.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não será retornado pela Calculadora, mas definido pelo valor informado em NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vCBS
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor do ajuste da CBS deve ser informado e ser igual ao valor total da CBS.
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não será retornado pela Calculadora, mas definido pelo valor informado em NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vCBS
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor total da CBS da União incorreto.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 04 ou 06; ou Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 01, este campo será igual ao valor total/IBSCBSTot/vIBS retornado pela Calculadora.

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular`

- **Campo:** `gTribRegular`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de tributação regular
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1583` — Grupo de tributação regular não deve ser informado para o cClassTribIBSCBS indicado.
    - Detalhe da regra: O grupo de tributação regular não deve ser informado se o indicador para tributação regular (exigeGrupoTributacaoRegular) para o código da classificação tributária - cClassTribIBSCBS for igual a false
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1584` — Grupo de tributação regular deve ser informado para o cClassTribIBSCBS indicado.
    - Detalhe da regra: O grupo de tributação regular deve ser informado se o indicador para tributação regular (exigeGrupoTributacaoRegular) para o código da classificação tributária - cClassTribIBSCBS for igual a true
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/pAliqEfeRegIBSUF`

- **Campo:** `pAliqEfeRegIBSUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota efetiva de tributação regular do IBS estadual
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1585` — Alíquota efetiva de tributação regular do IBS estadual incorreta.
    - Detalhe da regra: A alíquota efetiva de tributação regular do IBS estadual deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/pAliqEfetRegIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/vTribRegIBSUF`

- **Campo:** `vTribRegIBSUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da tributação regular do IBS estadual.  
    
  vTribRegIBSUF = vBC x pAliqEfeRegIBSUF
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1586` — Valor da tributação regular do IBS estadual incorreto.
    - Detalhe da regra: O valor da tributação regular do IBS estadual deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/vTribRegIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/pAliqEfeRegIBSMun`

- **Campo:** `pAliqEfeRegIBSMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota efetiva de tributação regular do IBS municipal
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1587` — Alíquota efetiva de tributação regular do IBS municipal incorreta.
    - Detalhe da regra: A alíquota efetiva de tributação regular do IBS municipal deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/pAliqEfetRegIBSMun retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/vTribRegIBSMun`

- **Campo:** `vTribRegIBSMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da tributação regular do IBS municipal.  
    
  vTribRegIBSMun = vBC x pAliqEfeRegIBSMun
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1588` — Valor da tributação regular do IBS municipal incorreto.
    - Detalhe da regra: O valor da tributação regular do IBS municipal deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/vTribRegIBSMun retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/pAliqEfeRegCBS`

- **Campo:** `pAliqEfeRegCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota efetiva de tributação regular da CBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1589` — Alíquota efetiva de tributação regular da CBS incorreta.
    - Detalhe da regra: A alíquota efetiva de tributação regular da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/pAliqEfetRegCBS retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/vTribRegCBS`

- **Campo:** `vTribRegCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da tributação regular da CBS.  
    
  vTribRegCBS = vBC x pAliqEfeRegCBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1590` — Valor da tributação regular da CBS incorreto.
    - Detalhe da regra: O valor da tributação regular da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribRegular/vTribRegCBS retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`

- **Campo:** `gTribCompraGov`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da composição do valor do IBS e da CBS em compras governamentais
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1600` — Grupo de compras governamentais não deve ser informando quando o tpEnteGov não foi informado na DPS.
    - Detalhe da regra: O grupo de tributação para compras governamentais não deve ser informado para essas operações (tpEnteGov não foi informado informado na DPS).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1601` — Grupo de compras governamentais deve ser informando quando o tpEnteGov não foi informado na DPS.
    - Detalhe da regra: O grupo de tributação para compras governamentais deve ser informado para essas operações (tpEnteGov foi informado informado na DPS).
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGovpIBSUF`

- **Campo:** `pIBSUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do IBS de competência do Estado
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1602` — Alíquota do IBS de competência do Estado incorreta.
    - Detalhe da regra: A alíquota do IBS de competência do Estado deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/pAliqIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGovvIBSUF`

- **Campo:** `vIBSUF`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do Tributo do IBS da UF calculado
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1603` — Valor do Tributo do IBS da UF incorreto.
    - Detalhe da regra: O valor do Tributo do IBS da UF deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/vTribIBSUF retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGovpIBSMun`

- **Campo:** `pIBSMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do IBS de competência do  
  Município
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1604` — Alíquota do IBS de competência do
Município incorreta.
    - Detalhe da regra: A alíquota do IBS de competência do Município deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/pAliqIBSMun retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGovvIBSMun`

- **Campo:** `vIBSMun`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do Tributo do IBS do Município  
  calculado
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1605` — Valor do Tributo do IBS do Município incorreto.
    - Detalhe da regra: O valor do Tributo do IBS do Município deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/vTribIBSMun retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGovpCBS`

- **Campo:** `pCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota da CBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1606` — Alíquota da CBS incorreta.
    - Detalhe da regra: A alíquota da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/pAliqCBS retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGovvCBS`

- **Campo:** `vCBS`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribCompraGov`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do Tributo da CBS calculado
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1607` — Valor do Tributo da CBS incorreto.
    - Detalhe da regra: O valor do Tributo da CBS deve ser igual ao valor IBSCBS/gIBSCBS/gTribCompraGov/vTribCBS retornado pela Calculadora

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN`

- **Campo:** `gTribSN`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da composição do valor do IBS e da CBS para o Simples Nacional
- **Notas explicativas:** Grupo só deve ser destacado quanto opSimpNac = 3 ou 4 e regApIBSCBSSN = 1 ou 2.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Grupo de informações de IBS/CBS para Simples Nacional não deve ser informado.
    - Detalhe da regra: Grupo não deve ser destacado quando opSimpNac = 1 (Não Optante) ou 2 (MEI); ou quando  opSimpNac = 3 (ME/EPP) ou 4 (Pendente) e regApIBSCBSSN = 3 (IBS e CBS apurados pelo regime regular).
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Grupo de informações de IBS/CBS para Simples Nacional deve ser informado.
    - Detalhe da regra: Grupo deve ser destacado quando opSimpNac = 3 (ME/EPP) ou 4 (Pendente) e regApIBSCBSSN = 1 ou 2 (CBS e/ou IBS apurados pelo SN).

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/pIBSSN`

- **Campo:** `pIBSSN`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do IBS Total calculada apenas para os Optantes do Simples Nacional.
- **Notas explicativas:** Apenas deve ser informando quando se tratar de Optantes (opSimpNac = 3 ou 4) e com apuração do IBS no SN regApIBSCBSSN = 1.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — A alíquota do IBS para o Simples Nacional não deve ser informada.
    - Detalhe da regra: A alíquota de IBS para o Simples Nacional não pode ser informada se regApIBSCBSSN = 2.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor de alíquota para o IBS do Simples Nacional incorreta.
    - Detalhe da regra: Quando o regime de apuração pelo Simples Nacional (regApIBSCBSSN) = 1 (IBS e CBS apurados pelo SN), a alíquota do IBS para o Simples Nacional deve ser informada e deve ser igual ao valor retornado pela Calculadora.

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/vIBSSN`

- **Campo:** `vIBSSN`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do IBS para os Optantes do Simples Nacional
- **Notas explicativas:** Apenas deve ser informando quando se tratar de Optantes (opSimpNac = 3 ou 4) e com apuração do IBS no SN regApIBSCBSSN = 1.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor do IBS para o Simples Nacional não deve ser informado.
    - Detalhe da regra: O valor de de IBS para o Simples Nacional não pode ser informado se regApIBSCBSSN = 2.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor do IBS para o Simples Nacional incorreto.
    - Detalhe da regra: Quando o regime de apuração pelo Simples Nacional (regApIBSCBSSN) = 1 (IBS e CBS apurados pelo SN), o valor do IBS para o Simples Nacional deve ser informado e deve ser igual a vReceitaBrutaSN x pIBSSN.

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/pCBSSN`

- **Campo:** `pCBSSN`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota da CBS apenas para os Optantes do Simples Nacional.
- **Notas explicativas:** Não haverá regra vinculada pois o campo é obrigatório, ou seja, será a mesma regra do grupo gTribSN.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Alíquota da CBS para o Simples Nacional incorreta.
    - Detalhe da regra: A alíquota da CBS para o Simples Nacional deve ser igual ao valor retornado pela Calculadora.

### `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/vCBSSN`

- **Campo:** `vCBSSN`
- **Caminho no XML:** `NFSe/infNFSe/IBSCBS/totCIBS/gTribSN/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da CBS para os Optantes do Simples Nacional
- **Notas explicativas:** Não haverá regra vinculada pois o campo é obrigatório, ou seja, será a mesma regra do grupo gTribSN.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Valor da CBS para o Simples Nacional incorreto.
    - Detalhe da regra: O valor total da CBS para o Simples Nacional deve ser igual a vReceitaBrutaSN x pCBSSN.

### `NFSe/infNFSe/DPS`

- **Campo:** `DPS`
- **Caminho no XML:** `NFSe/infNFSe/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da DPS relativas ao serviço prestado

### `NFSe/infNFSe/DPS/versao`

- **Campo:** `versao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/`
- **Elemento (ELE):** A  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-4V2
- **Descrição:** Versão do leiaute da DPS.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0001` — O prazo de aceitação da versão do leiaute da DPS expirou.
    - Detalhe da regra: Prazo de aceitação da versão do leiaute DPS ultrapassado.

### `NFSe/infNFSe/DPS/infDPS`

- **Campo:** `infDPS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de Informações da  
  Declaração de Prestação de Serviços - DPS

### `NFSe/infNFSe/DPS/infDPS/id`

- **Campo:** `id`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** ID  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 45
- **Descrição:** O identificador da DPS é composto pela concatenação de campos que constam no leiaute da DPS.  
  A formação deste identificador considera o literal "DPS" associado a outras 42 posições numéricas, conforme descrito abaixo:  
    
  "DPS" +   
  Cód.Mun. (7) +   
  Tipo de Inscrição Federal (1) +   
  Inscrição Federal (14 - CPF completar com 000 à esquerda) +   
  Série DPS (5) +   
  Núm. DPS (15)
- **Notas explicativas:** Tipo de inscrição Federal = 1 / Inscrição Federal = CPF emitente da DPS;  
  Tipo de inscrição Federal = 2 / Inscrição Federal = CNPJ emitente da DPS;
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0004` — Conteúdo do identificador informado na DPS difere da concatenação dos campos correspondentes.
    - Detalhe da regra: O identificador da DPS é formado conforme a concatenação dos seguintes campos: "DPS" + Cód.Mun.Emi. + Tipo de Inscrição Federal + Inscrição Federal + Série DPS + Núm. DPS  Campo identificador da DPS inválido. Identificador da DPS difere da concatenação dos campos correspondentes. "DPS" + Cód.Mun.Emi. + Tipo de Inscrição Federal + Inscrição Federal + Série DPS + Núm. DPS   Verificar se tipo de inscrição e inscrição, informados no identificador da DPS, estão corretamente correspondidos conforme o seguinte:  Tipo de inscrição Federal = 1 / Inscrição Federal = CPF emitente da DPS; Tipo de inscrição Federal = 2 / Inscrição Federal = CNPJ emitente da DPS;  Cód.Mun.Emi. é o código do município do endereço do emitente da DPS.

### `NFSe/infNFSe/DPS/infDPS/tpAmb`

- **Campo:** `tpAmb`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Identificação do tipo de ambiente no Sistema Nacional NFS-e:   
  1 - Produção;   
  2 - Homologação;
- **Valores aceitos (domínio identificado):**
  - `1` → Produção
  - `2` → Homologação
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0006` — Ambiente informado diverge do ambiente de recebimento para o qual o emitente enviou a DPS.

### `NFSe/infNFSe/DPS/infDPS/dhEmi`

- **Campo:** `dhEmi`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data e hora da emissão da DPS.  
  Data e hora no formato UTC (Universal Coordinated Time):  
  AAAA-MM-DDThh:mm:ssTZD
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0008` — A data e hora de emissão da DPS deve ser anterior ou igual à data do seu processamento (dhProc) pelo Sistema Nacional NFS-e.
    - Detalhe da regra: A data de emissão da DPS deve ser anterior ou igual à data e hora do seu processamento (dhProc) pelo Sistema Nacional NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1294` — Prazo para entrega da DF-e excedido.
    - Detalhe da regra: A data de compartilhamento do DF-e não pode ser posterior à há mais de 6 anos de sua emissão.

### `NFSe/infNFSe/DPS/infDPS/verAplic`

- **Campo:** `verAplic`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-20
- **Descrição:** Versão do aplicativo que gerou a DPS.

### `NFSe/infNFSe/DPS/infDPS/serie`

- **Campo:** `serie`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-5
- **Descrição:** Série da DPS.
- **Notas explicativas:** cc
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0010` — A série informada na DPS não pertence à faixa definida para o tipo de emissor utilizado para a sua emissão.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0014` — Conjunto de Série, Número, Código do Município Emissor e CNPJ/CPF informado nesta DPS já existe em uma NFS-e gerada a partir de uma DPS enviada anteriormente.

### `NFSe/infNFSe/DPS/infDPS/nDPS`

- **Campo:** `nDPS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15
- **Descrição:** Número da DPS.
- **Notas explicativas:** 1 até 999999999999999

### `NFSe/infNFSe/DPS/infDPS/dCompet`

- **Campo:** `dCompet`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data de competência da prestação do serviço.  
  Ano, Mês e Dia (AAAA-MM-DD)
- **Notas explicativas:** A data de competência deve ser única e ser a mesma que a data do fato gerador do tributo, ou seja, a data da prestação do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0015` — A data de competência informada na DPS não pode ser posterior à data de emissão (dhEmi) da DPS.
    - Detalhe da regra: A data de competência informada na DPS deve ser anterior ou igual à data de emissão (dhEmi) da DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0016` — A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS, exceto quando o emitente for MEI na data de competëncia informada.
    - Detalhe da regra: A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS.  Exceto quando o emitente da DPS for MEI (opSimpNac = 2) na data de competência da emissão da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1270` — A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS.
    - Detalhe da regra: A data de competência deve ser igual ou posterior à data de ativação do convênio do município emissor informado na DPS. A situação do convêncio do município emissor informado na DPS deve ser ATIVO.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0018` — A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CNPJ do emitente no cadastro CNPJ.
    - Detalhe da regra: A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CNPJ do emitente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0020` — A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CPF do emitente no cadastro CPF.
    - Detalhe da regra: A data de competência informada na DPS deve ser igual ou posterior à data de inscrição do CPF do emitente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0023` — A data de competência informada na DPS deve ser igual ou posterior à data do indicador municipal, registrada no CNC do município correspondente ao município emissor da DPS (cLocEmi).
    - Detalhe da regra: Se houver registro complementar do contribuinte (CNPJ ou CPF + IM do emitente da DPS), com situação "Ativo", no CNC do município correspondente ao município emissor da DPS (cLocEmi), a data de competência informada na DPS deve ser igual ou posterior à data do indicador municipal.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0025` — A data de competência informada na DPS deve ser igual ou posterior à data autorizasção de uso do emissores, registrada no CNC do município correspondente ao município emissor da DPS (cLocEmi) para o contribuinte.
    - Detalhe da regra: Se houver registro complementar do contribuinte (CNPJ ou CPF + IM do emitente da DPS), com situação "Ativo", no CNC do município correspondente ao município emissor da DPS (cLocEmi), a data de competência informada na DPS deve ser igual ou posterior à data de autorizasção de uso do emissores para o contribuinte pelo município emissor (cLocEmi).

### `NFSe/infNFSe/DPS/infDPS/tpEmit`

- **Campo:** `tpEmit`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Emitente da DPS:  
    
  1 - Prestador;  
  2 - Tomador;  
  3 - Intermediário;
- **Valores aceitos (domínio identificado):**
  - `1` → Prestador
  - `2` → Tomador
  - `3` → Intermediário
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E9996` — Nesta versão da aplicação, não é permitida a emissão de NFS-e pelo tomador ou intermediário.
    - Detalhe da regra: Se a DPS for emitida pelo tomador ou intermendiário (tpEmit = 2 ou 3), então a DPS deve ser rejeitada pelo sistema.

### `NFSe/infNFSe/DPS/infDPS/cMotivoEmisTI`

- **Campo:** `cMotivoEmisTI`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Motivo da Emissão da DPS pelo Tomador/Intermediário:  
    
  1 - Importação de Serviço;  
  2 - Tomador/Intermediário obrigado a emitir NFS-e por legislação municipal;  
  3 - Tomador/Intermediário emitindo NFS-e por recusa de emissão pelo prestador;  
  4 - Tomador/Intermediário emitindo por rejeitar a NFS-e emitida pelo prestador;
- **Notas explicativas:** Se o município de incidência não for o do tomador, o sistema deve rejeitar eventuais retenções.
- **Valores aceitos (domínio identificado):**
  - `1` → Importação de Serviço
  - `2` → Tomador/Intermediário obrigado a emitir NFS-e por legislação municipal
  - `3` → Tomador/Intermediário emitindo NFS-e por recusa de emissão pelo prestador
  - `4` → Tomador/Intermediário emitindo por rejeitar a NFS-e emitida pelo prestador
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0029` — O motivo da emissão não pode ser preenchido se o emitente for o prestador de serviço.
    - Detalhe da regra: Se o emitente for o prestador de serviço (tpEmit = 1), então este campo não deve ser preenchido.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0031` — Não pode haver retenção do ISSQN pelo tomador quando o município de incidência não for o do tomador.
    - Detalhe da regra: Para o tomador emitente da DPS, estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN tem que ser igual a 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0032` — Não pode haver retenção do ISSQN pelo intermediário quando o município de incidência não for o do intermediário.
    - Detalhe da regra: Para o intermediário emitente da DPS, estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN tem que ser igual a 1).

### `NFSe/infNFSe/DPS/infDPS/finNFSe`

- **Campo:** `finNFSe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Indicador da finalidade da emissão de NFS-e   
    
  0 - NFS-e regular  
  1 - NFS-e de crédito  
  2 - NFS-e de débito
- **Valores aceitos (domínio identificado):**
  - `0` → NFS-e regular
  - `1` → NFS-e de crédito
  - `2` → NFS-e de débito

### `NFSe/infNFSe/DPS/infDPS/tpNFSeDebito`

- **Campo:** `tpNFSeDebito`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2
- **Descrição:** Indicador do tipo de NFS-e de Ajuste de Débito (indicado apenas quando finNFSe = 2)  
    
  01 - Transferência de créditos para Cooperativas	  
  02 - Anulação de Crédito por Saídas Imunes/Isentas	  
  03 - Débitos de notas fiscais não processadas na apuração	  
  04 - Multa e juros	  
  05 - Transferência de crédito na sucessão	  
  06 - Pagamento Antecipado
- **Notas explicativas:** Campo deve ser informado quando finNFSe = 2 (NFS-e de débito).
- **Valores aceitos (domínio identificado):**
  - `01` → Transferência de créditos para Cooperativas
  - `02` → Anulação de Crédito por Saídas Imunes/Isentas
  - `03` → Débitos de notas fiscais não processadas na apuração
  - `04` → Multa e juros
  - `05` → Transferência de crédito na sucessão
  - `06` → Pagamento Antecipado
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando finNFSe = 2, este campo deve ser informado.
    - Detalhe da regra: O indicador do tipo de NFS-e de Ajuste de Débito deve ser informado quando finNFSe = 2
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando finNFSe = 0 ou 1, este campo não deve ser informado.
    - Detalhe da regra: O indicador do tipo de NFS-e de Ajuste de Débito não deve ser informado quando finNFSe = 0 ou 1

### `NFSe/infNFSe/DPS/infDPS/tpNFSeCredito`

- **Campo:** `tpNFSeCredito`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2
- **Descrição:** Indicador do tipo de NFS-e de Ajuste de Crédito (indicado apenas quando finNFSe = 1)  
    
  01 - Multa e juros	  
  05 - Transferência de crédito na sucessão
- **Notas explicativas:** Campo deve ser informado quando finNFSe = 1 (NFS-e de crédito).
- **Valores aceitos (domínio identificado):**
  - `01` → Multa e juros
  - `05` → Transferência de crédito na sucessão
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando finNFSe = 1, este campo deve ser informado.
    - Detalhe da regra: O indicador do tipo de NFS-e de Ajuste de Crédito deve ser informado quando finNFSe = 1.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando finNFSe = 0 ou 2, este campo não deve ser informado.
    - Detalhe da regra: O indicador do tipo de NFS-e de Ajuste de Crédito não deve ser informado quando finNFSe = 0 ou 2.

### `NFSe/infNFSe/DPS/infDPS/chNFSeRej`

- **Campo:** `chNFSeRej`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 50
- **Descrição:** Chave de Acesso da NFS-e rejeitada pelo Tomador/Intermediário.
- **Notas explicativas:** O tomador deve referenciar neste campo a nota do prestador, utilizando-se da chave da NFS-e emitida pelo prestador e previamente rejeitada pelo tomador, ou seja, o Tomador/Intermediário antes de emitir sua NFS-e pelo motivo 4 do campo cMotivoEmisTI deverá emitir um Evento de Manifestação de NFS-e de rejeição para a NFS-e emitida pelo prestador, cuja chave de acesso será informada neste campo chNFSeRej.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0034` — Somente é permitido o preenchimento do campo de chave de acesso de NFS-e rejeitada se o tipo de emitente for Tomador ou Intermediário e o motivo da emissao for por rejeição de NFS-e emitida pelo prestador.
    - Detalhe da regra: Somente é permitido o preencimento deste campo se o emitente da DPS for o Tomador ou Intermediário (tpEmit igual a 2 ou 3) e o motivo da emissão for a rejeição de NFS-e emitida pelo Prestador (cMotivoEmisTI igual a 4).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0035` — A chave de acesso de NFS-e informada nesta DPS não possui a ela vinculada o evento de manifestação de rejeição emitido pelo mesmo emitente desta DPS.
    - Detalhe da regra: Verificar se a NFS-e informada possui Evento de Manifestação de Rejeição de NFS-e do Tomador ou Intermediario cujo autor do evento seja o mesmo emitente (Tomador ou Intermediário) desta DPS.

### `NFSe/infNFSe/DPS/infDPS/cLocEmi`

- **Campo:** `cLocEmi`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código de 7 dígitos da localidade emissora da NFS-e.
- **Notas explicativas:** O campo cLocEmi (Código da Localidade de Emissão da DPS) sempre corresponderá a um município brasileiro e identificado pela tabela de códigos de municípios do IBGE ou um trecho de concessão de exploração de rodovia para a qual a NFS-e foi emiitida.  
    
  O município emissor da NFS-e é aquele município em que o emitente da DPS está cadastrado e autorizado a "emitir uma NFS-e", ou seja, emitir uma DPS para que o sistema nacional valide as informações nela prestadas e gere a NFS-e correspondente para o emitente.  
    
  Para que o sistema nacional emita a NFS-e o município emissor deve ser conveniado e estar ativo no sistema nacional. Além disso o convênio do município deve permitir que os contribuintes do município utilize os emissores públicos do Sistema Nacional NFS-e.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0037` — O código do município emissor informado na DPS é inexistente no cadastro de convênio municipal do sistema nacional.
    - Detalhe da regra: O código do município emissor informado na DPS deve existir no cadastro de convênio municipal do sistema nacional.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0038` — A situação do convênio do município emissor informado na DPS deve ser "ATIVO" no cadastro de convênio municipal do sistema nacional.
    - Detalhe da regra: A situação do convênio do município emissor informado na DPS deve ser "ATIVO" no cadastro de convênio municipal do sistema nacional.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0039` — O município emissor informado na DPS deve estar parametrizado para utilizar os emissores públicos nacionais, conforme parametrização do município no Sistema Nacional NFS-e.
    - Detalhe da regra: O município emissor informado na DPS deve estar parametrizado para utilizar os emissores públicos nacionais, conforme parametrização do município no Sistema Nacional NFS-e.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0041` — O município emissor não corresponde ao município do emitente MEI no CNPJ.
    - Detalhe da regra: Se tpEmit for igual a 1 (prestador) e a opção pelo simples nacional for igual a 2 (MEI),  então o município emissor deve corresponder ao município do endereço do emitente no cadastro CNPJ.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1304` — O código do município emissor da NFS-e não existe conforme tabela do IBGE ou difere do código do municipio que está compartilhando o documento com o ADN do Sistema Nacional NFS-e.
    - Detalhe da regra: Verificar se o código do município emissor da NFS-e existe, conforme TAB.MUN_IBGE do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe, e corresponde ao mesmo município que está compartilhando a NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1272` — O código do município informado não existe ou não está ativo no convênio municipal na data de processamento de compartilhamento com o ADN.
    - Detalhe da regra: O código do município informado deve existir e estar ativo no cadastro de convênio municipal na data de processamento do compartilhamento com o ADN.

### `NFSe/infNFSe/DPS/infDPS/subst`

- **Campo:** `subst`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas à NFS-e a ser substituída

### `NFSe/infNFSe/DPS/infDPS/substchSubstda`

- **Campo:** `chSubstda`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/subst`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 50
- **Descrição:** Chave de Acesso da NFS-e a ser substituída.
- **Notas explicativas:** O município conveniado ao Sistema Nacional NFS-e deverá parametrizar o prazo máximo permitido para que o emitente da NFS-e possa substituir uma NFS-e que o município tenha gerado.  
    
  Prazo máximo parametrizável é 2 anos.  
    
  O município conveniado ao Sistema Nacional NFS-e deverá parametrizar se impede ou não a substituição de nota caso a nota Substuída não tenha as informações do NI do tomador  
    
  Um evento de bloqueio de ofício para qualquer outro tipo de evento é considerado vigente se não há um correspondente evento de desbloqueio de ofício que contemple o tipo de evento bloqueado.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0042` — Chave de NFS-e a ser substituída é inválida.
    - Detalhe da regra: Chave de NFS-e a ser substituída é inválida.  1 - Verificar DV da chave de NFS-e a ser substituída informada nesta DPS; 2 - Verificar a correspondência exata dos campos (Cód.Mun. / Tipo de Inscrição / Inscrição) da chave de NFS-e a ser substituída informada e o id desta DPS;
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0044` — NFS-e não existe na base de dados do autorizador de NFS-e nacional. Informe uma chave de NFS-e existente.
    - Detalhe da regra: NFS-e inexistente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0046` — Uma NFS-e cancelada não pode ser substituída. Informe uma chave de NFS-e não cancelada anteriormente.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0050` — Uma NFS-e não pode ser substituída fora do prazo estabelecido pelo município emissor da NFS-e.
    - Detalhe da regra: Não poderá ocorrer a substituição de NFS-e fora do prazo permitido, conforme parametrização do município emissor da NFS-e, exceto quando a justificativa para substituição de NFS-e for Desenquadramento ou Enquadramento de NFS-e no Simples Nacional (cMotivo = 1 ou 2).
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0056` — NFS-e não pode ser substituída pois não possui identificação do tomador.
    - Detalhe da regra: Não poderá ocorrer a substituição de NFS-e que não contenha identificação do tomador, conforme parametrização do município emissor da NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0058` — Não poderá ocorrer a substituição de NFS-e com alteração da identificação do não emitente, conforme parametrização do município emissor da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0060` — Os campos data de competência, subitem da lista nacional de serviços, código complementar municipal e local da prestação não podem ser alterados quando a opção do simples nacional for Não Optante (opSimpNac = 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0061` — Os campos identificação do Tomador (se identificado na DPS), data de competência (dCompet), e valor do serviço (vServ), não podem ser alterados quando a opção do simples nacional for MEI (opSimpNac = 2) ou ME/EPP (opSimpNac = 3).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0065` — Não é possível substituição da NFS-e que tenha sido gerada em ambientes geradores diferentes.
    - Detalhe da regra: Não poderá ocorrer a substituição de NFS-e que tenha sido gerada em ambientes geradores difentes.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0068` — Não é possível a substituição desta NFS-e pois a mesma possui registro de Evento de Solicitação de Análise Fiscal para Cancelamento de NFS-e aguardando resposta. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0070` — Não é possível a substituição desta NFS-e pois já ocorreu uma manifestação de confirmação de serviço. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
    - Detalhe da regra: Não poderá ocorrer a substituição de NFS-e que tenha registro de Evento de Manifestação de Confirmação da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0072` — Não é possível a substituição desta NFS-e pois já ocorreu uma manifestação tácita da NFS-e. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
    - Detalhe da regra: Não poderá ocorrer a substituição de NFS-e que tenha registro de Evento de Manifestação de Confirmação Tácita da NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0074` — Não é permitido realizar a substituição para NFS-e que possua Evento de Tributos Recolhidos vinculado, conforme parametrização do município de incidência do ISSQN. Para mais informações, consultar a Administração Tributária Municipal do município emissor da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0076` — Não é permitido realizar a substituição para NFS-e que possua Evento de Bloqueio de Ofício para o Evento de Cancelamento de NFS-e por Substituição vigente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1308` — NFS-e a ser substituída não possui um evento de Cancelamento por substituição compartilhado com o ADN e por isso não pode ser substituída.
    - Detalhe da regra: Uma NFS-e substituta não pode ser compartilhada com o ADN pelo município conveniado antes que o cancelamento por sustituição de NFS-e da nota a ser substituída tenha sido compartilhada anteriormente.  Obs: Verificar se já houve o compartilhamento com o ADN do cancelamento por substituição de NFS-e, quando uma NFS-e que está sendo compartilhada possuir uma chave de NFS-e válida informada no leiaute.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1310` — O identificador desta NFS-e substituta não está referenciado no evento de Cancelamento por substituição da NFS-e substituída.
    - Detalhe da regra: Uma NFS-e substituta não pode ser compartilhada com o ADN pelo município conveniado antes que o evento de cancelamento por sustituição de NFS-e, compartilhado anteriormente, contenha a referência ao identificador da NFS-e substituta que está sendo conpartilhada.  Obs:  Obs: Verificar se o identificador da NFS-e substituta corresponde à chave de acesso informada no campo evento/pedRegEvento/infPedReg/e105102/chSubstituta do evento de cancelamento por sustituição da NFS-e substituída;

### `NFSe/infNFSe/DPS/infDPS/substcMotivo`

- **Campo:** `cMotivo`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/subst`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código de justificativa para substituição de NFS-e:  
    
  01 - Desenquadramento de NFS-e do Simples Nacional;  
  02 - Enquadramento de NFS-e no Simples Nacional;  
  03 - Inclusão Retroativa de Imunidade/Isenção para NFS-e;  
  04 - Exclusão Retroativa de Imunidade/Isenção para NFS-e;  
  05 - Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo;  
  99 - Outros;
- **Notas explicativas:** Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo.
- **Valores aceitos (domínio identificado):**
  - `01` → Desenquadramento de NFS-e do Simples Nacional
  - `02` → Enquadramento de NFS-e no Simples Nacional
  - `03` → Inclusão Retroativa de Imunidade/Isenção para NFS-e
  - `04` → Exclusão Retroativa de Imunidade/Isenção para NFS-e
  - `05` → Rejeição de NFS-e pelo tomador ou pelo intermediário se responsável pelo recolhimento do tributo
  - `99` → Outros

### `NFSe/infNFSe/DPS/infDPS/substxMotivo`

- **Campo:** `xMotivo`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/subst`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15-255
- **Descrição:** Descrição do motivo da substituição da NFS-e quando o emitente deve descrever o motivo da substituição para outros motivos (cMotivo = 99).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0078` — Quando o campo cMotivo = 99, o campo xMotivo deve informado obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/prest`

- **Campo:** `prest`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao prestador do serviço

### `NFSe/infNFSe/DPS/infDPS/prest/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição federal (CNPJ) do prestador do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0080` — CNPJ do prestador informado na DPS é inválido.
    - Detalhe da regra: CNPJ informado na DPS é inválido (verificar DV).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0082` — CNPJ do emitente prestador não encontrado no cadastro CNPJ na data de competência.
    - Detalhe da regra: CNPJ do prestador não existe no cadastro CNPJ na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0084` — CNPJ do emitente prestador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CNPJ e CNC NFS-e.
    - Detalhe da regra: Para este CNPJ, se o emitente for o prestador de serviço (tpEmit = 1), na data de competência informada na DPS, o município emissor deve corresponder: 1) ao município do endereço registrado no cadastro CNPJ, se a situação padrão para emissão dos contribuintes, com endereço no município, do cadastro CNPJ da RFB for habilitada ou; 2) ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CNPJ + IM informados na DPS para o prestador devem existir no CNC NFS-e);  Exceto quando o emitente da DPS for MEI (opSimpNac = 2) na data de competência da emissão da NFS-e.

### `NFSe/infNFSe/DPS/infDPS/prest/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição federal (CPF) do prestador do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0096` — CPF do prestador informado na DPS é inválido.
    - Detalhe da regra: CPF informado na DPS é inválido (verificar DV).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0098` — CPF do emitente prestador não encontrado no cadastro CPF na data de competência.
    - Detalhe da regra: CPF do prestador não existe no cadastro CPF na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0099` — CPF do emitente prestador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme  cadastro nacional complementar NFS-e (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e).
    - Detalhe da regra: Para este CPF, se o emitente for o prestador de serviço (tpEmit = 1), na data de competência informada na DPS, o município emissor deve corresponder ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e);

### `NFSe/infNFSe/DPS/infDPS/prest/NIF`

- **Campo:** `NIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 40
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0112` — O prestador de serviço, quando emitente da DPS, não pode ser identificado pelo NIF.
    - Detalhe da regra: Se o campo tpEmit for ígual a 1, então NIF do prestador não pode ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0113` — O NIF ou cNaoNIF do prestador deve ser informado quando o grupo de informações de endereço no exterior do prestador de serviços foi informado.
    - Detalhe da regra: Se o grupo de informações de endereço no exterior do prestador de serviços foi informado então o NIF ou cNaoNIF do prestador deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/prest/cNaoNIF`

- **Campo:** `cNaoNIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo para não informação do NIF:  
    
  0 - Não informado na nota de origem;  
  1 - Dispensado do NIF;  
  2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Não informado na nota de origem
  - `1` → Dispensado do NIF
  - `2` → Não exigência do NIF
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0114` — O prestador de serviço, quando emitente da DPS, somente pode ser identificado pelo CNPJ ou CPF.
    - Detalhe da regra: Se o campo tpEmit for ígual a 1, então cNaoNIF do prestador não pode ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0115` — Valor 0 para o motivo da não informação do NIF do prestador não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo cNaoNIF do prestador, informado na DPS, for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/prest/CAEPF`

- **Campo:** `CAEPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 14
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).

### `NFSe/infNFSe/DPS/infDPS/prest/IM`

- **Campo:** `IM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15
- **Descrição:** Número do indicador municipal do prestador do serviço.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0116` — A IM deve ser informada para o emitente prestador do serviço na DPS, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Se o emitente for o prestador de serviço (tpEmit = 1) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço e o codigo do município emissor (cLocEmi), ambos informados na DPS, para identificar as ocorrências no CNC NFS-e. Se houver pelo menos uma ocorrência, então o emitente da DPS deve informar o IM correspondente registrado no CNC NFS-e, que identifique unicamente o registro complementar.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0119` — IM do emitente prestador não está autorizado a emitir NFS-e, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Se o emitente for o prestador de serviço (tpEmit = 1) e se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, verificar se o IM informado está autorizado a emitir NFS-e na data de processamento desta DPS,.  Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0120` — IM do prestador não deve ser informado, pois não existem informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Se o emitente for o prestador de serviço (tpEmit = 1) e, se não houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então o IM não deve ser informado na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi),  informados na DPS, para identificar o registro complementar no CNC NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0124` — O IM informado está inativo no CNC NFS-e do município emissor para a data de competência informada na DPS.
    - Detalhe da regra: Para o emitente prestador de serviço (tpEmit = 1), verificar se o IM informado nesta DPS está Inativo (cStat) no CNC do município emissor na data de competência informada.  Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.   Se todos os registros complementares estiverem inativos, utilizar as informações dos cadastros RFB (CNPJ ou CPF), conforme identificador federal utilizado para identificar o emitente da DPS.

### `NFSe/infNFSe/DPS/infDPS/prest/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 150
- **Descrição:** Nome / Nome Empresarial do prestador.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0121` — O nome ou razão social do prestador não deve ser informado quando o emitente da DPS for o próprio prestador.
    - Detalhe da regra: Se o emitente da DPS for o prestador de serviço (tpEmit for igual a 1), então o nome ou razão social não deve ser informado.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0122` — O nome ou razão social do prestador deve ser informado quando o emitente da DPS não for o próprio prestador.
    - Detalhe da regra: Se o emitente da DPS não for o prestador de serviço (tpEmit for igual a 2 ou 3), então o nome ou razão social deve ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0123` — O preenchimento do nome empresarial é obrigatório quando o prestador for identificado com NIF.
    - Detalhe da regra: Se NIF do prestador for preenchido então o campo xNome deve ser preenchido obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/prest/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do prestador de serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0129` — O endereço do prestador deve ser informado na DPS quando o prestador não for o emitente da DPS.
    - Detalhe da regra: Se o emitente da DPS for o tomador ou intermediário (tpEmit = 2 ou 3) o grupo de informações do endereço do prestador de serviço deve ser informado na DPS obrigatoriamente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0128` — O endereço do prestador do serviço não deve ser informado na DPS quando o próprio prestador for o emitente da DPS.
    - Detalhe da regra: Se o emitente da DPS é o prestador do serviço (tpEmit = 1), então o grupo de informações do endereço do prestador de serviço não deve ser informado na DPS.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endNac`

- **Campo:** `endNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço nacional.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do prestador do serviço.  
   (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0130` — O código do município para o endereço do prestador do serviço não existe conforme tabela de município do IBGE.
    - Detalhe da regra: O código do município para o endereço do prestador do serviço não existe, conforme TAB.MUN_IBGE do ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0132` — O código do município informado na DPS para o endereço do prestador do serviço, identificado pelo CNPJ, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - Detalhe da regra: Quando o endereço nacional do prestador for informado na DPS e o mesmo for identificado pelo CNPJ, o código do município do endereço do prestador, deve existir e corresponder ao município do seu endereço no cadastro CNPJ ou do endereço registrado em suas informações complementares no CNC NFS-e, na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0134` — O código do município informado na DPS para o endereço do prestador do serviço, identificado pelo CPF, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - Detalhe da regra: Quando o endereço nacional do prestador for informado na DPS e o mesmo for identificado pelo CPF, o código do município do endereço do prestador, deve existir e corresponder ao município do seu endereço no cadastro CPF ou do endereço registrado em suas informações complementares no CNC NFS-e, na data de competência informada na DPS.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP)   
   do endereço do prestador do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0138` — O CEP informado para o endereço nacional do prestador do serviço não existente ou não pertence ao município informado na DPS. Informe um CEP existente e que pertença ao município informado para o endereço do prestador do serviço na DPS.
    - Detalhe da regra: O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço no exterior.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0142` — O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o prestador for identificado pelo NIF e o emitente por CNPJ.
    - Detalhe da regra: Se o NIF do prestador de serviço foi informado e o emitente da DPS, tomador ou intermedirio (tpEmit = 2 ou 3), for identificado por CNPJ, então o grupo de informações de endereço no exterior do prestador do serviço deve ser informado obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/cPais`

- **Campo:** `cPais`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do país do endereço do prestador do prestador do serviço.  
   (Tabela de Países ISO)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0146` — O código de país informado para o endereço no exterior do prestador do serviço não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do prestador do serviço, conforme tabela de país ISO2.
    - Detalhe da regra: O código de país informado para o endereço no exterior do prestador do serviço deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-11
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/end/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do prestador do serviço.

### `NFSe/infNFSe/DPS/infDPS/prest/fone`

- **Campo:** `fone`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 6-20
- **Descrição:** Número do telefone do prestador.  
  (Preencher com o Código DDD + número do telefone.   
  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `NFSe/infNFSe/DPS/infDPS/prest/email`

- **Campo:** `email`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-80
- **Descrição:** E-mail do prestador.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0148` — Email inválido.
    - Detalhe da regra: Email deve ser informado conforme estrutura (conter @, ponto etc.).

### `NFSe/infNFSe/DPS/infDPS/prest/regTrib`

- **Campo:** `regTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas aos regimes de tributação do prestador de serviços

### `NFSe/infNFSe/DPS/infDPS/prest/regTrib/opSimpNac`

- **Campo:** `opSimpNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Situação perante Simples Nacional:  
    
  1 - Não Optante;  
     2 - Optante - Microempreendedor Individual (MEI);  
     3 - Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP);  
  4 - Optante Pendente;
- **Valores aceitos (domínio identificado):**
  - `1` → Não Optante
  - `2` → Optante - Microempreendedor Individual (MEI)
  - `3` → Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP)
  - `4` → Optante Pendente
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0160` — No mês de competência da NFS-e, a opção de situação perante o Simples Nacional, do prestador, informada na DPS não está de acordo com o cadastro Simples Nacional.
    - Detalhe da regra: Opção de situação perante o Simples Nacional do prestador, informada na DPS, não está de acordo com o cadastro Simples Nacional na data de competência informada na DPS. Se CNPJ do prestador não consta no cadastro então opSimpNac é igual a 1;
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0161` — NFS-e cujo emitente for MEI somente poderá ser compartilhada pelo município com o ADN se a data de competência, informada na NFS-e, for menor ou igual a 31/08/2023.
    - Detalhe da regra: Quando o emitente for MEI a NFS-e poderá ser compartilhada pelo município com o ADN somente se a data de competência for igual ou menor que 31/08/2023.

### `NFSe/infNFSe/DPS/infDPS/prest/regTrib/regApTribSN`

- **Campo:** `regApTribSN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Regime de Apuração Tributária pelo Simples Nacional.  
    
  Opção para que o contribuinte optante pelo Simples Nacional ME/EPP (opSimpNac = 3) possa indicar, ao emitir o documento fiscal, em qual regime de apuração os tributos federais e municipal estão inseridos, caso tenha ultrapassado algum sublimite ou limite definido para o Simples Nacional.  
    
    
  Esta informação não leva em consideração o regime de apuração do IBS e da CBS que devem ser informados no campo regApIBSCBSSN.  
     
  1 – Regime de apuração dos tributos federais e municipal pelo SN;   
  2 – Regime de apuração dos tributos federais pelo SN e o ISSQN pela NFS-e conforme respectiva legislação municipal do tributo;  
  3 – Regime de apuração dos tributos federais e municipal pela NFS-e conforme respectivas legislações federal e municipal de cada tributo;
- **Notas explicativas:** 1 - Um MEI, identificado como tal na data de competência informada na DPS após a verificação na base de dados do Simples Nacional, será tratado sempre como MEI no Sistema Nacional NFS-e, independentemente de quaisquer circustâncias que o próprio MEI tenha detectado que o descaracterize como MEI. A informação da situação do MEI sempre será aquela que for verificada no Simples Nacional na data de competência informada na DPS.  
    
  2 - Uma ME/EPP deixará de apurar o ISSQN pelo Simples Nacional quando atribuir ao campo regAPTribSN os valores 2 ou 3, conforme leiaute DPS.
- **Valores aceitos (domínio identificado):**
  - `1` → Regime de apuração dos tributos federais e municipal pelo SN
  - `2` → Regime de apuração dos tributos federais pelo SN e o ISSQN pela NFS-e conforme respectiva legislação municipal do tributo
  - `3` → Regime de apuração dos tributos federais e municipal pela NFS-e conforme respectivas legislações federal e municipal de cada tributo
  - `2` → Uma ME/EPP deixará de apurar o ISSQN pelo Simples Nacional quando atribuir ao campo regAPTribSN os valores 2 ou 3, conforme leiaute DPS.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0162` — Não é permitido ao não optante do Simples Nacional e o MEI preencherem o campo de indicação do regime de apuração dos tributos apurados.
    - Detalhe da regra: O regime de apuração dos tributos para o optante do Simples Nacional (ME/EPP) não pode ser preenchido quando o prestador de serviço não for optante do simples nacional ou for MEI, ou seja, o campo opSimpNac = 1 ou 2.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0166` — É obrigatorio o preenchimento do campo de regime de apuração dos tributos do SN para o optante do Simples Nacional ME/EPP ou com opção Pendente.
    - Detalhe da regra: O regime de apuração dos tributos para o optante do Simples Nacional (ME/EPP) deve ser preenchido obrigatoriamente quando o prestador de serviço for optante do simples nacional ou com a opção pendente, ou seja, o campo opSimpNac = 3 (ME/EPP) ou 4 (Pendente).

### `NFSe/infNFSe/DPS/infDPS/prest/regTrib/regApIBSCBSSN`

- **Campo:** `regApIBSCBSSN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Regime de Apuração Tributária pelo Simples Nacional para IBS e CBS.  
    
  1 - IBS e CBS apurados pelo SN;  
  2 - CBS apurada pelo SN e IBS apurado pelo regime regular;  
  3 - IBS e CBS apurados pelo regime regular
- **Notas explicativas:** Quando opSimpNac = 4 (Pendente), a NFS-e gerada só vai possuir as informações duplicadas de vIBSTot e vCBS (como contribuinte regular) e vIBSSN e vCBSSN quando regApIBSCBSSN = 1.
- **Valores aceitos (domínio identificado):**
  - `1` → IBS e CBS apurados pelo SN
  - `2` → CBS apurada pelo SN e IBS apurado pelo regime regular
  - `3` → IBS e CBS apurados pelo regime regular
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — É obrigatorio o preenchimento do campo de regime de apuração tributária pelo Simples Nacional para IBS e CBS para o optante do Simples Nacional ME/EPP ou com opção Pendente.
    - Detalhe da regra: O regime de apuração tributária pelo Simples Nacional para IBS e CBS deve ser preenchido obrigatoriamente quando o prestador de serviço for optante do simples nacional ou com a opção pendente, ou seja, o campo opSimpNac = 3 (ME/EPP) ou 4 (Pendente).
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Este campo não deve ser preenchido quando o prestador de serviço não for optante  pelo regime do Simples Nacional.
    - Detalhe da regra: O regime de apuração tributária pelo Simples Nacional para IBS e CBS não deve ser preenchido quando o prestador de serviço não for optante do simples nacional ou for MEI, ou seja, o campo opSimpNac = 1 (Não Optante) ou 2 (MEI).

### `NFSe/infNFSe/DPS/infDPS/prest/regTrib/regEspTrib`

- **Campo:** `regEspTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/prest/regTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Tipos de Regimes Especiais de Tributação Municipal:  
    
  0 - Nenhum;  
  1 - Ato Cooperado (Cooperativa);  
  2 - Estimativa;  
  3 - Microempresa Municipal;  
  4 - Notário ou Registrador;  
  5 - Profissional Autônomo;  
  6 - Sociedade de Profissionais;  
  9 - Outros;
- **Valores aceitos (domínio identificado):**
  - `0` → Nenhum
  - `1` → Ato Cooperado (Cooperativa)
  - `2` → Estimativa
  - `3` → Microempresa Municipal
  - `4` → Notário ou Registrador
  - `5` → Profissional Autônomo
  - `6` → Sociedade de Profissionais
  - `9` → Outros
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0172` — O Regime Especial de Tributação deve ser "Nenhum" (regEspTrib = 0) quando o serviço prestado for diferente de Tributável (tribISSQN = 1), ou seja, tribISSQN = 2, 3 ou 4.
    - Detalhe da regra: Não é permitido informar Regime Especial de Tributação, ou seja, regEspTrib deve ser igual a 0 (Nenhum), quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência",  (tribISSQN = 2, 3 ou 4).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0174` — Quando o prestador da NFS-e é MEI (opSimpNac = 2) o regime especial de tributação deve ser "Nenhum" (regEspTrib = 0).
    - Detalhe da regra: O tipo de regime especial de tributação deve ser "Nenhum", quando o prestador for MEI (opSimpNac = 2).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0175` — Quando o prestador optante pelo Simples Nacional tiver o regime de apuração dos tributos ocorrendo também pelo Simples Nacional, o regime especial de tributação do ISSQN deve ser "Nenhum" (regEspTrib = 0).
    - Detalhe da regra: O tipo de regime especial de tributação deve ser "Nenhum" (regEspTrib = 0) quando o prestador for optante do Simples Nacional ME/EPP (opSimpNac = 3) e o regime de apuração dos tributos federais e municipal ocorrer pelo SN (regApTribSN = 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0177` — Regime especial de tributação informado na DPS não é admitido na parametrização do município de incidência do ISSQN.
    - Detalhe da regra: Não é permitido informar Regime Especial de Tributação "Não admitido pelo município", conforme parametrização do município de incidência do ISSQN.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0176` — É permitido informar Profissional Autônomo na DPS somente se o prestador de serviço estiver parametrizado como Profissional Autônomo, na data de competência informada na DPS, em pelo menos um dos municípios, emissor ou de incidência do ISSQN (cLocIncid ou cLocEmi) ou se estiver admitido sem verificação (parâmetro "Informado na DPS pelo Emitente - Sem verificação"), conforme parametrização do município de incidência do ISSQN na data de competência informada na DPS.
    - Detalhe da regra: É permitido informar Profissional Autônomo na DPS somente se:   o prestador de serviço estiver parametrizado como Profissional Autônomo, na data de competência informada na DPS, em pelo menos um dos municípios, emissor ou de incidência do ISSQN (cLocIncid ou cLocEmi) ou se estiver admitido sem verificação (parâmetro "Informado na DPS pelo Emitente - Sem verificação"), conforme parametrização do município de incidência do ISSQN na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0178` — Regime especial de tributação não permitido para o prestador do serviço com código de tributação na data de competência, informados na DPS, conforme parametrização do município de incidência do ISSQN.
    - Detalhe da regra: É permitido informar Regime Especial de Tributação atribuído para contribuinte específico, conforme parametrização do município de incidência do ISSQN na data de competência informada na DPS.  ver descrição na coluna observações de negócio.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este grupo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este grupo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este grupo deve ser informado
    - Detalhe da regra: Este grupo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/DPS/infDPS/toma`

- **Campo:** `toma`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao tomador do serviço
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0187` — O grupo de informações relativas ao tomador/adquirente do serviço é obrigatório para o indicador de operação informado.
    - Detalhe da regra: Se campo cIndOp for igual a 030102, 050102, 100101, 100301, 100501, 030103, 050103, 100102, 100201, 100302, 100401, 100502 ou 100601, então o grupo toma deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/toma/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição federal (CNPJ) do tomador de serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0188` — CNPJ do tomador informado na DPS é inválido.
    - Detalhe da regra: CNPJ informado na DPS é inválido (verificar DV).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0190` — CNPJ do tomador não encontrado no cadastro CNPJ.
    - Detalhe da regra: CNPJ do tomador não existe no cadastro CNPJ na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0194` — CNPJ do emitente tomador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CNPJ e CNC NFS-e.
    - Detalhe da regra: Para este CNPJ, se o emitente for o tomador de serviço (tpEmit = 2), na data de competência informada na DPS o município emissor deve corresponder: 1) ao município do endereço registrado no cadastro CNPJ ou; 2) ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CNPJ + IM informados na DPS para o prestador devem existir no CNC NFS-e);
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0202` — Na emissão da NFS-e não é permitido que o prestador do serviço seja igual ao tomador do serviço.
    - Detalhe da regra: CNPJ do tomador é igual ao CNPJ do prestador. Para efeitos desta regra comparar o CNPJ completo.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0204` — CNPJ ou CPF do tomador não foi informado, mas existe uma indicação para retenção do ISSQN na DPS no campo de tipo de "Retenção do ISSQN".
    - Detalhe da regra: Se a DPS indicar retenção pelo tomador (tpRetISSQN = 2), então o tomador deve ser identificado por CNPJ ou CPF.

### `NFSe/infNFSe/DPS/infDPS/toma/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição federal (CPF) do tomador do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0206` — CPF do tomador informado na DPS é inválido.
    - Detalhe da regra: CPF informado na DPS é inválido (verificar DV).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0207` — CPF do tomador não encontrado no cadastro CPF.
    - Detalhe da regra: CPF do tomador inexistente no cadastro CPF na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0212` — CPF do emitente tomador não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CPF e CNC NFS-e.
    - Detalhe da regra: Para este CPF, se o emitente for o tomador de serviço (tpEmit = 2), na data de competência informada na DPS o município emissor deve corresponder ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e);

### `NFSe/infNFSe/DPS/infDPS/toma/NIF`

- **Campo:** `NIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 40
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0222` — O tomador de serviço, quando emitente da DPS, não pode ser identificado pelo NIF.
    - Detalhe da regra: Se o campo tpEmit for ígual a 2, então NIF do tomador não pode ser informado.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0223` — O NIF ou cNaoNIF do tomador deve ser informado quando o grupo de informações de endereço no exterior do tomador de serviços foi informado.
    - Detalhe da regra: Se o grupo de informações de endereço no exterior do tomador de serviços foi informado então o NIF ou cNaoNIF do tomador deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/toma/cNaoNIF`

- **Campo:** `cNaoNIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo para não informação do NIF:  
    
  0 - Não informado na nota de origem;  
  1 - Dispensado do NIF;  
  2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Não informado na nota de origem
  - `1` → Dispensado do NIF
  - `2` → Não exigência do NIF
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0224` — O tomador de serviço, quando emitente da DPS, somente pode ser identificado pelo CNPJ ou CPF.
    - Detalhe da regra: Se o campo tpEmit for ígual a 2, então cNaoNIF do tomador não pode ser informado.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0226` — Valor 0 para o motivo da não informação do NIF do tomador não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo cNaoNIF do tomador, informado na DPS, for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/toma/CAEPF`

- **Campo:** `CAEPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 14
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).

### `NFSe/infNFSe/DPS/infDPS/toma/IM`

- **Campo:** `IM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15
- **Descrição:** Número do indicador municipal do tomador do serviço.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0228` — A IM deve ser informada para o emitente tomador do serviço na DPS, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Se o emitente for o prestador de serviço (tpEmit = 2) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do tomador de serviço e o codigo do município emissor (cLocEmi), ambos informados na DPS, para identificar as ocorrências no CNC NFS-e. Se houver pelo menos uma ocorrência então o emitente da DPS deve informar o IM correspondente registrado no CNC NFS-e, que identifique unicamente o registro complementar.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0231` — IM do emitente tomador não está autorizado a emitir NFS-e, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Verificar se o IM informado na DPS está autorizado a emitir NFS-e na data de processamento desta DPS, se o emitente for o tomador de serviço (tpEmit = 2) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do tomador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0232` — IM do tomador não deve ser informado, pois não existem informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Se o emitente for o tomador de serviço (tpEmit = 2) e, se não houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então o IM não deve ser informado na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do tomador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0229` — O IM informado está inativo no CNC NFS-e do município emissor para a data de competência informada na DPS.
    - Detalhe da regra: Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.  Para o emitente tomador de serviço (tpEmit = 2), verificar se o IM informado nesta DPS está Inativo (cStat) no CNC do município emissor na data de competência informada.   Se todos os registros complementares estiverem inativos, utilizar as informações dos cadastros RFB (CNPJ ou CPF), conforme identificador federal utilizado para identificar o emitente da DPS.

### `NFSe/infNFSe/DPS/infDPS/toma/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 150
- **Descrição:** Nome / Nome Empresarial do tomador.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0233` — O nome tomador deve ser preenchido obrigatoriamente quando o NIF do tomador for preenchido.
    - Detalhe da regra: Se NIF for preenchido então o campo xNome deve ser preenchido obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/toma/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do tomador do serviço.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0234` — O endereço do tomador é obrigatório para o indicador de operação informado ou quando a incidência do ISSQN definida para o serviço prestado ocorrer no local do estabelecimento/domicílio do tomador.
    - Detalhe da regra: Quando o emitente da DPS informar um subitem da lista de serviço cuja incidência do ISSQN ocorra no local do estabelecimento/endereço do tomador, conforme planilha MUN.INCID_INFO.SERV.  ou cIndOp for igual a 030102, 050102, 100101, 100301, 100501, 030103, 050103, 100102, 100201, 100302, 100401, 100502 ou 100601  o endereço do tomador deve ser obrigatoriamente informado.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endNac`

- **Campo:** `endNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço nacional.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0235` — O endereço nacional do tomador do serviço deve ser informado na DPS quando o tomador for identificado pelo CNPJ.
    - Detalhe da regra: Se o tpEmit é igual a 1 e o tomador foi identificado pelo CNPJ, então o grupo de informações de endereço nacional do tomador do serviço deve ser informado obrigatoriamente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0236` — O endereço nacional do tomador do serviço não deve ser informado na DPS quando o próprio tomador do serviço for o emitente da DPS.
    - Detalhe da regra: Se o emitente da DPS é o tomador do serviço (tpEmit = 2), então o grupo de informações do endereço nacional do tomador não deve ser informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0237` — O endereço nacional do tomador do serviço deve ser informado na DPS quando o valor do ISSQN for retido pelo tomador, exceto se o emitente da DPS é o próprio tomador do serviço.
    - Detalhe da regra: Se o valor do ISSQN deve ser retido pelo tomador do serviço (tpRetISSQN = 2), então o grupo de informações do endereço nacional deve ser informado na DPS obrigatoriamente, exceto se o emitente da DPS é o tomador do serviço (tpEmit = 2).

### `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do tomador do serviço.  
   (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0238` — O código do município informado na DPS para o endereço do tomador do serviço não existe conforme tabela de município do IBGE.
    - Detalhe da regra: O código do município informado para o endereço do tomador do serviço não existe, conforme tabela de municípios do IBGE.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP)   
   do endereço do tomador do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0240` — O CEP informado para o endereço nacional do tomador do serviço não existe ou não pertence ao município do endereço do tomador.
    - Detalhe da regra: O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço no exterior.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0242` — O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o tomador for identificado pelo NIF e o emitente por CNPJ.
    - Detalhe da regra: Se o NIF do tomador de serviço foi informado e o emitente da DPS for identificado por CNPJ, então o grupo de informações de endereço no exterior do tomador do serviço deve ser informado obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cPais`

- **Campo:** `cPais`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do país do endereço do prestador do tomador do serviço.  
   (Tabela de Países ISO)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0246` — O código de país informado para o endereço no exterior do tomador do serviço não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do tomador do serviço, conforme tabela de país ISO2.
    - Detalhe da regra: O código de país informado para o endereço no exterior do tomador do serviço deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-11
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/end/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do tomador do serviço.

### `NFSe/infNFSe/DPS/infDPS/toma/fone`

- **Campo:** `fone`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 6-20
- **Descrição:** Número do telefone do tomador.  
  (Preencher com o Código DDD + número do telefone.   
  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `NFSe/infNFSe/DPS/infDPS/toma/email`

- **Campo:** `email`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/toma/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-80
- **Descrição:** E-mail do tomador.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0247` — Email inválido.
    - Detalhe da regra: Email deve ser informado conforme estrutura (conter @, ponto etc.).

### `NFSe/infNFSe/DPS/infDPS/interm`

- **Campo:** `interm`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao intermediário do serviço

### `NFSe/infNFSe/DPS/infDPS/interm/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição federal (CNPJ) do intermediário de serviço
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0248` — CNPJ do intermediário informado na DPS é inválido.
    - Detalhe da regra: CNPJ informado na DPS é inválido (verificar DV).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0250` — CNPJ do intermediário não encontrado no cadastro CNPJ.
    - Detalhe da regra: CNPJ do intermediário não existe no cadastro CNPJ na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0254` — CNPJ do emitente intermediário não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CNPJ e CNC NFS-e.
    - Detalhe da regra: Para este CNPJ, se o emitente for o intermediário do serviço (tpEmit = 3), na data de competência informada na DPS o município emissor deve corresponder: 1) ao município do endereço registrado no cadastro CNPJ ou; 2) ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CNPJ + IM informados na DPS para o prestador devem existir no CNC NFS-e);
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0262` — Na emissão da NFS-e não é permitido que o prestador do serviço seja igual ao intermediário do serviço.
    - Detalhe da regra: CNPJ do intermediário é igual ao CNPJ do prestador. Para efeitos desta regra comparar a raíz dos CNPJ (8 primeiros dígitos).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0264` — CNPJ ou CPF do intermediário não foi informado, mas existe uma indicação para retenção do ISSQN na DPS no campo de tipo de "Retenção do ISSQN".
    - Detalhe da regra: Se a DPS indicar retenção pelo intermediário (tpRetISSQN = 3), então o intermediário deve ser identificado por CNPJ ou CPF.

### `NFSe/infNFSe/DPS/infDPS/interm/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição federal (CPF) do intermediário do serviço
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0266` — CPF do intermediário informado na DPS é inválido.
    - Detalhe da regra: CPF informado na DPS é inválido (verificar DV).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0268` — CPF do intermediário não encontrado no cadastro CPF.
    - Detalhe da regra: CPF intermediário inexistente no cadastro CPF na data de competência informada na DPS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0272` — CPF do emitente intermediário não possui estabelecimento ou domicílio em um município correspondente ao município emissor, na data de competência informada na DPS, conforme cadastros CPF e CNC NFS-e.
    - Detalhe da regra: Para este CPF, se o emitente for o intermediário do serviço (tpEmit = 3), na data de competência informada na DPS o município emissor (cLocEmi) deve corresponder ao município do endereço registrado no cadastro nacional complementar NFS-e. (cLocEmi + CPF + IM informados na DPS para o prestador devem existir no CNC NFS-e);

### `NFSe/infNFSe/DPS/infDPS/interm/NIF`

- **Campo:** `NIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 40
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0280` — O intermediário de serviço, quando emitente da DPS, não pode ser identificado pelo NIF.
    - Detalhe da regra: Se o campo tpEmit for ígual a 3, então NIF do intermediário não pode ser informado.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0281` — O NIF ou cNaoNIF do intermediário deve ser informado quando o grupo de informações de endereço no exterior do intermediário de serviços foi informado.
    - Detalhe da regra: Se o grupo de informações de endereço no exterior do intermediário de serviços foi informado então o NIF ou cNaoNIF do intermediário deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/interm/cNaoNIF`

- **Campo:** `cNaoNIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo para não informação do NIF:  
    
  0 - Não informado na nota de origem;  
  1 - Dispensado do NIF;  
  2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Não informado na nota de origem
  - `1` → Dispensado do NIF
  - `2` → Não exigência do NIF
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0284` — O intermediário de serviço, quando emitente da DPS, somente pode ser identificado pelo CNPJ ou CPF.
    - Detalhe da regra: Se o campo tpEmit for ígual a 3, então cNaoNIF do intermediário não pode ser informado.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0286` — Valor 0 para o motivo da não informação do NIF do intermediário não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo cNaoNIF do intermediário, informado na DPS, for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/interm/CAEPF`

- **Campo:** `CAEPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 14
- **Descrição:** Número do Cadastro de Atividade Econômica da Pessoa Física (CAEPF).

### `NFSe/infNFSe/DPS/infDPS/interm/IM`

- **Campo:** `IM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 15
- **Descrição:** Número do indicador municipal do intermediário do serviço
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0287` — A IM não foi informada para o emitente intermediário do serviço na DPS.
    - Detalhe da regra: Se o emitente for o prestador de serviço (tpEmit = 3) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço e o codigo do município emissor (cLocEmi), ambos informados na DPS, para identificar as ocorrências no CNC NFS-e. Se houver pelo menos uma ocorrência então o emitente da DPS deve informar o IM correspondente registrado no CNC NFS-e, que identifique unicamente o registro complementar.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0289` — IM do emitente intermediário não está autorizado a emitir NFS-e, conforme informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Verificar se o IM informado na DPS está autorizado a emitir NFS-e na data de processamento desta DPS, se o emitente for o intermediário de serviço (tpEmit = 3) e, se houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então a IM deve ser informada na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do intermediário de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0290` — IM do intermediário não deve ser informado, pois não existem informações complementares registradas no CNC NFS-e do município emissor informado na DPS.
    - Detalhe da regra: Se o emitente for o intermediário de serviço (tpEmit = 3) e, se não houver registro complementar do contribuinte no CNC do município correspondente ao município emissor da DPS, então o IM não deve ser informado na DPS.  Utilizar o identificador federal (CNPJ ou CPF) do intermediário de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0288` — O IM informado está inativo no CNC NFS-e do município emissor para a data de competência informada na DPS.
    - Detalhe da regra: Utilizar o identificador federal (CNPJ ou CPF) do prestador de serviço, o codigo do município emissor (cLocEmi) e o IM,  informados na DPS, para identificar o registro complementar no CNC NFS-e.  Para o emitente intermediário de serviço (tpEmit = 3), verificar se o IM informado nesta DPS está Inativo (cStat) no CNC do município emissor na data de competência informada.   Se todos os registros complementares estiverem inativos, utilizar as informações dos cadastros RFB (CNPJ ou CPF), conforme identificador federal utilizado para identificar o emitente da DPS.

### `NFSe/infNFSe/DPS/infDPS/interm/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 150
- **Descrição:** Nome / Nomer Empresarial do intermediário
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0292` — O nome intermediário deve ser preenchido obrigatoriamente quando o NIF do intermediário for preenchido.
    - Detalhe da regra: Se NIF for preenchido então o campo xNome deve ser preenchido obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/interm/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endNac`

- **Campo:** `endNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço nacional.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1388` — O endereço nacional do intermediário do serviço deve ser informado na DPS quando o intermediário for identificado pelo CNPJ.
    - Detalhe da regra: Se o tpEmit é igual a 1 e o intermediário foi identificado pelo CNPJ, então o grupo de informações de endereço nacional do intermediário do serviço deve ser informado obrigatoriamente.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0291` — O endereço nacional do intermediário do serviço não deve ser informado na DPS quando o próprio tomador do serviço for o emitente da DPS.
    - Detalhe da regra: Se o emitente da DPS é o intermediário do serviço (tpEmit = 3), então o grupo de informações do endereço nacional do intermediário não deve ser informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0293` — O endereço nacional do intermediário do serviço deve ser informado na DPS quando o valor do ISSQN for retido pelo intermediário, exceto se o emitente da DPS é o intermediário do serviço.
    - Detalhe da regra: Se o valor do ISSQN deve ser retido pelo intermediário do serviço (tpRetISSQN = 3), então o grupo de informações do endereço nacional deve ser informado na DPS obrigatoriamente, exceto se o emitente da DPS é o intermediário do serviço (tpEmit = 3).

### `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do intermediário do serviço.  
   (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0294` — O código do município informado na DPS para o endereço do intermediário do serviço não existe conforme tabela de município do IBGE.
    - Detalhe da regra: O código do município informado para o endereço do intermediário do serviço não existe, conforme tabela de municípios do IBGE.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP)   
   do endereço do intermediário do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0296` — O CEP informado para o endereço nacional do intermediário do serviço não existe ou não pertence ao município do endereço do intermediário.
    - Detalhe da regra: O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço no exterior.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0298` — O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o intermediário for identificado pelo NIF e o emitente por CNPJ.
    - Detalhe da regra: Se o NIF do intermediário de serviço foi informado e o emitente da DPS for identificado por CNPJ, então o grupo de informações de endereço no exterior do tomador do serviço deve ser informado obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cPais`

- **Campo:** `cPais`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do país do endereço do prestador do intermediário do serviço.  
   (Tabela de Países ISO)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0299` — O código de país informado para o endereço no exterior do intermediário do serviço não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do intermediário do serviço, conforme tabela de país ISO2.
    - Detalhe da regra: O código de país informado para o endereço no exterior do intermediário do serviço deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-11
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/end/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do intermediário do serviço.

### `NFSe/infNFSe/DPS/infDPS/interm/fone`

- **Campo:** `fone`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 6-20
- **Descrição:** Número do telefone do intermediário.  
  (Preencher com o Código DDD + número do telefone.   
  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `NFSe/infNFSe/DPS/infDPS/interm/email`

- **Campo:** `email`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/interm/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-80
- **Descrição:** E-mail do intermediário.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0300` — Email inválido.
    - Detalhe da regra: Email deve ser informado conforme estrutura (conter @, ponto etc.).

### `NFSe/infNFSe/DPS/infDPS/serv`

- **Campo:** `serv`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao serviço prestado
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/DPS/infDPS/serv/locPrest`

- **Campo:** `locPrest`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao local da prestação do serviço
- **Notas explicativas:** OBS: As operações de exploração de vias (ou rodovias) no campo de incidência do ISSQN (subitem 22.01 da lista de serviço do Sistema Nacional NFS-e) serão formalizadas pela "NFS-e Via", Nota Fiscal de Serviço eletrônica de Exploração de Via, que terá um layout específico a ser publicado em breve.  
    
     
   Para atender o dispositivo do Art 3º, § 3º,  
   (Considera-se ocorrido o fato gerador do imposto no local do estabelecimento prestador nos serviços executados em águas marítimas, excetuados os serviços descritos no subitem 20.01)  
   o Sistema Nacional NFS-e "Águas Marítimas" como uma localidade de prestação de serviço, assim como qualquer município brasileiro.  
     
   cLocPrestacao poderá assumir: qualquer código que represente um município da tabela de códigos de municípios do IBGE, qualquer código quer represente um trecho de concessão de exploração de rodovias do cadastro próprio do Sistema Nacional NFS-e ou 0000000, que representa "Águas Marítimas".

### `NFSe/infNFSe/DPS/infDPS/serv/locPrest/cLocPrestacao`

- **Campo:** `cLocPrestacao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/locPrest/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código da localidade da prestação do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0302` — O código do local da prestação do serviço não existe conforme a tabela de municípios IBGE disponibilizada no ANEXO_A-MUNICIPIO_IBGE-PAISES_ISO2-SNNFSe.
    - Detalhe da regra: Se informado, o código do município deve existir na tabela de municípios do IBGE ou possuir a codificação 0000000, que representa "Águas Marítimas".
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1402` — Quando é informado o subitem 200101 para o código de tributação nacional (cTribNac), não é permitido informar 0000000, que representa "Águas Marítimas", para o local de prestação do serviço (cLocPrestacao).
    - Detalhe da regra: Se informado o subitem 200101 para o código de tributação nacional (cTribNac),  então não é permitido informar 0000000, que representa "Águas Marítimas", para o local de prestação do serviço (cLocPrestacao).

### `NFSe/infNFSe/DPS/infDPS/serv/locPrest/cPaisPrestacao`

- **Campo:** `cPaisPrestacao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/locPrest/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do país onde ocorreu a prestação do serviço.  
  (Tabela de Países ISO)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0304` — Informe um código de país existente diferente de Brasil (BR), conforme tabela de país ISO2.
    - Detalhe da regra: Se informado, o código do país deve existir na tabela de país ISO2 e ser diferente de Brasil (BR).

### `NFSe/infNFSe/DPS/infDPS/serv/cServ`

- **Campo:** `cServ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao código do serviço prestado

### `NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribNac`

- **Campo:** `cTribNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 6
- **Descrição:** Código de tributação nacional do ISSQN, nos termos da LC 116/2003, Conforme aba MUN.INCID_INFO.SERV. do ANEXO I
- **Notas explicativas:** Para o caso de serviço prestado em "Águas Marítimas" o seviço informado nunca poderá ser 20.01
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0310` — O código de tributação nacional informado não existe ou não está administrado pelo município de incidência do ISSQN na data de competência informada na DPS, 
conforme a lista de serviços nacional do Sistema Nacional NFS-e.
    - Detalhe da regra: Verificar se o código de tributação nacional informado existe e está administrado pelo município de incidência do ISSQN na data de competência informada na DPS, conforme a lista de serviços nacional do Sistema Nacional NFS-e.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0312` — O código de tributação nacional informado não está administrado pelo município de incidência do ISSQN na data de competência informada na DPS, 
conforme a lista de serviços nacional do Sistema Nacional NFS-e.
    - Detalhe da regra: Verificar se o código de tributação nacional informado está administrado pelo município de incidência do ISSQN na data de competência informada na DPS, conforme a lista de serviços nacional do Sistema Nacional NFS-e.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.

### `NFSe/infNFSe/DPS/infDPS/serv/cServ/cTribMun`

- **Campo:** `cTribMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 3
- **Descrição:** Código de tributação municipal do ISSQN.
- **Regras de negócio associadas:**
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0314` — O código de tributação municipal informado não existe ou não está administrado pelo município de incidência do ISSQN na data de competência informada na DPS,
    - Detalhe da regra: Verificar se o código de tributação municipal informado existe e está administrado pelo município de incidência do ISSQN na data de competência informada na DPS.  Exceto quando o emitente da DPS for MEI na data de competência da emissão da NFS-e.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0315` — Não é permitido informar 000 para o codigo de tributação municipal na DPS.

### `NFSe/infNFSe/DPS/infDPS/serv/cServ/cNBS`

- **Campo:** `cNBS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 9
- **Descrição:** Código NBS correspondente ao serviço prestado, seguindo a versão 2.0, conforme Anexo B.
- **Notas explicativas:** NBS - Nomenclatura Brasileira de Serviços, Intangíveis e outras Operações que produzam Variações no Patrimônio
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0316` — Código da lista NBS informado inexistente tabela de NBS do sistema.
    - Detalhe da regra: O código da lista NBS informado na DPS não existe, conforme tabela NBS do ANEXO_B-NBS2-LISTA_SERVICO_NACIONAL-SNNFSe do Manual Integrado do Sistema Nacional NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0318` — É obrigatório informar na DPS um item da NBS para casos de exportação de serviço.
    - Detalhe da regra: Se o emitente for o prestador (tpEmit = 1) e qualquer um dos campos abaixo for informado na DPS,  País no exterior do endereço do tomador do serviço ou País no exterior do endereço do intermediário do serviço ou cPaisPrestacao é informado,  então é obrigatório informar na DPS um  item da NBS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0320` — É obrigatório informar na DPS um item da NBS para casos de importação de serviço.
    - Detalhe da regra: Se o emitente for o tomador (tpEmit = 2) ou o intermediário de serviço (tpEmit = 3), e qualquer um dos campos abaixo for informado na DPS  País no exterior do endereço do prestador do serviço ou cPaisPrestacao é informado,  então é obrigatório informar na DPS um item da NBS.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0322` — É obrigatório informar na DPS um item da NBS se for declarada qualquer informação de IBS/CBS.
    - Detalhe da regra: Se o bloco de informações de IBS/CBS (NFSe/infNFSe/DPS/infDPS/IBSCBS) for informado na DPS, então é obrigatório informar na DPS um item da NBS.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O código da NBS informado para o subitem 99.03 do código de tributação nacional deve ser 1.1002.10.00 ou 1.1002.20.00.
    - Detalhe da regra: Quando o código de tributação nacional (cTribNac) corresponder ao subitem 99.03, o código da NBS informado deve ser obrigatoriamente 1.1002.10.00 ou 1.1002.20.00.

### `NFSe/infNFSe/DPS/infDPS/serv/cServ/cAtvSN`

- **Campo:** `cAtvSN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2
- **Descrição:** Código da atividade do Simples Nacional, conforme a Lei Complementar nº 123/2006:  
    
  7 - Prestação de serviços, cessão de direitos, de uso ou de espaço com incidência do ISS, tributados exclusivamente pelo Anexo III.  
  8 - Prestação de serviços contábeis autorizados a pagar o ISS em valor fixo em guia do Município - Anexo III.  
  9 - Prestação de serviços - Sujeitos ao Fator “R” – Anexo III ou V.  
  10 - Prestação de serviços de transporte municipal rodoviário, metroviário, ferroviário e aquaviário de passageiros relacionados no subitem 16.01 da lista anexa à LC 116/2003 - Anexo III.  
  11 - Locação de bens móveis e operações com serviços, bens imateriais e direitos, inclusive com bens imóveis, sem incidência de ISS - Anexo III.  
  12 - Prestação de serviços da área da construção civil relacionados nos subitens 7.02 e 7.05 da lista anexa à LC 116/2003 - Anexo III.  
  13 - Prestação de serviços da área da construção civil relacionados nos subitens 7.02 e 7.05 da lista anexa à LC 116/2003 - Anexo IV.  
  14 - Prestação de serviços - Anexo IV.  
  90 - Operações não tributadas.
- **Notas explicativas:** Em observância à padronização das informações constantes nos documentos fiscais de padrão nacional, manteve-se a numeração ordinal da relação de códigos da atividade do Simples Nacional, conforme a Lei Complementar nº 123/2006, adotando-se apenas aqueles aplicáveis às operações abrangidas pela NFS-e.  
    
  Campo deve ser informado apenas quando opSimpNac =   2 - Optante - Microempreendedor Individual (MEI); ou  
     3 - Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP); ou 4 - Optante Pendente;
- **Valores aceitos (domínio identificado):**
  - `7` → Prestação de serviços, cessão de direitos, de uso ou de espaço com incidência do ISS, tributados exclusivamente pelo Anexo III.
  - `8` → Prestação de serviços contábeis autorizados a pagar o ISS em valor fixo em guia do Município - Anexo III.
  - `9` → Prestação de serviços - Sujeitos ao Fator “R” – Anexo III ou V.
  - `10` → Prestação de serviços de transporte municipal rodoviário, metroviário, ferroviário e aquaviário de passageiros relacionados no subitem 16.01 da lista anexa à LC 116/2003 - Anexo III.
  - `11` → Locação de bens móveis e operações com serviços, bens imateriais e direitos, inclusive com bens imóveis, sem incidência de ISS - Anexo III.
  - `12` → Prestação de serviços da área da construção civil relacionados nos subitens 7.02 e 7.05 da lista anexa à LC 116/2003 - Anexo III.
  - `13` → Prestação de serviços da área da construção civil relacionados nos subitens 7.02 e 7.05 da lista anexa à LC 116/2003 - Anexo IV.
  - `14` → Prestação de serviços - Anexo IV.
  - `90` → Operações não tributadas.
  - `3` → Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP); ou 4 - Optante Pendente
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — É obrigatório o preenchimento do código da atividade do Simples Nacional para o prestador de serviço optante do regime do Simples Nacional ou com sua opção pendente.
    - Detalhe da regra: O código da atividade do Simples Nacional deve ser preenchido quando opSimNac = 3 (ME/EPP) ou 4 (Pendente).
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Este campo não deve ser informado para prestador de serviço não optante do regime do Simples Nacional.
    - Detalhe da regra: O código da atividade do Simples Nacional não deve ser preenchido quando opSimNac = 1 (Não Optante) ou 2 (MEI).
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o código de tributação nacional informado for 16.01.XX, deve ser informado o código da atividade do Simples Nacional igual a 10.
    - Detalhe da regra: Para o subitem do código de tributação nacional (cTribNac) = 16.01, deve ser informado o cAtvSN = 10.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o código de tributação nacional informado for 99.04.01, deve ser informado o código da atividade do Simples Nacional igual a 11.
    - Detalhe da regra: Para o subitem do código de tributação nacional (cTribNac) = 99.04.01, deve ser informado o cAtvSN = 11.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o código de tributação nacional informado for 7.02.XX ou 7.05.XX, deve ser informado o código da atividade do Simples Nacional igual a 12 ou 13.
    - Detalhe da regra: Para os subitens dos códigos de tributação nacional (cTribNac) = 7.02 ou 7.05, deve ser informado o cAtvSN = 12 ou 13.

### `NFSe/infNFSe/DPS/infDPS/serv/cServ/cIntContrib`

- **Campo:** `cIntContrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 20
- **Descrição:** Código interno do contribuinte
- **Notas explicativas:** Utilizado para identificação da DPS no Sistema interno do Contribuinte

### `NFSe/infNFSe/DPS/infDPS/serv/cServ/xDescServ`

- **Campo:** `xDescServ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/cServ/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1000
- **Descrição:** Descrição completa do serviço prestado

### `NFSe/infNFSe/DPS/infDPS/serv/comExt`

- **Campo:** `comExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações sobre transações entre residentes ou domiciliados no Brasil com residentes ou domiciliados no exterior
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0330` — É obrigatório prestar informações de comércio exterior para as situações de exportação de serviços.
    - Detalhe da regra: EXPORTAÇÃO DE SERVIÇO  Se o emitente for o prestador (tpEmit = 1), e qualquer um dos campos abaixo for informado na DPS   País no exterior do endereço do tomador do serviço, País no exterior do endereço do intermediário do serviço ou cPaisPrestacao é informado ou  tribISSQN for Exportação de serviço (tribISSQN = 3),  então o grupo de informações de comércio exterior devem ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0331` — É obrigatório prestar informações de comércio exterior para as situações de importação de serviços.
    - Detalhe da regra: IMPORTAÇÃO DE SERVIÇO   Se o emitente for o tomador (tpEmit = 2) ou o intermediário de serviço (tpEmit = 3),  e qualquer um dos campos abaixo for informado na DPS  País no exterior do endereço do prestador do serviço ou cPaisPrestacao é informado,  então o grupo de informações de comércio exterior devem ser informados.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/mdPrestacao`

- **Campo:** `mdPrestacao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Modo de Prestação:  
    
  0 - Desconhecido (tipo não informado na nota de origem);  
  1 - Transfronteiriço;  
  2 - Consumo no Brasil;  
  3 - Movimento Temporário de Pessoas Físicas;  
  4 - Consumo no Exterior;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Desconhecido (tipo não informado na nota de origem)
  - `1` → Transfronteiriço
  - `2` → Consumo no Brasil
  - `3` → Movimento Temporário de Pessoas Físicas
  - `4` → Consumo no Exterior
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0333` — Valor 0 para o modo de prestação não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo mdPrestacao for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/vincPrest`

- **Campo:** `vincPrest`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Vínculo entre as partes no negócio:  
    
  0 - Sem vínculo com o Tomador/Prestador  
  1 - Controlada;  
  2 - Controladora;  
  3 - Coligada;  
  4 - Matriz;  
  5 - Filial ou sucursal;  
  6 - Outro vínculo;  
  9 - Desconhecido (tipo não informado na nota de origem);
- **Notas explicativas:** Adicionar ao Hint do campo: O adquirente/ Prestador do serviço é pessoa considerada vinculada ao prestador/ adquirente, nos termos do art. 23 da Lei nº 9.430, de 1996
- **Valores aceitos (domínio identificado):**
  - `0` → Sem vínculo com o Tomador/Prestador
  - `1` → Controlada
  - `2` → Controladora
  - `3` → Coligada
  - `4` → Matriz
  - `5` → Filial ou sucursal
  - `6` → Outro vínculo
  - `9` → Desconhecido (tipo não informado na nota de origem)

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/tpMoeda`

- **Campo:** `tpMoeda`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Identifica a moeda da transação comercial.   
  O usuário deve informar o código da moeda.
- **Notas explicativas:** inclusão, no Emissor Público, da tabela de moedas do Banco Central do Brasil para seleção pelo emitente da NFS-e.   
  No Painel Nacional deverá haver função para atualização da tabela de Moedas.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/vServMoeda`

- **Campo:** `vServMoeda`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do serviço prestado expresso em moeda estrangeira especificada em tpmoeda.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/mecAFComexP`

- **Campo:** `mecAFComexP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo prestador do serviço:  
    
  00 - Desconhecido (tipo não informado na nota de origem);  
  01 - Nenhum;  
  02 - ACC - Adiantamento sobre Contrato de Câmbio – Redução a Zero do IR e do IOF;  
    03 - ACE – Adiantamento sobre Cambiais Entregues - Redução a Zero do IR e do IOF;  
  04 - BNDES-Exim Pós-Embarque – Serviços;  
   05 - BNDES-Exim Pré-Embarque - Serviços;  
    06 - FGE - Fundo de Garantia à Exportação;  
  07 - PROEX - EQUALIZAÇÃO  
   08 - PROEX - Financiamento;
- **Notas explicativas:** Campo disponível na nota do prestador.  
    
  O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `00` → Desconhecido (tipo não informado na nota de origem)
  - `01` → Nenhum
  - `02` → ACC - Adiantamento sobre Contrato de Câmbio – Redução a Zero do IR e do IOF
  - `03` → ACE – Adiantamento sobre Cambiais Entregues - Redução a Zero do IR e do IOF
  - `04` → BNDES-Exim Pós-Embarque – Serviços
  - `05` → BNDES-Exim Pré-Embarque - Serviços
  - `06` → FGE - Fundo de Garantia à Exportação
  - `07` → PROEX - EQUALIZAÇÃO
  - `08` → PROEX - Financiamento
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0341` — Valor 0 para o Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo prestador do serviço não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo mecAFComexP for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/mecAFComexT`

- **Campo:** `mecAFComexT`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo tomador do serviço:  
    
  00 - Desconhecido (tipo não informado na nota de origem);  
  01 - Nenhum;  
  02 - Adm. Pública e Repr. Internacional;  
  03 - Alugueis e Arrend. Mercantil de maquinas, equip., embarc. e aeronaves;  
  04 - Arrendamento Mercantil de aeronave para empresa de transporte aéreo público;  
  05 - Comissão a agentes externos na exportação;  
  06 - Despesas de armazenagem, mov. e transporte de carga no exterior;  
  07 - Eventos FIFA (subsidiária);  
  08 - Eventos FIFA;  
  09 - Fretes, arrendamentos de embarcações ou aeronaves e outros;  
  10 - Material Aeronáutico;  
  11 - Promoção de Bens no Exterior;  
  12 - Promoção de Dest. Turísticos Brasileiros;  
  13 - Promoção do Brasil no Exterior;  
  14 - Promoção Serviços no Exterior;  
  15 - RECINE;  
  16 - RECOPA;  
  17 - Registro e Manutenção de marcas, patentes e cultivares;  
  18 - REICOMP;  
  19 - REIDI;  
  20 - REPENEC;  
  21 - REPES;  
  22 - RETAERO;   
  23 - RETID;  
  24 - Royalties, Assistência Técnica, Científica e Assemelhados;  
  25 - Serviços de avaliação da conformidade vinculados aos Acordos da OMC;  
  26 - ZPE;
- **Notas explicativas:** Campo disponível na nota do tomador.  
    
  O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `00` → Desconhecido (tipo não informado na nota de origem)
  - `01` → Nenhum
  - `02` → Adm. Pública e Repr. Internacional
  - `03` → Alugueis e Arrend. Mercantil de maquinas, equip., embarc. e aeronaves
  - `04` → Arrendamento Mercantil de aeronave para empresa de transporte aéreo público
  - `05` → Comissão a agentes externos na exportação
  - `06` → Despesas de armazenagem, mov. e transporte de carga no exterior
  - `07` → Eventos FIFA (subsidiária)
  - `08` → Eventos FIFA
  - `09` → Fretes, arrendamentos de embarcações ou aeronaves e outros
  - `10` → Material Aeronáutico
  - `11` → Promoção de Bens no Exterior
  - `12` → Promoção de Dest. Turísticos Brasileiros
  - `13` → Promoção do Brasil no Exterior
  - `14` → Promoção Serviços no Exterior
  - `15` → RECINE
  - `16` → RECOPA
  - `17` → Registro e Manutenção de marcas, patentes e cultivares
  - `18` → REICOMP
  - `19` → REIDI
  - `20` → REPENEC
  - `21` → REPES
  - `22` → RETAERO
  - `23` → RETID
  - `24` → Royalties, Assistência Técnica, Científica e Assemelhados
  - `25` → Serviços de avaliação da conformidade vinculados aos Acordos da OMC
  - `26` → ZPE
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0343` — Valor 0 para o Mecanismo de apoio/fomento ao Comércio Exterior utilizado pelo tomador do serviço não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo mecAFComexT for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/movTempBens`

- **Campo:** `movTempBens`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Vínculo da Operação à Movimentação Temporária de Bens:  
    
  0 - Desconhecido (tipo não informado na nota de origem);  
  1 - Não;  
  2 - Vinculada - Declaração de Importação;  
  3 - Vinculada - Declaração de Exportação;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Desconhecido (tipo não informado na nota de origem)
  - `1` → Não
  - `2` → Vinculada - Declaração de Importação
  - `3` → Vinculada - Declaração de Exportação
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0345` — Valor 0 para o Vínculo da Operação à Movimentação Temporária de Bens não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo movTempBens for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/nDI`

- **Campo:** `nDI`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-12
- **Descrição:** Número da Declaração de Importação (DI/DSI/DA/DRI-E) averbado.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0352` — O preenchimento do campo nDI (Número da Declaração de Importação) é obrigatório quando o campo (movTempBens) Vínculo da Operação à Movimentação Temporária de Bens for igual a 2.
    - Detalhe da regra: Se movTempBens = 2, então o preenchimento de nDI é obrigatório
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0354` — O preenchimento dos campos nDI (Número da Declaração de Importação) ou do nRE (úmero do Registro de Exportação) não é permitido quando o campo (movTempBens) Vínculo da Operação à Movimentação Temporária de Bens for igual a 1.
    - Detalhe da regra: Se movTempBens = 1, então o preenchimento de nDI e nRE não é permitido

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/nRE`

- **Campo:** `nRE`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 12
- **Descrição:** Número do Registro de Exportação (RE) averbado.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0356` — O preenchimento do campo nRE (úmero do Registro de Exportação) é obrigatório quando o campo (movTempBens) Vínculo da Operação à Movimentação Temporária de Bens for igual a 3.
    - Detalhe da regra: Se movTempBens = 3, então o preenchimento de nRE é obrigatório

### `NFSe/infNFSe/DPS/infDPS/serv/comExt/mdic`

- **Campo:** `mdic`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/comExt/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Indicador se a NFS-e deverá ser disponibilizada ao MDIC.  
    
  0 - Não enviar para o MDIC;  
  1 - Enviar para o MDIC;
- **Valores aceitos (domínio identificado):**
  - `0` → Não enviar para o MDIC
  - `1` → Enviar para o MDIC

### `NFSe/infNFSe/DPS/infDPS/servobra`

- **Campo:** `obra`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas à obras de construção civil e congêneres
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0370` — O grupo de informações de obra é obrigatório quando o código de tributação nacional pertencer a um dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 1414.03 e 14.14.04 da lista de serviços.
    - Detalhe da regra: Se o código de tributação nacional pertencer a um dos subitens, 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 14.14.03 e 14.14.04 da lista de serviços, então o grupo de informações de obra é obrigatório.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0372` — O grupo de informações de obra não é permitido quando o código de tributação nacional não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 1414.03 e 14.14.04 da lista de serviços, com exceção do código 99.01.01.
    - Detalhe da regra: Se o código de tributação nacional não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01, 07.19.01, 14.14.03 e 14.14.04 da lista de serviços, então o grupo de informações de obra não é permitido. *Exceção: O grupo de informações de obra pode ser informado se o código de tributação nacional for o 99.01.01.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/inscImobFisc`

- **Campo:** `inscImobFisc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-30
- **Descrição:** Inscrição imobiliária fiscal   
  (código fornecido pela prefeitura para a identificação da obra ou para fins de recolhimento do IPTU)

### `NFSe/infNFSe/DPS/infDPS/serv/obra/cObra`

- **Campo:** `cObra`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-30
- **Descrição:** Número de identificação da obra.  
  Cadastro Nacional de Obras (CNO) ou Cadastro Específico do INSS (CEI).

### `NFSe/infNFSe/DPS/infDPS/serv/obra/cCIB`

- **Campo:** `cCIB`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código do Cadastro Imobiliário Brasileiro - CIB
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0373` — Código CIB inválido.
    - Detalhe da regra: Código do Cadastro Imobiliário Brasileito - CIB deve ser um código válido - 7 caracteres + DV

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código de Endereçamento Postal numérico do endereço nacional da obra.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0380` — Informe um CEP correspondente ao município do local da prestação do serviço informado nesta DPS para indicar corretamente o endereço da obra.
    - Detalhe da regra: O CEP a ser informa para endereço da obra deve pertencer ao município que foi informado como local da prestação do serviço.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0382` — O CEP não deve ser informado quando o endereço da obra ocorrer no exterior do país.
    - Detalhe da regra: Se o pais da prestação do serviço de obra foi informado (cPaisPrestacao foi informado), então o CEP não pode ser informado.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações descritivas do endereço no exterior da obra.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0384` — O grupo de informações de endereço da atividade de obra ocorrido no exterior deve ser informado quando o país do local da prestação for informado na DPS.
    - Detalhe da regra: Se o pais local da prestação do serviço de obra foi informado (cPaisPrestacao foi informado), então o grupo de informações de endereço no exterior deve ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0386` — O grupo de informações de endereço da atividade de obra ocorrido no exterior não deve ser informado quando o município do local da prestação for informado na DPS.
    - Detalhe da regra: Se o município local da prestação do serviço de obra foi informado (cMunPrestacao foi informado), então o grupo de informações de endereço no exterior não pode ser informado.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-11
- **Descrição:** Código de Endereçamento Postal alfanumérico do endereço no exterior da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior, local da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior, local da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/obra/end/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/obra/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço da obra.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento`

- **Campo:** `atvEvento`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas à atividades de eventos
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0390` — O grupo de informações de Atividade/Evento é obrigatório quando o código de tributação nacional pertencer ao item 12 da lista de serviços.
    - Detalhe da regra: Se o código de tributação nacional pertencer ao item 12 da lista de serviços, então o grupo de informações de Atividade/Evento é obrigatório.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0392` — O grupo de informações de Atividade/Evento não é permitido quando o código de tributação nacional não pertencer ao item 12 da lista de serviços, com exceção do código 99.01.01.
    - Detalhe da regra: Se o código de tributação nacional não pertencer ao item 12 da lista de serviços, então o grupo de informações de Atividade/Evento não é permitido. *Exceção: O grupo de informações de Atividade/Evento pode ser informado se o código de tributação nacional for o 99.01.01.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 255
- **Descrição:** Nome do evento Artístico, Cultural, Esportivo, ...

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/dtIni`

- **Campo:** `dtIni`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data de início da atividade de evento.  
  Ano, Mês e Dia (AAAA-MM-DD)

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/dtFim`

- **Campo:** `dtFim`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Data de fim da atividade de evento.  
  Ano, Mês e Dia (AAAA-MM-DD)

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/idAtvEvt`

- **Campo:** `idAtvEvt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-30
- **Descrição:** Identificação da Atividade de Evento   
  (código identificador de evento determinado pela Administração Tributária Municipal)
- **Notas explicativas:** Choice com o grupo de endereço da atividade de evento

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código de Endereçamento Postal numérico do endereço nacional da atividade de evento.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0398` — Informe um CEP correspondente ao município do local da prestação do serviço informado nesta DPS para indicar corretamente o endereço da atividade ou evento.
    - Detalhe da regra: Se o município local da prestação da atividade de evento foi informado (cMunPrestacao foi informado), então o CEP deve ser informado e pertencer a este município.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0400` — O CEP não deve ser informado quando o endereço da atividade de evento ocorrer no exterior do país.
    - Detalhe da regra: Se o pais local da prestação da atividade de evento foi informado (cPaisPrestacao foi informado), então o CEP não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações descritivas do endereço no exterior da atividade de evento.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0402` — O grupo de informações de endereço da atividade de evento ocorrido no exterior deve ser informado quando o país do local da prestação for informado na DPS.
    - Detalhe da regra: Se o pais da prestação da atividade de evento foi informado (cPaisPrestacao foi informado), então o grupo de informações do endereço no exterior deve ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0404` — O grupo de informações de endereço da atividade de evento ocorrido no exterior não deve ser informado quando o município do local da prestação for informado na DPS.
    - Detalhe da regra: Se o município local da prestação da atividade de evento foi informado (cMunPrestacao foi informado), então o grupo de informações  do endereço no exterior não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Código de Endereçamento Postal alfanumérico do endereço no exterior da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior, local da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior, local da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/atvEvento/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço da atividade de evento.

### `NFSe/infNFSe/DPS/infDPS/servinfoCompl`

- **Campo:** `infoCompl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações complementares disponível para todos os serviços prestados
- **Notas explicativas:** Campos possíveis de preenchimento na DPS para todos os subitens da lista de serviços que forem prestados

### `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/idDocTec`

- **Campo:** `idDocTec`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-40
- **Descrição:** Identificador de Documento de Responsabilidade Técnica:  
  ART, RRT, DRT, Outros.

### `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/docRef`

- **Campo:** `docRef`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-255
- **Descrição:** Chave da nota, número identificador da nota, número do contrato ou outro identificador de documento emitido pelo prestador de serviços, que subsidia a emissão dessa nota pelo tomador do serviço ou intermediário (preenchimento obrigatório caso a nota esteja sendo emitida pelo Tomador ou intermediário do serviço).

### `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/xPed`

- **Campo:** `xPed`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-60
- **Descrição:** Número do  pedido/ordem de compra/ordem de serviço/projeto que autorize a prestação do serviço em  
  operações B2B - Informação de interesse do tomador do serviço para controle e gestão da  
  Negociação

### `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/gItemPed`

- **Campo:** `gItemPed`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de itens do pedido/ordem de compra/ordem de serviço/projeto.

### `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/gItemPed/xItemPed`

- **Campo:** `xItemPed`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/gItemPed/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-99  |  **Tamanho:** 1-60
- **Descrição:** Número do item do  pedido/ordem de compra/ordem de serviço/projeto - Identificação do número do item do  
  pedido ou ordem de compra destacado e xPed

### `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/xInfComp`

- **Campo:** `xInfComp`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/serv/infoCompl/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2000
- **Descrição:** Campo livre para preenchimento pelo contribuinte.

### `NFSe/infNFSe/DPS/infDPS/valores`

- **Campo:** `valores`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas à valores do serviço prestado
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/DPS/infDPS/valores/vServPrest`

- **Campo:** `vServPrest`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas aos valores do serviço prestado

### `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/vReceb`

- **Campo:** `vReceb`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário recebido pelo intermediário do serviço (R$).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0423` — O valor recebido deve ser informado na DPS quando o intermediário do serviço for o emitente da DPS.
    - Detalhe da regra: O valor recebido deve ser informado na DPS quando o intermediário do serviço for o emitente da DPS (tpEmit = 3).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0424` — O valor recebido não deve ser informado na DPS quando o prestador ou tomador do serviço for o emitente da DPS.
    - Detalhe da regra: O valor recebido não deve ser informado na DPS quando o prestador ou tomador do serviço for o emitente da DPS  (tpEmit = 1 ou tpEmit = 2).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0425` — O valor recebido não pode ser menor que o valor do serviço informado na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/vServ`

- **Campo:** `vServ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vServPrest/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário do serviço (R$).  
    
  (Para os códigos de tributação nacional do subitem 99.03, vServ = pCopropriedade x vTotOper)
- **Notas explicativas:** half even com tolerância de R$0,01
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0427` — O valor do serviço deve ser maior ou igual ao somatório dos valores informados para Desconto Incondicionado, Deduções/Reduções e Benefício Municipal.
    - Detalhe da regra: vAjusteBCISSQN é: um valor informado pelo emitente para ajuste (dedução/redução) da BC do ISSQN;  vCalcAjusteBCISSQN é: o cálculo do valor de ajuste (dedução/redução) da BC do ISSQN:  1) Quando o valor de ajuste (dedução/redução) for apurado a partir de um percentual informado na DPS, calcular este percentual sobre o valor do serviço já abatido o valor do desconto incondicionado. Ex:  Valor de ajuste (dedução/redução) = (Valor do serviço - valor desconto incodicional) x % de ajuste (dedução/redução).  VServ >= desconto incondicionado + Valor de (ajuste) dedução/redução  2) Quando um ou mais documentos são informados pelo emitente na DPS para ajuste (dedução/redução) da BC do ISSQN.  Neste caso o resultado do somatório é o valor deste campo do leiaute NFS-e;  ---------------------------  vInfoBM é: um valor informado pelo emitente para reduzir a BC do ISSQN;  VCalcBM é: o cálculo do valor de redução da BC do ISSQN a partir de benefício municipal:  1) Quando o valor do benefício municipal for apurado a partir de um percentual parametrizado para redução da base de cálculo, aplicar o percentual parametrizado sobre o valor do serviço já abatidos os valores do desconto incondicionado e dedução/redução.  Ex:  Valor de benefício municipal = (Valor do serviço - valor desconto incodicional - valor de dedução/redução) x % de benefício municipal.  VServ >= desconto incondicionado + Valor de ajuste (dedução/redução) + valor de benefício municipal.  2) Quando um valor monetário de benefício municipal é informado pelo emitente na DPS para redução da BC do ISSQN.

### `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond`

- **Campo:** `vDescCondIncond`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas aos descontos condicionados e incondicionados

### `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/vDescIncond`

- **Campo:** `vDescIncond`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário do desconto incondicionado (R$).  
    
  (Para os códigos de tributação nacional do subitem 99.03, vDescIncond = pCopropriedade x vDescIncondTot)
- **Notas explicativas:** half even com tolerância de R$0,01
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0431` — O valor do desconto incondicionado informado na DPS deve ser menor que o valor do serviço e maior que zero.
    - Detalhe da regra: Verificar o valor do desconto incondicionado informado na DPS que deve ser menor que o valor do serviço e maior que zero.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — Para locações (subitem 99.03), o valor do desconto incondicionado deve ser igual ao valor total do desconto incondicionado multiplicado pelo percentual de copropriedade.
    - Detalhe da regra: Para os códigos de tributação nacional do subitem 99.03, vDescIncond = pCopropriedade x vDescIncondTot.

### `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/vDescCond`

- **Campo:** `vDescCond`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vDescCondIncond/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário do desconto condicionado (R$).  
    
  (Para os códigos de tributação nacional do subitem 99.03, vDescCond = pCopropriedade x vDescCondTot)
- **Notas explicativas:** half even com tolerância de R$0,01
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0432` — O valor do desconto condicionado informado na DPS deve ser menor que o valor do serviço e maior que zero.
    - Detalhe da regra: Verificar se o valor do desconto condicionado informado na DPS deve ser menor que o valor do serviço e maior que zero.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — Para locações (subitem 99.03), o valor do desconto condicionado deve ser igual ao valor total do desconto condicionado multiplicado pelo percentual de copropriedade.
    - Detalhe da regra: Para os códigos de tributação nacional do subitem 99.03, vDescCond = pCopropriedade x vDescCondTot.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC`

- **Campo:** `vAjusteBC`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao valores para ajuste dos valores de base de cálculo.
- **Notas explicativas:** Aqui são referenciados os ajustes (deduções/reduções) que serão considerados apenas para a Base de Cálculo do ISSQN.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0435` — Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução do ISSQN quando ocorrer Imunidade, Exportação do serviço ou Não incidência.
    - Detalhe da regra: Não é permitido o preenchimento dos campos do grupo de informações relativas à ajuste de Base de Cálculo quando ocorrer "Imunidade" (tribISSQN = 2), "Exportação de serviço" (tribISSQN = 3) ou "Não incidência" (tribISSQN = 4), ou seja, tpRetISSQN tem que ser igual a 1 (tpRetISSQN = 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0436` — Não é permitido o preenchimento dos campos do grupo de informações relativas à Dedução/Redução do ISSQN quando o prestador de serviço é MEI.
    - Detalhe da regra: Não é permitido o preenchimento dos campos do grupo de informações relativas à ajuste de Base de Cálculo quando o prestador do serviço é MEI (opSimpNac = 2).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — Não é permitido o preenchimento dos campos do grupo de informações relativas à Ajuste de base de cálculo quando o prestador de serviço tiver algum regime especial de tributação, exceto se tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
    - Detalhe da regra: Não é permitido o preenchimento dos campos do grupo de informações relativas à ajustes de BC, quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5 ou 6).  Exceto quando houver qualquer ajuste de BC com documentos dos tipos:  101 – Repasse de remuneração por intermediação de imóveis a demais corretores            envolvidos na operação; 102 – Repasse de valores a fornecedor relativo a fornecimento intermediado por            agência de turismo; 103 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de produção externa por conta                                      e ordem de terceiro; 104 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de mídia por conta                                      e ordem de terceiro; 105 – Glosa de Serviços de Saúde; 199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a            operações por conta e ordem de terceiro;  ou seja, tpAjusteBC = 101, 102, 103, 104, 105 ou 199;
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — Não é permitido o preenchimento dos campos do grupo de informações relativas à ajuste de base de cálculo quando o benefício municipal informado na DPS for do tipo "Isenção", exceto se tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
    - Detalhe da regra: Não é permitido o preenchimento dos campos do grupo de informações relativas à ajustes de BC, quando o benefício municipal informado na DPS for do tipo "Isenção".   Exceto quando houver qualquer ajuste de BC com documentos dos tipos:  101 – Repasse de remuneração por intermediação de imóveis a demais corretores            envolvidos na operação; 102 – Repasse de valores a fornecedor relativo a fornecimento intermediado por            agência de turismo; 103 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de produção externa por conta                                      e ordem de terceiro; 104 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de mídia por conta                                      e ordem de terceiro; 105 – Glosa de Serviços de Saúde; 199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a            operações por conta e ordem de terceiro;  ou seja, tpAjusteBC = 101, 102, 103, 104, 105 ou 199;.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — O tipo de ajuste de base de cálculo informado na DPS não é permitido pelo município de incidência do ISSQN, conforme parametrizações do código de serviço do município de incidência,  exceto se tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
    - Detalhe da regra: Se o prestador de serviço não for optante do Simples Nacional (opSimpNac = 1) e a situação do convênio do município de incidência do ISSQN no Sistema Nacional NFS-e for "Ativo",  então o sistema permite informações de ajustes de BC, conforme as parametrizações dos respectivos códigos de serviço administrados pelo municipio de incidência do ISSQN no Sistema Nacional NFS-e.  Obs: Independentemente se o município de incidência do ISSQN não permitir ajuste de BC por documentos, o sistema nacional NFS-e aceitará a DPS com ajuste de BC para os seguintes tipos de documentos informados:  101 – Repasse de remuneração por intermediação de imóveis a demais corretores            envolvidos na operação; 102 – Repasse de valores a fornecedor relativo a fornecimento intermediado por            agência de turismo; 103 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de produção externa por conta                                      e ordem de terceiro; 104 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de mídia por conta                                      e ordem de terceiro; 105 – Glosa de Serviços de Saúde; 199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a            operações por conta e ordem de terceiro;  ou seja, tpAjusteBC = 101, 102, 103, 104, 105 ou 199;.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — Não é permitido o preenchimento de informações relativas à ajuste de base de cálculo para o prestador de serviço ME/EPP, apurando pelo SN conforme parametrização do código de serviço admnistrado pelo municipio de incidência do ISSQN, exceto se tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
    - Detalhe da regra: Se o prestador do serviço é ME/EPP (opSimpNac = 3), o regime de apuração ocorre pelo SN (regApTribSN = 1) e o municipio de incidência está "Ativo",  então não é permitido o preenchimento dos campos do grupo de informações relativas à ajustes de BC,  exceto quando o código de tributação nacional (cTribNac) corresponder aos subitens:  042201, 042301, 050901, 060101, 060201, 070201, 070202, 070501 ,070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301. Neste cenário, o sistema verifica a parametrização e permite o preenchimento das informações conforme admissões dos tipos de Ajustes de BC nas parametrizações destes respectivos códigos de serviço acima listados, administradas pelo municipio de incidência do ISSQN no Sistema Nacional NFS-e.  Obs: Independentemente se o município de incidência do ISSQN não permitir ajuste de BC por documentos, o sistema nacional NFS-e aceitará a DPS com ajuste de BC para os seguintes tipos de documentos informados:  101 – Repasse de remuneração por intermediação de imóveis a demais corretores            envolvidos na operação; 102 – Repasse de valores a fornecedor relativo a fornecimento intermediado por            agência de turismo; 103 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de produção externa por conta                                      e ordem de terceiro; 104 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de mídia por conta                                      e ordem de terceiro; 105 – Glosa de Serviços de Saúde; 199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a            operações por conta e ordem de terceiro;  ou seja, tpAjusteBC = 101, 102, 103, 104, 105 ou 199;
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — O tipo de ajuste de base de cálculo informado na DPS não é permitida para o prestador de serviço ME/EPP, apurando pelo SN, exceto se tpAjusteBC = 101, 102, 103, 104, 105 ou 199.
    - Detalhe da regra: Se o prestador do serviço é ME/EPP (opSimpNac = 3), o regime de apuração ocorre pelo SN (regApTribSN = 1) e o municipio de incidência NÃO ter a situação "Ativo" para seu convênio,  então não é permitido o preenchimento dos campos do grupo de informações relativas à ajustes de BC,  exceto quando o código de tributação nacional (cTribNac) corresponder aos subitens:  042201, 042301, 050901, 060101, 060201, 070201, 070202, 070501 ,070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.  Obs: Independentemente se o município de incidência do ISSQN NÃO ter a situação "Ativo" para seu convênio, o sistema nacional NFS-e aceitará a DPS com ajuste de BC para os seguintes tipos de documentos informados:  101 – Repasse de remuneração por intermediação de imóveis a demais corretores            envolvidos na operação; 102 – Repasse de valores a fornecedor relativo a fornecimento intermediado por            agência de turismo; 103 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de produção externa por conta                                      e ordem de terceiro; 104 – Reembolso ou ressarcimento recebido por agência de propaganda e            publicidade por valores pagos relativos a serviços de mídia por conta                                      e ordem de terceiro; 105 – Glosa de Serviços de Saúde; 199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a            operações por conta e ordem de terceiro;  ou seja, tpAjusteBC = 101, 102, 103, 104, 105 ou 199;

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/pAjusteBCISSQN`

- **Campo:** `pAjusteBCISSQN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-3V2
- **Descrição:** Valor percentual padrão para ajuste dos valores de base de cálculo do ISSQN.
- **Notas explicativas:** As três opções para informação de Ajuste (Dedução/Redução), caso exista, são:  
  Valor, Percentual ou Documento;
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `Exxx` — Só é permitido um ajuste entre os tipos percentual (pAjusteBCISSQN ) e valor monetário (vAjusteBCISSQN).
    - Detalhe da regra: Se o campo pAjusteBCISSQN for informado, o ajuste de BC para o ISSQN do tipo valor monetário (vAjusteBCISSQN) não pode ser informado na DPS.
  -  **Aplic.:** - | **Efeito:** - | **Cód. erro:** `-` — 
    - Detalhe da regra: Se informado, o valor percentual para ajuste da Base de Cálculo do ISSQN deve ser maior 0 e menor ou igual a 100%.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0454` — Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por percentual.
    - Detalhe da regra: Código de serviço informado na DPS não permite ajuste da Base de Cálculo do ISSQN por percentual, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0444` — O valor percentual  de dedução/redução informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - Detalhe da regra: O valor percentual  de ajuste da Base de Cálculo do ISSQN informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços: 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/vAjusteBCISSQN`

- **Campo:** `vAjusteBCISSQN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário padrão para ajuste dos valores de base de cálculo do ISSQN
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Só é permitido um ajuste entre os tipos percentual (pAjusteBCISSQN ) e valor monetário (vAjusteBCISSQN).
    - Detalhe da regra: Se o campo vAjusteBCISSQN for informado, o ajuste de BC para o ISSQN do tipo percentual (pAjusteBCISSQN) não pode ser informado na DPS.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0446` — Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por valor monetário.
    - Detalhe da regra: Código de serviço informado na DPS não permite ajuste da Base de Cálculo do ISSQN por valor monetário, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0447` — O valor de dedução/redução informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos subitens 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301, da lista de serviços nacional do Sistema Nacional NFS-e.
    - Detalhe da regra: O valor de ajuste da Base de Cálculo do ISSQN informado na DPS não pode reduzir o valor da BC de forma que resulte no valor do ISSQN a uma alíquota efetiva menor que 2%, exceto para os códigos relativos aos serviços: 042201, 042301, 050901, 070201, 070202, 070501 , 070502, 090201, 090202, 100101, 100102, 100103, 100104, 100105, 100201, 100202, 100301, 100401, 100402, 100403, 100501, 100502, 100601, 100701, 100801, 100901, 101001, 150101, 150102, 150103, 150104, 150105, 151001, 151002, 151003, 151004, 151005, 160101, 160102, 160103, 160104, 160201, 170501, 170601, 171001, 171002, 171101, 171102, 171201, 210101, 250301.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos`

- **Campo:** `documentos`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de documento utilizado para ajuste dos valores de base de cálculo (ISSQN e/ou IBS/CBS).
- **Regras de negócio associadas:**
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0449` — Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por documento informado.
    - Detalhe da regra: Código de serviço informado na DPS não permite dedução/redução na base de cálculo do ISSQN por documentos, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentosdocAjusteBC`

- **Campo:** `docAjusteBC`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1000  |  **Tamanho:** -
- **Descrição:** Grupo de informações de documento utilizado para ajuste dos valores de base de cálculo (ISSQN e/ou IBS/CBS).

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/tpAjusteBC`

- **Campo:** `tpAjusteBC`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-3
- **Descrição:** Tipo de Ajuste:  
    
  1 – Alimentação e bebidas/frigobar;  
  2 – Materiais;  
  3 - Produção Externa;  
  4 - Reembolso de despesas;  
  5 – Repasse consorciado;  
  6 – Repasse plano de saúde;  
  7 – Serviços;  
  8 – Subempreitada de mão de obra;  
  9 - Profissional parceiro;  
  99 – Outras deduções exclusivas do ISSQN;  
  101 – Repasse de remuneração por intermediação de imóveis a demais corretores  
             envolvidos na operação  
  102 – Repasse de valores a fornecedor relativo a fornecimento intermediado por  
             agência de turismo  
  103 – Reembolso ou ressarcimento recebido por agência de propaganda e  
             publicidade por valores pagos relativos a serviços de produção externa por conta                            
             e ordem de terceiro  
  104 – Reembolso ou ressarcimento recebido por agência de propaganda e  
             publicidade por valores pagos relativos a serviços de mídia por conta                            
             e ordem de terceiro  
  105 – Glosa de Serviços de Saúde  
  199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a  
             operações por conta e ordem de terceiro
- **Notas explicativas:** Verificar a planilha AJUSTE.BC.REPERCUSSÃO com os tipos de ajuste e as respectivas repercussões nas bases de cálculo do ISSQN, do IBS/CBS e da Receita Bruta do Simples Nacional.
- **Valores aceitos (domínio identificado):**
  - `1` → Alimentação e bebidas/frigobar
  - `2` → Materiais
  - `3` → Produção Externa
  - `4` → Reembolso de despesas
  - `5` → Repasse consorciado
  - `6` → Repasse plano de saúde
  - `7` → Serviços
  - `8` → Subempreitada de mão de obra
  - `9` → Profissional parceiro
  - `99` → Outras deduções exclusivas do ISSQN
  - `101` → Repasse de remuneração por intermediação de imóveis a demais corretores
  - `102` → Repasse de valores a fornecedor relativo a fornecimento intermediado por
  - `103` → Reembolso ou ressarcimento recebido por agência de propaganda e
  - `104` → Reembolso ou ressarcimento recebido por agência de propaganda e
  - `105` → Glosa de Serviços de Saúde
  - `199` → Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Código de serviço informado na DPS não permite (ajuste) dedução/redução na base de cálculo do ISSQN por documento informado.
    - Detalhe da regra: O código de serviço informado na DPS não permite ajuste na base de cálculo do ISSQN por documentos, conforme parametrização do município de incidência conveniado ao Sistema Nacional NFS-e. Portanto, o tipo de ajuste (tpAjusteBC) informado deve ser diferente de 2, 5, 6, 7, 8, 9 e 99.  Exceção: se o contribuinte for optante do Simples Nacional (opSimpNac = 3) e o subitem do código de tributação nacional (cTribNac) for 06.01 ou 06.02 (Salão Parceiro) ou 07.02 ou 07.05 (Construção Civil), deve ser ignorada a parametrização municipal caso o município de incidência não tenha autorizado o ajuste de base de cálculo do ISSQN por documentos.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Não é possivel informar o ajuste (dedução/redução) na base de cálculo do ISSQN por documentos quando já informado por percentual ou por valor.
    - Detalhe da regra: Se na DPS já foi informado ajuste na base de cálculo do ISSQN por percentual (pAjusteBCISSQN) ou por valor (vAjusteBCISSQN), não se permite ajuste na base de cálculo do ISSQN por documentos se o tipo de ajuste (tpAjusteBC) informado for 2, 5, 6, 7, 8, 9 ou 99.
  -  **Aplic.:** - | **Efeito:** - | **Cód. erro:** `-` — 
    - Detalhe da regra: Se o código de tributação nacional (cTribNac) = 6.01 ou 6.02, então o tipo da ajuste (tpAjusteBC) informado deve ser "Profissional Parceiro" (tpAjusteBC = 9)

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/xTpAjusteBC`

- **Campo:** `xTpAjusteBC`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 0-150
- **Descrição:** Descrição do ajuste quando o tipo informado (tpAjusteBC) é "99 – Outras deduções exclusivas do ISSQN"  
  ou  
  "199 – Outros reembolsos ou ressarcimentos recebidos por valores pagos relativos a operações por conta e ordem de terceiro".
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — A descrição do tipo de ajuste não deve ser preenchida.
    - Detalhe da regra: A descrição do ajuste de base de cálculo (xTpAjusteBC) só pode ser informada quando tpAjusteBC = 99 ou 199.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — A descrição do tipo de ajuste deve ser preenchida.
    - Detalhe da regra: A descrição do ajuste de base de cálculo (xTpAjusteBC) deve informada quando tpAjusteBC = 99 ou 199.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/vTotDoc`

- **Campo:** `vTotDoc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário total do documento informado (R$).  
  Este é o valor total no documento informado que é passível de ajuste de base(s) de cálculo.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/vAjuteAplic`

- **Campo:** `vAjuteAplic`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário efetivamente utilizado para ajuste de base(s) de cálculo do valor do serviço da NFS-e que está sendo emitida (R$).  
  Deve ser menor ou igual ao valor total do documento (vTotDoc).
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor de ajuste informado na DPS não pode ser superior ao valor do serviço prestado.
    - Detalhe da regra: O valor do ajuste aplicado deve ser menor ou igual ao valor do serviço prestado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor de ajuste não pode ser superior ao valor do documento informado.
    - Detalhe da regra: O valor do ajuste aplicado deve ser menor ou igual ao valor do documento informado (vTotDoc).

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dtEmiDoc`

- **Campo:** `dtEmiDoc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Data da emissão do documento dedutível.  
  Ano, mês e dia (AAAA-MM-DD)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0950` — Data de emissão do documento tem que ser igual ou posterior à data de competência (dtCompDoc)

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dtCompDoc`

- **Campo:** `dtCompDoc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Data da competência do documento dedutível.  
  Ano, mês e dia (AAAA-MM-DD)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0951` — Data de competência do documento tem que ser igual ou anterior à data de emissão (dtEmiDoc)

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional`

- **Campo:** `dFeNacional`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** CG  |  **Tipo:** CG  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de documentos fiscais eletrônicos que se encontram no repositório nacional.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/tipoChaveDFe`

- **Campo:** `tipoChaveDFe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Documento fiscal a que se refere a chaveDfe que seja um dos documentos do Repositório Nacional:  
  1 = NFS-e;  
  2 = NF-e;  
  3 = CT-e;  
  9 = Outro;

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/xTipoChaveDFe`

- **Campo:** `xTipoChaveDFe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-255
- **Descrição:** Descrição da DF-e a que se refere a chaveDfe que seja um dos documentos do Repositório Nacional. Deve ser preenchido apenas quando tipoChaveDFe = 9 (Outro).

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/chaveDFe`

- **Campo:** `chaveDFe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/dFeNacional/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-50
- **Descrição:** Chave do Documento Fiscal eletrônico do repositório nacional referenciado para os casos de operações já tributadas.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0940` — Chave DF-e incorreta.
    - Detalhe da regra: A chave do Documento Fiscal eletrônico - DF-e deve estar no formato DF-e indicado no tipo. Verificar tamanho: NFSe - 50 dígitos e NFe e CTe - 44 dígitos

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro`

- **Campo:** `docFiscalOutro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** CG  |  **Tipo:** CG  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de documento fiscais, eletrônicos ou não, que não se encontram no repositório nacional.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Outros documentos ficais fiscais não podem ser informados quando a data de competência for anterior a 01 de janeiro de 2026.
    - Detalhe da regra: Outros documentos fiscais só podem ser informados se a data de competência do documento (dtCompDoc) for anterior a 01/01/2026.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/cMunDocFiscal`

- **Campo:** `cMunDocFiscal`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município emissor do documento fiscal que não se encontra no repositório nacional
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0943` — O código do município emissor do documento fiscal para fins de reembolso, repasse e ressarcimento que não está no repositório nacional está incorreto.
    - Detalhe da regra: O código deve existir conforme tabela de município do IBGE.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/nDocFiscal`

- **Campo:** `nDocFiscal`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Número do documento fiscal que não se encontra no repositório nacional

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/xDocFiscal`

- **Campo:** `xDocFiscal`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docFiscalOutro/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Descrição do documento fiscal

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro`

- **Campo:** `docOutro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** CG  |  **Tipo:** CG  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de documento não fiscal.
- **Notas explicativas:** O grupo de informações de documentos para ajuste (dedução/redução) pode não ter correspondência para Municípios que não utilizem o padrão ABRASF na versão 2.04.  
     
   Nesse caso, sugere-se que o Município que vá utilizar a transcrição da NFS-e do padrão de seu emissor para o padrão nacional, para encaminhamento ao ADN, apenas para essa fase inicial de implantação do padrão, utilize nessa operação o valor obtido como ajuste (dedução/redução) e o informe como “valor monetário”, e não “documentos”.  
     
   Nesse sentido, também o Painel Administrativo Municipal deve ser parametrizado como ajuste por “valor monetário” para o código de serviço correspondente, até que seu emissor próprio passe a refletir na origem o padrão nacional.  
    
  Importante esclarecer que quando o tipo de ajuste for "Profissional Parceiro" (tpAjusteBC = 9), pode-se vincula-lo a um documento não fiscal (nDoc).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Para o tipo de ajuste informado, deve-se informar um documento fiscal.
    - Detalhe da regra: Para os tipos de ajuste (tpAjusteBC) =  101, 103, 104 ou 199, deve ser informado um documento fiscal.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/nDoc`

- **Campo:** `nDoc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Número do documento não fiscal.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/xDoc`

- **Campo:** `xDoc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/docOutro/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Descrição do documento não fiscal.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec`

- **Campo:** `fornec`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do fornecedor do serviço prestado

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição federal (CNPJ) do fornecedor de serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0945` — CNPJ do fornecedor de reembolso, repasse e ressarcimento informado na DPS é inválido.
    - Detalhe da regra: CNPJ informado na DPS é inválido (verificar DV).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0946` — CNPJ do fornecedor de reembolso, repasse e ressarcimento informado não encontrado no cadastro CNPJ na data de competência.
    - Detalhe da regra: CNPJ do fornecedor não existe no cadastro CNPJ na data de competência do documento (dtCompDoc).

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição federal (CPF) do fornecedor do serviço.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0947` — CPF do fornecedor de reembolso, repasse e ressarcimento informado informado na DPS é inválido.
    - Detalhe da regra: CPF informado na DPS é inválido (verificar DV).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0948` — CPF do fornecedor de reembolso, repasse e ressarcimento informado não encontrado no cadastro CPF na data de competência.
    - Detalhe da regra: CPF do fornecedor não existe no cadastro CPF na data de competência do documento (dtCompDoc).

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/NIF`

- **Campo:** `NIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 40
- **Descrição:** Este elemento só deverá ser preenchido para fornecedores não residentes no Brasil.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1538` — O NIF ou cNaoNIF do fornecedor deve ser informado quando o grupo de informações de endereço no exterior do fornecedor de serviços for informado.
    - Detalhe da regra: Se o grupo de informações de endereço no exterior do fornecedor de serviços foi informado então o NIF ou cNaoNIF do fornecedor deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/cNaoNIF`

- **Campo:** `cNaoNIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo para não informação do NIF:  
    
  0 - Não informado na nota de origem;  
  1 - Dispensado do NIF;  
  2 - Não exigência do NIF;
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Não informado na nota de origem
  - `1` → Dispensado do NIF
  - `2` → Não exigência do NIF
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0490` — Valor 0 para o motivo da não informação do NIF do fornecedor não é permitido na Sefin do Sistema Nacional NFS-e.
    - Detalhe da regra: Se o valor do campo cNaoNIF do fornecedor, informado na DPS, for 0, então a DPS deve ser rejeitada.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 150
- **Descrição:** Nome / Razão Social do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac`

- **Campo:** `endNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço nacional.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0492` — O grupo de informações de endereço nacional deve ser informado obrigatoriamente quando o fornecedor for identificado pelo CPF ou CNPJ.
    - Detalhe da regra: Se CNPJ ou CPF do fornecedor for informado, então o grupo de informaçoes de endereço nacional do fornecedor deve ser informado obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do fornecedor.  
   (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0494` — O código do município informado na DPS para o endereço do fornecedor do serviço não existe conforme tabela de município do IBGE.
    - Detalhe da regra: O código do município informado para o endereço do fornecedor não existe, conforme tabela de municípios do IBGE.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP)  
   do endereço do fornecedor.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0496` — O CEP informado para o endereço nacional do fornecedor não existe ou não pertence ao município do endereço do fornecedor.
    - Detalhe da regra: O CEP informado deve existir e pertencer ao município correspondente ao código do município informado para o endereço do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço no exterior.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0498` — O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o fornecedor for identificado pelo NIF.
    - Detalhe da regra: Se o NIF do fornecedor foi informado, então o grupo de informações de endereço no exterior do fornecedor deve ser informado obrigatoriamente.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/cPais`

- **Campo:** `cPais`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do país do endereço do prestador do fornecedor.  
   (Tabela de Países ISO)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0499` — O código de país informado para o endereço no exterior do fornecedor não existe ou é igual ao código do Brasil. Informe um código de país existente e diferente do codigo do Brasil (BR) para o endereço no exterior do fornecedor, conforme tabela de país ISO2.
    - Detalhe da regra: O código de país informado para o endereço no exterior do fornecedor deve existir e ser diferente de Brasil (BR), conforme a tabela ISO2.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-11
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/fone`

- **Campo:** `fone`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 6-20
- **Descrição:** Número do telefone do fornecedor.  
  (Preencher com o Código DDD + número do telefone.  
  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/email`

- **Campo:** `email`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/vAjusteBC/documentos/docAjusteBC/fornec/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-80
- **Descrição:** E-mail do fornecedor.

### `NFSe/infNFSe/DPS/infDPS/valores/trib`

- **Campo:** `trib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relacionados aos tributos relacionados ao serviço prestado
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun`

- **Campo:** `tribMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relacionados ao   
  Imposto Sobre Serviços de Qualquer Natureza - ISSQN

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tribISSQN`

- **Campo:** `tribISSQN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Tributação do ISSQN sobre o serviço prestado:  
    
  1 - Operação tributável;  
  2 - Imunidade;  
  3 - Exportação de serviço;  
  4 - Não Incidência;
- **Valores aceitos (domínio identificado):**
  - `1` → Operação tributável
  - `2` → Imunidade
  - `3` → Exportação de serviço
  - `4` → Não Incidência
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0529` — O sistema considera este cenário para a prestação de serviço informada na DPS uma operação tributável. Não é permitido ao emitente da DPS informar que a prestação de serviço se trata de uma exportação de serviço.
    - Detalhe da regra: Não é permitido ao emitente informar se tratar de uma situação de exportação de serviço (tribISSQN = 3) para os cenários 6, 10, 34, 38, 66, 80, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0530` — O sistema considera este cenário para a prestação de serviço informada na DPS uma exportação de serviço. Não é permitido ao emitente da DPS informar que a prestação de serviço se trata de uma operação tributável.
    - Detalhe da regra: Não é permitido ao emitente informar se tratar de uma situação de operação tributável (tribISSQN = 1) para os cenários 26, 54, 92, 96, 106, 110, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0532` — O campo que informa sobre a tributação do ISSQN deve ser "4 - Não Incidência", quando houver o serviço prestado for 99.01.01 - Serviços sem a incidência de ISSQN e ICMS.
    - Detalhe da regra: Quando o serviço prestado for 99.01.01 - Serviços sem a incidência de ISSQN e ICMS não há incidência do ISSQN (tribISSQN = 4).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0539` — Não é permitido informar não incidência do ISSQN = 4 (Não Incidência) para qualquer subitem da lista nacional de serviço informado na DPS, se o subitem for incidente, conforme a parametrização do município de incidência do ISSQN.
    - Detalhe da regra: Quando qualquer subitem da lista de serviço nacional for incidente, conforme a parametrização do município de incidência do ISSQN, não é permitido informar não incidência do ISSQN, ou seja, os valores permitidos para o campo tribISSQN são: tribISSQN = 1, 2 ou 3.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0540` — Não há incidência do ISSQN (tribISSQN = 4) pois a parametrização do muncípio de incidência do ISSQN indica que o código de serviço prestado, informado na DPS, não é incidente neste município.
    - Detalhe da regra: Quando qualquer subitem da lista de serviço nacional for não incidente, conforme a parametrização do município de incidência do ISSQN, é obrigatório informar não incidência do ISSQN, ou seja, o valor permitido para o campo tribISSQN é: tribISSQN = 4.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/cPaisResult`

- **Campo:** `cPaisResult`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2
- **Descrição:** Código do país onde ocorreu o resultado do serviço prestado.  
  (Tabela de Países ISO)
- **Notas explicativas:** Se houver indicação pelo emitente de exportação de serviço, mesmo não havendo nenhum elemento para a ocorrência de exportação, então o emitente deve indicar em qual país ocorreu o resultado do serviço prestado.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0590` — É obrigatório informar o código do país onde ocorreu o resultado do serviço prestado para os cenários 2, 30, 58, 62, 72, 76, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - Detalhe da regra: Se, a tributação do ISSQN é igual à Exportação de serviço e Local da Prestação do Serviço é no Brasil e o Serviço prestado tem incidência no Local do Estabelecimento do Prestador, conforme LC 116/03, ou Se, a tributação do ISSQN é igual à Exportação de serviço e Local da Prestação do Serviço é no Brasil e o Serviço prestado tem incidência no Local do Estabelecimento do Tomador, conforme LC 116/03, e o Endereço do Tomador do serviço é no Exterior ou não informado, Então, é obrigatório informar o código do país onde ocorreu o resultado do serviço prestado.  obs: todos os cenários iguais a 2, 30, 58, 62, 72, 76, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0591` — Não é permitido informar o código do país onde ocorreu o resultado do serviço prestado para os cenários diferentes de 2, 30, 58, 62, 72, 76 conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".
    - Detalhe da regra: Se a tributação do ISSQN é diferente de Exportação de serviço ou Local da Prestação do Serviço é no Exterior ou o Serviço prestado tem incidência no Local de Prestação, conforme LC 116/03, ou Se a tributação do ISSQN é igual à Exportação de serviço e Local da Prestação do Serviço é no Brasil e o Serviço prestado tem incidência no Local do Estabelecimento do Tomador, conforme LC 116/03, e o Endereço do Tomador do serviço é no Brasil.  Não é permitido informar o código do país onde ocorreu o resultado do serviço prestado.  obs: todos os cenários diferentes de 2, 30, 58, 62, 72, 76, conforme a planilha "EXPORTACAO_EMISSÃO_NFS-e".

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tpImunidade`

- **Campo:** `tpImunidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Identificação da Imunidade do ISSQN – somente para o caso de Imunidade.  
    
  Tipos de Imunidades:  
    
  0 - Imunidade (tipo não informado na nota de origem);  
  1 - Patrimônio, renda ou serviços, uns dos outros (CF88, Art 150, VI, a);  
  2 - Entidades religiosas e templos de qualquer culto, inclusive suas organizações assistenciais e beneficentes (CF88, Art 150, VI, b);  
  3 - Patrimônio, renda ou serviços dos partidos políticos, inclusive suas fundações, das entidades sindicais dos trabalhadores, das instituições de educação e de assistência social, sem fins lucrativos, atendidos os requisitos da lei (CF88, Art 150, VI, c);  
  4 - Livros, jornais, periódicos e o papel destinado a sua impressão (CF88, Art 150, VI, d);  
  5 - Fonogramas e videofonogramas musicais produzidos no Brasil contendo obras musicais ou literomusicais de autores brasileiros e/ou obras em geral interpretadas por artistas brasileiros bem como os suportes materiais ou arquivos digitais que os contenham, salvo na etapa de replicação industrial de mídias ópticas de leitura a laser.   (CF88, Art 150, VI, e);
- **Notas explicativas:** O valor 0 deve ser utilizado como opção de preenchimento do campo somente no compartilhamento de NFS-e pelo municipio com o ADN NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → Imunidade (tipo não informado na nota de origem)
  - `1` → Patrimônio, renda ou serviços, uns dos outros (CF88, Art 150, VI, a)
  - `2` → Entidades religiosas e templos de qualquer culto, inclusive suas organizações assistenciais e beneficentes (CF88, Art 150, VI, b)
  - `4` → Livros, jornais, periódicos e o papel destinado a sua impressão (CF88, Art 150, VI, d)
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0592` — O tipo de imunidade é obrigatório e deve ser informado somente quando o campo referente à tributação do ISSQN for igual a "2 - Imunidade".
    - Detalhe da regra: Obrigatório e informado somente quando o campo referente à tributação do ISSQN for igual a 2 (tribISSQN = 2).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0593` — Não permitido o valor "0 - Imunidade (tipo não informado na nota de origem)" na DPS quando utilizado os Emissores Públicos Nacionais para emissao de NFS-e.
    - Detalhe da regra: Não permitido o valor "0 - Imunidade (tipo não informado na nota de origem)" na DPS quando utilizado os Emissores Públicos Nacionais para emissão de NFS-e.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp`

- **Campo:** `exigSusp`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Informações para a suspensão da Exigibilidade do ISSQN
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0585` — Somente é permitido informar suspensão de exigibilidade quando a opção da tributação do ISSQN for uma operação tributável 
(tribISSQN = 1).
    - Detalhe da regra: Não é permitido informar suspensão da exigibilidade do ISSQN por decisão judicial ou administrativa, quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/tpSusp`

- **Campo:** `tpSusp`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Opção para Exigibilidade Suspensa:  
    
  1 - Exigibilidade do ISSQN Suspensa por Decisão Judicial;  
  2 - Exigibilidade do ISSQN Suspensa por Processo Administrativo;
- **Valores aceitos (domínio identificado):**
  - `1` → Exigibilidade do ISSQN Suspensa por Decisão Judicial
  - `2` → Exigibilidade do ISSQN Suspensa por Processo Administrativo

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/nProcesso`

- **Campo:** `nProcesso`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/exigSusp/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 30
- **Descrição:** Número do processo judicial ou administrativo de suspensão da exigibilidade.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM`

- **Campo:** `BM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações sobre o tipo do Benefício Municipal

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/nBM`

- **Campo:** `nBM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Identificador do benefício parametrizado pelo município.  
    
  Trata-se de um identificador único que foi gerado pelo Sistema Nacional no momento em que o município de incidência do ISSQN incluiu o benefício no sistema.  
    
  Critério de formação do número de identificação de parâmetros municipais:  
    
  7 dígitos - posição 1 a 7: número identificador do Município, conforme código IBGE;  
  2 dígitos - posições 8 e 9 : número identificador do tipo de parametrização   
  (01-legislação, 02-regimes especiais, 03-retenções, 04-outros benefícios);  
  5 dígitos - posição 10 a 14 : número sequencial definido pelo sistema quando do registro específico do parâmetro dentro do tipo de parametrização no sistema;
- **Notas explicativas:** Trata-se de um identificador único que foi gerado pelo Sistema Nacional no momento em que o município de incidência do ISSQN incluiu o benefício no sistema.  
    
  Critério de formação do número de identificação de parâmetros municipais:  
    
  7 dígitos - posição 1 a 7: número identificador do Município, conforme código IBGE;  
    
  2 dígitos - posições 8 e 9 : número identificador do tipo de parametrização   
  (01-legislação, 02-regimes especiais, 03-retenções, 04-outros benefícios);  
    
  5 dígitos - posição 10 a 14 : número sequencial definido pelo sistema quando do registro específico do parâmetro dentro do tipo de parametrização no sistema;  
    
  O emitente poderá obter essa informação de parametrização do município através de API própria que dará publicidade às parametrizações dos municípios.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/vRedBCBM`

- **Campo:** `vRedBCBM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário (R$) informado pelo emitente para redução da base de cálculo (BC) do ISSQN devido a um Benefício Municipal (BM).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/pRedBCBM`

- **Campo:** `pRedBCBM`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/BM/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-3V2
- **Descrição:** Valor percentual (%) informado pelo emitente para redução da base de cálculo (BC) do ISSQN devido a um Benefício Municipal (BM).
- **Notas explicativas:** O limite para este valor percentual informado pelo emitente está previamente parametrizado pelo município de incidência no cadastro do benefício municipal.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/tpRetISSQN`

- **Campo:** `tpRetISSQN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Tipo de retencao do ISSQN:  
    
  1 - Não Retido;  
  2 - Retido pelo Tomador;  
  3 - Retido pelo Intermediario;
- **Valores aceitos (domínio identificado):**
  - `1` → Não Retido
  - `2` → Retido pelo Tomador
  - `3` → Retido pelo Intermediario
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0580` — Não é permitido haver retenção quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - Detalhe da regra: Não é permitido haver retenção do ISSQN (tpRetISSQN = 2 ou 3) quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo tpRetISSQ = 1 quando o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0583` — Não é permitido retenção do ISSQN para o prestador do serviço que seja MEI na data de competência informada na DPS.
    - Detalhe da regra: Se o prestador do serviço tiver opção perante o Simples Nacional MEI (opSimpNac = 2) na data de competência informada na DPS, então não é permitido ocorrer retenção do ISSQN (tpRetISSQN igual a 2 ou 3), ou seja, tpRetISSQN tem que ser igual a 1 (tpRetISSQN = 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0588` — Não é permitido retenção do ISSQN para o prestador do serviço que tenha algum regime especial de tributação na data de competência informada na DPS.
    - Detalhe da regra: Se o prestador do serviço tiver um regime especial de tributação (regEspTrib = 1, 2, 3, 4, 5 ou 6) na data de competência informada na DPS, então não é permitido ocorrer retenção do ISSQN (tpRetISSQN igual a 2 ou 3), ou seja, tpRetISSQN tem que ser igual a 1 (tpRetISSQN = 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0594` — Não é permitido retenção do ISSQN quando houver Benefício Municipal do tipo Isenção.
    - Detalhe da regra: Quando o benefício municipal informado na DPS for do tipo "Isenção", não poderá ocorrer retenção do ISSQN  (tpRetISSQN igual a 2 ou 3) ou seja, tpRetISSQN tem que ser igual a 1.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0596` — Não é permitido retenção do ISSQN quando o serviço prestado corresponder ao subitem 220101 - Serviço de exploração de rodovia da lista de serviços do Sistema Nacional NFS-e.
    - Detalhe da regra: Quando o codigo de tributação nacional corresponder ao subitem 220101 da lista de serviços do Sistema Nacional NFS-e, não poderá ocorrer retenção do ISSQN (tpRetISSQN igual a 2 ou 3) ou seja, tpRetISSQN tem que ser igual a 1.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0650` — Em caso de importação de serviço pelo tomador, o ISSQN deve ser retido pelo tomador.
    - Detalhe da regra: Se o emitente da DPS for o tomador de serviço (tpEmit = 2) e o prestador for identificado por NIF ou,  na falta do NIF informado, o endereço for no exterior e local da prestação no território brasileiro  (cLocPrestacao é preenchido), então a retenção do imposto devido deve ser realizada obrigatoriamente  pelo tomador (tpRetISSQN = 2).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0652` — Em caso de importação de serviço pelo intermediário, o ISSQN deve ser retido pelo intermediário.
    - Detalhe da regra: Se o emitente da DPS for o intermediário de serviço (tpEmit = 3) e o prestador for identificado por NIF ou,  na falta do NIF informado, o endereço for no exterior e local da prestação no território brasileiro  (cLocPrestacao é preenchido), então a retenção do imposto devido deve ser realizada obrigatoriamente  pelo tomador (tpRetISSQN = 3).
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0667` — Município da incidência do ISSQN não autoriza que o CPF do tomador informado na DPS seja indicado para retenção deste imposto.
    - Detalhe da regra: Verificar se o CPF informado como tomador na DPS (NFSe/infNFSe/DPS/infDPS/toma/CPF) está previamente cadastrado para retenção do ISSQN na parametrização do município de incidência do imposto.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0670` — Município da incidência do ISSQN não autoriza que o CPF do intermediário informado na DPS seja indicado para retenção deste imposto.
    - Detalhe da regra: Verificar se o CPF informado como intermediário na DPS (NFSe/infNFSe/DPS/infDPS/interm/CPF) está previamente cadastrado para retenção na parametrização do município de incidência do imposto.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0672` — Não pode haver retenção do ISSQN se e o tomador for o emitente da DPS e estiver estabelecido em município diferente do município de incidência do ISSQN.
    - Detalhe da regra: Se o tomador emitente da DPS (tpEmit = 2) for estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN deve ser igual a 1).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0673` — Não pode haver retenção do ISSQN se e o intermediário for o emitente da DPS e estiver estabelecido em município diferente do município de incidência do ISSQN.
    - Detalhe da regra: Se o intermediário emitente da DPS (tpEmit = 3) for estabelecido em município diferente do município de incidência do ISSQN, então não pode haver retenção (tpRetISSQN deve ser igual a 1).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/pAliq`

- **Campo:** `pAliq`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribMun/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1V2
- **Descrição:** Valor da alíquota (%) do serviço prestado relativo ao município sujeito ativo (município de incidência) do ISSQN.
- **Notas explicativas:** Se o município de incidência pertence ao Sistema Nacional NFS-e a alíquota estará parametrizada e, portanto, será fornecida pelo sistema.  
    
  Se o município de incidência não pertence ao Sistema Nacional NFS-e a alíquota não estará parametrizada e, por isso, deverá ser fornecida pelo emitente.
- **Regras de negócio associadas:**
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0595` — Não é permitido informar alíquota superior a 5%.
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0600` — Não é permitido informar a alíquota para prestador de serviço optante do simples nacional do tipo MEI.
    - Detalhe da regra: Não é permitido informar alíquota quando o prestador é optante do simples nacional do tipo MEI (opSimpNac = 2).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0602` — Não é permitido informar alíquota quando o campo referente à tributação do ISSQN indicar imunidade, exportação ou não incidência.
    - Detalhe da regra: Não é permitido informar alíquota quando o serviço prestado for imune, exportação de serviço ou não incidência do ISSQN sobre o serviço prestado, ou seja, o campo referente à tributação do ISSQN (tribISSQN) é igual a "2 - Imunidade, "3 - Exportação de Serviço" ou "4 - Não Incidência", (tribISSQN = 2, 3 ou 4).
  - [Nível 2] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0604` — Não é permitido informar alíquota quando o prestador de serviço possui algum regime especial de tributação.
    - Detalhe da regra: Não é permitido informar alíquota quando o prestador de serviço tiver um regime especial de tributação, ou seja, o campo que indica o regime especial de tributação é diferente de 0, (regEspTrib = 1, 2, 3, 4, 5 ou 6).
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0612` — Não é permitido informar alíquota quando o benefício municipal informado na DPS for do tipo "Isenção" ou "Alíquota Diferenciada".
    - Detalhe da regra: Não é permitido informar alíquota quando o benefício municipal for informado na DPS for do tipo "Isenção" ou "Alíquota Diferenciada".
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0617` — Não é permitido informar alíquota quando o prestador de serviço não é optante do simples nacional (opSimpNac = 1) na data de competência informada na DPS, com o município de incidência do ISSQN com situação "ATIVO" no Sistema Nacional NFS-e.
    - Detalhe da regra: Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) o prestador de serviço seja não optante do Simples Nacional (opSimpNac = 1)  na data de competência informada na DPS, e 2) o convênio do município de incidência do ISSQN está ativo na data de competência informada na DPS;
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0619` — É obrigatório informar alíquota quando o prestador de serviço não é optante do simples nacional (opSimpNac = 1) na data de competência informada na DPS, o município de incidência do ISSQN não está com situação "ATIVO" no Sistema Nacional NFS-e e não haja algum regime especial de tributaçao para o prestador.
    - Detalhe da regra: É obrigatório o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) o prestador de serviço seja não optante do Simples Nacional (opSimpNac = 1)  na data de competência informada na DPS, e 2) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS, e 3) nenhum regime especial de tributação para o prestador de serviço (regEspTrib = 0);
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0621` — É obrigatório informar alíquota quando há indicação de retenção do ISSQN (tpRetISSQN = 2 ou 3) para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1), sem benefício municipal ou, se houver, seja diferente de isenção ou alíquota diferenciada, cujo município de incidência esteja Ativo no Sistema Nacional NFS-e. Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
    - Detalhe da regra: É obrigatorio o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3)  na data de competência de emissão da DPS e;  2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e; 3) o convênio do município de incidência do ISSQN está "Ativo" na data de competência informada na DPS,  4) não haja benefício municipal ou, se houver, seja diferente de "Isenção" e "Alíquota diferenciada", e 5) haja retenção do ISSQN (tpRetISSQN = 2 ou 3);  Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0625` — Não é permitido informar alíquota quando não há indicação de retenção do ISSQN (tpRetISSQN = 1) para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1), sem benefício municipal ou, se houver, seja diferente de isenção ou alíquota diferenciada, cujo município de incidência esteja Ativo no Sistema Nacional NFS-e.
    - Detalhe da regra: Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3)  na data de competência de emissão da DPS e;  2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e; 3) o convênio do município de incidência do ISSQN está "Ativo" na data de competência informada na DPS,  4) não haja benefício municipal ou, se houver, seja diferente de "Isenção" e "Alíquota diferenciada", e 5) não haja retenção do ISSQN (tpRetISSQN = 1);
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0628` — É obrigatório informar alíquota quando o município de incidência do ISSQN não está Ativo no Sistema Nacional NFS-e, para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1), com retenção do ISSQN (tpRetISSQN = 2 ou 3). Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
    - Detalhe da regra: É obrigatório o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3)  na data de competência de emissão da DPS e;  2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e; 3) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS, e 4) haja retenção do ISSQN (tpRetISSQN = 2 ou 3);  Obs: neste cenário, o percentual da alíquota mínima informada permitida é 1,8%.
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0631` — Não é permitido informar alíquota quando o município de incidência do ISSQN não está Ativo no Sistema Nacional NFS-e, para o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN pelo simples nacional (regApTribISSQN = 1) sem retenção do ISSQN (tpRetISSQN = 1).
    - Detalhe da regra: Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3)  na data de competência de emissão da DPS e;  2) a apuração do ISSQN seja pelo SN (regApTribSN = 1) e; 3) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS, e 4) não haja retenção do ISSQN (tpRetISSQN = 1);
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0635` — Não é permitido informar alíquota quando o convênio do município de incidência do ISSQN está ativo na data de competência informada na DPS, para o prestador de serviço ME/EPP (opSimpNac = 3) com a apuração do ISSQN fora do Simples Nacional, ou seja, pela alíquota do município para o serviço prestado (regApTribSN = 2 ou 3).
    - Detalhe da regra: Não é permitido o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) o prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3)  na data de competência informada na DPS, e 2) a apuração do ISSQN fora do Simples Nacional, ou seja, pela alíquota do município  para o serviço prestado (regApTribSN = 2 ou 3) e; 3) o convênio do município de incidência do ISSQN está ativo na data de competência informada na DPS;
  - [Nível 3] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0640` — É obrigatório informar alíquota quando o prestador de serviço ME/EPP (opSimpNac = 3) na data de competência informada na DPS, com apuração do ISSQN fora do Simples Nacional (regApTribISSQN = 2 ou 3), ou seja, pela alíquota do município para o serviço prestado, cujo município de incidência não esteja "Ativo" no Sistema Nacional NFS-e.
    - Detalhe da regra: É obrigatorio o preenchimento do campo pAliq quando ocorrer as condições abaixo simultaneamente:  1) O prestador de serviço seja optante do Simples Nacional ME/EPP (opSimpNac = 3)  na data de competência de emissão da DPS e;  2) a apuração do ISSQN fora do Simples Nacional, ou seja, pela alíquota do município  para o serviço prestado (regApTribSN = 2 ou 3) e; 3) o convênio do município de incidência do ISSQN não está "Ativo" na data de competência informada na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed`

- **Campo:** `tribFed`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de outros tributos relacionados ao serviço prestado
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Obrig. | **Cód. erro:** `E0675` — Não é permitido a prestação de informações relativas aos tributos federais quando o emitente da DPS for identificado por um pessoa física (CPF).
    - Detalhe da regra: Não é permitido o preenchimento das informações relativas aos tributos federais quando o emitente da DPS for identificado por uma pessoa física (CPF).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Obrig. | **Cód. erro:** `E0676` — Não é permitido o preenchimento das informações relativas aos tributos federais quando o emitente for identificado como MEI na data de competência informada na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins`

- **Campo:** `piscofins`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações dos tributos PIS/COFINS

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/CST`

- **Campo:** `CST`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código de Situação Tributária do PIS/COFINS (CST):  
     
   00 - Nenhum;   
   01 - Operação Tributável com Alíquota Básica;  
   02 - Operação Tributável com Alíquota Diferenciada;  
   03 - Operação Tributável com Alíquota por Unidade de Medida de Produto;  
   04 - Operação Tributável monofásica - Revenda a Alíquota Zero;  
   05 - Operação Tributável por Substituição Tributária;  
   06 - Operação Tributável a Alíquota Zero;  
   07 - Operação Isenta da Contribuição;  
   08 - Operação sem Incidência da Contribuição;  
   09 - Operação com Suspensão da Contribuição;  
  49 - Outras Operações de Saída;  
  50 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Tributada no Mercado Interno;  
  51 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno;  
  52 - Operação com Direito a Crédito – Vinculada Exclusivamente a Receita de Exportação;  
  53 - Operação com Direito a Crédito – Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno;  
  54 - Operação com Direito a Crédito – Vinculada a Receitas Tributadas no Mercado Interno e de Exportação;  
  55 - Operação com Direito a Crédito – Vinculada a Receitas Não Tributadas no Mercado Interno e de Exportação;  
  56 - Operação com Direito a Crédito – Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação;  
  60 - Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno;  
  61 - Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno;  
  62 - Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação;  
  63 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno;  
  64 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação;  
  65 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação;  
  66 - Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação;  
  67 - Crédito Presumido – Outras Operações;  
  70 - Operação de Aquisição sem Direito a Crédito;  
  71 - Operação de Aquisição com Isenção;  
  72 - Operação de Aquisição com Suspensão;  
  73 - Operação de Aquisição a Alíquota Zero;  
  74 - Operação de Aquisição sem Incidência da Contribuição;  
  75 - Operação de Aquisição por Substituição Tributária;  
  98 - Outras Operações de Entrada;  
  99 - Outras Operações;
- **Valores aceitos (domínio identificado):**
  - `00` → Nenhum
  - `01` → Operação Tributável com Alíquota Básica
  - `02` → Operação Tributável com Alíquota Diferenciada
  - `03` → Operação Tributável com Alíquota por Unidade de Medida de Produto
  - `04` → Operação Tributável monofásica - Revenda a Alíquota Zero
  - `05` → Operação Tributável por Substituição Tributária
  - `06` → Operação Tributável a Alíquota Zero
  - `07` → Operação Isenta da Contribuição
  - `08` → Operação sem Incidência da Contribuição
  - `09` → Operação com Suspensão da Contribuição
  - `49` → Outras Operações de Saída
  - `50` → Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Tributada no Mercado Interno
  - `51` → Operação com Direito a Crédito – Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno
  - `52` → Operação com Direito a Crédito – Vinculada Exclusivamente a Receita de Exportação
  - `53` → Operação com Direito a Crédito – Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno
  - `54` → Operação com Direito a Crédito – Vinculada a Receitas Tributadas no Mercado Interno e de Exportação
  - `55` → Operação com Direito a Crédito – Vinculada a Receitas Não Tributadas no Mercado Interno e de Exportação
  - `56` → Operação com Direito a Crédito – Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação
  - `60` → Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita Tributada no Mercado Interno
  - `61` → Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita Não-Tributada no Mercado Interno
  - `62` → Crédito Presumido – Operação de Aquisição Vinculada Exclusivamente a Receita de Exportação
  - `63` → Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno
  - `64` → Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas no Mercado Interno e de Exportação
  - `65` → Crédito Presumido – Operação de Aquisição Vinculada a Receitas Não-Tributadas no Mercado Interno e de Exportação
  - `66` → Crédito Presumido – Operação de Aquisição Vinculada a Receitas Tributadas e Não-Tributadas no Mercado Interno e de Exportação
  - `67` → Crédito Presumido – Outras Operações
  - `70` → Operação de Aquisição sem Direito a Crédito
  - `71` → Operação de Aquisição com Isenção
  - `72` → Operação de Aquisição com Suspensão
  - `73` → Operação de Aquisição a Alíquota Zero
  - `74` → Operação de Aquisição sem Incidência da Contribuição
  - `75` → Operação de Aquisição por Substituição Tributária
  - `98` → Outras Operações de Entrada
  - `99` → Outras Operações

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/vBCPisCofins`

- **Campo:** `vBCPisCofins`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da Base de Cálculo do PIS/COFINS, relativo à apuração própria (R$).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Obrig. | **Cód. erro:** `E0677` — O valor da BC para Pis/Cofins deve ser menor ou igual ao valor do serviço informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0678` — O valor BC do Pis/Cofins deve ser informado quando o CST for diferente de 0, 8 ou 9.
    - Detalhe da regra: Se CST for diferente de "0 - Nenhum", "8 - Operação sem Incidência da Contribuição", "9 - Operação com Suspensão da Contribuição", o valor BC do Pis/Cofins deve ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0680` — O valor BC do Pis/Cofins informado deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - Detalhe da regra: Se CST for diferente de "0 - Nenhum", "8 - Operação sem Incidência da Contribuição", "9 - Operação com Suspensão da Contribuição", o valor BC do Pis/Cofins deve ser maior que zero e menor que o valor do serviço informado na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0682` — O valor BC do Pis/Cofins não pode ser informado quando o valor de CST for igual a 0, 8 ou 9.
    - Detalhe da regra: Se CST for igual a "0 - Nenhum", "8 - Operação sem Incidência da Contribuição", "9 - Operação com Suspensão da Contribuição", o valor BC do Pis/Cofins não pode ser informado.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/pAliqPis`

- **Campo:** `pAliqPis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota do PIS, relativa à apuração própria (%).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0684` — A alíquota do Pis deve ser informada quando a base de cálculo deste imposto for informada.
    - Detalhe da regra: Se o valor da base de cálculo do Pis/Cofins (vBCPisCofins) for informado, então a alíquota do Pis deve ser informada.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0686` — A alíquota do Pis deve ser igual ou maior que 0 e menor ou igual a 100%.
    - Detalhe da regra: Se a alíquota do Pis (pAliqPis) for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0688` — Para os CST for "4 - Operação Tributável monofásica - Revenda a Alíquota Zero" ou "6 - Operação Tributável a Alíquota Zero", o valor das alíquotas para Pis e Cofins devem ser preenchidas com zero (0,00%).
    - Detalhe da regra: Se CST for "4 - Operação Tributável monofásica - Revenda a Alíquota Zero" ou "6 - Operação Tributável a Alíquota Zero", o valor das alíquotas para Pis e Cofins devem ser preenchidas com zero (0,00%).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/pAliqCofins`

- **Campo:** `pAliqCofins`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-2V2
- **Descrição:** Alíquota da COFINS, relativa à apuração própria (%).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0690` — A alíquota do Cofins deve ser informada quando a base de cálculo deste imposto for informada.
    - Detalhe da regra: Se o valor da base de cálculo do Pis/Cofins (vBCPisCofins) for informado, então a alíquota do Cofins deve ser informada.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0692` — A alíquota do Cofins deve ser igual ou maior que 0 e menor ou igual a 100%.
    - Detalhe da regra: Se a alíquota do Cofins (pAliqCofins) for informada, então deve ser igual ou maior que 0 e menor ou igual a 100%.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/vPis`

- **Campo:** `vPis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do débito de PIS apuração própria (R$).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0694` — O valor do Pis informado não corresponde ao resultado da BC Pis/Cofins x Alíquota Pis, que foram informados na DPS.
    - Detalhe da regra: Se o valor da alíquota do Pis (pAliqPis) for informado, então o valor do Pis informado na DPS deve ser igual ao valor da base de cálculo do Pis/Cofins x alíquota do Pis, que foram informados na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/vCofins`

- **Campo:** `vCofins`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do débito de COFINS apuração própria (R$).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0696` — O valor do Cofins informado não corresponde ao resultado da BC Pis/Cofins x Alíquota Cofins, que foram informados na DPS.
    - Detalhe da regra: Se o valor da alíquota do Cofins (pAliqCofins) for informado, então o valor Cofins informado na DPS deve ser igual ao valor da base de cálculo do Pis/Cofins x alíquota do Cofins , que foram informados na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/tpRetPisCofins`

- **Campo:** `tpRetPisCofins`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/piscofins/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Tipo de retenção PIS/COFINS e CSLL:  
    
  0 - PIS/COFINS/CSLL Não Retidos;  
  1 - PIS/COFINS Retido;  
  2 - PIS/COFINS Não Retido;  
  3 - PIS/COFINS/CSLL Retidos;  
  4 - PIS/COFINS Retidos, CSLL Não Retido;  
  5 - PIS Retido, COFINS/CSLL Não Retido;  
  6 - COFINS Retido, PIS/CSLL Não Retido;  
  7 - PIS Não Retido, COFINS/CSLL Retidos;  
  8 - PIS/COFINS Não Retidos, CSLL Retido;  
  9 - COFINS Não Retido, PIS/CSLL Retidos;
- **Notas explicativas:** Os valores 1 e 2 só serão aceitos até os grupos "IBSCBS" se tornarem obrigatórios (01/08/2026) para a autorização/recepção da NFS-e. Mais esclarecimentos podem ser encontrados na Nota Técnica SE/CGNFS-e nº 007, de 07 de fevereiro de 2026, disponível no portal da NFS-e.
- **Valores aceitos (domínio identificado):**
  - `0` → PIS/COFINS/CSLL Não Retidos
  - `1` → PIS/COFINS Retido
  - `2` → PIS/COFINS Não Retido
  - `3` → PIS/COFINS/CSLL Retidos
  - `4` → PIS/COFINS Retidos, CSLL Não Retido
  - `5` → PIS Retido, COFINS/CSLL Não Retido
  - `6` → COFINS Retido, PIS/CSLL Não Retido
  - `7` → PIS Não Retido, COFINS/CSLL Retidos
  - `8` → PIS/COFINS Não Retidos, CSLL Retido
  - `9` → COFINS Não Retido, PIS/CSLL Retidos
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0698` — Se CST informado for diferente de 0, 8 ou 9, o tipo de retenção para Pis/Cofins deve ser informado.
    - Detalhe da regra: Se CST for diferende de "0 - Nenhum", "8 - Operação sem Incidência da Contribuição", "9 - Operação com Suspensão da Contribuição", o tipo de retenção para Pis/Cofins deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/vRetCP`

- **Campo:** `vRetCP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário do CP(R$).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0699` — O valor do tributo CP deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - Detalhe da regra: Se o valor do tributo CP for informado, então deve ser maior que zero e menor que o valor do serviço informado na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/vRetIRRF`

- **Campo:** `vRetIRRF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário do IRRF (R$).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0700` — O valor do tributo IRRF deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - Detalhe da regra: Se o valor do tributo IRRF for informado, então deve ser maior que zero e menor que o valor do serviço informado na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/vRetCSLL`

- **Campo:** `vRetCSLL`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/tribFed/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor relativo às retenções das Contribuições Sociais (R$), de acordo com a indicação no campo tpRetPisCofins.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0720` — Se o tipo de retenção do PIS/COFINS for igual a "0 - PIS/COFINS/CSLL Não Retidos", então não é permitido informar o campo vRetCSLL.
    - Detalhe da regra: Se o tipo de retenção do PIS/COFINS/CSLL for igual a "0 - PIS/COFINS/CSLL Não Retidos", então não é permitido informar o campo vRetCSLL.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0724` — Se o tipo de retenção do PIS/COFINS for diferente de "0 - PIS/COFINS/CSLL Não Retidos" ou 
de "2 - PIS/COFINS Não Retido", então é obrigatório informar o campo vRetCSLL.
    - Detalhe da regra: Se o tipo de retenção do PIS/COFINS/CSLL for diferente de "0 - PIS/COFINS/CSLL Não Retidos" ou  de "2 - PIS/COFINS Não Retido", então é obrigatório informar o campo vRetCSLL.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0701` — O valor do tributo CSLL deve ser maior que zero e menor que o valor do serviço informado na DPS.
    - Detalhe da regra: Se o valor do tributo CSLL for informado, então deve ser maior que zero e menor que o valor do serviço informado na DPS.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib`

- **Campo:** `totTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações para totais aproximados dos tributos relacionados ao serviço prestado
- **Notas explicativas:** Os campos totalizadores deste grupo serão reavaliados em novas versões do layout proposto.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib`

- **Campo:** `vTotTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Valor monetário total aproximado dos tributos,  
  em conformidade com o artigo 1o da Lei no 12.741/2012

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/vTotTribFed`

- **Campo:** `vTotTribFed`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário total aproximado dos tributos federais (R$).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/vTotTribEst`

- **Campo:** `vTotTribEst`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário total aproximado dos tributos estaduais (R$).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/vTotTribMun`

- **Campo:** `vTotTribMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/vTotTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário total aproximado dos tributos municipais (R$).

### `NFSe/infNFSe/DPS/infDPS/valorestrib/totTrib/pTotTrib`

- **Campo:** `pTotTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valorestrib/totTrib/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Valor percentual total aproximado dos tributos,  
  em conformidade com o artigo 1o da Lei no 12.741/2012

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/pTotTribFed`

- **Campo:** `pTotTribFed`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Valor percentual total aproximado dos tributos federais (%).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/pTotTribEst`

- **Campo:** `pTotTribEst`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Valor percentual total aproximado dos tributos estaduais (%).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/pTotTribMun`

- **Campo:** `pTotTribMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTrib/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Valor percentual total aproximado dos tributos municipais (%).

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/indTotTrib`

- **Campo:** `indTotTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Indicador de informação de valor total de tributos.  
  Se informado indica que o emitente opta por não informar nenhum valor estimado para os Tributos  
  (Decreto 8.264/2014).  
    
  0 - Não;
- **Valores aceitos (domínio identificado):**
  - `0` → Não
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0712` — Para ME/EPP indTotTrib nunca poderá ser informado.
    - Detalhe da regra: Se a situação do emitente da DPS perante o Simples Nacional na data de competência informada for ME/EPP, o choice indTotTrib nunca poderá ser informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0713` — Para Não Optante do SN os campos, indicador de informação de valor total de tributos e  percentual aproximado do total dos tributos da alíquota do Simples Nacional (%), não podem ser informado.
    - Detalhe da regra: Se a situação do emitente da DPS perante o Simples Nacional na data de competência informada for Não Optante, indTotTrib e pTotTribSN nunca poderá ser informado.

### `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/pTotTribSN`

- **Campo:** `pTotTribSN`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/valores/trib/totTrib/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Valor percentual aproximado do total dos tributos da alíquota do Simples Nacional (%).
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0710` — Para MEI pTotTribSN nunca poderá ser informado.
    - Detalhe da regra: Se a situação do emitente da DPS perante o Simples Nacional na data de competência informada for MEI, o choice pTotTribSN nunca poderá ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS`

- **Campo:** `IBSCBS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações declaradas pelo emitente referentes ao IBS e à CBS
- **Notas explicativas:** Para optantes dos Simples Nacional, os grupos IBSCBS só serão obrigatórios a partir de 2027.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0850` — É permitido declarar informações de IBS/CBS somente a partir da data de competência 01/01/2026.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0854` — Somente é permitio declarar informações de IBS/CBS a partir da versão 1,01 da DPS.
    - Detalhe da regra: Somente é permitio declarar informações de IBS/CBS a partir da versão 1.01 da DPS.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/indFinal`

- **Campo:** `indFinal`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Indica operação de uso ou consumo pessoal. (art. 57)  
    
  0=Não  
  1=Sim

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/cIndOp`

- **Campo:** `cIndOp`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 6
- **Descrição:** Código indicador da operação de fornecimento, conforme tabela “código indicador de operação”
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0901` — Código indicador da operação inexistente.
    - Detalhe da regra: O código indicador da operação deve constar na tabela de códigos conforme ANEXO B
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando a finalidade de emissão da NFS-e for regular (finNFS = 0), este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este campo deve ser informado.

Ou

Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este campo deve ser informado
    - Detalhe da regra: Este campo deve ser informado obrigatoriamente (OCOR. 1-1) quando finNFSe = 0 ou quando tpNFSeDebito = 04 ou 06 ou tbNFSeCredito = 01

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/indZFMALC`

- **Campo:** `indZFMALC`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Indicador da operação de fornecimento favorecido com alíquota zero de CBS (conforme art. 451 e art. 466 da Lei Complementar nº 214/2025)  
    
  0 - Não;  
  1 - Sim.
- **Notas explicativas:** Se indZFMALC=1, o valor da alíquota da CBS será 0 (zero).  
  O campo indZFMALC só deve ser informado se observadas as seguintes regras:  
    
  1) cIndOp deve ser 010101, 010102, 010103, 010106, 020101, 020201, 020301, 030101, 030102, 050101, 050102, 050201, 060101, 070101, 070102, 100301, 100302, 100401, 100501, 100502 ou 100601;  
  2) Fornecedor e destinatário dentro da Zona Franca de Manaus (ZFM); ou fornecedor e destinatário dentro da mesma Área de Livre Comércio (ALC).
- **Valores aceitos (domínio identificado):**
  - `0` → Não
  - `1` → Sim.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXXX` — O indicador da operação de fornecimento favorecido (indCFMALC) não deve ser informado para o código indicador da operação (cIndOp) informado.
    - Detalhe da regra: O indicador da operação de fornecimento favorecido com alíquota zero de CBS só deve ser informado se o código indicador da operação for 010101, 010102, 010103, 010106, 020101, 020201, 020301, 030101, 030102, 050101, 050102, 050201, 060101, 070101, 070102, 100301, 100302, 100401, 100501, 100502 ou 100601.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/tpOper`

- **Campo:** `tpOper`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Tipo de Operação com Entes Governamentais ou outros serviços sobre bens imóveis:  
    
  1 – Fornecimento com pagamento posterior;  
  2 - Recebimento do pagamento com fornecimento já realizado;  
  3 – Fornecimento com pagamento já realizado;  
  4 – Recebimento do pagamento com fornecimento posterior;  
  5 – Fornecimento e recebimento do pagamento concomitantes;
- **Notas explicativas:** Campo deve ser informado para as seguintes situações previstas na LC 214/2025:  
    
  Aquisição de serviços pela administração pública direta, por autarquias e por fundações públicas: Art. 10 §2º (Qualquer serviço);  
  Cessão onerosa de bem imóvel: Art. 254 III (Serviço 25.05 da LC 116/2003);  
  Arrendamento de bem imóvel: Art. 254 III (Serviço 15.09 da LC 116/2003);  
  Administração de bem imóvel: Art. 254 IV (Serviço 17.12 da LC 116/2003);  
  Intermediação de bem imóvel: Art. 254 IV (Serviço 10.05 da LC 116/2003).
- **Valores aceitos (domínio identificado):**
  - `1` → Fornecimento com pagamento posterior
  - `2` → Recebimento do pagamento com fornecimento já realizado
  - `3` → Fornecimento com pagamento já realizado
  - `4` → Recebimento do pagamento com fornecimento posterior
  - `5` → Fornecimento e recebimento do pagamento concomitantes
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0903` — Código do tipo de Operação (tpOper) deve ser informado quando se tratar de uma compra governamental ou um dos serviços da LC 116/2003 listados: 25.05; 15.09; 17.12; 10.05.
    - Detalhe da regra: tpOper deve ser informado se tpEnteGov for informado ou se o serviço prestado (cTribNac) corresponder aos serviços listados da LC 116/2003 (e seus correspondentes na NBS): 25.05; 15.09; 17.12; 10.05.
  -  **Aplic.:** - | **Efeito:** - | **Cód. erro:** `-` — 
    - Detalhe da regra: tpOper deve ser informado se tpEnteGov for informado.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0904` — Código do tipo de Operação (tpOper) não pode ser informado quando não se tratar de uma compra governamental ou um dos serviços da LC 116/2003 listados: 25.05; 15.09; 17.12; 10.05.
    - Detalhe da regra: tpOper não pode ser informado se tpEnteGov não for informado ou o serviço (cTribNac) não corresponder aos serviços da LC 116/2003 (e seus correspondentes na NBS): 25.05; 15.09; 17.12; 10.05.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gRefNFSe`

- **Campo:** `gRefNFSe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de NFS-e referenciadas.
- **Notas explicativas:** Obrigatório para tpOper = 2 ou 3
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0905` — O grupo de documentos referenciados deve ser informado para o tipo de operação (tpOper).
    - Detalhe da regra: O grupo de documentos referenciados (gRefNFSe) deve ser informado quando tpOper = 2 ou 3.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0906` — O grupo de documentos referenciados não pode ser informado para o tipo de operação (tpOper).
    - Detalhe da regra: O grupo de documentos referenciados (gRefNFSe) não pode ser informado se tpOper não for informado  ou quando tpOper = 1, 4 ou 5.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 03 ou 04, este grupo deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 03 ou 04, este grupo deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este grupo deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 01, este grupo deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) =  01, 02 ou 05, este grupo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gRefNFSe/refNFSe`

- **Campo:** `refNFSe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gRefNFSe/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-99  |  **Tamanho:** 50
- **Descrição:** Chave da NFS-e referenciada.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0907` — NFS-e referenciada é inválida.
    - Detalhe da regra: A chave NFS-e referenciada deve ser uma chave válida (validar DV)
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual 04, deve-se referenciar uma única NFSe.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 04, somente será referenciada uma única NFSe.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, deve-se referenciar uma única NFSe.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Crédito (tpNFSeCredito = 01), somente será referenciada uma única NFSe.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/tpEnteGov`

- **Campo:** `tpEnteGov`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Tipo de ente governamental  
    
  Para administração pública direta e suas autarquias e fundações:   
  1 = União;  
  2 = Estado;  
  3 = Distrito Federal;   
  4 = Município;
- **Notas explicativas:** Campo só deve ser informado no caso de compras governamentais.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03, 04 ou 05, este campo não deve ser informado.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) =  01, 02, 03, 04 ou 05, este campo não deve ser informado.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01 ou 05, este campo não deve ser informado.
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 01 ou 05, este campo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/indDoacao`

- **Campo:** `indDoacao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1
- **Descrição:** Indica uma Operação de Doação
- **Notas explicativas:** Em relação às doações:  
    
  1)Doação com contraprestação;   
  - NFS-e deve ser emitida a valor de mercado.  
  indDoacao: Não deve ser informado;  
  gEstornoCred: Não deve ser informado;  
  cClassTrib: Tributação Regular.  
    
  2) Doação sem contraprestação;  
    
  2.1) Quando não houve apropriação de créditos anteriores:   
  - Deve-se emitir NFS-e a valor de mercado. Como não houve créditos na entrada, deve-se realizar a doação sem qualquer estorno.  
  indDoacao: Deve ser informado;  
  gEstornoCred: Não deve ser informado;  
  cClassTrib: "410003 - Doações sem contraprestação em benefício do doador";  
    
  2.2) Quando houve apropriação de créditos anteriores:  
  2.2.a) Pode-se estornar os créditos de entrada ao informar valores de IBS e de CBS no grupo gEstornoCred. Nesse caso, deve-se realizar um cálculo dos créditos obtidos na entrada para serem informados no grupo de estorno;  
  indDoacao: Deve ser informado;  
  gEstornoCred: Deve ser informado;  
  cClassTrib: "410026 - Doação com anulação de crédito";  
    
  2.2.b) Pode-se tributar a operação de doação de forma equivalente a uma operação com incidência regular. Nesse caso, não há estorno e a NFS-e deve ser emitida a valor de mercado;  
  indDoacao: Deve ser informado;  
  gEstornoCred: Não deve ser informado;  
  cClassTrib: Tributação regular.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Indicador de doação deve ser informado para o cClassTrib 410003 ou 410026.
    - Detalhe da regra: O indicador de doação deve ser obrigatoriamente informado quando cClassTrib se refere à doação: 410003 ou 410026.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/indDest`

- **Campo:** `indDest`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** A respeito do Destinatário dos serviços:  
    
  0 – o destinatário é o próprio tomador/adquirente identificado na NFS-e (tomador=adquirente=destinatário);  
  1 – o destinatário não é o próprio adquirente, podendo ser outra pessoa, física ou jurídica (ou equiparada), ou um estabelecimento diferente do indicado como tomador (tomador=adquirente≠destinatário);
- **Valores aceitos (domínio identificado):**
  - `0` → o destinatário é o próprio tomador/adquirente identificado na NFS-e (tomador=adquirente=destinatário)
  - `1` → o destinatário não é o próprio adquirente, podendo ser outra pessoa, física ou jurídica (ou equiparada), ou um estabelecimento diferente do indicado como tomador (tomador=adquirente≠destinatário)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest`

- **Campo:** `dest`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas ao Destinatário
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0910` — O destinatário não deve ser identificado para o código indicador indDest informado.
    - Detalhe da regra: O destinatário só deve ser identificado quando indDest for 1.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/CNPJ`

- **Campo:** `CNPJ`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** Número da inscrição no Cadastro Nacional de Pessoa Jurídica (CNPJ) do destinatário de serviço
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0911` — CNPJ do destinatário informado na DPS é inválido.
    - Detalhe da regra: CNPJ informado na DPS é inválido (verificar DV).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0912` — CNPJ do destinatário não encontrado no cadastro CNPJ na data de competência.
    - Detalhe da regra: CNPJ do destinatário não existe no cadastro CNPJ na data de competência informada na DPS.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/CPF`

- **Campo:** `CPF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 11
- **Descrição:** Número da inscrição no Cadastro Nacional de Pessoa Física (CPF) do destinatário do serviço
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0913` — CPF do destinatário informado na DPS é inválido.
    - Detalhe da regra: CPF informado na DPS é inválido (verificar DV).
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0914` — CPF do destinatário não encontrado no cadastro CPF na data de competência.
    - Detalhe da regra: CPF do destinatário não existe no cadastro CPF na data de competência informada na DPS.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/NIF`

- **Campo:** `NIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 40
- **Descrição:** Número de identificação fiscal fornecido por órgão de administração tributária no exterior

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/cNaoNIF`

- **Campo:** `cNaoNIF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** CE  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1
- **Descrição:** Motivo para não informação do NIF:  
     
   0 - Não informado na nota de origem;  
   1 - Dispensado do NIF;  
   2 - Não exigência do NIF;
- **Valores aceitos (domínio identificado):**
  - `0` → Não informado na nota de origem
  - `1` → Dispensado do NIF
  - `2` → Não exigência do NIF

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/xNome`

- **Campo:** `xNome`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-150
- **Descrição:** Nome / Nome Empresarial do destinatário

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac`

- **Campo:** `endNac`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço nacional.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do destinatário do serviço.  
    (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0920` — O código do município para o endereço do destinatário do serviço não existe conforme tabela de município do IBGE.
    - Detalhe da regra: O código do município para o endereço do destinatário do serviço não existe, conforme tabela IBGE.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0921` — O código do município informado na DPS para o endereço do destinatário do serviço, identificado pelo CNPJ, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - Detalhe da regra: Se o destinatário for identificado pelo CNPJ, o código do município do endereço do destinatário deve existir e corresponder ao município do seu endereço no cadastro CNPJ na data de competência informada na DPS.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0922` — O código do município informado na DPS para o endereço do destinatário do serviço, identificado pelo CPF, não corresponde ao município registrado em seus cadastros na data de competência informada na DPS.
    - Detalhe da regra: Se o destinatário for identificado pelo CPF, o código do município do endereço do destinatário deve existir e corresponder ao município do seu endereço no cadastro CPF na data de competência informada na DPS.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endNac/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) do endereço do destinatário do serviço.  
  (Informar os zeros não significativos)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt`

- **Campo:** `endExt`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço no exterior.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/cPais`

- **Campo:** `cPais`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do país do endereço do destinatário do serviço.  
    (Tabela de Países ISO)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/cEndPost`

- **Campo:** `cEndPost`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-11
- **Descrição:** Código alfanumérico do Endereçamento Postal no exterior do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/xCidade`

- **Campo:** `xCidade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Nome da cidade no exterior do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/xEstProvReg`

- **Campo:** `xEstProvReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/endExt/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Estado, província ou região da cidade no exterior do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/xLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/nro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/xCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/xBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/end/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do destinatário do serviço.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/fone`

- **Campo:** `fone`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 6-20
- **Descrição:** Número do telefone do destinatário.  
   (Preencher com o Código DDD + número do telefone.  Nas operações com exterior é permitido informar o código do país + código da localidade + número do telefone)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/email`

- **Campo:** `email`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/dest/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-80
- **Descrição:** E-mail do destinatário.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0930` — E-mail inválido.
    - Detalhe da regra: E-mail deve ser informado conforme estrutura (conter @, ponto etc.).

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel`

- **Campo:** `imovel`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações de operações relacionadas a bens imóveis, exceto obras.
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0931` — Não é permitido o grupo de informações relativo a imóvel quando o código de tributação nacional, relativo à construção civil, for infomado na DPS.
    - Detalhe da regra: Se o código de tributação nacional (cTribNac) pertencer a um dos subitens, 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços, então o grupo de informações de imóvel não é permitido.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0932` — É obrigatório o grupo de informações relativo ao imóvel na DPS quando o código indicador da operação informado for relacionado à imóvel conforme a tabela IndOp do ANEXO_C-INDOP_IBSCBS-SNNFSe-ESPEC.
    - Detalhe da regra: Se o código de tributação nacional (cTribNac) não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços e, o código indicador da operação (cIndOp) for relativo a operações com imóveis (020101, 020201, 020202, 020301 ou 020401), então o grupo de informações de imóvel é obrigatório.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0928` — Não é permitido o grupo de informações relativo a imóvel quando o código de tributação nacional (cTribNac) não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços e, o código indicador da operação (cIndOp) não for relativo a operações com imóveis (020101, 020201 ou 020301), conforme a tabela IndOp do ANEXO_C-INDOP_IBSCBS-SNNFSe-ESPEC.
    - Detalhe da regra: Se o código de tributação nacional (cTribNac) não pertencer a algum dos subitens 07.02.01, 07.02.02, 07.04.01, 07.05,01, 07.05.02, 07.06.01, 07.06.02, 07.07.01, 07.08.01, 07.17.01 e 07.19.01 da lista de serviços e, o código indicador da operação (cIndOp) não for relativo a operações com imóveis (020101, 020201, 020202, 020301 ou 020401), então o grupo de informações de imóvel não é permitido.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/cMun`

- **Campo:** `cMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 7
- **Descrição:** Código do município do endereço do imóvel  
   (Tabela do IBGE)
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Código IBGE inválido para o município do(s) imóvel(is).
    - Detalhe da regra: O código do município para o endereço do(s) imóvel(is) não existe, conforme tabela IBGE.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao`

- **Campo:** `gLocacao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas às operações de locação, cessão onerosa ou arrendamento de bens imóveis
- **Notas explicativas:** Grupo só é admitido quando se tratar de locação, cessão onerosa ou arrendamento de bens imóveis Código de tributação nacional (cTribNac) for de 99.03.01 à 99.03.05 (subitem 99.03)
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Grupo gLocacao não deve ser informado.
    - Detalhe da regra: O grupo gLocacao não deve ser informado quando o subitem do código de tributação nacional (cTribNac) for diferente de 99.03.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Grupo gLocacao deve ser informado.
    - Detalhe da regra: O grupo gLocacao deve ser informado quando o subitem do código de tributação nacional (cTribNac) for igual 99.03.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/pCopropriedade`

- **Campo:** `pCopropriedade`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-2V2
- **Descrição:** Percentual de Copropriedade  
  (Caso só haja um locador, cedente ou arrendador, informar o Percentual de Copropriedade de 100%)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/vTotOper`

- **Campo:** `vTotOper`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor total da operação com bem imóvel  
  (Informar o valor total da operação de locação, cessão onerosa ou arrendamento de bens imóveis, associado ao aluguel, renda ou equivalente, conforme art. 255 da LC 214/2025).  
    
  Não deverá ser inserido neste campo o valor proporcional do coproprietário.
- **Notas explicativas:** Lei Complementar n° 214, de 16 de janeiro de 2025  
    
  Art. 255. A base de cálculo do IBS e da CBS é o valor:  
  (...)  
  II - da locação, cessão onerosa ou arrendamento do bem imóvel;  
  (...)  
  § 1º O valor da operação de que trata o caput deste artigo inclui:  
  I - o valor dos juros e das variações monetárias, em função da taxa de câmbio ou de índice ou coeficiente aplicáveis por disposição legal ou contratual;  
  II - a atualização monetária, nas vendas contratadas com cláusula de atualização monetária do saldo credor do preço, que venham a integrar os valores efetivamente recebidos pela alienação de bem imóvel;  
  III - os valores a que se referem os incisos I a III e VI do § 1º do art. 12 desta Lei Complementar.  
    
  Art. 12. (...)  
  § 1º O valor da operação compreende o valor integral cobrado pelo fornecedor a qualquer título, inclusive os valores correspondentes a:  
  I - acréscimos decorrentes de ajuste do valor da operação;  
  II - juros, multas, acréscimos e encargos;  
  III - descontos concedidos sob condição;  
  (...)  
  VI - demais importâncias cobradas ou recebidas como parte do valor da operação, inclusive seguros e taxas.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/vDescIncondTot`

- **Campo:** `vDescIncondTot`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor total do Desconto Incondicionado  
   (Informar o valor total do desconto incondicionado na operação de locação, cessão onerosa ou arrendamento de bens imóveis)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/vDescCondTot`

- **Campo:** `vDescCondTot`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor total do Desconto Condicionado  
   (Informar o valor total do desconto incondicionado na operação de locação, cessão onerosa ou arrendamento de bens imóveis)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/dVencOrig`

- **Campo:** `dVencOrig`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gLocacao/`
- **Elemento (ELE):** E  |  **Tipo:** D  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Data de vencimento original  
  Ano, Mês e Dia (AAAA-MM-DD)  
  (Informar data de vencimento original do aluguel, renda ou equivalente na operação de locação, cessão onerosa ou arrendamento de bens imóveis)
- **Notas explicativas:** A data de vencimento original refere-se ao esgotamento do prazo inicialmente fixado para pagamento do aluguel, renda ou equivalente.  
     
  Essa informação não possui efeitos no cálculo e na apuração do IBS e da CBS, servindo apenas como informativo para orientar o mês ou período de referência do aluguel, renda ou equivalente.  
    
  Em que pese o campo ser facultativo, recomenda-se o seu preenchimento.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob`

- **Campo:** `gUnidImob`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-99  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas às unidades imobiliárias objeto da operação
- **Notas explicativas:** Todas as unidades imobiliárias aqui informadas e que compõem a mesma operação devem, obrigatoriamente, estar localizadas no mesmo município (cMun).
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Grupo de unidade imobiliária obrigatório quando código indicador da operação (cIndOp) for igual a 020101, 020201 ou 020301
    - Detalhe da regra: Quando o código indicador da operação (cIndOp) não for relativo a operações com Bens Imóveis com Características Especiais, ou seja, cIndOp = 020101, 020201 ou 020301, então o grupo de informações de unidade imobialiária é obrigatória.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/inscImobFisc`

- **Campo:** `inscImobFisc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-30
- **Descrição:** Inscrição imobiliária fiscal  
   (código fornecido pela prefeitura para a identificação da obra ou para fins de recolhimento do IPTU)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/cCIB`

- **Campo:** `cCIB`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/`
- **Elemento (ELE):** CE  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código do Cadastro Imobiliário Brasileiro - CIB
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0933` — Código CIB inválido.
    - Detalhe da regra: Código do Cadastro Imobiliário Brasileito - CIB deve ser um código válido - 7 caracteres + DV

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end`

- **Campo:** `end`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/`
- **Elemento (ELE):** CG  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações do endereço do imóvel.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end/CEP`

- **Campo:** `CEP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código numérico do Endereçamento Postal nacional (CEP) do endereço do imóvel.  
  (Informar os zeros não significativos)

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/endxLgr`

- **Campo:** `xLgr`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-255
- **Descrição:** Tipo e nome do logradouro do endereço do imóvel.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/endnro`

- **Campo:** `nro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-60
- **Descrição:** Número no logradouro do endereço do imóvel.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/endxCpl`

- **Campo:** `xCpl`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-156
- **Descrição:** Complemento do endereço do imóvel.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/endxBairro`

- **Campo:** `xBairro`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/end`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 1-60
- **Descrição:** Bairro do endereço do imóvel.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis`

- **Campo:** `gAjusteBCLocImoveis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1000  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas a valores de ajuste (dedução/redução) da Base de Cálculo do IBS e da CBS referentes às operações de locação, cessão onerosa ou arrendamento de bens imóveis
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O grupo de ajuste da base de cálculo do IBS/CBS para imóveis não deve ser informado.
    - Detalhe da regra: O grupo gAjusteBCLocImoveis não deve ser informado quando o subitem do código de tributação nacional (cTribNac) for diferente de 99.03.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/tpAjusteBCLocImoveis`

- **Campo:** `tpAjusteBCLocImoveis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Tipo de parcela não integrante da base de cálculo do IBS e da CBS  
    
    01 = Tributos inclusos no aluguel ou equivalente (Ex.: IPTU, Contribuição de melhoria) - apenas para NBS 1.1002.10.00 ou 1.1002.20.00  
    02 = Emolumento incluso no aluguel ou equivalente - apenas para NBS 1.1002.10.00 ou 1.1002.20.00  
    03 = Condomínio incluso no aluguel ou equivalente - apenas para NBS 1.1002.10.00 ou 1.1002.20.00  
  04 = Redutor Social - apenas para a NBS 1.1002.10.00  
    99 = Outras parcelas inclusas no aluguel ou equivalente
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O Redutor Social (tpAjusteBCLocImoveis = 04) só pode ser dedutível da Base de Cálculo de IBS/CBS se a operação for de locação de um imóvel residencial (cNBS = 1.1002.10.00).

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/xTpAjusteBCLocImoveis`

- **Campo:** `xTpAjusteBCLocImoveis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 0-150
- **Descrição:** Descrição do tipo de parcela não integrante da base de cálculo do IBS e da CBS quando a opção for "99  = Outras parcelas inclusas no aluguel ou equivalente".
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — A descrição do tipo de ajuste (dedução/redução) da Base de Cálculo do IBS/CBS deve ser informada quando o tipo de ajuste (tpAjusteBCLocImoveis) for igual a 99.
    - Detalhe da regra: A descrição do tipo de ajuste (dedução/redução) da Base de Cálculo do IBS/CBS deve ser informada quando o tpAjusteBCLocImoveis = 99.
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — A descrição do tipo de ajuste (dedução/redução) da Base de Cálculo do IBS/CBS não deve ser informada quando o tipo de ajuste (tpAjusteBCLocImoveis) for diferente de 99.
    - Detalhe da regra: A descrição do tipo de ajuste (dedução/redução) da Base de Cálculo do IBS/CBS não deve ser informada quando o tpAjusteBCLocImoveis é diferente de 99.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/vAjusteBCLocImoveis`

- **Campo:** `vAjusteBCLocImoveis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/imovel/gUnidImob/gAjusteBCLocImoveis/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor monetário utilizado para não inclusão na base de cálculo do IBS e da CBS da NFS-e que está sendo emitida (R$).  
  (Informar o valor total da parcela não integrante da base de cálculo - IPTU, Condomínio, Redutor social, etc. -, não devendo ser inserido o valor proporcional do coproprietário)
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor do ajuste (dedução/redução) da Base de Cálculo do IBS/CBS deve ser menor ou igual ao valor total da operação com bem imóvel.
    - Detalhe da regra: O valor do ajuste (dedução/redução) do IBS/CBS deve ser menor ou igual ao valor total da operação com bem imóvel (vTotOper).

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis`

- **Campo:** `bensMoveis`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1000  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas aos bens móveis objetos de locação
- **Notas explicativas:** Grupo só é admitido quando se tratar de locação de bens móveis. cTribNac = 99.04.01.
- **Regras de negócio associadas:**
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O grupo bensMoveis não deve ser informado para o código de serviço indicado.
    - Detalhe da regra: O grupo gLocBensMoveis não deve ser informado quando o código de serviço (cTribNac) for diferente de "99.04.01".
  -  **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O grupo bensMoveis deve ser informado quando o código de serviço (cTribNac) for "99.04.01".
    - Detalhe da regra: O grupo gLocBensMoveis deve ser informado quando o código de serviço (cTribNac) for "99.04.01".

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/cNCMBemMovel`

- **Campo:** `cNCMBemMovel`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** Código da Nomenclatura Comum do Mercosul (NCM) do bem móvel objeto da locação.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/xNCMBemMovel`

- **Campo:** `xNCMBemMovel`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-150
- **Descrição:** Descrição do Bem Móvel objeto da locação.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/qtdNCMBemMovel`

- **Campo:** `qtdNCMBemMovel`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/bensMoveis/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Quantidade do Bem Móvel objeto da locação.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores`

- **Campo:** `valores`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relativas aos valores do serviço prestado para IBS e CBS
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib`

- **Campo:** `trib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relacionados aos tributos IBS e CBS

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS`

- **Campo:** `gIBSCBS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relacionadas ao IBS e à CBS

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/CST`

- **Campo:** `CST`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Código de Situação Tributária do   
  IBS e da CBS

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/cClassTrib`

- **Campo:** `cClassTrib`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 6
- **Descrição:** Código de Classificação Tributária   
  do IBS e da CBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0958` — cClassTrib para IBS/CBS incorreto para operação de prestação de serviços.
    - Detalhe da regra: Código da classificação tributária - cClassTrib informado não é suportado para as operações de prestação de serviços (validoParaSiglaDfeInformado = false)
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0959` — cClassTrib não pertence ao grupo CST indicado.
    - Detalhe da regra: Código da classificação tributária - cClassTrib informado não pertence ao grupo do CST para IBS/CBS informado 3 primeiros dígitos do cClassTrib devem ser iguais ao CST
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, deve ser informado o cClassTrib igual a 800002
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, o Código da classificação tributária - cClassTrib informado deve ser igual a 800002
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 02, deve ser informado o cClassTrib igual a 811001
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Débito (tpNFSeDebito) = 02, o Código da classificação tributária - cClassTrib informado deve ser igual a 811001
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 03, deve ser informado o cClassTrib igual a 811002
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Débito (tpNFSeDebito) = 03, o Código da classificação tributária - cClassTrib informado deve ser igual a 811002
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 05, deve ser informado o cClassTrib igual a 800001
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Débito (tpNFSeDebito) = 05, o Código da classificação tributária - cClassTrib informado deve ser igual a 800001
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, deve ser informado o cClassTrib igual a 800001
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, o Código da classificação tributária - cClassTrib informado deve ser igual a 800001

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/cCredPres`

- **Campo:** `cCredPres`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** 2
- **Descrição:** Código e classificação do crédito presumido: IBS e CBS.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este campo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este campo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este campo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste`

- **Campo:** `gIBSCBSAjuste`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações para as Notas de Ajuste
- **Notas explicativas:** Grupo deve (e só pode) ser informando quando:  
  tpNFSeDebito = 01, 02, 03 ou 05 ou tpNFSeCredito = 05
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 04 ou 06, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 04 ou 06, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 01, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 01, este grupo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vIBS`

- **Campo:** `vIBS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do IBS a ser ajustado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/vCBS`

- **Campo:** `vCBS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBSAjuste/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da CBS a ser ajustado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular`

- **Campo:** `gTribRegular`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da Tributação Regular
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0964` — Grupo de tributação regular não deve ser informado.
    - Detalhe da regra: Grupo de tributação regular não deve ser informado quando o indicador para tributação regular (exigeGrupoTributacaoRegular) para o Código da Classificação Tributária - cClassTribIBSCBS for igual a false.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0965` — Grupo de tributação regular deve ser informado.
    - Detalhe da regra: Grupo de tributação regular não deve ser informado quando o indicador para tributação regular (exigeGrupoTributacaoRegular) para o Código da Classificação Tributária - cClassTribIBSCBS for igual a true.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/CSTReg`

- **Campo:** `CSTReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Código de Situação Tributária do   
  IBS e da CBS de tributação regular

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/cClassTribReg`

- **Campo:** `cClassTribReg`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gTribRegular/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 6
- **Descrição:** Código da Classificação Tributária do   
  IBS e da CBS de tributação regular
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0969` — cClassTribReg para IBS/CBS incorreto para operação de prestação de serviços.
    - Detalhe da regra: Código da classificação tributária - cClassTribReg informado não é suportado para as operações de prestação de serviços (validoParaSiglaDfeInformado = false)
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0970` — cClassTribReg não pertence ao grupo CST indicado em CSTReg.
    - Detalhe da regra: Código da classificação tributária - cClassTrib informado não pertence ao grupo do CST para IBS/CBS informado. 3 primeiros dígitos do cClassTribReg devem ser iguais ao CSTReg

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif`

- **Campo:** `gDif`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relacionadas ao diferimento para IBS e CBS
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0971` — Grupo de diferimento para IBS/CBS não deve ser informado.
    - Detalhe da regra: O código da situação tributária (cClassTribIBSCBS ) possui indicador que não permite o uso de diferimento (permiteDiferimento=false)
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E0972` — Grupo de diferimento para IBS/CBS deve ser informado.
    - Detalhe da regra: O código da situação tributária possui indicador que o diferimento deve ser informado (permiteDiferimento=true)
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Débito for igual a 01, 02, 03 ou 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipos de NFS-e de Ajuste de Débito (tpNFSeDebito) = 01, 02, 03 ou 05, este grupo não deve ser informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — Quando o Tipo de NFS-e de Ajuste de Crédito for igual a 05, este grupo não deve ser informado
    - Detalhe da regra: Para Tipo de NFS-e de Ajuste de Crédito (tpNFSeCredito) = 05, este grupo não deve ser informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/pDifUF`

- **Campo:** `pDifUF`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-3V2
- **Descrição:** Percentual de diferimento para o IBS estadual.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/pDifMun`

- **Campo:** `pDifMun`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-3V2
- **Descrição:** Percentual de diferimento para o IBS municipal.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/pDifCBS`

- **Campo:** `pDifCBS`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gDif/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-3V2
- **Descrição:** Percentual de diferimento para a CBS.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred`

- **Campo:** `gEstornoCred`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações relacionadas aos estornos de créditos do IBS e da CBS.
- **Notas explicativas:** A obrigatoriedade ou a vedação do preenchimento deste grupo está condicionada ao indicador “ind_gEstornoCred” da tabela de cClassTrib do IBS e da CBS.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O grupo de estorno de crédito não deve ser informado quando o cClassTrib for diferente de 410026 ou o indicador de doação (indDoacao) não tiver sido informado.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O grupo de estorno de crédito deve ser obrigatoriamente informado quando o cClassTrib for 410026 e o indicador de doação (indDoacao) for informado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/vIBSEstCred`

- **Campo:** `vIBSEstCred`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor do IBS a ser estornado.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor do IBS a ser estornado deve ser inferior ao valor do serviço prestado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/vCBSEstCred`

- **Campo:** `vCBSEstCred`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gEstornoCred/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 1-15V2
- **Descrição:** Valor da CBS a ser estornado.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — O valor da CBS a ser estornado deve ser inferior ao valor do serviço prestado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gPagAntecipado`

- **Campo:** `gPagAntecipado`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de referenciamento das NFS-e de pagamento antecipado para abatimento.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gPagAntecipado/refNFSe`

- **Campo:** `refNFSe`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/valores/trib/gIBSCBS/gPagAntecipado/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-99  |  **Tamanho:** 50
- **Descrição:** Chave da NFS-e de pagamento antecipado referenciada.
- **Notas explicativas:** Referência uma NFS-e de pagamento antecipado emitida anteriormente.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — NFS-e referenciada é inválida.
    - Detalhe da regra: A chave NFS-e referenciada deve ser uma chave válida.
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — A chave NFS-e informada não é uma nota de pagamento antecipado.
    - Detalhe da regra: A NFS-e referenciada deve ser uma nota de pagamento antecipado.

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc`

- **Campo:** `gPgtoVinc`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Grupo de informações da vinculação com a transação de pagamento

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto`

- **Campo:** `pgto`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-99  |  **Tamanho:** -
- **Descrição:** Dados dos pagamentos vinculados à NFS-e

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/nPag`

- **Campo:** `nPag`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 3
- **Descrição:** Numerador único de cada pagamento

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/idTransacao`

- **Campo:** `idTransacao`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2-35
- **Descrição:** Identificador específico da transação financeira, de acordo com o pagamento.
- **Notas explicativas:** Schema deve impedir que se repita dentro do grupo

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/tpMeioPgto`

- **Campo:** `tpMeioPgto`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/`
- **Elemento (ELE):** E  |  **Tipo:** N  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 2
- **Descrição:** Código do meio de pagamento utilizado:  
    
  15 = Boleto   
  17 = Pix QRCode dinâmico   
  18 = TED   
  20 = PIX chave ou QRCode estático   
  23 = Pix automático  
  24 = TEF / booktransfer

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/CNPJReceb`

- **Campo:** `CNPJReceb`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 14
- **Descrição:** CNPJ completo do recebedor do pagamento (fornecedor, plataforma, ou outra entidade que receba o pagamento do adquirente).
- **Notas explicativas:** Indicar o CNPJ responsável por receber dinheiro do adquirente na transação de pagamento. É possível que o CNPJ do recebedor seja diferente do CNPJ do fornecedor constante no documento fiscal.
- **Regras de negócio associadas:**
  - [Nível -] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `EXXX` — CNPJ do recebedor do pagamento na DPS é inválido.
    - Detalhe da regra: CNPJ informado na DPS é inválido (verificar DV).

### `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/CNPJBasePSP`

- **Campo:** `CNPJBasePSP`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/IBSCBS/gPgtoVinc/pgto/`
- **Elemento (ELE):** E  |  **Tipo:** C  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** 8
- **Descrição:** CNPJ base da instituição financeira ou de pagamento utilizada pelo recebedor do pagamento (fornecedor, plataforma, ou outra entidade que  
  receba o pagamento do adquirente).
- **Notas explicativas:** Indicar o CNPJ responsável por receber dinheiro do adquirente na transação de pagamento. É possível que o CNPJ do recebedor seja diferente do CNPJ do fornecedor constante no documento fiscal.

### `NFSe/infNFSe/DPS/infDPS/Signature`

- **Campo:** `Signature`
- **Caminho no XML:** `NFSe/infNFSe/DPS/infDPS/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 0-1  |  **Tamanho:** -
- **Descrição:** Assinatura XML da NFS-e Segundo o Padrão XML Digital Signature  
  Obrigatório quando for enviado para API.  
  Demais casos poderão ser opcionais a serem definidos em regra de validação.

### `NFSe/Signature`

- **Campo:** `Signature`
- **Caminho no XML:** `NFSe/`
- **Elemento (ELE):** G  |  **Tipo:** -  |  **Ocorrência (min-max):** 1-1  |  **Tamanho:** -
- **Descrição:** Assinatura XML da NFS-e segundo o padrão XML digital signature
- **Regras de negócio associadas:**
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1630` — Arquivo enviado com erro na assinatura.
    - Detalhe da regra: A assinatura da NFS-e deve ser válida.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1632` — Certificado Digital da assinatura inválido.
    - Detalhe da regra: Certificado Digital da assintura inválido:  - Validade do Certificado (data início e data fim); - Verifica a Cadeia de Certificação; - Certificado do Transmissor revogado; - LCR indisponível ou inválida.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1634` — Certificado Digital fora do padrão estabelecido.
    - Detalhe da regra: Certificado Digital da assinatura fora do padrão estabelecido pelo Sistema Nacional NFS-e:  - Versão diferente de 3; - Se informado, Basic Constraint deve ser true (não pode ser Certificado de AC); - KeyUsage não define 'Assinatura Digital' e 'Não Recusa'; - Falta a extensão de CNPJ (OtherName - OID=2.16.76.1.3.3) ou CPF (OtherName - OID=2.16.76.1.3.1); - Certificado Raiz difere da 'ICP-Brasil'.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1636` — A assinatura é obrigatória quando for enviado paraa API.
    - Detalhe da regra: É obrigatória a existência da assinatura da NFS-e quando for enviado para API.
  - [Nível 1] **Aplic.:** Obrig. | **Efeito:** Rej. | **Cód. erro:** `E1638` — A assinatura deve ser feita com o certificado digital do municiípio emissor da NFS-e.
    - Detalhe da regra: A assinatura deve ser feita com o certificado digital do município emissor da NFS-e.
