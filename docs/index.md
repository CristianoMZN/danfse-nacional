---
layout: default
title: Visão geral
nav_order: 1
permalink: /
---

# DANFSe Nacional

Biblioteca PHP 8.1+ para o **DANFSe Nacional** (Documento Auxiliar da NFS-e), distribuída via Packagist/Composer. Compatível com o padrão NFS-e 2.0 (Notas Técnicas NT 008/2026 e NT 009/2026 — Reforma Tributária do IBS/CBS).

A biblioteca entrega três pilares de mesmo nível:

1. **Geração de PDF** do DANFSe a partir do XML autorizado (saída em A4 retrato, fiel ao documento da SEFAZ).
2. **Parser tipado do XML** — converte a NFS-e em `array` associativo ou em objetos DTO `readonly` (`NFSe` / `InfNFSe` / `DPS` / ...) prontos para uso.
3. **Visualizador HTML** do DANFSe — gera o HTML intermediário consumido pelo `dompdf`, útil para inspeção antes da renderização final.

Sem dependência de framework: PHP puro, Laravel, Symfony, Cake ou qualquer outro projeto PHP. PSR-4; namespace `DanfseNacional\`.

## Próximos passos

- [Instalação e requisitos](instalacao.html)
- [Uso rápido — o primeiro PDF em 30 segundos](uso-rapido.html)
- [Conformidade com NT 008/2026 e NT 009/2026](conformidade.html)
- [Parser XML — `XmlToArray` e `parseXml`](parser-xml.html)
- [Referência completa de DTOs](dtos.html)
- [Customização — logos, `DanfseConfig`, `MunicipalityBranding`, canhoto](customizacao.html)
- [Visualizador HTML](visualizador-html.html)
- [Templates, fontes e limites normativos](templates-fontes.html)
- [Breaking changes entre versões](breaking-changes.html)
- [Testes e fixtures](testes.html)

## Repositório e issues

- Repositório: [github.com/CristianoMZN/danfse-nacional](https://github.com/CristianoMZN/danfse-nacional)
- Packagist: [packagist.org/packages/cristianomzn/danfse-nacional](https://packagist.org/packages/cristianomzn/danfse-nacional)
- Issues: [github.com/CristianoMZN/danfse-nacional/issues](https://github.com/CristianoMZN/danfse-nacional/issues)