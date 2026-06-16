# DANFSe Nacional

> **Fork** do repositório original [`andrevabo/danfse-nacional`](https://github.com/andrevabo/danfse-nacional), modificado para operar com o padrão **NFSe 2.0** (NT 008/2026 e NT 009/2026 — IBS/CBS).

Biblioteca PHP para geração de PDF do DANFSe (Documento Auxiliar da Nota Fiscal de Serviços eletrônica) a partir do XML da NFS-e Padrão Nacional.

A biblioteca recebe o XML de uma NFS-e autorizada e devolve o conteúdo binário de um PDF em A4 retrato, sem nenhuma dependência de framework. Pode ser usada em projetos Laravel, Symfony, ou em scripts PHP puro.

O objetivo principal desta biblioteca é criar um documento o mais fiel possível ao DANFSe original gerado pela API da SEFAZ, com apenas alguns ajustes para melhorar a legibilidade.

Nas NFS-e do ambiente de Homologação, o PDF apresenta a mesma mensagem do documento original, "NFS-e SEM VALIDADE JURÍDICA", além de uma marca d'água adicional para diferenciar os PDFs de teste dos emitidos em Produção.

## Compatibilidade

| Versão NFS-e | Norma Técnica | Status |
|---|---|---|
| v1.01 | Padrão Nacional original | Suportada |
| v2.0 | NT 008/2026 (DANFSe) + NT 009/2026 (XML IBS/CBS) | Suportada |

A biblioteca é retrocompatível: XMLs v1.01 (sem IBS/CBS) continuam funcionando normalmente. A seção IBS/CBS no PDF só é renderizada quando os dados estão presentes no XML.

## Exemplos

- [DANFSe - Produção](examples/danfse.pdf)
- [DANFSe - Homologação](examples/danfse-homologacao.pdf)

## Requisitos

PHP 8.1 ou superior com as extensões `simplexml`, `mbstring` e `fileinfo` habilitadas.

## Instalação

```bash
composer require CristianoMZN/danfse-nacional
```

## Uso básico

O caminho mais direto é passar o XML e receber o PDF em uma única chamada.

```php
use DanfseNacional\DanfseGenerator;

$xml = file_get_contents('nfse_autorizada.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

file_put_contents('danfse.pdf', $pdf);
```

## NFS-e v2.0 com IBS/CBS (NT 009/2026)

Para XMLs v2.0 que incluem os grupos IBS/CBS (Imposto sobre Bens e Serviços / Contribuição sobre Bens e Serviços), a biblioteca renderiza automaticamente a seção de tributação do IBS/CBS no DANFSe:

```php
use DanfseNacional\DanfseGenerator;

// XML v2.0 com IBS/CBS
$xml = file_get_contents('nfse_v2_com_ibs_cbs.xml');

$generator = new DanfseGenerator();
$pdf = $generator->generateFromXml($xml);

// O PDF inclui a seção IBS/CBS automaticamente
file_put_contents('danfse_v2.pdf', $pdf);
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

## Parse NFSe (sem gerar PDF)

É possível extrair os dados do XML da NFS-e sem gerar o PDF. A biblioteca oferece duas abordagens: retornar um **array associativo** ou um **objeto DTO tipado**.

### Como array

Use `XmlToArray` para converter o XML em um array PHP associativo:

```php
use DanfseNacional\XmlToArray;

$xml = file_get_contents('nfse_autorizada.xml');
$array = (new XmlToArray())->convert($xml);

echo $array['infNFSe']['nNFSe'];           // "10"
echo $array['infNFSe']['emit']['CNPJ'];     // "11222333000181"
echo $array['infNFSe']['valores']['vLiq'];  // "1292.75"
```

### Como objeto DTO

Use `DanfseGenerator::parseXml()` para obter um objeto `NFSe` com propriedades tipadas:

```php
use DanfseNacional\DanfseGenerator;

$nfse = (new DanfseGenerator())->parseXml($xml);

echo $nfse->infNFSe->nNFSe;                 // "10"
echo $nfse->infNFSe->emit->xNome;           // "EMPRESA EXEMPLO..."
echo $nfse->infNFSe->valores->vLiq;         // "1292.75"
echo $nfse->infNFSe->DPS->infDPS->dCompet;  // "2026-01-15"
```

Ambas as abordagens funcionam com XMLs v1.01 e v2.0 (IBS/CBS). Para XMLs v2.0, os campos IBS/CBS também estarão disponíveis:

```php
$nfse = (new DanfseGenerator())->parseXml($xmlV2);

$ibsCbs = $nfse->infNFSe->IBSCBS;
$aliqIBSUF = $ibsCbs->valores?->uf?->pAliqEfetUF;
$aliqCBS = $ibsCbs->valores?->fed?->pAliqEfetCBS;
$vTotalCBS = $ibsCbs->totCIBS?->gCBS?->vCBS;
```

> Veja o exemplo completo em [`examples/example_parse.php`](examples/example_parse.php).

## Estrutura dos dados mapeados

O método `parseXml()` retorna um objeto `DanfseNacional\Dto\NFSe` com propriedades tipadas e `readonly`. A hierarquia segue a estrutura do XML da NFS-e Nacional:

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

Todos os campos opcionais no esquema da NFS-e são representados como propriedades `nullable` ou com valor padrão de string vazia, portanto o acesso nunca lança exceções por campo ausente.

## Logo da empresa

Por padrão, o cabeçalho do documento exibe o logo incluído no pacote. Para substituí-lo pelo logo da empresa, informe o caminho do arquivo de imagem via `logoPath`. A biblioteca detecta o MIME type e monta o data URI automaticamente.

```php
use DanfseNacional\DanfseGenerator;
use DanfseNacional\Config\DanfseConfig;

$config = new DanfseConfig(logoPath: '/caminho/para/logo.png');
$generator = new DanfseGenerator($config);

$pdf = $generator->generateFromXml($xml);
```

Para suprimir o logo completamente, passe `false`.

```php
$config = new DanfseConfig(logoPath: false);
```

Caso o dado já esteja disponível como data URI (por exemplo, quando o logo é armazenado em banco de dados), é possível fornecê-lo diretamente via `logoDataUri`. Se ambos `logoDataUri` e `logoPath` forem informados, `logoDataUri` tem precedência. `logoPath: false` sempre suprime o logo, independente de `logoDataUri`.

```php
$config = new DanfseConfig(logoDataUri: 'data:image/png;base64,...');
```

## Identificação do município

O cabeçalho do DANFSe possui um espaço reservado para a identificação do ente municipal emissor. Por padrão esse espaço fica em branco. Para preenchê-lo, configure `MunicipalityBranding` com o nome do município, a secretaria responsável e o e-mail de contato. O logotipo do município segue a mesma convenção: aceita caminho de arquivo ou data URI.

```php
use DanfseNacional\DanfseGenerator;
use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\MunicipalityBranding;

$config = new DanfseConfig(
    logoPath: '/caminho/para/logo-empresa.png',
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

## Geração em dois passos

É possível acessar o método `parseXml()` para obter um objeto `DanfseNacional\Dto\NFSe` com os dados da NFS-e antes de gerar o PDF.

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

## Geração do HTML intermediário

Para inspecionar o HTML gerado antes da renderização, útil em testes e depuração, use `generateHtml()`.

```php
use DanfseNacional\DanfseGenerator;

$generator = new DanfseGenerator();
$nfse = $generator->parseXml($xml);

$html = $generator->generateHtml($nfse);
```

## Entrega da resposta em aplicações web

Em vez de salvar o arquivo em disco, o conteúdo binário do PDF pode ser enviado diretamente como resposta HTTP.

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

## Dependências

A biblioteca depende exclusivamente de pacotes sem acoplamento a frameworks:

`dompdf/dompdf` para renderização do HTML em PDF, `cuyz/valinor` para o mapeamento seguro do array XML para os DTOs tipados, e `bacon/bacon-qr-code` para a geração do QR Code de consulta pública.

## Testes

```bash
composer install
./vendor/bin/phpunit
```
