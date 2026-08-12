---
layout: default
title: Testes
nav_order: 11
permalink: /testes.html
---

# Testes e fixtures

A suíte usa PHPUnit. Não há linter, formatador, typecheck ou CI configurado — a única verificação automática é o `phpunit`.

## Rodando a suíte

```bash
composer install
./vendor/bin/phpunit
```

Ou, usando o script Composer:

```bash
composer test
```

## Fixtures de teste

A `realXmlProvider()` e o teste `test_batch_generation_all_xmls` varrem dois diretórios:

- `tests/xmls/` — fixtures **públicas** (NFS-e reais cujo emissor/tomador autorizou divulgação; versionadas no repo).
- `tests/xmls.local/` — fixtures **privadas** (gitignored; cada desenvolvedor pode colocar aqui XMLs reais cujo conteúdo não deve ir para o repo público).

Quando o basename coincide, a versão em `xmls.local/` **sobrescreve** a de `xmls/`. Detalhes e exemplos em `tests/xmls.local/README.md`.

## Servidor de desenvolvimento para inspeção

```bash
php -S localhost:8000
```

Abra `http://localhost:8000/?key=<basename-do-xml-em-schemas>` para ver o DANFSe renderizado em HTML.

Acrescente `?html=1` para receber o HTML intermediário em vez do `var_dump` do DTO.

## Próximos passos

- [Conformidade com NT 008/2026 e NT 009/2026](conformidade.html)
- [Visualizador HTML](visualizador-html.html)