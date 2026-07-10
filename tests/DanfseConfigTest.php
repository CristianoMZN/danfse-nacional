<?php

namespace DanfseNacional\Tests;

use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\MunicipalityBranding;
use PHPUnit\Framework\TestCase;

class DanfseConfigTest extends TestCase
{
    public function test_default_constructor_has_null_municipality(): void
    {
        $this->assertNull((new DanfseConfig())->municipality);
    }

    public function test_constructor_accepts_municipality(): void
    {
        $b = new MunicipalityBranding(name: 'Prefeitura de Niterói');
        $this->assertSame($b, (new DanfseConfig(municipality: $b))->municipality);
    }

    public function test_municipality_logo_path_is_converted(): void
    {
        $branding = new MunicipalityBranding(
            name: 'Prefeitura de Niterói',
            logoPath: __DIR__ . '/fixtures/logo.png',
        );

        $this->assertNotNull($branding->logoDataUri);
        $this->assertStringStartsWith('data:image/png;base64,', $branding->logoDataUri);
    }

    public function test_municipality_logo_data_uri_is_used_directly(): void
    {
        $branding = new MunicipalityBranding(
            name: 'ACME Ltda',
            logoDataUri: 'data:image/png;base64,abc123',
        );

        $this->assertSame('data:image/png;base64,abc123', $branding->logoDataUri);
    }

    public function test_municipality_without_logo_is_null(): void
    {
        $branding = new MunicipalityBranding(name: 'Prefeitura de Niterói');
        $this->assertNull($branding->logoDataUri);
    }

    public function test_municipality_invalid_logo_path_throws(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new MunicipalityBranding(name: 'X', logoPath: '/caminho/inexistente/logo.png');
    }
}
