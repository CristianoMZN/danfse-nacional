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

        // NT 008 §2.4.3: em homologação, o aviso obrigatório é o texto
        // "NFS-e SEM VALIDADE JURÍDICA" no cabeçalho — não há marca d'água
        // "HOMOLOGAÇÃO" prevista na norma (marca d'água só existe para
        // NFS-e CANCELADA ou SUBSTITUÍDA, §2.5).
        $this->assertStringContainsString('NFS-e SEM VALIDADE JURÍDICA', $html);
    }

    public function test_ambiente_1_does_not_render_homologacao_watermark(): void
    {
        $xml = $this->xmlWithAmbiente(1);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

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

    public function test_header_without_branding_shows_municipio_from_xml(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('Município: São Carlos / SP', $html);
        $this->assertStringContainsString('Ambiente Gerador:', $html);
        $this->assertStringNotContainsString('Prefeitura de Niterói', $html);
    }

    public function test_header_with_branding_is_additive_to_municipio_line(): void
    {
        // NT 008 §2.4.3 e tabela do cabeçalho: o Município do emitente é campo
        // obrigatório do cabeçalho — o branding customizável do ente emitente é
        // aditivo (nunca substitui a identificação normativa).
        $config = new \DanfseNacional\Config\DanfseConfig(
            municipality: new \DanfseNacional\Config\MunicipalityBranding(
                name: 'Prefeitura de Niterói',
                department: 'Secretaria Municipal de Fazenda',
                email: 'iss@fazenda.niteroi.rj.gov.br',
            ),
        );
        $generator = new DanfseGenerator($config);
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('Município: São Carlos / SP', $html);
        $this->assertStringContainsString('Prefeitura de Niterói', $html);
        $this->assertStringContainsString('Secretaria Municipal de Fazenda', $html);
        $this->assertStringContainsString('Ambiente Gerador:', $html);
        $this->assertStringContainsString('Tipo de Ambiente:', $html);
    }

    public function test_tributacao_federal_renders_pis_and_cofins_with_distinct_values(): void
    {
        $xml = $this->xmlWithPisCofins('7.89', '4.32');

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $pisSection = $this->extractRowAfterLabel($html, 'PIS - Débito Apuração Própria');
        $cofinsSection = $this->extractRowAfterLabel($html, 'COFINS - Débito Apuração Própria');

        $this->assertStringContainsString('R$ 7,89', $pisSection);
        $this->assertStringContainsString('R$ 4,32', $cofinsSection);
        $this->assertNotSame($pisSection, $cofinsSection);
    }

    public function test_desconto_incondicionado_e_condicionado_rotulados_corretamente(): void
    {
        $xml = $this->xmlWithDescontos('123.45', '67.89');

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $incondSection = $this->extractCellAfterLabel($html, 'Desconto Incondicionado');
        $condSection = $this->extractCellAfterLabel($html, 'Desconto Condicionado');

        $this->assertStringContainsString('R$ 123,45', $incondSection);
        $this->assertStringContainsString('R$ 67,89', $condSection);
        $this->assertNotSame($incondSection, $condSection);
    }

    public function test_bloco_9_red_aliq_ibs_uses_uf_e_cbs(): void
    {
        $path = __DIR__ . '/../../examples/35503081262984091000951000001373996226063822327793.xml';
        $xmlComReducao = (string) file_get_contents($path);
        $this->assertNotFalse($xmlComReducao, "XML com pRedAliq não encontrado em {$path}");

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xmlComReducao);
        $html = $generator->generateHtml($nfse);

        $reducao = $this->extractCellAfterLabel($html, 'Red. Alíquota IBS / Red. Alíquota CBS');

        $this->assertStringContainsString('60,00%', $reducao);
        $this->assertStringNotContainsString('- /', $reducao);
        $this->assertStringNotContainsString('/ -', $reducao);
    }

    public function test_pis_cofins_oculto_para_competencia_2027_ou_posterior(): void
    {
        $xml = $this->xmlWithCompetencia('2027-01-15');

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringNotContainsString('PIS - Débito Apuração Própria', $html);
        $this->assertStringNotContainsString('COFINS - Débito Apuração Própria', $html);
    }

    public function test_pis_cofins_visivel_para_competencia_ate_2026(): void
    {
        $xml = $this->xmlWithCompetencia('2026-12-31');

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('PIS - Débito Apuração Própria', $html);
        $this->assertStringContainsString('COFINS - Débito Apuração Própria', $html);
    }

    public function test_pdf_page_margin_dentro_da_faixa_nt_008_2_2(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        preg_match('/@page\s*\{[^}]*margin:\s*([\d.]+)pt/u', $html, $m);
        $this->assertNotEmpty($m, '@page { margin: ... } não encontrado no CSS gerado');

        $pageMarginPt = (float) $m[1];
        $this->assertGreaterThanOrEqual(4.25, $pageMarginPt,
            '@page margin (' . $pageMarginPt . 'pt) abaixo do mínimo NT 008 §2.2 (0,15cm = 4.25pt)');
        $this->assertLessThanOrEqual(5.67, $pageMarginPt,
            '@page margin (' . $pageMarginPt . 'pt) acima do máximo NT 008 §2.2 (0,20cm = 5.67pt)');
    }

    public function test_pdf_body_no_print_sem_margin_e_padding_para_nao_estourar_nt_008(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $this->assertMatchesRegularExpression(
            '/@media\s+print\s*\{[^@]*body\s*\{[^}]*margin:\s*0[^}]*padding:\s*0/s',
            $html,
            'No @media print, body deve ter margin:0 e padding:0 — '
            . 'caso contrário, somam-se ao @page margin e estouram o máximo de 0,20cm da NT 008 §2.2.'
        );
    }

    public function test_pdf_body_no_print_preserva_borda_1pt_da_pagina(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $this->assertMatchesRegularExpression(
            '/@media\s+print\s*\{[^@]*body\s*\{[^}]*border:\s*(1pt|1px)[^;]*\bsolid\b/s',
            $html,
            'No @media print, body deve manter border 1pt (exigência NT 008 §2.2 — "Borda da página: 1pt").'
        );
    }

    public function test_pdf_renderiza_em_pagina_unica_nt_008_2_2(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $html = $generator->generateHtml($nfse);

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', false);
        $options->set('defaultFont', 'liberationsans');
        $options->set('defaultMediaType', 'print');
        $options->set('dpi', 96);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $this->assertSame(1, $dompdf->getCanvas()->get_page_count(),
            'DANFSe deve caber em uma única página (NT 008 §2.2).');
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

    private function xmlWithPisCofins(string $vPis, string $vCofins): string
    {
        $xml = $this->xml;
        $xml = preg_replace(
            '#<vPis>[^<]*</vPis>#',
            '<vPis>' . $vPis . '</vPis>',
            $xml,
            1
        );
        $xml = preg_replace(
            '#<vCofins>[^<]*</vCofins>#',
            '<vCofins>' . $vCofins . '</vCofins>',
            $xml,
            1
        );
        return $xml;
    }

    private function xmlWithDescontos(string $vDescIncond, string $vDescCond): string
    {
        $xml = $this->xml;
        if (!str_contains($xml, '<vDescIncond>')) {
            $xml = preg_replace(
                '#(<tribISSQN>1</tribISSQN>)#',
                '$1<vDescIncond>' . $vDescIncond . '</vDescIncond><vDescCond>' . $vDescCond . '</vDescCond>',
                $xml,
                1
            );
        } else {
            $xml = preg_replace('#<vDescIncond>[^<]*</vDescIncond>#', '<vDescIncond>' . $vDescIncond . '</vDescIncond>', $xml, 1);
            $xml = preg_replace('#<vDescCond>[^<]*</vDescCond>#', '<vDescCond>' . $vDescCond . '</vDescCond>', $xml, 1);
        }
        return $xml;
    }

    private function xmlWithCompetencia(string $dCompet): string
    {
        return preg_replace(
            '#<dCompet>[^<]*</dCompet>#',
            '<dCompet>' . $dCompet . '</dCompet>',
            $this->xml,
            1
        );
    }

    private function extractRowAfterLabel(string $html, string $label): string
    {
        $pos = strpos($html, $label);
        if ($pos === false) {
            return '';
        }
        return substr($html, $pos, 1200);
    }

    private function extractCellAfterLabel(string $html, string $label): string
    {
        $pos = strpos($html, $label);
        if ($pos === false) {
            return '';
        }
        $endTd = strpos($html, '</td>', $pos);
        if ($endTd === false) {
            return substr($html, $pos, 600);
        }
        return substr($html, $pos, $endTd - $pos + 5);
    }
}
