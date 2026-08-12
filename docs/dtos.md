---
layout: default
title: DTOs
nav_order: 6
permalink: /dtos.html
---

# Referência de DTOs

Toda árvore de DTOs da biblioteca é `readonly` (PHP 8.2+) e espelha fielmente a hierarquia do XML da NFS-e Nacional. Campos opcionais no esquema são `?string` (ou string vazia) — acessos nunca lançam por campo ausente.

Namespace: `DanfseNacional\Dto\`.

## Árvore de tipos

```
NFSe
└── InfNFSe
    ├── Emitente
    │   └── EnderecoEmitente
    ├── ValoresNFSe
    ├── IBSCBS                                  [v2.0 — opcional]
    │   ├── IBSCBSValores
    │   │   ├── IBSCBSUF
    │   │   ├── IBSCBSMun
    │   │   └── IBSCBSFed
    │   └── TotCIBS
    │       ├── GIBS
    │       │   ├── GIBSCredPres
    │       │   ├── GIBSUFTot
    │       │   └── GIBSMunTot
    │       ├── GCBS
    │       │   └── GCBSCredPres
    │       ├── GTribRegular
    │       ├── GTribCompraGov
    │       └── GTribSN
    └── Dps
        └── InfDPS
            ├── Substituicao
            ├── Prestador
            │   └── RegTrib
            ├── Tomador
            │   └── Endereco
            │       └── EnderecoNacional
            ├── Intermediario
            ├── Servico
            │   ├── LocPrest
            │   ├── CServ
            │   ├── InfoCompl
            │   │   └── GItemPed (list<string>)
            │   ├── ComExt                       [v2.0]
            │   ├── Obra                          [v2.0]
            │   └── AtvEvento                     [v2.0]
            ├── Valores
            │   ├── VServPrest
            │   ├── VDescCondIncond
            │   ├── VAjusteBC
            │   └── Tributacao
            │       ├── TribMunicipal
            │       ├── TribFederal
            │       │   └── PisCofins
            │       └── TotTrib
            │           └── TotTribPercent
            └── DPS_IBSCBS                        [v2.0]
                └── ValoresDPS_IBSCBS
                    └── TriBDPS_IBSCBS
                        └── GIBSCBS_DPS
```

## NFSe

| Campo      | Tipo      | Descrição                                  |
| ---------- | --------- | ------------------------------------------ |
| `infNFSe`  | `?InfNFSe` | Bloco principal da NFS-e (pode ser `null`) |
| `versao`   | `string`  | Atributo `versao` do XML raiz              |

## InfNFSe

Cabeçalho do documento (`<infNFSe>`).

| Campo         | Tipo            | Descrição                                                    |
| ------------- | --------------- | ------------------------------------------------------------ |
| `Id`          | `string`        | Atributo `Id` da tag `<infNFSe>` (chave de acesso)            |
| `xLocEmi`     | `string`        | Local de emissão                                             |
| `xLocPrestacao` | `string`      | Local da prestação                                           |
| `nNFSe`       | `string`        | Número da NFS-e                                              |
| `cLocIncid`   | `string`        | Código IBGE do município de incidência                       |
| `xLocIncid`   | `string`        | Nome do município de incidência                              |
| `xTribNac`    | `string`        | Tributação nacional                                          |
| `xTribMun`    | `string`        | Tributação municipal                                         |
| `xNBS`        | `string`        | Código NBS                                                    |
| `verAplic`    | `string`        | Versão da aplicação emissora                                 |
| `ambGer`      | `string`        | Ambiente de geração (`1` = produção, `2` = homologação)        |
| `tpEmis`      | `string`        | Tipo de emissão                                              |
| `procEmi`     | `string`        | Processo de emissão                                          |
| `cStat`       | `string`        | Código de status da NFS-e (define "Situação da NFS-e")        |
| `dhProc`      | `string`        | Data/hora de processamento                                   |
| `nDFSe`       | `string`        | Número do DFSe                                                |
| `xOutInf`     | `string`        | Outras informações                                           |
| `emit`        | `?Emitente`     | Emitente                                                     |
| `valores`     | `?ValoresNFSe`  | Valores da NFS-e                                             |
| `IBSCBS`      | `?IBSCBS`       | Bloco IBS/CBS (NT 009) — `null` em XML sem Reforma Tributária |
| `DPS`         | `?Dps`          | DPS original                                                 |

## Emitente

| Campo       | Tipo                | Descrição                                                  |
| ----------- | ------------------- | ---------------------------------------------------------- |
| `CNPJ`      | `string`            | CNPJ do emitente                                           |
| `CPF`       | `string`            | CPF do emitente                                            |
| `NIF`       | `string`            | NIF (estrangeiro)                                          |
| `cNaoNIF`   | `string`            | Código de "não possui NIF"                                 |
| `CAEPF`     | `string`            | CAEPF                                                      |
| `IM`        | `string`            | Inscrição Municipal                                        |
| `xNome`     | `string`            | Nome / razão social                                        |
| `xFant`     | `string`            | Nome fantasia                                              |
| `enderNac`  | `?EnderecoEmitente` | Endereço nacional                                          |
| `fone`      | `string`            | Telefone                                                   |
| `email`     | `string`            | E-mail                                                     |

**Método:** `documento(): string` — retorna `CNPJ` ?: `CPF` ?: `NIF`.

## EnderecoEmitente

| Campo      | Tipo     | Descrição           |
| ---------- | -------- | ------------------- |
| `xLgr`     | `string` | Logradouro          |
| `nro`      | `string` | Número              |
| `xCpl`     | `string` | Complemento         |
| `xBairro`  | `string` | Bairro              |
| `cMun`     | `string` | Código IBGE do município |
| `UF`       | `string` | Sigla UF            |
| `CEP`      | `string` | CEP                 |

## ValoresNFSe

| Campo                  | Tipo     | Descrição                                            |
| ---------------------- | -------- | ---------------------------------------------------- |
| `vCalcAjusteBCISSQN`   | `string` | Valor do ajuste de BC do ISSQN (NT 009)              |
| `vCalcDR`              | `string` | Valor da dedução/redução (NT 008 retrocompat)        |
| `tpBM`                 | `string` | Tipo de bem móvel                                    |
| `vCalcBM`              | `string` | Valor do cálculo do bem móvel                        |
| `vBC`                  | `string` | Base de cálculo                                      |
| `pAliqAplic`           | `string` | Alíquota aplicada                                    |
| `vISSQN`               | `string` | Valor do ISSQN                                       |
| `vTotalRet`            | `string` | Total retido                                         |
| `vLiq`                 | `string` | Valor líquido                                        |
| `xOutInf`              | `string` | Outras informações                                   |

## IBSCBS (NT 009)

Presente apenas quando o XML traz o bloco da Reforma Tributária.

| Campo                | Tipo               | Descrição                          |
| -------------------- | ------------------ | ---------------------------------- |
| `cLocalidadeIncid`   | `string`           | Localidade de incidência           |
| `xLocalidadeIncid`   | `string`           | Nome da localidade de incidência   |
| `pRedutor`           | `string`           | Percentual redutor                 |
| `valores`            | `?IBSCBSValores`   | Valores por ente                    |
| `totCIBS`            | `?TotCIBS`         | Totais do CIBS                      |

### IBSCBSValores

| Campo                     | Tipo        | Descrição                          |
| ------------------------- | ----------- | ---------------------------------- |
| `vBC`                     | `string`    | Base de cálculo IBS/CBS            |
| `vCalcAjusteBCIBSCBS`     | `string`    | Ajuste de BC IBS/CBS (NT 009)      |
| `vCalcAjusteBCLocImoveis` | `string`    | Ajuste de BC por imóveis (NT 009)  |
| `vReceitaBrutaSN`         | `string`    | Receita bruta do Simples Nacional  |
| `uf`                      | `?IBSCBSUF` | IBS UF                             |
| `mun`                     | `?IBSCBSMun`| IBS município                      |
| `fed`                     | `?IBSCBSFed`| CBS federal                        |

#### IBSCBSUF / IBSCBSMun / IBSCBSFed

Cada DTO traz três campos `string` com percentual base, redutor e alíquota efetiva. Por exemplo, em `IBSCBSUF`:

| Campo         | Tipo     | Descrição                       |
| ------------- | -------- | ------------------------------- |
| `pIBSUF`      | `string` | Percentual IBS UF               |
| `pRedAliqUF`  | `string` | Redutor da alíquota UF          |
| `pAliqEfetUF` | `string` | Alíquota efetiva UF             |

### TotCIBS

| Campo             | Tipo             | Descrição                          |
| ----------------- | ---------------- | ---------------------------------- |
| `vTotNF`          | `string`         | Valor total da NF                  |
| `gIBS`            | `?GIBS`          | Totais IBS                         |
| `gCBS`            | `?GCBS`          | Totais CBS                         |
| `gTribRegular`    | `?GTribRegular`  | Tributação regular                 |
| `gTribCompraGov`  | `?GTribCompraGov`| Tributação em compra governamental |
| `gTribSN`         | `?GTribSN`       | Tributação no Simples Nacional     |

#### GIBS

| Campo         | Tipo              | Descrição                |
| ------------- | ----------------- | ------------------------ |
| `vIBSTot`     | `string`          | Valor total IBS          |
| `gIBSCredPres` | `?GIBSCredPres`  | Crédito presumido IBS    |
| `gIBSUFTot`   | `?GIBSUFTot`      | Totais IBS UF            |
| `gIBSMunTot`  | `?GIBSMunTot`     | Totais IBS município     |

#### GCBS

| Campo          | Tipo            | Descrição             |
| -------------- | --------------- | --------------------- |
| `gCBSCredPres` | `?GCBSCredPres` | Crédito presumido CBS |
| `vDifCBS`      | `string`        | Diferencial CBS       |
| `vCBS`         | `string`        | Valor total CBS       |

## DPS / InfDPS

```php
final readonly class InfDPS {
    public ?Substituicao $subst;
    public ?Prestador $prest;
    public ?Tomador $toma;
    public ?Intermediario $interm;
    public ?Servico $serv;
    public ?Valores $valores;
    public ?DPS_IBSCBS $IBSCBS;
}
```

`InfDPS` traz ainda campos `string` simples para `Id`, `tpAmb`, `dhEmi`, `verAplic`, `serie`, `nDPS`, `dCompet`, `tpEmit`, `cMotivoEmisTI`, `finNFSe`, `tpNFSeDebito`, `tpNFSeCredito`, `chNFSeRej` e `cLocEmi`.

### Prestador / Tomador

Ambos seguem o mesmo padrão do Emitente (CNPJ/CPF/NIF/cNaoNIF/CAEPF/IM/xNome/end/fone/email) com `end` sendo `?Endereco`. `Prestador` traz adicionalmente `?RegTrib $regTrib`. Ambos expõem `documento(): string`.

### Endereco / EnderecoNacional

`Endereco` (genérico) carrega `?EnderecoNacional $endNac`, `xLgr`, `nro`, `xCpl`, `xBairro`. `EnderecoNacional` traz `cMun`, `CEP`, `UF`.

### Servico

| Campo       | Tipo        | Descrição                                |
| ----------- | ----------- | ---------------------------------------- |
| `locPrest`  | `?LocPrest` | Local da prestação                       |
| `cServ`     | `?CServ`    | Código do serviço                        |
| `infoCompl` | `?InfoCompl`| Informações complementares                |
| `comExt`    | `?ComExt`   | Comércio exterior (v2.0)                 |
| `obra`      | `?Obra`     | Obra (v2.0)                              |
| `atvEvento` | `?AtvEvento`| Atividade / evento (v2.0)                |

`InfoCompl` traz `xInfComp`, `docRef`, `idDocTec`, `xPed` e `gItemPed` (lista de `string`).

### Valores (DPS)

| Campo              | Tipo              | Descrição                                  |
| ------------------ | ----------------- | ------------------------------------------ |
| `vServPrest`       | `?VServPrest`     | Valores do serviço prestado                |
| `vDescCondIncond`  | `?VDescCondIncond`| Descontos condicionado / incondicionado    |
| `vAjusteBC`        | `?VAjusteBC`      | Ajuste de BC (modelo NT 009 + retrocompat) |
| `trib`             | `?Tributacao`     | Tributação                                 |

#### VAjusteBC

Modelo NT 009 (campos `pAjusteBCISSQN` / `vAjusteBCISSQN`) **com fallback NT 008** (campos `pDR` / `vDR` populados automaticamente quando o XML traz `vDedRed`):

| Campo               | Tipo     | Descrição                                    |
| ------------------- | -------- | -------------------------------------------- |
| `pAjusteBCISSQN`    | `string` | Percentual de ajuste (NT 009)                |
| `vAjusteBCISSQN`    | `string` | Valor do ajuste (NT 009)                     |
| `pDR`               | `string` | Percentual de dedução/redução (NT 008 legacy) |
| `vDR`               | `string` | Valor de dedução/redução (NT 008 legacy)       |

### Tributacao

| Campo     | Tipo            | Descrição                                |
| --------- | --------------- | ---------------------------------------- |
| `tribMun` | `?TribMunicipal`| Tributação municipal                     |
| `tribFed` | `?TribFederal`  | Tributação federal                       |
| `totTrib` | `?TotTrib`      | Totais dos tributos (Lei 12.741/2012)    |

#### TribMunicipal

Campos `string` para `tribISSQN`, `tpRetISSQN`, `pAliq`, `vBC`, `vISSQN`, `vDescCond`, `vDescIncond`, `vDeducao`, `vOutDed`, **`tpImunidade`** (renomeado em 2.0.0), `suspExigibilidade`, `nProcessoSuspensao`, `beneficioMunicipal`.

#### TribFederal

| Campo      | Tipo        | Descrição           |
| ---------- | ----------- | ------------------- |
| `piscofins`| `?PisCofins`| PIS/COFINS          |
| `vRetCP`   | `string`    | Retenção de previdência |
| `vRetIRRF` | `string`    | Retenção de IRRF     |
| `vRetCSLL` | `string`    | Retenção de CSLL     |

`PisCofins` traz `CST`, `vBCPisCofins`, `pAliqPis`, `pAliqCofins`, `vPis`, `vCofins`, `tpRetPisCofins`.

#### TotTrib / TotTribPercent

`TotTrib` traz `vTotTribFed`, `vTotTribEst`, `vTotTribMun` e `?TotTribPercent $pTotTrib` (com `pTotTribFed`, `pTotTribEst`, `pTotTribMun`).

## DPS_IBSCBS (NT 009)

Bloco IBS/CBS declarado na DPS (cClassTrib etc.):

```php
final readonly class DPS_IBSCBS {
    public string $indFinal;
    public string $tpOper;
    public ?ValoresDPS_IBSCBS $valores;
}
```

`ValoresDPS_IBSCBS` leva a `?TriBDPS_IBSCBS $trib`, que por sua vez leva a `?GIBSCBS_DPS $gIBSCBS` (com `CST` e `cClassTrib`).

## Próximos passos

- [Breaking changes entre versões]({{ '/breaking-changes.html' | relative_url }})
- [Parser XML — origens dos campos]({{ '/parser-xml.html' | relative_url }})