# DANFSe Nacional

> **Fork** do repositório [`andrevabo/danfse-nacional`](https://github.com/andrevabo/danfse-nacional), adaptado para o padrão NFS-e 2.0 (NT 008/2026 e NT 009/2026 — IBS/CBS).

Biblioteca PHP para a NFS-e Nacional 2.0, distribuída via Packagist/Composer.
Oferece três entregáveis de mesmo nível:

1. **Geração de PDF** do DANFSe (Documento Auxiliar da NFS-e) a partir do
   XML autorizado — saída em A4 retrato, com o objetivo de ser o mais fiel
   possível ao documento emitido pela SEFAZ.
2. **Parser tipado do XML** — converte o XML da NFS-e em `array` associativo
   ou em objetos DTO `readonly` (NFSe/InfNFSe/DPS/...) para uso em qualquer
   outro recurso da sua aplicação.
3. **Visualizador HTML** do DANFSe — gera o HTML intermediário consumido pelo
   dompdf, útil para inspecionar o documento antes de produzir o PDF.

Sem dependência de framework: funciona em PHP puro, Laravel, Symfony, Cake ou
qualquer outro projeto PHP. PSR-4; namespace `DanfseNacional\`.

Nas NFS-e do ambiente de Homologação, o PDF apresenta o aviso obrigatório
"NFS-e SEM VALIDADE JURÍDICA" (Arial, 9pt, negrito, vermelho) no cabeçalho,
conforme NT 008/2026 §2.4.3. Quando a NFS-e está **cancelada** ou
**substituída** (`cStat = 101` ou `102`), o PDF traz a marca d'água
obrigatória "CANCELADA" ou "SUBSTITUÍDA" (Arial, 50pt+, cinza K35, na
diagonal — NT 008/2026 §2.5).

A "Situação da NFS-e" é lida a partir de `NFSe/infNFSe/cStat` (não `tpEmis`)
e o rótulo "Emitente da NFS-e" reflete o `tpEmit` da DPS (Prestador /
Tomador & Intermediário), evitando informação divergente da tag XML
correspondente. O texto fixo de "Totais Aproximados dos Tributos" segue o
formato oficial NT 008 Nota 10:
`Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012: Federais: R$ X ; Estaduais: R$ Y ; Municipais: R$ Z`.

## Conformidade com a NT 008/2026

O layout do DANFSe segue o modelo do Anexo I da NT 008/2026 (SE/CGNFS-e):

- Impressão em página única, A4 retrato, margens 0,15–0,20cm.
- Fontes: Arial para títulos/labels e Microsoft Sans Serif para conteúdo,
  com os tamanhos mínimos da norma (9pt cabeçalho, 8pt município, 7pt
  conteúdo, 6pt labels e rodapé do QR). Como Arial e Microsoft Sans Serif
  são fontes proprietárias, a biblioteca distribui **Liberation Sans** como
  equivalente métrico do Arial e utiliza **DejaVu Sans** (embutida no
  Dompdf) como equivalente do Microsoft Sans Serif. As TTFs de Liberation
  Sans ficam em `src/Template/fonts/` e são registradas automaticamente no
  Dompdf.
- Sombreamento cinza K5 (~#F2F2F2) no cabeçalho, títulos de bloco e nos
  campos "Emitente da NFS-e" e "Valor Líquido da NFS-e + IBS/CBS".
- Linhas divisórias 0,5pt; borda da página 1pt.
- QR Code de consulta pública apontando para
  `https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave=<chave>` com o
  texto de autenticidade abaixo.
- Rejeição automática (via exceção) se o conteúdo estourar 1 página.

## Compatibilidade

A biblioteca lida com o **XML NFS-e v1.01** (única versão de XML existente) e
renderiza o **DANFSe em dois layouts**:

| Layout do DANFSe | Norma Técnica | Status |
|---|---|---|
| v1.0 | Padrão original, sem bloco IBS/CBS | Suportado |
| v2.0 | NT 008/2026, com seção IBS/CBS quando o XML traz o bloco | Suportado |

O XML v1.01 pode ou não trazer o grupo `IBSCBS` (reforma tributária,
NT 009/2026). Quando presente, a biblioteca preenche automaticamente a seção
de tributação IBS/CBS do DANFSe. A escolha do layout é feita pelo conteúdo
do XML, não pela versão dele.

## Exemplos

`examples/example.php` itera todos os XMLs em `examples/`, gerando para cada
um um PDF sem configuração (`danfse_simples_<chave>.pdf`) e um PDF com
identificação da Prefeitura de Niterói (`danfse_com_config_<chave>.pdf`,
acompanhado de `danfse_com_config_<chave>.html`).

## Requisitos

PHP 8.1 ou superior com as extensões `simplexml`, `mbstring` e `fileinfo`
habilitadas.

## Instalação

```bash
composer require CristianoMZN/danfse-nacional
```

---

# 1. Geração de PDF

O caminho mais direto é passar o XML e receber o PDF em uma única chamada.

```php
use DanfseNacional\DanfseGenerator;

$xml = file_get_contents('nfse_autorizada.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

file_put_contents('danfse.pdf', $pdf);
```

O PDF é gerado em A4 retrato e busca ser fiel ao DANFSe original emitido pela
SEFAZ, com pequenos ajustes para melhorar a legibilidade.

## NFS-e com IBS/CBS (reforma tributária)

XMLs v1.01 que incluam os grupos IBS/CBS (Imposto sobre Bens e Serviços /
Contribuição sobre Bens e Serviços, conforme NT 009/2026) fazem a biblioteca
renderizar automaticamente a seção de tributação do IBS/CBS no DANFSe:

```php
use DanfseNacional\DanfseGenerator;

// XML v1.01 com bloco IBS/CBS
$xml = file_get_contents('nfse_com_ibs_cbs.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

// O PDF inclui a seção IBS/CBS automaticamente
file_put_contents('danfse.pdf', $pdf);
```

Acesse os campos IBS/CBS via DTOs:

```php
$nfse = $generator->parseXml($xml);

// IBS/CBS calculados (infNFSe)
$ibsCbs = $nfse->infNFSe->IBSCBS;
$aliqIBSUF = $ibsCbs->valores?->uf?->pAliqEfetUF;
$aliqIBSMun = $ibsCbs->valores?->mun?->pAliqEfetMun;
$aliqCBS = $ibsCbs->valores?->fed?->pAliqEfetCBS;
$vTotalIBS = $ibsCbs->totCIBS?->gIBS?->vIBSTot;
$vTotalCBS = $ibsCbs->totCIBS?->gCBS?->vCBS;

// IBS/CBS declarados (DPS)
$ibsCbsDps = $nfse->infNFSe->DPS->infDPS->IBSCBS;
$cst = $ibsCbsDps->valores?->trib?->gIBSCBS?->CST;

// FinNFSe (finalidade da NFS-e)
$finNFSe = $nfse->infNFSe->DPS->infDPS->finNFSe;
```

## Logos do documento

O DANFSe exibe **duas logos** no cabeçalho, com responsabilidades bem
distintas:

1. **Logo da NFS-e** (obrigatória) — vem embutida no binário da biblioteca
   em `DanfseNacional\Config\DefaultLogo::DATA_URI`. É parte fixa do
   documento: o consumidor **não pode** substituí-la, desativá-la nem
   informá-la via `DanfseConfig`. A logo NFS-e é sempre renderizada.

2. **Logo do ente emitente** (opcional) — brasão da prefeitura, logo da
   empresa, marca de autarquia etc. Informada via `MunicipalityBranding`
   (a classe serve para qualquer ente: município, empresa, autarquia).
   Quando omitida, o canto direito do cabeçalho mostra apenas
   "Município: &lt;cidade/UF&gt;" derivado do XML.

```php
use DanfseNacional\DanfseGenerator;
use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\MunicipalityBranding;

// Sem logo do ente (apenas a logo NFS-e obrigatória):
$generator = new DanfseGenerator();

// Com brasão da prefeitura / logo da empresa:
$generator = new DanfseGenerator(new DanfseConfig(
    municipality: new MunicipalityBranding(
        name: 'Prefeitura de Niterói',
        department: 'Secretaria de Fazenda',
        email: 'iss@fazenda.niteroi.gov.br',
        logoPath: '/caminho/para/brasao.png',
    ),
));
```

A logo do ente é convertida internamente para data URI e embutida no
PDF. `MunicipalityBranding` aceita `logoPath` (caminho do arquivo) ou
`logoDataUri` (data URI pronto). Os dois são mutuamente exclusivos;
`logoDataUri` tem precedência. `logoPath` inválido lança
`InvalidArgumentException` (a logo do ente é opt-in, mas quando você
opta por ela, o caminho precisa existir).

## Identificação do município

O cabeçalho do DANFSe exibe **sempre** a linha "Município: &lt;cidade / UF&gt;"
derivada do XML (`Municipios::lookup(emit->enderNac->cMun)`), pois é campo
obrigatório da NT 008/2026 §2.4.3. Quando `MunicipalityBranding` é informado,
o nome do ente, departamento e brasão aparecem **em adição** à linha
"Município:", nunca a substituindo.

```php
use DanfseNacional\DanfseGenerator;
use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\MunicipalityBranding;

$config = new DanfseConfig(
    municipality: new MunicipalityBranding(
        name: 'Prefeitura de Niterói',
        department: 'Secretaria Municipal de Fazenda',
        email: 'iss@fazenda.niteroi.rj.gov.br',
        logoPath: '/caminho/para/logo-prefeitura.png',
    ),
);

$generator = new DanfseGenerator($config);
$pdf = $generator->generateFromXml($xml);
```

## Canhoto (opcional)

O bloco de canhoto é opcional (NT 008/2026 §2.3.3, Nota 11). Pode ser
desligado via `DanfseConfig`, redistribuindo o espaço para "Descrição do
Serviço" e "Informações Complementares":

```php
$config = new DanfseConfig(mostrarCanhoto: false);
$generator = new DanfseGenerator($config);
```

## Geração em dois passos

É possível acessar o método `parseXml()` para obter um objeto
`DanfseNacional\Dto\NFSe` com os dados da NFS-e antes de gerar o PDF.

```php
use DanfseNacional\DanfseGenerator;

$generator = new DanfseGenerator();

$nfse = $generator->parseXml($xml);

// Acessa os dados tipados via DTOs
$numeroNfse = $nfse->infNFSe->nNFSe;
$cnpjEmitente = $nfse->infNFSe->emit->CNPJ;
$valorLiquido = $nfse->infNFSe->valores->vLiq;
$descricaoServico = $nfse->infNFSe->DPS->infDPS->serv->cServ->xDescServ;

$pdf = $generator->generatePdf($nfse);
```

## Entrega da resposta em aplicações web

Em vez de salvar o arquivo em disco, o conteúdo binário do PDF pode ser
enviado diretamente como resposta HTTP.

```php
// PHP puro
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="danfse.pdf"');
echo $pdf;

// Laravel
return response($pdf, 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="danfse.pdf"',
]);
```

---

# 2. Parser de XML

O parser transforma o XML da NFS-e em estruturas PHP prontas para uso.
Funciona com XMLs v1.01 e v2.0 (IBS/CBS) e oferece duas saídas
equivalentes: `array` associativo ou DTO tipado.

## Como array

Use `XmlToArray` para converter o XML em um array PHP associativo:

```php
use DanfseNacional\XmlToArray;

$xml = file_get_contents('nfse_autorizada.xml');
$array = (new XmlToArray())->convert($xml);

echo $array['infNFSe']['nNFSe'];           // "10"
echo $array['infNFSe']['emit']['CNPJ'];     // "11222333000181"
echo $array['infNFSe']['valores']['vLiq'];  // "1292.75"
```

## Como objeto DTO

Use `DanfseGenerator::parseXml()` para obter um objeto `NFSe` com propriedades
tipadas:

```php
use DanfseNacional\DanfseGenerator;

$nfse = (new DanfseGenerator())->parseXml($xml);

echo $nfse->infNFSe->nNFSe;                 // "10"
echo $nfse->infNFSe->emit->xNome;           // "EMPRESA EXEMPLO..."
echo $nfse->infNFSe->valores->vLiq;         // "1292.75"
echo $nfse->infNFSe->DPS->infDPS->dCompet;  // "2026-01-15"
```

Para XMLs v2.0, os campos IBS/CBS também estarão disponíveis:

```php
$nfse = (new DanfseGenerator())->parseXml($xmlV2);

$ibsCbs = $nfse->infNFSe->IBSCBS;
$aliqIBSUF = $ibsCbs->valores?->uf?->pAliqEfetUF;
$aliqCBS = $ibsCbs->valores?->fed?->pAliqEfetCBS;
$vTotalCBS = $ibsCbs->totCIBS?->gCBS?->vCBS;
```

> Veja o exemplo completo em [`examples/example_parse.php`](examples/example_parse.php).

## Estrutura dos dados mapeados

O método `parseXml()` retorna um objeto `DanfseNacional\Dto\NFSe` com
propriedades tipadas e `readonly`. A hierarquia segue a estrutura do XML da
NFS-e Nacional:

```
NFSe
├── InfNFSe
│   ├── emit (Emitente)
│   │   └── enderNac (EnderecoEmitente)
│   ├── valores (ValoresNFSe)
│   │   ├── vBC, vISSQN, vLiq ...
│   │   └── (v2.0) vCalcAjusteBCISSQN, tpBM, vCalcBM
│   ├── IBSCBS [v2.0] (IBSCBS)
│   │   ├── valores (IBSCBSValores)
│   │   │   ├── uf (IBSCBSUF) — pIBSUF, pAliqEfetUF
│   │   │   ├── mun (IBSCBSMun) — pIBSMun, pAliqEfetMun
│   │   │   └── fed (IBSCBSFed) — pCBS, pAliqEfetCBS, pRedAliqCBS
│   │   └── totCIBS (TotCIBS)
│   │       ├── gIBS (GIBS) — gIBSUFTot, gIBSMunTot
│   │       └── gCBS (GCBS) — vCBS, vDifCBS
│   └── DPS (Dps)
│       └── infDPS (InfDPS)
│           ├── prest (Prestador)
│           │   ├── IM, xNome [v2.0]
│           │   └── regTrib (RegTrib)
│           │       └── regApIBSCBSSN [v2.0]
│           ├── toma (Tomador)
│           │   └── end (Endereco)
│           │       └── endNac (EnderecoNacional)
│           ├── interm (Intermediario)
│           │   └── IM [v2.0, renomeado de IMPrestMun]
│           ├── serv (Servico)
│           │   ├── locPrest (LocPrest)
│           │   ├── cServ (CServ)
│           │   │   └── cAtvSN [v2.0]
│           │   ├── comExt [v2.0]
│           │   ├── obra [v2.0]
│           │   └── atvEvento [v2.0]
│           ├── valores (Valores)
│           │   ├── vServPrest (VServPrest)
│           │   └── trib (Tributacao)
│           │       ├── tribMun (TribMunicipal)
│           │       ├── tribFed (TribFederal)
│           │       │   └── piscofins (PisCofins)
│           │       └── totTrib (TotTrib)
│           │           ├── vTotTribFed/Est/Mun [v2.0]
│           │           └── pTotTrib (TotTribPercent)
│           └── IBSCBS [v2.0] (DPS_IBSCBS)
│               ├── indFinal, tpOper
│               └── valores (ValoresDPS_IBSCBS)
│                   └── trib (TribDPS_IBSCBS)
│                       └── gIBSCBS (GIBSCBS_DPS) — CST, cClassTrib
```

Todos os campos opcionais no esquema da NFS-e são representados como
propriedades `nullable` ou com valor padrão de string vazia, portanto o acesso
nunca lança exceções por campo ausente.

---

# 3. Visualizador HTML

O visualizador HTML expõe o HTML intermediário consumido pelo `dompdf` para
renderizar o PDF. Útil para inspecionar a marcação do DANFSe em testes,
depuração ou em qualquer cenário em que o PDF ainda não é o destino final.

```php
use DanfseNacional\DanfseGenerator;

$generator = new DanfseGenerator();
$nfse = $generator->parseXml($xml);

$html = $generator->generateHtml($nfse);
```

O método `generateHtml()` retorna a string HTML completa (com o logo
aplicado conforme `DanfseConfig` e a seção IBS/CBS renderizada quando
presente no XML).

---

# 4. Customização do template

Os tamanhos de fonte, cores, espessuras de linha e sombreamentos do template
seguem os mínimos normativos da NT 008/2026 §2.4 e são fixados em `pt` no
`<style>` de `src/Template/danfse.php`. **Não reduza esses valores** — usar
uma fonte menor que os mínimos (7pt conteúdo, 6pt labels, 9pt cabeçalho)
descaracteriza o layout do Anexo I e pode causar rejeição do documento.

Ampliar tamanhos, ao contrário, é permitido desde que o modelo/ordem dos
blocos seja preservado.

## Fontes proprietárias e equivalentes métricos

A NT 008/2026 §2.4 exige Arial (títulos/labels) e Microsoft Sans Serif
(conteúdo). Ambas são proprietárias. Para garantir renderização em qualquer
ambiente PHP/Docker sem dependência de fontes instaladas no SO, a biblioteca
distribui:

- `src/Template/fonts/LiberationSans-{Regular,Bold,Italic,BoldItalic}.ttf`
  (equivalente métrico do Arial) — registrado automaticamente no Dompdf via
  `DanfseGenerator::registerFonts()` e usado como `defaultFont
  'liberationsans'`.
- `DejaVu Sans` (embutido no Dompdf) registrado como `microsoftsansserif`,
  equivalente do Microsoft Sans Serif.

Se precisar trocar a família tipográfica por uma terceira, **ela deve continuar
métrica-compatível com Arial / MS Sans Serif** e a mudança deve ser
documentada aqui.

---

## Dependências

A biblioteca depende exclusivamente de pacotes sem acoplamento a frameworks:

`dompdf/dompdf` para renderização do HTML em PDF, `cuyz/valinor` para o
mapeamento seguro do array XML para os DTOs tipados, e `bacon/bacon-qr-code`
para a geração do QR Code de consulta pública.

## Testes

```bash
composer install
./vendor/bin/phpunit
```
