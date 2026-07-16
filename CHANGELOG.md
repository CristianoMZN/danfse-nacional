# Changelog

Todas as mudanças notáveis neste projeto serão documentadas aqui.

## [2.0.1] - 2026-07-16

### Adicionado
- Bloco de canhoto agora é **opcional** via `DanfseConfig::mostrarCanhoto`
  (NT 008 §2.3.3, Nota 11). Quando desligado, o espaço é redistribuído para
  "Descrição do Serviço" / "Informações Complementares" pelo CSS existente
  (`flex-grow: 1` da última `bordered-section`).
- Marca d'água diagonal "CANCELADA" / "SUBSTITUÍDA" (NT 008 §2.5), Arial,
  ≥50pt, cinza K35, acionada automaticamente via `NFSe/infNFSe/cStat`.
- Aviso de homologação "NFS-e SEM VALIDADE JURÍDICA" agora usa classe
  dedicada (`title-homolog`) em 9pt bold Arial vermelho (NT 008 §2.4.3).
- `DanfseGenerator::generatePdf()` rejeita com `RuntimeException` quando o
  Dompdf gera mais de uma página (NT 008 §2.2 — impressão em página única).
- Enums `CStat` e `TpEmit` (`src/Enums/`) refletindo NFSe/infNFSe/cStat e
  DPS/infDPS/tpEmit, conforme NT 008 (não usar `tpEmis` para "Situação" nem
  texto fixo para "Emitente da NFS-e").

### Corrigido
- Fontes: removido `<link>` para Roboto (Google Fonts, ignorado pelo
  Dompdf `isRemoteEnabled=false`). Substituído por **Liberation Sans**
  embarcado em `src/Template/fonts/` (equivalente métrico do Arial) +
  **DejaVu Sans** registrado como `microsoftsansserif` (equivalente do
  Microsoft Sans Serif, embutido no Dompdf).
- CSS do `src/Template/danfse.php` reescrito em `pt` fixos com os mínimos
  da NT 008: 9pt cabeçalho, 8pt município, 7pt conteúdo, 6pt labels e
  rodapé do QR. Removido `html { font-size: 90% }` de `@media print` que
  reduzia toda a hierarquia em 10%.
- Sombreamento cinza K5 (`#F2F2F2`) aplicado em cabeçalho, títulos de
  bloco e nos campos "Emitente da NFS-e" / "Valor Líquido da NFS-e +
  IBS/CBS" (era `header-cell`/`section-header` parcial).
- Linhas divisórias em 0,5pt e borda da página em 1pt.
- Margem da página em 5pt (≈0,176cm), dentro da faixa 0,15–0,20cm da
  NT 008 §2.2.
- Campo "Emitente da NFS-e" agora usa `tpEmit` do XML (Prestador /
  Tomador / Intermediário do Serviço), não mais texto fixo.
- "Situação da NFS-e" agora usa `cStat` do XML via enum `CStat`, não
  mais `tpEmis`.
- Bloco IBS/CBS: célula "Exclusões e Reduções da Base de Cálculo" imprime
  o somatório de valores `vCalcAjusteBCISSCBS + vCalcAjusteBCLocImoveis`,
  e a célula "Red. Alíquota IBS / Red. Alíquota CBS" lista os percentuais
  `pRedAliqUF / pRedAliqMun / pRedAliqCBS` (eram todos iguais antes).
- "Destinatário da Operação = Tomador" passa a depender apenas de
  `indDest=1` ou coincidência de documentos (não da mera existência do
  tomador).
- Endereço de emitente/tomador/intermediário/destinatário agora inclui
  `xCpl` (complemento) na concatenação.
- Formato de "Totais Aproximados dos Tributos" segue agora o padrão NT
  008 Nota 10: `Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012:
  Federais: R$ X ; Estaduais: R$ Y ; Municipais: R$ Z` (plural, "cfe.",
  separador `;`).
- Canhoto reescrito: rótulos em primeira maiúscula sem asteriscos
  (`Data Cientificação`, `Identificação e Assinatura`, `Nº NFS-e /
  Chave NFS-e`); fonte do valor elevada para 7pt.
- Canhoto: cells ajustados para as larguras da NT 008/2026 §2.3.3
  (5,09 / 5,09 / 10,19 cm). A 3ª coluna, que recebe
  `<nNFSe> / <chave 50 dígitos>` (até 66 caracteres), estava com
  ~5,14 cm em um layout de 3 colunas iguais; o conteúdo quebrava em
  2–3 linhas e o que não cabia era clipado pela margem da página A4,
  dando a impressão de que a chave de acesso havia sumido do canhoto.
- `Formatter::cnpjCpf()` aplicado ao CNPJ alfanumérico com a máscara
  `nn.nnn.nnn/nnnn-nn` mesmo com letras (NT 009).
- Cabeçalho do DANFSe sempre imprime "Município: ..." derivado do XML,
  mesmo quando `MunicipalityBranding` é informado (era substituído indevidamente).

### Testes
- Novos testes de conformidade NT 008 em `tests/DanfseConformanceTest.php`:
  marca d'água CANCELADA/SUBSTITUÍDA, aviso de homologação, indDest,
  tpEmit, totais Lei 12.741, truncamentos (xNome 77 + `...`, xDescServ
  1297), tamanhos mínimos de fonte, QR Code 60pt, sombreamento K5,
  canhoto configurável.
- Testes adaptados que afirmavam o comportamento pré-norma
  (`HOMOLOGAÇÃO`, `**** DATA CIENTIFICAÇÃO:`,
  `Nº NFS-e / CHAVE NFS-e`, substituição do município pelo branding,
  formato "Federal:" em vez de "Federais:", uso de `tpEmis` na
  "Situação") agora verificam o comportamento pós-norma.

### Limitações conhecidas (Blocos 2 e 3 do plano)
- Posicionamento absoluto por coordenadas em cm (Anexo I) continua em
  tabelas HTML, não milimétrico.
- Cobertura completa da NT 009 (`vAjusteBC`, `gAjusteBCLocImoveis`,
  `bensMoveis`, `gLocacao`, `gUnidImob`, `gTribSN`, `gPgtoVinc`,
  `indFinal`, `regApIBSCBSSN`) e fórmulas de BC do ISSQN/IBS-CBS ficam
  para ciclos posteriores.

## [2.0.0] - 2026-07-10

### Quebrado (breaking)
- `DanfseConfig` não aceita mais `logoDataUri` nem `logoPath` no construtor.
  A logo NFS-e (a "logo da nota") deixou de ser configurável: ela é
  obrigatória, vem embutida em `DanfseNacional\Config\DefaultLogo::DATA_URI`
  e é renderizada incondicionalmente pelo template. Consumidores que
  passavam esses parâmetros devem removê-los; o logo é sempre exibido.
- Apenas o logo do ente emitente (empresa, brasão da prefeitura, etc.)
  continua configurável, via `MunicipalityBranding::logoDataUri` ou
  `::logoPath` — esta parte é opt-in e sem alteração de contrato.

### Adicionado
- `DanfseNacional\Config\DefaultLogo::DATA_URI` como fonte única e
  obrigatória da logo NFS-e (data URI base64 do PNG oficial).
- Testes de regressão que falham se a logo NFS-e parar de ser
  renderizada (`tests/RealXmlTest.php::test_rendered_html_contains_embedded_nfse_logo`)
  ou se a constante `DefaultLogo::DATA_URI` for corrompida
  (`tests/DefaultLogoTest.php`).

### Migração (1.x → 2.0.0)
```php
// Antes (1.x)
$config = new DanfseConfig(logoPath: $caminho, municipality: $b);

// Depois (2.0.0)
$config = new DanfseConfig(municipality: $b);
// A logo NFS-e é fixa; para customizar a logo do ente, use
// MunicipalityBranding(name: ..., logoPath: $caminho).
```

## [1.0.2.0] - 2026-07-10

### Corrigido
- Logo NFS-e sumia em ambientes Composer/Laravel onde o diretório
  `assets/` não era publicável. PNG embutido como constante PHP
  (`DefaultLogo::DATA_URI`), eliminando dependência de I/O em runtime.
