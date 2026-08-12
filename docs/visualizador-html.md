---
layout: default
title: Visualizador HTML
nav_order: 8
permalink: /visualizador-html.html
---

# Visualizador HTML

O visualizador HTML expõe o HTML intermediário consumido pelo `dompdf` para renderizar o PDF. Útil para inspecionar a marcação do DANFSe em testes, depuração ou em qualquer cenário em que o PDF ainda não é o destino final.

```php
use DanfseNacional\DanfseGenerator;

$generator = new DanfseGenerator();
$nfse = $generator->parseXml($xml);

$html = $generator->generateHtml($nfse);
```

`generateHtml()` retorna a string HTML completa, com:

- Logo NFS-e aplicada automaticamente (fixa em `DefaultLogo::DATA_URI`).
- Logo do ente configurada via `DanfseConfig::municipality`, quando informada.
- Seção IBS/CBS renderizada quando presente no XML.

## Quando usar

- **Inspeção manual** do layout em desenvolvimento (curl no servidor local, por exemplo).
- **Geração de snapshots HTML** para versionar visualmente regressões em testes.
- **Integração com frontends** que preferem renderizar o DANFSe em HTML para impressão pelo navegador.

## Servidor de desenvolvimento

A raiz do repositório traz um `index.php` que serve qualquer XML de `schemas/` via `?key=<basename>`:

```bash
php -S localhost:8000
```

Abra `http://localhost:8000/?key=<basename-do-xml-em-schemas>` para ver o DANFSe renderizado em HTML. Use `?html=1` para receber o HTML intermediário em vez do `var_dump` do DTO.

## Próximos passos

- [Customização — logos, `DanfseConfig`, `MunicipalityBranding`, canhoto](customizacao.html)
- [Testes e fixtures](testes.html)