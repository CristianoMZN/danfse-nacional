---
layout: default
title: Conformidade NT 008/2026 e NT 009/2026
nav_order: 4
permalink: /conformidade.html
---

# Conformidade com NT 008/2026 e NT 009/2026

A biblioteca segue o modelo do **Anexo I da NT 008/2026** (SE/CGNFS-e) e absorve as renomeações e novos campos introduzidos pela **NT 009/2026** (Reforma Tributária — IBS/CBS).

## Layout do DANFSe

- Impressão em página única, A4 retrato, margens 0,15–0,20 cm.
- Fontes: Arial para títulos/labels e Microsoft Sans Serif para conteúdo, com os tamanhos mínimos da norma (9pt cabeçalho, 8pt município, 7pt conteúdo, 6pt labels e rodapé do QR). Arial e Microsoft Sans Serif são proprietárias; a biblioteca distribui [Liberation Sans e DejaVu Sans]({{ '/templates-fontes.html' | relative_url }}) como equivalentes métricos.
- Sombreamento cinza K5 (~`#F2F2F2`) no cabeçalho, títulos de bloco e nos campos "Emitente da NFS-e" e "Valor Líquido da NFS-e + IBS/CBS".
- Linhas divisórias 0,5 pt; borda da página 1 pt.
- QR Code de consulta pública apontando para
  `https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=<chave>` com o texto de autenticidade abaixo.
- Rejeição automática (via `RuntimeException`) se o conteúdo estourar 1 página.

## Modelo flexível (NT 008 §2.1 / §2.4.5)

O item 2.1 da NT 008 explicita que os tamanhos descritos em 2.4.5 (X/Y em cm) **não são obrigatórios**, mas o **modelo do Anexo I é obrigatório** (ordem/disposição dos blocos). A lib usa flexbox/table com larguras aproximadas equivalentes à tabela 2.4.5, garantindo o modelo/ordem normativo.

Se o consumidor quiser posicionamento absoluto em cm, basta editar o CSS em `src/Template/danfse.php` (lembrando que `1cm = 28,3465pt`).

## Supressões e campos vazios

- **Bloco Tributação IBS/CBS condicional:** suprimido automaticamente quando o XML não traz o grupo `IBSCBS` (NFS-e v1.0 sem reforma tributária).
- **Campos vazios preenchidos com `-`** (Nota 12 da NT 008) — nunca em branco nem omitidos.
- **Tamanhos e concatenações conforme tabela 2.4.5:** "Local da Prestação / Sigla UF / País", "Município/UF/País de Incidência do ISSQN", "Emitente" (≤ 13 chars), truncamento com reticências em Nome/Endereço/Descrição do Serviço/Situação/Finalidade.
- **Ordem oficial em Informações Complementares** (Nota 12): `Inf. Cont.:`, `NFS-e Subst.:`, `Doc. Ref.:`, `Cod. Obra:` / `Insc. Imob.:`, `Cod. Evt.:`, `Inf. A. T. Mun.:`, e a linha obrigatória `Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012`. Truncamento em 1997 chars preservando a linha final.

## Marca d'água e situação da NFS-e

- **Homologação** (`tpAmb = 2`): cabeçalho exibe o aviso obrigatório "NFS-e SEM VALIDADE JURÍDICA" (Arial, 9pt, negrito, vermelho) — NT 008 §2.4.3.
- **Cancelada / Substituída** (`cStat = 101` ou `102`): marca d'água diagonal obrigatória "CANCELADA" / "SUBSTITUÍDA" (Arial, 50pt+, cinza K35) — NT 008 §2.5.
- A "Situação da NFS-e" é lida a partir de `NFSe/infNFSe/cStat` (não `tpEmis`).
- O rótulo "Emitente da NFS-e" reflete o `tpEmit` da DPS (Prestador / Tomador & Intermediário), evitando informação divergente da tag XML correspondente.

## Texto de "Totais Aproximados dos Tributos"

Texto fixo exigido pela NT 008 Nota 10:

```
Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012: Federais: R$ X ; Estaduais: R$ Y ; Municipais: R$ Z
```

## NT 009/2026 — Reforma Tributária (IBS/CBS)

Renomeações aplicadas nos DTOs:

- `vCalcAjusteBCIBSCBS`
- `vCalcAjusteBCISSQN`
- `vCalcAjusteBCLocImoveis`
- `gAjusteBCLocImoveis`

Campos novos (`regApIBSCBSSN`, `indFinal`, `gPgtoVinc`) ficam disponíveis via DTO, mas não são impressos por não terem posição fixa no Anexo I.

### Compatibilidade de versões

A biblioteca lida com o **XML NFS-e v1.01** (única versão de XML existente) e renderiza o DANFSe em dois layouts:

| Layout do DANFSe | Norma Técnica                                          | Status     |
| --------------- | ------------------------------------------------------ | ---------- |
| v1.0            | Padrão original, sem bloco IBS/CBS                     | Suportado  |
| v2.0            | NT 008/2026, com seção IBS/CBS quando o XML traz o bloco | Suportado |

O XML v1.01 pode ou não trazer o grupo `IBSCBS`. Quando presente, a biblioteca preenche automaticamente a seção de tributação IBS/CBS do DANFSe. **A escolha do layout é feita pelo conteúdo do XML, não pela versão dele.**

## Próximos passos

- [Templates, fontes e limites normativos]({{ '/templates-fontes.html' | relative_url }})
- [Breaking changes entre versões]({{ '/breaking-changes.html' | relative_url }})