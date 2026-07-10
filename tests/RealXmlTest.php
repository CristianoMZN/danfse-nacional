<?php

namespace DanfseNacional\Tests;

use DanfseNacional\DanfseGenerator;
use DanfseNacional\Dto\NFSe;
use DanfseNacional\Template\DanfseTemplate;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RealXmlTest extends TestCase
{
    private string $outputDir;

    protected function setUp(): void
    {
        $this->outputDir = __DIR__ . '/output';
        if (!is_dir($this->outputDir)) {
            mkdir($this->outputDir, 0755, true);
        }
    }

    public static function realXmlProvider(): array
    {
        $dir = __DIR__ . '/xmls';
        $files = glob($dir . '/*.xml');

        $cases = [];
        foreach ($files as $file) {
            $basename = basename($file, '.xml');
            $cases[$basename] = [$file];
        }

        return $cases;
    }

    #[DataProvider('realXmlProvider')]
    public function test_real_xml_generates_valid_pdf(string $xmlPath): void
    {
        $xml = file_get_contents($xmlPath);
        $this->assertNotFalse($xml, "Falha ao ler XML: {$xmlPath}");

        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($xml);

        $this->assertStringStartsWith('%PDF-', $pdf, 'PDF gerado não começa com %PDF-');

        $size = strlen($pdf);
        $this->assertGreaterThan(1000, $size, 'PDF parece muito pequeno');
        $this->assertLessThan(5_000_000, $size, 'PDF parece muito grande');

        $outputPath = $this->outputDir . '/' . basename($xmlPath, '.xml') . '.pdf';
        file_put_contents($outputPath, $pdf);
        $this->assertFileExists($outputPath);
    }

    #[DataProvider('realXmlProvider')]
    public function test_real_xml_parses_to_nfse_dto(string $xmlPath): void
    {
        $xml = file_get_contents($xmlPath);
        $this->assertNotFalse($xml, "Falha ao ler XML: {$xmlPath}");

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);

        $this->assertInstanceOf(NFSe::class, $nfse);
        $this->assertNotNull($nfse->infNFSe, 'infNFSe não deve ser nulo');
        $this->assertNotEmpty($nfse->infNFSe->nNFSe, 'nNFSe não deve ser vazio');
        $this->assertNotNull($nfse->infNFSe->emit, 'emit não deve ser nulo');
        $this->assertNotEmpty($nfse->infNFSe->emit->CNPJ, 'CNPJ do emitente não deve ser vazio');
    }

    #[DataProvider('realXmlProvider')]
    public function test_real_xml_template_data_has_required_keys(string $xmlPath): void
    {
        $xml = file_get_contents($xmlPath);
        $this->assertNotFalse($xml, "Falha ao ler XML: {$xmlPath}");

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);

        $template = new DanfseTemplate();
        $data = $template->buildData($nfse);

        $this->assertArrayHasKey('chave_acesso', $data);
        $this->assertNotEmpty($data['chave_acesso']);

        $this->assertArrayHasKey('emitente', $data);
        $this->assertArrayHasKey('nome', $data['emitente']);
        $this->assertArrayHasKey('cnpj_cpf', $data['emitente']);

        $this->assertArrayHasKey('tomador', $data);
        $this->assertArrayHasKey('nome', $data['tomador']);

        $this->assertArrayHasKey('servico', $data);
        $this->assertArrayHasKey('descricao', $data['servico']);

        $this->assertArrayHasKey('totais', $data);
        $this->assertArrayHasKey('valor_liquido', $data['totais']);

        $this->assertArrayHasKey('ambiente', $data);
        $this->assertContains($data['ambiente'], [1, 2]);
    }

    public function test_empty_xml_throws_exception(): void
    {
        $this->expectException(\Throwable::class);

        $generator = new DanfseGenerator();
        $generator->generateFromXml('');
    }

    public function test_malformed_xml_throws_exception(): void
    {
        $this->expectException(\Throwable::class);

        $generator = new DanfseGenerator();
        @$generator->generateFromXml('<root><child>unclosed');
    }

    public function test_non_nfse_xml_generates_pdf_with_defaults(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.01">'
            . '<infNFSe Id="NFS00000000000000000000000000000000000000000000">'
            . '<nNFSe>1</nNFSe>'
            . '</infNFSe></NFSe>';

        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($xml);

        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_schema_xml_generates_valid_pdf(): void
    {
        $xmlPath = __DIR__ . '/../schemas/208_DALTEC_601.xml';
        if (!is_file($xmlPath)) {
            $this->markTestSkipped("Fixture local ausente: {$xmlPath} (diretório schemas/ não é versionado).");
        }

        $xml = file_get_contents($xmlPath);
        $this->assertNotFalse($xml);

        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($xml);

        $this->assertStringStartsWith('%PDF-', $pdf);

        $size = strlen($pdf);
        $this->assertGreaterThan(1000, $size);
        $this->assertLessThan(5_000_000, $size);
    }

    public function test_batch_generation_all_xmls(): void
    {
        $dirs = [
            __DIR__ . '/xmls',
            __DIR__ . '/../schemas',
            __DIR__ . '/../examples',
        ];

        $generator = new DanfseGenerator();
        $total = 0;
        $success = 0;

        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                continue;
            }

            $xmlFiles = glob($dir . '/*.xml');
            foreach ($xmlFiles as $xmlFile) {
                $total++;
                $xml = file_get_contents($xmlFile);
                if ($xml === false) {
                    continue;
                }

                try {
                    $pdf = $generator->generateFromXml($xml);
                    $this->assertStringStartsWith('%PDF-', $pdf);
                    $success++;
                } catch (\Throwable $e) {
                    $this->fail("Falha ao gerar PDF para " . basename($xmlFile) . ": " . $e->getMessage());
                }
            }
        }

        $this->assertGreaterThan(0, $total, 'Nenhum XML encontrado para teste');
        $this->assertSame($total, $success, "Nem todos os XMLs geraram PDFs válidos");
    }
}
