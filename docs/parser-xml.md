---
layout: default
title: Parser XML
nav_order: 5
permalink: /parser-xml.html
---

# Parser de XML

A biblioteca parseia o XML da NFS-e Nacional (v1.01, com ou sem grupo IBS/CBS) em estruturas PHP prontas para uso. Há duas saídas equivalentes: `array` associativo ou DTO tipado.

## Como `array` — `XmlToArray`

`DanfseNacional\XmlToArray` converte o XML em um array associativo limpo.

```php
use DanfseNacional\XmlToArray;

$xml = file_get_contents('nfse_autorizada.xml');
$array = (new XmlToArray())->convert($xml);

echo $array['infNFSe']['nNFSe'];           // "10"
echo $array['infNFSe']['emit']['CNPJ'];     // "11222333000181"
echo $array['infNFSe']['valores']['vLiq'];  // "1292.75"
```

### Namespace NFS-e

`XmlToArray` conhece o namespace `http://www.sped.fazenda.gov.br/nfse` e extrai apenas os filhos sob esse namespace. A assinatura digital (`http://www.w3.org/2000/09/xmldsig#`) é descartada.

### Atributos XML

Atributos sem namespace (ex.: `Id`, `versao`) são incluídos como chaves regulares do array.

### Elementos repetíveis

Elementos com cardinalidade repetível no leiaute (1-N ou 0-N) são **sempre materializados como array indexado**, mesmo quando há uma única ocorrência. Isso mantém o mapeamento estável para `list<Foo>` no DTO.

Lista atual (ver `XmlToArray::REPEATABLE_ELEMENTS`):

- `xItemPed`
- `refNFSe`
- `docAjusteBC`
- `docDedRed`
- `bensMoveis`
- `gUnidImob`
- `gAjusteBCLocImoveis`

> Para qualquer nome fora dessa lista, o parser retorna a **última** ocorrência encontrada — comportamento compatível com a versão histórica da biblioteca.

## Como objeto DTO — `DanfseGenerator::parseXml()`

Para uma API tipada, use `DanfseGenerator::parseXml()`, que retorna um objeto `DanfseNacional\Dto\NFSe` com propriedades `readonly`:

```php
use DanfseNacional\DanfseGenerator;

$nfse = (new DanfseGenerator())->parseXml($xml);

echo $nfse->infNFSe->nNFSe;                 // "10"
echo $nfse->infNFSe->emit->xNome;           // "EMPRESA EXEMPLO..."
echo $nfse->infNFSe->valores->vLiq;         // "1292.75"
echo $nfse->infNFSe->DPS->infDPS->dCompet;  // "2026-01-15"
```

Para XMLs com bloco IBS/CBS:

```php
$nfse = (new DanfseGenerator())->parseXml($xmlV2);

$ibsCbs = $nfse->infNFSe->IBSCBS;
$aliqIBSUF = $ibsCbs->valores?->uf?->pAliqEfetUF;
$aliqCBS   = $ibsCbs->valores?->fed?->pAliqEfetCBS;
$vTotalCBS = $ibsCbs->totCIBS?->gCBS?->vCBS;
```

> Exemplo completo: [`examples/example_parse.php`](https://github.com/CristianoMZN/danfse-nacional/blob/main/examples/example_parse.php).

## Por dentro: como o parser funciona

`DanfseGenerator::parseXml()` orquestra três etapas:

1. **`XmlToArray::convert()`** — XML → array associativo.
2. **`normalizeLegacySchema()`** — campos renomeados entre NT 008 e NT 009 (`vDedRed` → `vAjusteBC::$pDR/$vDR`) são mesclados no DTO único do modelo NT 009, evitando perda silenciosa de dados em NFS-e legadas (`DPS versao="1.00"`).
3. **`nullifyEmptyGroups()`** — strings vazias em posições de grupo nullable (`?Objeto`) viram `null`, evitando rejeição pelo Valinor quando o XML traz `<tribFed/>` ou `<vDescCondIncond/>` vazios.

Por fim, o array é mapeado para `DanfseNacional\Dto\NFSe` via [CuyZ/Valinor](https://github.com/CuyZ/Valinor) com `allowSuperfluousKeys()` e `allowPermissiveTypes()`. Chaves XML não mapeadas para uma propriedade do DTO são ignoradas (não lançam exceção), o que dá resiliência contra versões futuras do leiaute.

## Robustez de campos ausentes

Todos os campos opcionais no esquema da NFS-e são representados como propriedades `nullable` ou com valor padrão de string vazia. O acesso a um campo ausente nunca lança exceção.

## Limitação conhecida — `documentos/docDedRed` e `documentos/docAjusteBC`

Ainda não são parseados na 2.0.0: o leiaute permite 1-1000 ocorrências com choice groups internos (`chNFSe`, `chNFe`, `NFSeMun`, `NFNFS`, `nDocFisc`, `nDoc`, `tpDedRed` etc.) e nenhum XML real testado até o momento traz esse grupo.

Quando uma NFS-e real trouxer `vDedRed/documentos` ou `vAjusteBC/documentos`, o grupo será adicionado sem breaking change.

## Próximos passos

- [Referência completa de DTOs](dtos.html)