# Changelog

Todas as mudanças notáveis neste projeto serão documentadas aqui.

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
