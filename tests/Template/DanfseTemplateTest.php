<?php

namespace DanfseNacional\Tests\Template;

use DanfseNacional\DanfseGenerator;
use PHPUnit\Framework\TestCase;

class DanfseTemplateTest extends TestCase
{
    private string $v1Xml;
    private string $v2Xml;

    /** @var callable|null */
    private $previousErrorHandler = null;

    protected function setUp(): void
    {
        $v1Path = __DIR__ . '/../../examples/nfse_exemplo.xml';
        $this->v1Xml = (string) file_get_contents($v1Path);
        $this->assertNotFalse($this->v1Xml, "nfse_exemplo.xml não encontrado em {$v1Path}");

        $v2Path = __DIR__ . '/../../examples/nfse_exemplo_v2.xml';
        $this->v2Xml = (string) file_get_contents($v2Path);
        $this->assertNotFalse($this->v2Xml, "nfse_exemplo_v2.xml não encontrado em {$v2Path}");

        $this->previousErrorHandler = set_error_handler(
            static function (int $errno, string $errstr, string $errfile = '', int $errline = 0): bool {
                if ((error_reporting() & $errno) === 0) {
                    return false;
                }
                throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
            }
        );
    }

    protected function tearDown(): void
    {
        restore_error_handler();
        $this->previousErrorHandler = null;
    }

    public function test_renders_minimal_v1_xml_without_warnings(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v1Xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('<!DOCTYPE html>', $html);
        $this->assertStringNotContainsString('Undefined', $html);
        $this->assertStringNotContainsString('Warning', $html);
        $this->assertStringNotContainsString('Notice', $html);
    }

    public function test_renders_v2_ibs_cbs_xml_without_warnings(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringNotContainsString('Undefined', $html);
        $this->assertStringNotContainsString('Warning', $html);
        $this->assertStringNotContainsString('Notice', $html);
        $this->assertStringContainsString('IBS', $html);
    }

    public function test_ambiente_2_renders_homologacao_watermark(): void
    {
        $xml = $this->v2XmlWithAmbiente(2);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('HOMOLOGAÇÃO', $html);
        $this->assertStringContainsString('SEM VALIDADE JURÍDICA', $html);
    }

    public function test_ambiente_1_does_not_render_homologacao_watermark(): void
    {
        $xml = $this->v2XmlWithAmbiente(1);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringNotContainsString('HOMOLOGAÇÃO', $html);
        $this->assertStringNotContainsString('SEM VALIDADE JURÍDICA', $html);
    }

    private function v2XmlWithAmbiente(int $ambiente): string
    {
        return str_replace(
            '<tpAmb>1</tpAmb>',
            '<tpAmb>' . $ambiente . '</tpAmb>',
            $this->v2Xml
        );
    }
}
