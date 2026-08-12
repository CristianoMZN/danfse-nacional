---
layout: default
title: Instalação
nav_order: 2
permalink: /instalacao.html
---

# Instalação e requisitos

## Requisitos

- **PHP 8.1** ou superior
- Extensões PHP habilitadas:
  - `simplexml`
  - `mbstring`
  - `fileinfo`
- Composer

## Instalação via Composer

```bash
composer require cristianomzn/danfse-nacional
```

A biblioteca traz como dependências diretas:

- [`dompdf/dompdf`](https://github.com/dompdf/dompdf) — renderização HTML → PDF.
- [`cuyz/valinor`](https://github.com/CuyZ/Valinor) — mapeamento seguro do array XML para os DTOs tipados.
- [`bacon/bacon-qr-code`](https://github.com/Bacon/BaconQrCode) — geração do QR Code de consulta pública.

Nenhuma dessas dependências acopla a biblioteca a um framework específico.

## Verificando a instalação

```bash
composer show cristianomzn/danfse-nacional
```

A saída deve listar o pacote, a versão instalada e a relação de dependências resolvidas.

## Próximos passos

- [Uso rápido — gerar o primeiro PDF](uso-rapido.html)