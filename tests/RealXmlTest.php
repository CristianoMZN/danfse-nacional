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

    public function test_xml_without_tomador_generates_pdf_without_warnings(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.01">'
            . '<infNFSe Id="NFS43118092228252000000106000000000065326063370231116">'
            . '<xLocEmi>Marau</xLocEmi><xLocPrestacao>Marau</xLocPrestacao>'
            . '<nNFSe>653</nNFSe><cLocIncid>4311809</cLocIncid><xLocIncid>Marau</xLocIncid>'
            . '<xTribNac>Barbearia, cabeleireiros, manicuros, pedicuros e congêneres.</xTribNac>'
            . '<verAplic>EmissorWeb_1.6.0.0</verAplic><ambGer>2</ambGer><tpEmis>1</tpEmis>'
            . '<procEmi>2</procEmi><cStat>100</cStat>'
            . '<dhProc>2026-06-19T16:13:26-03:00</dhProc><nDFSe>496970</nDFSe>'
            . '<emit><CNPJ>28252000000106</CNPJ>'
            . '<xNome>ANGELA CRISTINA COLUSSI DOS SANTOS</xNome>'
            . '<enderNac><xLgr>RUA ANTONIO PORTO</xLgr><nro>54</nro>'
            . '<xBairro>JOSE PRIMO BERNARDI</xBairro><cMun>4311809</cMun><UF>RS</UF>'
            . '<CEP>99150000</CEP></enderNac>'
            . '<fone>5492690438</fone></emit>'
            . '<valores><vLiq>239.90</vLiq></valores>'
            . '<DPS versao="1.01">'
            . '<infDPS Id="DPS431180922825200000010670000000000000000544">'
            . '<tpAmb>1</tpAmb><dhEmi>2026-06-19T16:13:26-03:00</dhEmi>'
            . '<verAplic>EmissorWeb_1.6.0.0</verAplic><serie>70000</serie><nDPS>544</nDPS>'
            . '<dCompet>2026-06-19</dCompet><tpEmit>1</tpEmit><cLocEmi>4311809</cLocEmi>'
            . '<prest><CNPJ>28252000000106</CNPJ><fone>5492690438</fone>'
            . '<regTrib><opSimpNac>3</opSimpNac><regApTribSN>1</regApTribSN>'
            . '<regEspTrib>0</regEspTrib></regTrib></prest>'
            . '<serv><locPrest><cLocPrestacao>4311809</cLocPrestacao></locPrest>'
            . '<cServ><cTribNac>060101</cTribNac><xDescServ>Hidratação</xDescServ>'
            . '</cServ></serv>'
            . '<valores><vServPrest><vServ>239.90</vServ></vServPrest><trib>'
            . '<tribMun><tribISSQN>1</tribISSQN><tpRetISSQN>1</tpRetISSQN></tribMun>'
            . '<tribFed><piscofins><CST>00</CST></piscofins></tribFed>'
            . '<totTrib><pTotTribSN>9.67</pTotTribSN></totTrib>'
            . '</trib></valores>'
            . '</infDPS></DPS>'
            . '</infNFSe></NFSe>';

        $generator = new DanfseGenerator();

        $errors = [];
        set_error_handler(function (int $errno, string $errstr) use (&$errors) {
            $errors[] = $errstr;
            return true;
        });

        try {
            $pdf = $generator->generateFromXml($xml);
        } finally {
            restore_error_handler();
        }

        $this->assertStringStartsWith('%PDF-', $pdf);
        $this->assertNotEmpty($pdf);
        $this->assertSame([], $errors, 'Nenhum warning deve ser emitido: ' . implode(' | ', $errors));

        $nfse = $generator->parseXml($xml);
        $template = new DanfseTemplate();
        $data = $template->buildData($nfse);

        $this->assertFalse($data['tomador_identificado']);
        $this->assertSame('-', $data['tomador']['email']);
        $this->assertSame('-', $data['tomador']['nome']);
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

    public function test_rendered_html_contains_embedded_nfse_logo(): void
    {
        $xmlPath = __DIR__ . '/xmls/43118092261508808000179000000000025926020142727080.xml';
        $xml = file_get_contents($xmlPath);
        $this->assertNotFalse($xml);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('<td class="logo-cell">', $html);
        $this->assertMatchesRegularExpression(
            '#<td class="logo-cell">\s*<img src="(data:image/png;base64,[^"]{1000,})" alt="NFS-e"#s',
            $html,
            'Logo NFS-e deve ser renderizada incondicionalmente no template, como data URI base64 da DefaultLogo::DATA_URI.',
        );
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
