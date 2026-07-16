# Checklist de Validação Final do DANFSe

Rode este checklist **antes** de considerar a geração do PDF concluída ou de entregar código de
geração como pronto. Marque item a item; qualquer "não" deve ser corrigido antes da entrega.

## Estrutura e página

- [ ] O documento tem **exatamente 1 página**.
- [ ] Formato retrato, papel mínimo A4 (210×297mm), não é papel jornal.
- [ ] Margens entre 0,15cm e 0,20cm em todos os lados.
- [ ] Borda da página com 1pt; linhas divisórias dos blocos com 0,5pt.
- [ ] A ordem e disposição dos blocos segue o Anexo I (nenhum bloco reordenado fora das supressões
      permitidas).

## Cabeçalho

- [ ] Logomarca oficial da NFS-e presente no canto esquerdo.
- [ ] Texto "DANFSe v2.0" e "Documento Auxiliar da NFS-e" centralizados, negrito, 9pt, Arial.
- [ ] Município do emitente, ambiente gerador e tipo de ambiente no canto direito, com os tamanhos
      corretos (8pt / 6pt / 6pt).
- [ ] Se `tpAmb = 2` (homologação): aviso **"NFS-e SEM VALIDADE JURÍDICA"** presente, vermelho,
      negrito, 9pt, Arial, na posição correta.
- [ ] Se `tpAmb = 1` (produção): aviso de homologação **ausente** (não deve aparecer em produção).

## QR Code

- [ ] URL exata: `https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=<chave de acesso correta>`.
- [ ] Dimensão mínima 1,52×1,52cm.
- [ ] Posição X:17,48cm / Y:1,67cm (ou equivalente ao Anexo I).
- [ ] Texto de rodapé de autenticidade (3 linhas, 6pt) presente e com o texto oficial.
- [ ] QR Code testado/decodificado com sucesso (não apenas "parece" um QR Code — decodifique
      programaticamente antes de aceitar o PDF como válido).

## Campos e dados

- [ ] Todos os campos exibidos existem de fato na tag XML correspondente (nenhum dado inventado,
      nenhum "placeholder" deixado no PDF final).
- [ ] Campos ausentes no XML foram preenchidos com "-" (Nota 12), e não deixados em branco nem
      omitidos silenciosamente (exceto supressões de bloco permitidas).
- [ ] Concatenações seguem o formato exato da tabela (`Município / UF`, `nn.nnn.nnn/nnnn-nn`,
      `DD/MM/AAAA hh:mm:ss` etc. — ver `field_specification.md`).
- [ ] Truncamento com reticências "..." aplicado corretamente onde o conteúdo excede o tamanho
      máximo de caracteres da tabela (Nome, Endereço, Descrição do Serviço, Situação, Finalidade
      etc.) — sem cortar informação sem indicar reticências.
- [ ] Chave de Acesso impressa em bloco único de 50 dígitos, sem o prefixo "NFS".
- [ ] Campo CNPJ tratado como alfanumérico (tipo caractere) — não valida/formata assumindo apenas
      dígitos (regra NT 009).
- [ ] Fórmulas de base de cálculo (ISSQN e IBS/CBS) recalculadas/conferidas conforme a versão de
      leiaute (NT 008 vs. NT 009) e a competência da NFS-e (antes/depois de 2027 para PIS/COFINS
      na BC do IBS/CBS).
- [ ] "Totais Aproximados dos Tributos" (Lei nº 12.741/2012) presente em Informações
      Complementares, no formato oficial, com R$ ou %.
- [ ] Ordem dos campos dentro de "Informações Complementares" respeitada (`Inf. Cont.:`, `NFS-e
      Subst.:`, `Doc. Ref.:`, `Cod. Obra:`/`Insc. Imob.:`, `Cod. Evt.:`, `Doc. Tec.:`, `Núm.
      Ped.:`, `Item Ped.:`, `Inf. A. T. Mun.:`, Totais Aproximados) e separada por pipes `|`.

## Fontes e cores

- [ ] Títulos/labels em Arial; conteúdo em Microsoft Sans Serif (ou aviso explícito ao usuário se a
      fonte exata não estiver disponível no ambiente, com decisão registrada — nunca substituir
      silenciosamente).
- [ ] Tamanhos mínimos respeitados (7pt conteúdo geral / 6pt labels de campo / 7pt labels de
      identificação / 9pt título do cabeçalho / 6pt textos de rodapé).
- [ ] Sombreamento cinza claro (5%) presente no cabeçalho, títulos de bloco, campo "Emitente da
      NFS-e" e campo "Valor Líquido da NFS-e + IBS/CBS"; fundo branco nos demais campos.
- [ ] Cor preto sólido (K100) em todo texto normal.

## Supressões (se aplicadas)

- [ ] Cada supressão aplicada está na lista permitida (`suppression_rules.md`).
- [ ] O texto de substituição é **exatamente** o texto fixo oficial (conferir grafia, sem
      parafrasear).
- [ ] Nenhum bloco obrigatório (Prestador, Serviço Prestado, Tributação Federal, Tributação
      IBS/CBS, Valor Total) foi indevidamente suprimido.
- [ ] Espaço liberado por supressão foi redistribuído corretamente (Descrição do Serviço e/ou
      Informações Complementares, deslocando blocos seguintes).

## Casos especiais

- [ ] Se a NFS-e está **cancelada**: marca d'água diagonal "CANCELADA", Arial, mínimo 50pt, cinza
      K35, presente.
- [ ] Se a NFS-e está **substituída**: marca d'água diagonal "SUBSTITUÍDA" (mesmas specs) presente
      **e** a chave da NFS-e substituída consta em Informações Complementares (`NFS-e Subst.:`).
- [ ] Se é NFS-e de ajuste de crédito/débito (NT 009, `finNFSe` 1 ou 2): campo "Finalidade" reflete
      a descrição correta do novo domínio.

## Sanidade final

- [ ] O PDF renderiza corretamente em pelo menos um leitor de PDF padrão (sem erros de fonte
      ausente, sem texto sobreposto/cortado, sem elementos fora da página).
- [ ] Nenhuma informação foi impressa que não decorra do XML da NFS-e (ex.: nada de campos
      "inventados" para preencher espaço).
- [ ] Se qualquer item deste checklist não pôde ser garantido (ex.: falta um dado no XML de teste,
      fonte não disponível no ambiente), isso foi **comunicado explicitamente ao usuário**, e não
      apenas ignorado silenciosamente.

> Lembrete: um DANFSe fora do padrão pode ser **rejeitado** e resultar em **multa** tanto para
> quem emite quanto para quem desenvolveu o software. Quando em dúvida sobre qualquer regra,
> volte a `field_specification.md`, `layout_rules.md`, `suppression_rules.md` ou
> `nt009_reform_updates.md` antes de assumir um comportamento.
