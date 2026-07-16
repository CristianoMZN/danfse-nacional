# Regras de Layout, Fontes, Cores, Cabeçalho, QR Code e Marca d'Água

Fonte: NT nº 008/2026 (SE/CGNFS-e), itens 2.2, 2.4, 2.5.

## Papel e página (item 2.2)

- Qualquer tipo de papel **exceto papel jornal**, desde que garanta contraste suficiente para
  leitura do QR Code.
- **Impressão obrigatória em página única.** Nunca gerar um DANFSe com mais de 1 página — se o
  conteúdo (ex.: Descrição do Serviço ou Informações Complementares) for muito extenso, truncar com
  reticências "..." conforme os limites de caracteres da tabela em `field_specification.md`, nunca
  quebrar para uma segunda página.
- Modo retrato, formulário de tamanho **mínimo A4 (210 x 297mm)**.
- Margens entre o corpo impresso e o final do formulário: **mínimo 0,15cm, máximo 0,20cm**, em
  todas as laterais (inclusive superior e inferior).
- Linhas divisórias dos blocos: **0,5pt** de espessura.
- Borda da página: **1pt** de espessura.

## Sombreamento (fundo)

- Fundo **cinza claro, 5% de densidade (K5)** obrigatório em:
  - Cabeçalho;
  - Título de cada bloco de campos;
  - Campo "Emitente da NFS-e";
  - Campo "Valor Líquido da NFS-e + IBS/CBS".
- Fundo **branco (0% de densidade)** em todos os demais campos/dados.

## Fontes (item 2.4)

- **Títulos/labels**: fonte **Arial**.
- **Conteúdo dos campos**: fonte **Microsoft Sans Serif**.
- Cor: **preto sólido (K100)** em todo o documento (exceto o aviso de homologação, que é vermelho —
  ver abaixo — e a marca d'água de cancelamento/substituição, que é cinza K35).
- Espaçamento: normal (sem tracking customizado).
- **Tamanhos mínimos:**
  | Elemento | Tamanho | Estilo |
  |---|---|---|
  | Título (label) de bloco de campos | 7pt | Negrito, CAIXA ALTA |
  | Título (label) de campo comum | 6pt | Negrito, primeira letra maiúscula (demais minúsculas) |
  | Título (label) dos campos do bloco "Dados de Identificação da NFS-e" (item 2.1.2) | 7pt | Negrito, CAIXA ALTA |
  | Conteúdo dos campos de identificação do documento | 7pt | Normal |
  | Conteúdo dos campos dos demais blocos | 7pt | Normal |
  | Título "DANFSe v2.0" / "Documento Auxiliar da NFS-e" (cabeçalho) | 9pt | Negrito, Arial |
  | Identificação do município do emitente (cabeçalho, canto direito) | 8pt | Normal, Microsoft Sans Serif |
  | Ambiente gerador / tipo de ambiente (cabeçalho, canto direito) | 6pt | Normal, Microsoft Sans Serif |
  | Texto de rodapé do QR Code (3 linhas) | 6pt | Normal, Microsoft Sans Serif |
  | Aviso "NFS-e SEM VALIDADE JURÍDICA" | 9pt | Negrito, Arial, **vermelho sólido (M100/Y100)** |
  | Marca d'água CANCELADA/SUBSTITUÍDA | mínimo 50pt | Normal, Arial, **cinza (K35)**, disposta na diagonal |

  **Nunca use tamanho de fonte abaixo destes mínimos.** É permitido usar tamanho maior se o layout
  do Anexo I e as posições relativas dos blocos forem respeitados.

## Cabeçalho (item 2.4.3)

O cabeçalho deve conter, obrigatoriamente:

1. **Canto esquerdo**: logomarca oficial da NFS-e (usar exatamente a imagem oficial):
   `https://www.gov.br/nfse/pt-br/biblioteca/documentacao-tecnica/logos-da-nfs-e/Logo%20-%20NFS-e%20-%20Horizontal.png/view`
2. **Ao centro**: texto "DANFSe v2.0" e, logo abaixo, "Documento Auxiliar da NFS-e" — negrito,
   9pt, Arial, centralizado no quadro.
3. **Canto direito**: nome do município do emitente (8pt, normal), ambiente gerador e tipo de
   ambiente do Sistema Nacional NFS-e (6pt, normal) — todos em Microsoft Sans Serif.
4. **À direita dos campos de identificação**: QR Code (código de barras bidimensional) apontando
   para consulta rápida.
5. Abaixo do QR Code: texto complementar fixo de 3 linhas, 6pt, Microsoft Sans Serif:
   > "A autenticidade desta NFS-e pode ser verificada pela leitura deste código QR ou pela
   > consulta da chave de acesso no portal nacional da NFS-e"

### Aviso obrigatório de homologação (tpAmb = 2)

Quando a NFS-e foi gerada em **ambiente de produção restrita / homologação**
(`NFSe/infNFSe/DPS/infDPS/` → `tpAmb = 2`), é **obrigatório** incluir, abaixo do título "Documento
Auxiliar da NFS-e", o texto:

```
NFS-e SEM VALIDADE JURÍDICA
```

- Negrito, 9pt, fonte Arial, **vermelho sólido (M100/Y100)**.
- **Nunca omitir este aviso quando tpAmb = 2** — isso descaracteriza o documento como sendo de
  teste e pode induzir o destinatário a tratar um documento sem validade jurídica como válido.

## QR Code (item 2.4.3)

- URL obrigatória (adicionar a chave de acesso da NFS-e após o `=`):
  ```
  https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=<CHAVE_DE_ACESSO>
  ```
- Dimensão **mínima**: 1,52cm × 1,52cm.
- Posição (coordenadas X/Y a partir da margem): **X: 17,48cm, Y: 1,67cm**.
- Deve permanecer legível: garantir contraste adequado impresso (não usar papel/fundo que
  comprometa a leitura).

## Marca d'água (item 2.5)

### Cancelamento da NFS-e (2.5.1)
Quando a NFS-e estiver **cancelada**, incluir marca d'água na diagonal com o texto:
```
CANCELADA
```
- Formato normal, tamanho **mínimo 50pt**, fonte **Arial**, cor **cinza (K35)**.

### Substituição da NFS-e (2.5.2)
Quando a NFS-e tiver sido **substituída**, incluir marca d'água na diagonal com o texto:
```
SUBSTITUÍDA
```
- Mesmas especificações de formato/tamanho/fonte/cor do cancelamento.
- Além disso, em Informações Complementares deve constar `NFS-e Subst.: <chave da NFS-e
  substituída>` (Nota 7 da tabela de campos).

## Limitações de impressora (item 2.5.3)

Se for necessária margem superior/inferior maior por limitação da impressora, a **única** redução
permitida é na altura do bloco "Informações Complementares", deslocando os campos seguintes
(Canhoto) para baixo pelo mesmo valor da redução. Não reduzir nenhum outro bloco por esse motivo.

## Modelo obrigatório (item 2.2.4)

O DANFSe deve seguir o **modelo do Anexo I** da NT 008 (ordem e disposição de blocos: Cabeçalho →
Dados da NFS-e → Prestador/Fornecedor → Tomador/Adquirente → Destinatário da Operação →
Intermediário da Operação → Serviço Prestado → Tributação Municipal (ISSQN) → Tributação Federal
(exceto CBS) → Tributação IBS/CBS → Valor Total da NFS-e → Informações Complementares → Canhoto).
Não reordenar blocos. As únicas variações permitidas são as supressões descritas em
`suppression_rules.md`.
