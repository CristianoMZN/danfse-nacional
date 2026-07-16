# Tabela Oficial de Campos do DANFSe (NT nº 008 — item 2.4.5)

Fonte: Especificações Técnicas do DANFSe, Nota Técnica nº 008 – Versão 1.0 (05/05/2026), SE/CGNFS-e.

Todas as medidas estão em **centímetros**. `Alt.` = altura do bloco/campo, `Larg.` = largura,
`Esq.` = posição a partir da margem esquerda, `Sup.` = posição a partir da margem superior.
`Tam. do Campo` = tamanho máximo sugerido em caracteres do conteúdo já concatenado (quando
aplicável, truncar com reticências "..." conforme indicado).

> Estes tamanhos/posições **não são obrigatórios em si** (item 2.1: "os tamanhos descritos no item
> 2.4.5 não são obrigatórios"), **mas o DANFSe deve ser impresso conforme o modelo do Anexo I**
> (posição relativa dos blocos) **e respeitando os tamanhos mínimos de fonte** do item 2.4. Ou seja:
> você pode ajustar levemente larguras/alturas desde que o modelo/ordem dos blocos e os tamanhos
> mínimos de fonte sejam respeitados. Quando em dúvida, use os valores desta tabela como padrão.

## CABEÇALHO

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco cabeçalho, geral) | — | 1,16 | 20,40 | 0,30 | 0,30 | | |
| Logomarca da NFSe | — | 0,85 | 4,00 | 0,49 | 0,44 | Logo oficial: https://www.gov.br/nfse/pt-br/biblioteca/documentacao-tecnica/logos-da-nfs-e/Logo%20-%20NFS-e%20-%20Horizontal.png/view | |
| Quadro da descrição "DANFSe..." | — | 1,16 | 10,19 | 5,41 | 0,30 | Centralizar texto. "DANFSe v2.0" + "Documento Auxiliar da NFS-e", negrito, 9pt, Arial | |
| Quadro da identificação Município/Ambiente | — | 1,16 | 5,09 | 15,62 | 0,30 | | |
| Município | `NFSe/infNFSe/` + `NFSe/infNFSe/emitendendNac/` (xLocEmi + UF) | 0,64 | 5,09 | 15,62 | 0,30 | Concatenar: "Município: CCCC / CC". Não exibir se código de tributação nacional = 99 | 37 |
| Ambiente Gerador | `NFSe/infNFSe/` (ambGer) | 0,24 | 5,09 | 15,62 | 0,97 | | 1 |
| Tipo de Ambiente | `NFSe/infNFSe/DPS/infDPS/` (tpAmb) | 0,24 | 5,09 | 15,62 | 1,22 | 1 = Produção; 2 = Homologação → exigir aviso "NFS-e SEM VALIDADE JURÍDICA" | 1 |
| Quadro do QR Code | — | 1,52 | 1,52 | 17,48 | 1,67 | Dimensão mínima obrigatória | |
| Quadro complemento QR Code | — | 0,68 | 4,72 | 15,80 | 3,36 | Texto de autenticidade (3 linhas, 6pt) | |

## DADOS DA NFS-e (identificação do documento)

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco, geral) | — | 2,84 | 20,40 | 0,30 | 1,48 | | |
| Chave de Acesso da NFS-e | `NFSe/infNFSe/` (id) | 0,77 | 15,30 | 0,30 | 1,48 | Informar o id sem o prefixo "NFS" | 50 |
| Número da NFS-e | `NFSe/infNFSe/` (nNFSe) | 0,67 | 5,09 | 0,30 | 2,27 | | 13 |
| Competência da NFS-e | `NFSe/infNFSe/DPS/infDPS/` (dCompet) | 0,67 | 5,09 | 5,41 | 2,27 | DD/MM/AAAA | 10 |
| Data e Hora da Emissão da NFS-e | `NFSe/infNFSe/` (dhProc) | 0,67 | 5,09 | 10,51 | 2,27 | DD/MM/AAAA hh:mm:ss | 19 |
| Número da DPS | `NFSe/infNFSe/DPS/infDPS/` (nDPS) | 0,67 | 5,09 | 0,30 | 2,96 | | 15 |
| Série da DPS | `NFSe/infNFSe/DPS/infDPS/` (serie) | 0,67 | 5,09 | 5,41 | 2,96 | | 5 |
| Data e Hora da Emissão da DPS | `NFSe/infNFSe/DPS/infDPS/` (dhEmi) | 0,67 | 5,09 | 10,51 | 2,96 | DD/MM/AAAA hh:mm:ss | 19 |
| Emitente da NFS-e | `NFSe/infNFSe/DPS/infDPS/` (tpEmit) | 0,67 | 5,09 | 0,30 | 3,65 | 3 opções (1 a 3) — usar descrição, ex: "Prestador". **Campo tem sombreamento cinza obrigatório** | 13 |
| Situação da NFS-e | `NFSe/infNFSe/` (cStat) | 0,67 | 5,09 | 5,41 | 3,65 | Usar descrição da opção; truncar com "..." acima de 37 caracteres | 40 |
| Finalidade | `NFSe/infNFSe/DPS/infDPS/IBSCBS/` (finNFSe) | 0,67 | 5,09 | 10,51 | 3,65 | Usar descrição da opção; truncar acima de 37 caracteres. **Ver NT 009**: domínio mudou (0=regular,1=crédito,2=débito) | 40 |

## PRESTADOR / FORNECEDOR

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 4,34 | | |
| CNPJ / CPF / NIF | `.../prest/` (CNPJ/CPF/NIF) | 0,63 | 5,09 | 5,41 | 4,34 | Formatos: nn.nnn.nnn/nnnn-nn / nnn.nnn.nnn-nn / nnn. **A partir de jul/2026, CNPJ é alfanumérico (tipo C)** | 18/14/40 |
| Indicador Municipal (Inscrição) | `.../prest/` (IM) | 0,63 | 5,09 | 10,51 | 4,34 | | 15 |
| Telefone | `.../prest/` (fone) | 0,63 | 5,09 | 15,62 | 4,34 | | 20 |
| Nome / Nome Empresarial | `.../prest/` (xNome) | 0,63 | 10,19 | 0,30 | 4,98 | Truncar "..." acima de 77 caracteres | 80 |
| Município / Sigla UF | `.../prest/end/endNac ou endExt` (cMun/xCidade + UF) | 0,63 | 5,09 | 10,51 | 4,98 | Concatenar nome do município + UF | 37 |
| Código IBGE / CEP | `.../prest/end/endNac ou endExt` (cMun+CEP ou cEndPost) | 0,63 | 5,09 | 15,62 | 4,98 | nnnnnnn / nn.nnn-nnn ou nnnnnnn / nnnnnnnnnnn(ext) | 21 |
| Endereço | `.../prest/end/` (xLgr, nro, xCpl, xBairro) | 0,63 | 10,19 | 0,30 | 5,62 | Concatenar tudo; truncar "..." acima de 77 caracteres. **Nota 1**: linha suprimível | 80 |
| Email | `.../prest/` (email) | 0,63 | 10,19 | 10,51 | 5,62 | **Nota 1**: linha suprimível | 80 |
| Simples Nacional na Data de Competência | `.../prest/regTrib/` (opSimpNac) | 0,63 | 5,09 | 0,30 | 6,28 | 3 opções (1-3). **NT 009 adiciona opção 4 = Optante Pendente**; truncar acima de 37 caracteres | 40 |
| Regime de Apuração Tributária pelo SN | `.../prest/regTrib/` (regApTribSN) | 0,63 | 10,19 | 10,51 | 6,28 | 3 opções; truncar acima de 77 caracteres. **Nota 2**. Ver também campo novo `regApIBSCBSSN` (NT 009) | 80 |

## TOMADOR / ADQUIRENTE

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 6,92 | **Nota 2** (bloco suprimível) | |
| CNPJ / CPF / NIF | `.../toma/` | 0,63 | 5,09 | 5,41 | 6,92 | mesmos formatos do Prestador | 18/14/40 |
| Indicador Municipal (Inscrição) | `.../toma/` (IM) | 0,63 | 5,09 | 10,51 | 6,92 | | 15 |
| Telefone | `.../toma/` (fone) | 0,63 | 5,09 | 15,62 | 6,92 | | 20 |
| Nome / Nome Empresarial | `.../toma/` (xNome) | 0,63 | 10,19 | 0,30 | 7,56 | truncar acima de 77 | 80 |
| Município / Sigla UF | `.../toma/end/...` | 0,63 | 5,09 | 10,51 | 7,56 | | 37 |
| Código IBGE / CEP | `.../toma/end/...` | 0,63 | 5,09 | 15,62 | 7,56 | | 21 |
| Endereço | `.../toma/end/` | 0,63 | 10,19 | 0,30 | 8,22 | **Nota 1** | 80 |
| E-mail | `.../toma/` (email) | 0,63 | 10,19 | 10,51 | 8,22 | **Nota 1** | 80 |

## DESTINATÁRIO DA OPERAÇÃO

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 8,86 | **Nota 2 e Nota 3** (suprimível se destinatário = tomador) | |
| CNPJ / CPF / NIF | `.../IBSCBS/dest/` | 0,63 | 5,09 | 5,41 | 8,86 | | 18/14/40 |
| Telefone | `.../IBSCBS/dest/` (fone) | 0,63 | 5,09 | 15,62 | 8,86 | | 20 |
| Nome / Nome Empresarial | `.../IBSCBS/dest/` (xNome) | 0,63 | 10,19 | 0,30 | 9,50 | truncar acima de 77 | 80 |
| Município / Sigla UF | `.../IBSCBS/dest/end/...` | 0,63 | 5,09 | 10,51 | 9,50 | | 37 |
| Código IBGE / CEP | `.../IBSCBS/dest/end/...` | 0,63 | 5,09 | 15,62 | 9,50 | | 21 |
| Endereço | `.../IBSCBS/dest/end/` | 0,63 | 10,19 | 0,30 | 10,16 | **Nota 1** | 80 |
| E-mail | `.../IBSCBS/dest/` (email) | 0,63 | 10,19 | 10,51 | 10,16 | **Nota 1** | 80 |

## INTERMEDIÁRIO DA OPERAÇÃO

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 10,80 | **Nota 2** (suprimível) | |
| CNPJ / CPF / NIF | `.../interm/` | 0,63 | 5,09 | 5,41 | 10,80 | | 18/14/40 |
| Indicador Municipal (Inscrição) | `.../interm/` (IM) | 0,63 | 5,09 | 10,51 | 10,80 | | 15 |
| Telefone | `.../interm/` (fone) | 0,63 | 5,09 | 15,62 | 10,80 | | 20 |
| Nome / Nome Empresarial | `.../interm/` (xNome) | 0,63 | 10,19 | 0,30 | 11,44 | truncar acima de 77 | 80 |
| Município / Sigla UF | `.../interm/end/...` | 0,63 | 5,09 | 10,51 | 11,44 | | 37 |
| Código IBGE / CEP | `.../interm/end/...` | 0,63 | 5,09 | 15,62 | 11,44 | | 21 |
| Endereço | `.../interm/end/` | 0,63 | 10,19 | 0,30 | 12,09 | **Nota 1** | 80 |
| E-mail | `.../interm/` (email) | 0,63 | 10,19 | 10,51 | 12,09 | **Nota 1** | 80 |

## SERVIÇO PRESTADO

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 12,74 | | |
| Código de Tributação Nacional / Municipal | `.../serv/cServ/` + `NFSe/infNFSe/` (cTribNac+cTribMun) | 0,63 | 5,09 | 5,41 | 12,74 | nn.nn.nn / nnn | 14 |
| Código da NBS | `.../serv/cServ/` (cNBS) | 0,63 | 5,09 | 10,51 | 12,74 | n.nnnn.nn.nn | 9 |
| Local da Prestação / Sigla UF / País | `NFSe/infNFSe/` + `.../serv/locPrest/` | 0,63 | 5,09 | 15,62 | 12,74 | Concatenar município + UF (IBGE) + país (ISO 2 dígitos). Ex.: BR | 42 |
| Descrição do Código de Tributação Nacional/Municipal | `.../serv/cServ/` + `NFSe/infNFSe/` (xTribNac+xTribMun) | 0,38 | 20,40 | 0,30 | 13,39 | SE xTribMun<>"" ENTÃO desc. municipal SENÃO nacional. Truncar acima de 167 caract. **Sem título (label) no DANFSe** | 170 |
| Descrição do Serviço | `.../serv/cServ/` (xDescServ) | 0,63 | 20,40 | 0,30 | 13,79 | Truncar acima de 1297 caracteres | 1300 |

## TRIBUTAÇÃO MUNICIPAL (ISSQN)

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 14,43 | **Nota 4** (suprimível quando não há incidência de ISSQN) | |
| Tipo de Tributação do ISSQN | `.../valores/trib/tribMun/` (tribISSQN) | 0,63 | 5,09 | 0,30 | 14,43 | 4 opções (1-4). Ex: "Operação Tributável" | 21 |
| Município/UF/País de Incidência do ISSQN | `NFSe/infNFSe/` + `.../valores/trib/tribMun/` | 0,63 | 10,19 | 5,41 | 14,43 | concatenar, ex "BR" | 42 |
| Regime Especial de Tributação do ISSQN | `.../prest/regTrib/` (regEspTrib) | 0,63 | 5,09 | 0,30 | 15,08 | 8 opções (0-6,9). **Nota 5** | 27 |
| Tipo de Imunidade do ISSQN | `.../valores/trib/tribMun/` (tpImunidade) | 0,63 | 5,09 | 5,41 | 15,08 | 5 opções (1-5); truncar acima de 37. **Nota 5** | 40 |
| Suspensão da Exigibilidade do ISSQN | `.../valores/trib/tribMun/exigSusp/` (tpSusp) | 0,63 | 5,09 | 10,51 | 15,08 | Descrições fixas; truncar acima de 37. **Nota 5** | 40 |
| Número Processo Suspensão | `.../valores/trib/tribMun/exigSusp/` (nProcesso) | 0,63 | 5,09 | 15,62 | 15,08 | **Nota 5** | 30 |
| Benefício Municipal | `NFSe/infNFSe/valores/` (tpBM) | 0,63 | 5,09 | 0,30 | 15,73 | 4 opções (1,4). Ex "Isenção". **Nota 5** | 40 |
| Cálculo do BM | `valores/` ou `.../tribMun/BM/` (vCalcBM ou vRedBCBM) | 0,63 | 5,09 | 5,41 | 15,73 | **Nota 5** | 1-15V2 |
| Total Deduções/Reduções | `valores/vDedRed/` ou `valores/` + `IBSCBS/valores/` | 0,63 | 5,09 | 10,51 | 15,73 | **Nota 5. Ver NT 009**: grupo renomeado para `vAjusteBC` | 1-15V2 |
| Desconto Incondicionado | `valores/vDescCondIncond/` (vDescIncond) | 0,63 | 5,09 | 15,62 | 15,73 | **Nota 5** | 1-15V2 |
| BC ISSQN | `NFSe/infNFSe/valores/` (vBC) | 0,63 | 5,09 | 0,30 | 16,37 | Fórmula atualizada pela NT 009 (ver nt009_reform_updates.md) | 1-15V2 |
| Alíquota Aplicada | `valores/` (pAliqAplic) | 0,63 | 5,09 | 5,41 | 16,37 | | 1-2V2 |
| Retenção do ISSQN | `.../valores/trib/tribMun/` (tpRetISSQN) | 0,63 | 5,09 | 10,51 | 16,37 | 3 opções (1-3). Ex "Não Retido" | 25 |
| ISSQN Apurado | `NFSe/infNFSe/valores/` (vISSQN) | 0,63 | 5,09 | 15,62 | 16,37 | | 1-2V2 |

## TRIBUTAÇÃO FEDERAL (EXCETO CBS)

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 17,02 | | |
| IRRF | `.../valores/trib/tribFed/` (vRetIRRF) | 0,63 | 5,09 | 5,41 | 17,02 | | 1-15V2 |
| Contribuição Previdenciária – Retida | `.../trib/tribFed/` (vRetCP) | 0,63 | 5,09 | 10,51 | 17,02 | | 1-15V2 |
| Contribuições Sociais – Retidas | `.../trib/tribFed/` (vRetCSLL) | 0,63 | 5,09 | 15,62 | 17,02 | | 1-15V2 |
| PIS – Débito Apuração Própria | `.../tribFed/piscofins/` (vPis) | 0,63 | 5,09 | 0,30 | 17,67 | **Nota 6**: linha impressa somente para NFS-e com competência até fim de 2026 | 1-15V2 |
| COFINS – Débito Apuração Própria | `.../tribFed/piscofins/` (vCofins) | 0,63 | 5,09 | 5,41 | 17,67 | **Nota 6** | 1-15V2 |
| Descrição Contrib. Sociais – Retidas | `.../tribFed/piscofins/` (tpRetPisCofins) | 0,63 | 10,19 | 10,51 | 17,67 | 10 opções (1-9). **Nota 6** | 35 |

## TRIBUTAÇÃO IBS / CBS

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,63 | 5,09 | 0,30 | 18,32 | | |
| CST / cClassTrib | `.../IBSCBS/valores/trib/gIBSCBS/` (CST+cClassTrib) | 0,63 | 5,09 | 5,41 | 18,32 | nnn / nnnnnn | 12 |
| Indicador de Operação / Cód. IBGE Incidência / Município Incidência / UF | `.../IBSCBS/` + `NFSe/infNFSe/IBSCBS/` | 0,63 | 10,19 | 10,51 | 18,32 | Concatenar tudo: nnnnnn/nnnnnnn/ccc/CC | 56 |
| Exclusões e Reduções da Base de Cálculo | vários (ver tabela original) | 0,63 | 5,09 | 0,30 | 18,96 | Somatório de todos os campos listados | 1-15V2 |
| Base de Cálculo Após Exclusões e Reduções | `NFSe/infNFSe/IBSCBS/valores/` (vBC) | 0,63 | 5,09 | 5,41 | 18,96 | Fórmula NT 009 (ver referência) | 1-15V2 |
| Red. Alíquota IBS / Red. Alíquota CBS | `IBSCBS/valores/uf,mun,fed/` | 0,63 | 5,09 | 10,51 | 18,96 | % / % / % | 1-2V2 x3 |
| Alíquota IBS UF / IBS Mun | `IBSCBS/valores/uf,mun/` | 0,63 | 5,09 | 15,62 | 18,96 | % / % | 1-2V2 x2 |
| Alíq. Efetiva Municipal – IBS | `IBSCBS/valores/mun/` (pAliqEfetMun) | 0,63 | 5,09 | 0,30 | 19,61 | | 1-2V2 |
| Valor Apurado Municipal – IBS | `IBSCBS/totCIBS/gIBS/gIBSMunTot/` (vIBSMun) | 0,63 | 5,09 | 5,41 | 19,61 | | 1-15V2 |
| Alíq. Efetiva Estadual – IBS | `IBSCBS/valores/uf/` (pAliqEfetUF) | 0,63 | 5,09 | 10,51 | 19,61 | | 1-2V2 |
| Valor Apurado Estadual – IBS | `IBSCBS/totCIBS/gIBS/gIBSUFTot/` (vIBSUF) | 0,63 | 5,09 | 15,62 | 19,61 | | 1-15V2 |
| Valor Total Apurado – IBS | `IBSCBS/totCIBS/gIBS/` (vIBSTot) | 0,63 | 5,09 | 0,30 | 20,26 | **NT 009**: ocorrência mudou de obrigatória p/ opcional (Simples Nacional) | 1-15V2 |
| Alíquota – CBS | `IBSCBS/valores/fed/` (pCBS) | 0,63 | 5,09 | 5,41 | 20,26 | | 1-2V2 |
| Alíquota Efetiva – CBS | `IBSCBS/valores/fed/` (pAliqEfetCBS) | 0,63 | 5,09 | 10,51 | 20,26 | | 1-2V2 |
| Valor Total Apurado – CBS | `IBSCBS/totCIBS/gCBS/` (vCBS) | 0,63 | 5,09 | 15,62 | 20,26 | **NT 009**: ocorrência mudou p/ opcional (Simples Nacional) | 1-15V2 |

## VALOR TOTAL DA NFS-E

| Campo | Caminho XML | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|---|
| (bloco) | — | 0,67 | 5,09 | 0,30 | 20,90 | | |
| Valor da Operação / Serviço | `valores/vServPrest/` (vServ) | 0,67 | 5,09 | 5,41 | 20,90 | | 1-15V2 |
| Desconto Incondicionado | `valores/vDescCondIncond/` (vDescIncond) | 0,67 | 5,09 | 10,51 | 20,90 | | 1-15V2 |
| Desconto Condicionado | `valores/vDescCondIncond/` (vDescCond) | 0,67 | 5,09 | 15,62 | 20,90 | | 1-15V2 |
| Total das Retenções (ISSQN / Federais) | `valores/` (vTotalRet) | 0,67 | 5,09 | 0,30 | 21,59 | | 1-15V2 |
| Valor Líquido da NFS-e | `valores/` (vLiq) | 0,67 | 5,09 | 5,41 | 21,59 | | 1-15V2 |
| Total do IBS/CBS | `IBSCBS/totCIBS/gIBS/` + `gCBS/` (vIBSTot+vCBS) | 0,67 | 5,09 | 10,51 | 21,59 | | 1-15V2 |
| Valor Líquido da NFS-e + IBS/CBS | `IBSCBS/totCIBS/` (vTotNF) | 0,67 | 5,09 | 15,62 | 21,59 | **Campo tem sombreamento cinza obrigatório** | 1-15V2 |

## INFORMAÇÕES COMPLEMENTARES

| Campo | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|
| (bloco) | 0,39 | 20,40 | 0,30 | 22,27 | | |
| Informações Complementares | 0,39 | 20,40 | 0,30 | 22,68 | União de todos os campos de informações complementares. **Ordem obrigatória**: `Inf. Cont.:`; `NFS-e Subst.:` (Nota 7); `Doc. Ref.:`; `Cod. Obra:` / `Insc. Imob.:` (Nota 8); `Cod. Evt.:` (Nota 9); `Doc. Tec.:`; `Núm. Ped.:`; `Item Ped.:`; `Inf. A. T. Mun.:`. Separar por pipes `\|`. **Obrigatório** constar "Totais Aproximados dos Tributos" (Nota 10). Truncar em 1997 caracteres SEM prejudicar a linha final de Totais Aproximados (que é fixa) | 2000 |

## CANHOTO (opcional)

| Campo | Alt. | Larg. | Esq. | Sup. | Observações | Tam. |
|---|---|---|---|---|---|---|
| (bloco) | 0,67 | 20,40 | 0,30 | 28,10 | **Nota 11**: bloco opcional | |
| Data Cientificação | 0,67 | 5,09 | 0,30 | 28,10 | | |
| Identificação e Assinatura | 0,67 | 5,09 | 5,41 | 28,10 | | |
| Nº NFS-e / Chave NFS-e | `NFSe/infNFSe/` (nNFSe+id) | 0,67 | 10,19 | 10,51 | 28,10 | Informar id sem prefixo "NFS". Ex.: nnn / nnn | 66 |

---

## Notas oficiais (numeração da NT 008)

1. Linha (Endereço/Email) poderá ser suprimida mesmo que existam dados no XML.
2. Se não houver dados de Tomador/Adquirente, Destinatário e/ou Intermediário: informar apenas o
   texto fixo de "não identificado" no bloco correspondente (ver `suppression_rules.md`). Altura
   mínima do bloco 0,32cm, largura mínima 20,40cm; ajustar coordenadas conforme necessário.
3. Se o Destinatário da Operação for o próprio Tomador/Adquirente: suprimir e usar o texto fixo
   (ver `suppression_rules.md`). Mesmas alturas/larguras mínimas da Nota 2.
4. Para operações sem incidência de ISSQN: suprimir bloco "Tributação Municipal (ISSQN)" e usar
   texto fixo (ver `suppression_rules.md`). Mesmas alturas/larguras mínimas.
5. Linha pode ser suprimida caso **não existam dados em todos os campos da mesma linha** no XML
   (suprimir linha inteira, não campo isolado, salvo indicação contrária).
6. Linha (PIS/COFINS/Descrição Contrib. Sociais) será impressa apenas para NFS-e com **data de
   competência até o final do ano-calendário de 2026**. A partir de 2027, não imprimir.
7. Em caso de substituição da NFS-e: informar em Informações Complementares a chave de acesso da
   NFS-e substituída (`chSubstda`), no formato `NFS-e Subst.: <chave>`.
8. Quando obrigatório o preenchimento do grupo Obra/Imóvel: informar `Cod. Obra:` e `Insc. Imob.:`
   com os respectivos valores (`cObra`, `inscImobFisc`).
9. Quando obrigatório o preenchimento do grupo Evento: informar `Cod. Evt.:` + `idAtvEvt`.
10. **Obrigatório** constar a informação de Totais Aproximados de Tributos (Lei nº 12.741/2012),
    em R$ OU %, no formato: `Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012: Federais: R$
    ou % ; Estaduais: R$ ou % ; Municipais: R$ ou %`.
11. Bloco de Canhoto é opcional; se omitido, redistribuir o espaço para "Descrição do Serviço"
    e/ou "Informações Complementares", deslocando os campos seguintes.
12. Campos sem informação no XML devem ser preenchidos com um traço `-` (nunca deixados em
    branco/vazios nem omitidos silenciosamente, salvo supressão de bloco permitida).

**Regra geral de "1-15V2" / "1-2V2" / "1-3V2":** notação de tamanho de campo numérico monetário/
percentual da NT (dígitos inteiros-decimais, "V2" = 2 casas decimais). Ao formatar, use separador
decimal conforme padrão brasileiro (vírgula) e o prefixo "R$" ou "%" conforme o campo.
