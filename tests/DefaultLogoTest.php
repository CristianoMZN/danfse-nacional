<?php

namespace DanfseNacional\Tests;

use DanfseNacional\Config\DefaultLogo;
use PHPUnit\Framework\TestCase;

class DefaultLogoTest extends TestCase
{
    public function test_is_data_uri_png(): void
    {
        $this->assertStringStartsWith('data:image/png;base64,', DefaultLogo::DATA_URI);
    }

    public function test_decodes_to_valid_png_signature(): void
    {
        $b64 = substr(DefaultLogo::DATA_URI, strpos(DefaultLogo::DATA_URI, ',') + 1);
        $bin = base64_decode($b64, true);
        $this->assertNotFalse($bin);
        $this->assertSame("\x89PNG\r\n\x1a\n", substr($bin, 0, 8));
    }

    public function test_has_non_trivial_size(): void
    {
        $b64 = substr(DefaultLogo::DATA_URI, strpos(DefaultLogo::DATA_URI, ',') + 1);
        $this->assertGreaterThan(1000, strlen(base64_decode($b64)));
    }
}
