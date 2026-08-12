---
layout: default
title: Uso rápido
nav_order: 3
permalink: /uso-rapido.html
---

# Uso rápido

## Gerando o primeiro PDF

O caminho mais curto é passar o XML autorizado e receber o PDF em uma única chamada:

```php
use DanfseNacional\DanfseGenerator;

$xml = file_get_contents('nfse_autorizada.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

file_put_contents('danfse.pdf', $pdf);
```

`generateFromXml()` retorna o conteúdo binário do PDF (string) — basta gravá-lo em disco, enviá-lo como resposta HTTP, ou passá-lo adiante.

## NFS-e com IBS/CBS (Reforma Tributária)

XMLs v1.01 que incluam o grupo `IBSCBS` (NT 009/2026) fazem a biblioteca renderizar **automaticamente** a seção de tributação IBS/CBS no DANFSe — sem código extra:

```php
use DanfseNacional\DanfseGenerator;

$xml = file_get_contents('nfse_com_ibs_cbs.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

file_put_contents('danfse.pdf', $pdf);
```

A presença da seção é decidida pelo **conteúdo do XML**, não pela versão dele.

## Acesso aos dados antes do PDF

Use `parseXml()` quando precisar dos dados da NFS-e antes de renderizar (para gravar logs, auditar, exibir em UI etc.):

```php
use DanfseNacional\DanfseGenerator;

$generator = new DanfseGenerator();

$nfse = $generator->parseXml($xml);

echo $nfse->infNFSe->nNFSe;                 // "10"
echo $nfse->infNFSe->emit->xNome;           // "EMPRESA EXEMPLO..."
echo $nfse->infNFSe->valores->vLiq;         // "1292.75"
echo $nfse->infNFSe->DPS->infDPS->dCompet;  // "2026-01-15"

$pdf = $generator->generatePdf($nfse);
```

Os campos IBS/CBS também ficam disponíveis quando presentes:

```php
$ibsCbs = $nfse->infNFSe->IBSCBS;
$aliqIBSUF = $ibsCbs->valores?->uf?->pAliqEfetUF;
$aliqCBS   = $ibsCbs->valores?->fed?->pAliqEfetCBS;
$vTotalCBS = $ibsCbs->totCIBS?->gCBS?->vCBS;
```

> Veja a [referência completa de DTOs](dtos.html) para a árvore de objetos e tipos.

## Resposta HTTP direta (PHP puro / Laravel)

Em vez de salvar o arquivo em disco, basta devolver a string binária:

```php
// PHP puro
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="danfse.pdf"');
echo $pdf;

// Laravel
return response($pdf, 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="danfse.pdf"',
]);
```

## Próximos passos

- [Customização — logos, canhoto, identificação da prefeitura](customizacao.html)
- [Parser XML — `XmlToArray` e `parseXml`](parser-xml.html)