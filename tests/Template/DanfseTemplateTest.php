<?php

namespace DanfseNacional\Tests\Template;

use DanfseNacional\DanfseGenerator;
use PHPUnit\Framework\TestCase;

class DanfseTemplateTest extends TestCase
{
    private string $xml;

    /** @var callable|null */
    private $previousErrorHandler = null;

    protected function setUp(): void
    {
        $path = __DIR__ . '/../../examples/35489062255036530000181000000000653426072486424961.xml';
        $this->xml = (string) file_get_contents($path);
        $this->assertNotFalse($this->xml, "XML canônico não encontrado em {$path}");

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

    public function test_renders_xml_without_warnings(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('<!DOCTYPE html>', $html);
        $this->assertStringNotContainsString('Undefined', $html);
        $this->assertStringNotContainsString('Warning', $html);
        $this->assertStringNotContainsString('Notice', $html);
    }

    public function test_renders_ibscbs_section_when_present(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringNotContainsString('Undefined', $html);
        $this->assertStringNotContainsString('Warning', $html);
        $this->assertStringNotContainsString('Notice', $html);
        $this->assertStringContainsString('IBS', $html);
    }

    public function test_ambiente_2_renders_homologacao_watermark(): void
    {
        $xml = $this->xmlWithAmbiente(2);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('HOMOLOGAÇÃO', $html);
        $this->assertStringContainsString('SEM VALIDADE JURÍDICA', $html);
    }

    public function test_ambiente_1_does_not_render_homologacao_watermark(): void
    {
        $xml = $this->xmlWithAmbiente(1);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringNotContainsString('HOMOLOGAÇÃO', $html);
        $this->assertStringNotContainsString('SEM VALIDADE JURÍDICA', $html);
    }

    public function test_renders_without_ibscbs_block(): void
    {
        $xml = $this->xmlWithoutIBSCBS();

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringNotContainsString('Undefined', $html);
        $this->assertStringNotContainsString('Warning', $html);
        $this->assertStringNotContainsString('Notice', $html);
        $this->assertStringContainsString('<!DOCTYPE html>', $html);
    }

    private function xmlWithAmbiente(int $ambiente): string
    {
        return str_replace(
            '<tpAmb>1</tpAmb>',
            '<tpAmb>' . $ambiente . '</tpAmb>',
            $this->xml
        );
    }

    private function xmlWithoutIBSCBS(): string
    {
        return preg_replace(
            '#<IBSCBS>.*?</IBSCBS>#s',
            '',
            $this->xml
        );
    }
}
