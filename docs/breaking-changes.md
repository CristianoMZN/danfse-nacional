---
layout: default
title: Breaking changes
nav_order: 10
permalink: /breaking-changes.html
---

# Breaking changes entre versões

Mudanças incompatíveis com versões anteriores, com guia de migração.

## 2.0.0

### `DanfseNacional\Dto\TribMunicipal::$tipoImunidade` → `$tpImunidade`

A propriedade foi renomeada para casar com o nome XML oficial (`.../tribMun/tpImunidade`, NT 008 §2.4.5).

```php
// Antes (1.x)
$imunidade = $tribMun->tipoImunidade;

// Depois (2.0.0)
$imunidade = $tribMun->tpImunidade;
```

O valor era descartado silenciosamente antes da correção (a chave XML não casava com o nome da propriedade, e `allowSuperfluousKeys` ignorava). Nenhum consumidor estava acoplado ao nome antigo em condições normais.

NFS-e com `tpImunidade` informado agora passam a renderizar corretamente o rótulo "Tipo de Imunidade do ISSQN" no bloco 7.

### Remoção da tentativa de customização da logo NFS-e

A logo NFS-e passou a ser parte fixa e obrigatória do DANFSe, embutida em `DanfseNacional\Config\DefaultLogo::DATA_URI`. Tentativas anteriores via `DanfseConfig` (1.x) deixam de compilar em 2.0.0 — o consumidor **não pode** substituí-la nem desativá-la.

O único logo configurável continua sendo o do **ente emitente** (empresa ou brasão), via `MunicipalityBranding::logoDataUri` ou `::logoPath`.

## Próximos passos

- [Conformidade com NT 008/2026 e NT 009/2026](conformidade.html)
- [Customização — logos, `DanfseConfig`, `MunicipalityBranding`, canhoto](customizacao.html)