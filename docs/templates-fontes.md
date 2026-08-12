---
layout: default
title: Templates e fontes
nav_order: 9
permalink: /templates-fontes.html
---

# Templates, fontes e limites normativos

Os tamanhos de fonte, cores, espessuras de linha e sombreamentos do template seguem os **mínimos normativos** da NT 008/2026 §2.4 e são fixados em `pt` no `<style>` de `src/Template/danfse.php`. **Não reduza esses valores** — usar uma fonte menor que os mínimos descaracteriza o layout do Anexo I e pode causar rejeição do documento.

## Tamanhos mínimos (NT 008 §2.4)

| Elemento                  | Mínimo |
| ------------------------- | ------ |
| Cabeçalho                 | 9 pt   |
| Município                 | 8 pt   |
| Conteúdo                  | 7 pt   |
| Labels e rodapé do QR     | 6 pt   |

Ampliar tamanhos é permitido desde que o modelo/ordem dos blocos seja preservado.

## Fontes proprietárias e equivalentes métricos

A NT 008/2026 §2.4 exige **Arial** (títulos/labels) e **Microsoft Sans Serif** (conteúdo). Ambas são proprietárias. Para garantir renderização em qualquer ambiente PHP/Docker sem dependência de fontes instaladas no SO, a biblioteca distribui:

- `src/Template/fonts/LiberationSans-{Regular,Bold,Italic,BoldItalic}.ttf`
  (equivalente métrico do Arial) — registrado automaticamente no Dompdf via
  `DanfseGenerator::registerFonts()` e usado como `defaultFont 'liberationsans'`.
- **DejaVu Sans** (embutido no Dompdf) registrado como `microsoftsansserif`,
  equivalente do Microsoft Sans Serif.

Se precisar trocar a família tipográfica por uma terceira, **ela deve continuar métrico-compatível com Arial / MS Sans Serif** e a mudança deve ser documentada no README e aqui.

## Layout flexível (NT 008 §2.1)

A NT 008 explicita que os tamanhos em cm descritos na tabela 2.4.5 **não são obrigatórios**, mas o modelo do Anexo I é. A lib usa flexbox/table com larguras aproximadas equivalentes à tabela, garantindo o modelo/ordem normativo. Se o consumidor quiser posicionamento absoluto em cm, basta editar o CSS em `src/Template/danfse.php` (lembrando que `1cm = 28,3465pt`).

## Limites de caracteres por seção

Truncamentos aplicados conforme tabela 2.4.5, preservando reticências quando o conteúdo estoura:

- Nome, Endereço, Descrição do Serviço, Situação, Finalidade — truncamento com reticências.
- "Emitente" ≤ 13 caracteres.
- Informações Complementares — truncamento em 1997 chars preservando a linha final obrigatória `Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012`.

## Próximos passos

- [Conformidade com NT 008/2026 e NT 009/2026]({{ '/conformidade.html' | relative_url }})
- [Visualizador HTML]({{ '/visualizador-html.html' | relative_url }})