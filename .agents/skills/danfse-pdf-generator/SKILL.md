---
name: danfse-pdf-generator
description: Use whenever generating, rendering, printing, validating, or reviewing a DANFSe (Documento Auxiliar da NFS-e), the auxiliary PDF/printed representation of Brazil's NFS-e (Nota Fiscal de Servico Eletronica). Trigger for any task touching "DANFSe", "DANFSe v2.0", exporting an NFS-e to PDF, building an NFS-e/ERP module that emits this document, or reviewing an existing DANFSe generator's layout - even if the user just says "gerar o PDF da nota" or "imprimir a NFS-e". Encodes the mandatory layout, field positions/sizes, fonts, colors, QR Code spec, and suppression rules from Nota Tecnica no 008 (05/05/2026) plus field-mapping impacts of Nota Tecnica no 009 (04/06/2026, Reforma Tributaria/IBS-CBS). Non-compliant layouts can be rejected and trigger tax penalties for client and vendor - always consult these references before writing/approving DANFSe code and run the validation checklist before delivering.
---

# Gerador de DANFSe (Documento Auxiliar da NFS-e) — v2.0

## Por que isso importa (leia antes de codar)

O DANFSe **não é um documento de layout livre**. Ele é regulado pela Nota Técnica nº 008/2026
(SE/CGNFS-e) e deve seguir **obrigatoriamente** o modelo do Anexo I, com campos, posições,
tamanhos, fontes e cores fixados na especificação. Um DANFSe gerado fora do padrão pode ser
**rejeitado pela administração tributária / RFB**, e isso pode gerar **multas** para quem emitiu o
documento e para quem desenvolveu o software. Portanto:

- **Nunca "invente" layout, posição, fonte ou tamanho.** Use sempre os valores em
  `references/field_specification.md` (tabela oficial de tamanhos e posições — item 2.4.5 da NT 008).
- **Nunca omita um campo obrigatório** nem imprima algo que não exista na tag XML correspondente
  da NFS-e (a NT proíbe isso explicitamente).
- **Sempre rode o checklist** em `references/validation_checklist.md` antes de considerar o
  trabalho concluído.
- Se o pedido do usuário conflitar com a norma (ex.: "tira essa margem", "diminui a fonte do
  cabeçalho para caber mais"), avise que isso pode gerar rejeição/multa e explique a regra antes de
  prosseguir — não implemente silenciosamente uma violação.

## Como este skill está organizado

```
danfse-pdf-generator/
├── SKILL.md                          (este arquivo — fluxo de trabalho e regras-chave)
└── references/
    ├── field_specification.md        (tabela oficial: bloco/campo/caminho XML/tamanho/posição)
    ├── layout_rules.md                (papel, margens, fontes, cores, cabeçalho, QR Code, marca d'água)
    ├── suppression_rules.md           (o que pode ser omitido e como, com textos exatos)
    └── nt009_reform_updates.md        (impacto da Reforma Tributária/IBS-CBS nos campos e caminhos XML)
```

Leia os arquivos de referência conforme a etapa abaixo — não é preciso carregar todos de uma vez.

## Fluxo de trabalho recomendado

1. **Entenda a origem dos dados.** O DANFSe é sempre derivado do XML da NFS-e já autorizada
   (tags `NFSe/infNFSe/...`). Nunca gere um campo cujo valor não exista no XML. Se estiver
   escrevendo código que recebe um XML de NFS-e e produz o PDF, mapeie cada campo do PDF ao
   `Caminho no XML` exato listado em `references/field_specification.md`.

2. **Verifique se o XML segue o layout pós-Reforma (NT 009).** A partir de julho/2026 novos campos
   (IBS/CBS, Simples Nacional, locação de imóveis/bens móveis, CNPJ alfanumérico etc.) alteram
   caminhos e nomes de campos usados no DANFSe. Consulte
   `references/nt009_reform_updates.md` para saber qual nome/caminho usar em cada caso e quais
   campos antigos foram renomeados/descontinuados. Usar o nome antigo de campo (ex.:
   `vCalcDR`, `vCalcReeRepRes`, `gDedRedIBSCBS`) é um erro de conformidade.

3. **Monte o layout seguindo `references/layout_rules.md`:**
   - Página única, retrato, papel mínimo A4 (210×297mm), qualquer papel exceto jornal.
   - Margens: mínimo 0,15cm / máximo 0,20cm em todos os lados.
   - Fontes: **Arial** para títulos/labels, **Microsoft Sans Serif** para conteúdo, sempre preto
     sólido (K100), espaçamento normal. Não substitua por fontes "parecidas" sem verificar
     disponibilidade — se Arial/MS Sans Serif não estiverem disponíveis no ambiente de renderização,
     avise o usuário (não troque silenciosamente por Helvetica/Calibri etc., pois altera a métrica e
     pode estourar os tamanhos de campo especificados).
   - Sombreamento cinza claro (5%) no cabeçalho, títulos de bloco, e nos campos "Emitente da NFS-e"
     e "Valor Líquido da NFS-e + IBS/CBS"; fundo branco nos demais.
   - Linhas divisórias com 0,5pt; borda da página com 1pt.
   - Cabeçalho com logomarca oficial da NFS-e, texto "DANFSe v2.0" / "Documento Auxiliar da NFS-e",
     identificação do município do emitente, ambiente gerador e tipo de ambiente.
   - QR Code obrigatório apontando para
     `https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=<chave de acesso>`, dimensão mínima
     1,52×1,52cm, posição fixa (X:17,48cm / Y:1,67cm), com o texto de rodapé de 3 linhas
     explicando a autenticação.
   - Se `tpAmb = 2` (Homologação): incluir, em vermelho, negrito, 9pt, Arial, abaixo do título do
     cabeçalho, o texto **"NFS-e SEM VALIDADE JURÍDICA"**.
   - Se a NFS-e foi cancelada ou substituída: aplicar marca d'água diagonal cinza (K35), Arial,
     mínimo 50pt, com o texto **"CANCELADA"** ou **"SUBSTITUÍDA"** (ver `layout_rules.md`).

4. **Posicione cada campo com precisão de centímetros** usando a tabela de
   `field_specification.md` (altura, largura, posição X/Y em relação à margem, tamanho máximo em
   caracteres, e formato de concatenação quando aplicável — ex. `Município / UF`,
   `nn.nnn.nnn/nnnn-nn`). Onde a tabela indica "preencher com reticências (...)" ao exceder o
   limite de caracteres, implemente o truncamento — não deixe o texto estourar a caixa nem quebre a
   regra de "leitura clara" de forma que corte informação sem indicar reticências.

5. **Aplique as supressões apenas conforme permitido**, com o texto substituto **exato** definido
   na norma (ver `references/suppression_rules.md`). Nunca suprima um bloco só porque "está vazio
   por bug" — suprimir é uma opção de formatação válida somente para os blocos e condições
   explicitamente previstos (Tomador/Adquirente, Destinatário da Operação, Intermediário da
   Operação, Tributação Municipal ISSQN, e o bloco de Canhoto).

6. **Gere o PDF.** Para a implementação em si (biblioteca de PDF, posicionamento absoluto em cm,
   fontes embutidas, geração de QR Code), consulte também a skill `pdf` deste ambiente para boas
   práticas de criação/edição de PDF. Prefira posicionamento absoluto (coordenadas em cm convertidas
   para pontos: 1cm = 28.3465pt) em vez de fluxo automático de texto, pois a norma especifica
   coordenadas fixas.

7. **Valide antes de entregar.** Rode o checklist completo em
   `references/validation_checklist.md`. Se qualquer item falhar, corrija antes de apresentar o
   resultado — não entregue um DANFSe "quase conforme" sem avisar explicitamente quais pontos
   ficaram fora do padrão e por quê.

## Regras que mais causam rejeição (resumo rápido)

- Campo exibindo dado que não está na tag XML correspondente → **proibido**.
- Modelo diferente do Anexo I (ordem/posição de blocos alterada sem ser uma supressão permitida)
  → **proibido**.
- Ausência do QR Code, ou QR Code com URL/chave errada, ou fora das dimensões mínimas.
- Ausência do aviso "NFS-e SEM VALIDADE JURÍDICA" em homologação.
- Impressão em mais de uma página (o DANFSe deve caber em uma única página).
- Uso de papel jornal, ou contraste insuficiente para leitura do QR Code.
- Fonte/tamanho abaixo do mínimo normativo (7pt conteúdo geral, 6pt labels de campo, 7pt labels de
  identificação, 7pt bloco cabeçalho de identificação/QR, 9pt título do cabeçalho).
- Uso de nomes de campo/caminho XML desatualizados após a Reforma Tributária (ver NT 009) —
  isso indica que o mapeamento de dados está errado, não apenas a exibição.
- CNPJ tratado como campo puramente numérico quando, a partir de julho/2026, o CNPJ é
  alfanumérico (tipo caractere "C").

Quando em dúvida sobre um campo específico, **não estime** — abra
`references/field_specification.md` e confirme o valor exato antes de escrever código ou responder
ao usuário.
