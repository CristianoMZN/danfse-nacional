# Supressões e Modificações Permitidas (NT 008, item 2.3)

**Regra geral:** só é permitido suprimir os blocos e nos casos listados abaixo. Qualquer outra
supressão (ex.: tirar o bloco de Serviço Prestado, ou de Valor Total, ou de Tributação Federal)
**não é permitida** e pode causar rejeição do documento. Ao suprimir um bloco, você **deve**
substituir seu conteúdo pelo texto fixo exato indicado (não parafrasear, não abreviar).

## 1. Bloco "Tomador/Adquirente da Operação" (item 2.3.1)

Se não houver dados de Tomador/Adquirente no XML (ou não se aplicar à operação):

- Substituir os campos do bloco pelo texto único:
  ```
  TOMADOR/ADQUIRENTE DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
  ```
- Altura mínima do bloco: 0,32cm; largura mínima: 20,40cm.
- Redistribuir (aumentar) a altura do bloco "Descrição do Serviço" e/ou "Informações
  Complementares" no mesmo valor da redução obtida.
- Ajustar as coordenadas (X/Y) dos blocos seguintes conforme necessário.

## 2. Bloco "Destinatário da Operação" (item 2.3.1)

Se não houver dados de Destinatário no XML (ou não se aplicar):

- Substituir pelo texto único:
  ```
  DESTINATÁRIO DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
  ```
- Mesmas regras de altura mínima (0,32cm) / largura mínima (20,40cm) e redistribuição de espaço.

### 2b. Caso especial: Destinatário é o próprio Tomador/Adquirente (item 2.3.2)

Se o destinatário da operação for o próprio tomador/adquirente:

- Substituir o bloco "Destinatário da Operação" pelo texto único:
  ```
  O DESTINATÁRIO É O PRÓPRIO TOMADOR/ADQUIRENTE DA OPERAÇÃO
  ```
- Mesmas regras de altura mínima/largura mínima e redistribuição do espaço liberado para
  "Descrição do Serviço" e/ou "Informações Complementares".
- **Não confundir** esta supressão (texto "é o próprio tomador") com a supressão do item 1 acima
  (texto "não identificado") — use o texto correto para cada situação.

## 3. Bloco "Intermediário da Operação" (item 2.3.1)

Se não houver dados de Intermediário no XML (ou não se aplicar):

- Substituir pelo texto único:
  ```
  INTERMEDIÁRIO DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
  ```
  (Atenção: a NT grafa também como "INTERMEDIÁRO" em um trecho — use a grafia correta
  "INTERMEDIÁRIO".)
- Mesmas regras de altura mínima/largura mínima e redistribuição de espaço.

## 4. Bloco "Tributação Municipal (ISSQN)" (item 2.3.1)

Para operações às quais **não haja incidência de ISSQN**:

- Substituir todo o bloco pelo texto único:
  ```
  TRIBUTAÇÃO MUNICIPAL (ISSQN) - OPERAÇÃO NÃO SUJEITA AO ISSQN
  ```
- Altura mínima do bloco: 0,32cm; largura mínima: 20,40cm.
- Redistribuir o espaço liberado e ajustar coordenadas dos blocos seguintes.

## 5. Bloco de Canhoto (item 2.3.3)

- O Canhoto é **opcional**. Se o emitente optar por não utilizá-lo:
  - Suprimir todos os campos do bloco de Canhoto.
  - Aumentar o bloco "Descrição do Serviço" e/ou "Informações Complementares" pelo mesmo valor da
    supressão, deslocando os campos seguintes para baixo.

## 6. Linhas individuais suprimíveis independentemente de bloco (Notas 1 e 5 da tabela de campos)

- **Nota 1** — a linha de "Endereço"/"Email" (em qualquer bloco de pessoa: Prestador, Tomador,
  Destinatário, Intermediário) **pode ser suprimida mesmo havendo dados no XML** para esses campos
  especificamente. É a única supressão de linha permitida mesmo com dado presente.
- **Nota 5** — linhas de blocos de tributação (ex.: Regime Especial/Imunidade/Suspensão/Benefício
  Municipal, deduções) podem ser suprimidas **somente se não existirem dados em nenhum campo da
  mesma linha** no XML. Não suprimir se pelo menos um campo da linha tiver dado.

## O que NUNCA suprimir

- Cabeçalho (logomarca, "DANFSe v2.0", identificação de município/ambiente, QR Code).
- Bloco "Dados da NFS-e" (identificação do documento).
- Bloco "Prestador/Fornecedor".
- Bloco "Serviço Prestado".
- Bloco "Tributação Federal (Exceto CBS)".
- Bloco "Tributação IBS/CBS".
- Bloco "Valor Total da NFS-e".
- O aviso "NFS-e SEM VALIDADE JURÍDICA" quando tpAmb = 2.
- O texto obrigatório de "Totais Aproximados dos Tributos" em Informações Complementares.
- O QR Code e seu texto de rodapé de autenticidade.

## Checklist rápido de supressão

Antes de aplicar qualquer supressão, confirme:

1. O bloco/linha está na lista permitida acima?
2. A condição (dados ausentes / não aplicável / destinatário=tomador / sem incidência ISSQN /
   canhoto não usado) realmente se verifica no XML?
3. O texto de substituição é **exatamente** o texto fixo definido (sem parafrasear)?
4. O espaço liberado foi redistribuído para Descrição do Serviço e/ou Informações Complementares,
   e os blocos seguintes foram deslocados corretamente?
5. A altura/largura mínima do bloco suprimido (0,32cm / 20,40cm, quando aplicável) foi respeitada?
