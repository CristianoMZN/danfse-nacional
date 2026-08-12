---
layout: default
title: Customização
nav_order: 7
permalink: /customizacao.html
---

# Customização — `DanfseConfig`, logos e canhoto

O DANFSe pode ser customizado em pontos específicos sem comprometer a conformidade normativa. Os pontos configuráveis vivem em `DanfseNacional\Config\DanfseConfig` e `DanfseNacional\Config\MunicipalityBranding`.

## Logos do documento

O DANFSe exibe **duas logos** no cabeçalho, com responsabilidades bem distintas.

### 1. Logo da NFS-e (obrigatória)

Vem embutida no binário da biblioteca em `DanfseNacional\Config\DefaultLogo::DATA_URI`. É parte fixa do documento: o consumidor **não pode** substituí-la, desativá-la nem informá-la via `DanfseConfig`. A logo NFS-e é sempre renderizada.

### 2. Logo do ente emitente (opcional)

Brasão da prefeitura, logo da empresa, marca de autarquia etc. Informada via `MunicipalityBranding`. Quando omitida, o canto direito do cabeçalho mostra apenas "Município: \<cidade/UF\>" derivado do XML.

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

A logo do ente é convertida internamente para data URI e embutida no PDF. `MunicipalityBranding` aceita `logoPath` (caminho do arquivo) ou `logoDataUri` (data URI pronto). Os dois são mutuamente exclusivos; `logoDataUri` tem precedência. `logoPath` inválido lança `InvalidArgumentException` (a logo do ente é opt-in, mas quando você opta por ela, o caminho precisa existir).

## Identificação do município

O cabeçalho do DANFSe exibe **sempre** a linha "Município: \<cidade / UF\>" derivada do XML (`Municipios::lookup(emit->enderNac->cMun)`), pois é campo obrigatório da NT 008/2026 §2.4.3. Quando `MunicipalityBranding` é informado, o nome do ente, departamento e brasão aparecem **em adição** à linha "Município:", nunca a substituindo.

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

O bloco de canhoto é opcional (NT 008/2026 §2.3.3, Nota 11). Pode ser desligado via `DanfseConfig`, redistribuindo o espaço para "Descrição do Serviço" e "Informações Complementares":

```php
$config = new DanfseConfig(mostrarCanhoto: false);
$generator = new DanfseGenerator($config);
```

A redistribuição de espaço é garantida pelo `flex-grow: 1` da última `bordered-section` realocando a área antes ocupada para essas duas seções.

## `DanfseConfig`

```php
namespace DanfseNacional\Config;

final readonly class DanfseConfig {
    public function __construct(
        public ?MunicipalityBranding $municipality = null,
        public bool $mostrarCanhoto = true,
    ) {}
}
```

| Campo             | Tipo                     | Padrão  | Descrição                                                                                                |
| ----------------- | ------------------------ | ------- | -------------------------------------------------------------------------------------------------------- |
| `municipality`    | `?MunicipalityBranding`  | `null`  | Identificação/branding complementar do ente emitente. Não substitui o município do XML.                  |
| `mostrarCanhoto`  | `bool`                   | `true`  | Quando `false`, oculta o bloco de canhoto e redistribui o espaço para "Descrição do Serviço" / "Informações Complementares". |

## `MunicipalityBranding`

```php
namespace DanfseNacional\Config;

final readonly class MunicipalityBranding {
    public string $name;
    public string $department;
    public string $email;
    public ?string $logoDataUri;
    public ?string $logoPath;
}
```

| Campo         | Tipo            | Padrão | Descrição                                                                                                  |
| ------------- | --------------- | ------ | ---------------------------------------------------------------------------------------------------------- |
| `name`        | `string`        | —      | Nome do ente (prefeitura / empresa / autarquia). Obrigatório.                                              |
| `department`  | `string`        | `''`   | Departamento ou secretaria. Opcional.                                                                       |
| `email`       | `string`        | `''`   | E-mail de contato. Opcional.                                                                               |
| `logoDataUri` | `?string`       | `null` | Data URI pronto. Tem precedência sobre `logoPath`.                                                         |
| `logoPath`    | `?string`       | `null` | Caminho do arquivo de imagem. Detectado MIME automaticamente e convertido para data URI. Inválido lança `InvalidArgumentException`. |

> **Atenção:** a logo NFS-e (a "logo da nota") **NÃO** é configurada aqui. Ela é obrigatória e vem embutida em `DefaultLogo::DATA_URI`.

## Próximos passos

- [Templates, fontes e limites normativos](templates-fontes.html)
- [Visualizador HTML](visualizador-html.html)