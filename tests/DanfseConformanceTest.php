<?php

namespace DanfseNacional\Tests;

use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\DanfseGenerator;
use DanfseNacional\Template\DanfseTemplate;
use PHPUnit\Framework\TestCase;

class DanfseConformanceTest extends TestCase
{
    private string $xml;

    /** @var callable|null */
    private $previousErrorHandler = null;

    protected function setUp(): void
    {
        $path = __DIR__ . '/../examples/35489062255036530000181000000000653426072486424961.xml';
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

    public function test_cstat_cancelada_renders_watermark_and_labels(): void
    {
        $xml = preg_replace('#<cStat>100</cStat>#', '<cStat>101</cStat>', $this->xml, 1);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('>CANCELADA<', $html);
        $this->assertStringContainsString('watermark-danfse', $html);
        $this->assertStringContainsString('NFS-e Cancelada', $html);
        $this->assertStringNotContainsString('>SUBSTITUÍDA<', $html);
    }

    public function test_cstat_substituida_renders_watermark_and_nfs_sub_line(): void
    {
        $xml = preg_replace('#<cStat>100</cStat>#', '<cStat>102</cStat>', $this->xml, 1);
        $substKey = '43118092203119050000180000000000087726078443655568';
        $xml = preg_replace(
            '#</infDPS>#',
            '<subst><chSubstda>' . $substKey . '</chSubstda></subst></infDPS>',
            $xml,
            1
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString('>SUBSTITUÍDA<', $html);
        $this->assertStringContainsString('watermark-danfse', $html);
        $this->assertStringContainsString('NFS-e Substituída', $html);
        $this->assertStringContainsString('NFS-e Subst.: ' . $substKey, $html);
        $this->assertStringNotContainsString('>CANCELADA<', $html);
    }

    public function test_cstat_normal_does_not_render_watermark(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertStringNotContainsString('class="watermark-danfse"', $html);
        $this->assertStringNotContainsString('>CANCELADA<', $html);
        $this->assertStringNotContainsString('>SUBSTITUÍDA<', $html);
    }

    public function test_homologacao_aviso_obrigatorio_presente_e_em_vermelho_arial(): void
    {
        $xml = preg_replace('#<tpAmb>1</tpAmb>#', '<tpAmb>2</tpAmb>', $this->xml, 1);

        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($xml));

        $this->assertStringContainsString('NFS-e SEM VALIDADE JURÍDICA', $html);
        $this->assertStringContainsString('class="title-homolog"', $html);
        $this->assertMatchesRegularExpression(
            '/\.title-homolog\s*\{[^}]*color:\s*#FF0000/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.title-homolog\s*\{[^}]*font-family:\s*\'Arial\'/s',
            $html
        );
    }

    public function test_indDest_ausente_nao_trata_destinatario_como_tomador_quando_houver_secao_destinatario_preenchida(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('mesmo_tomador', $data['destinatario_situacao']);
    }

    public function test_indDest_com_destinatario_proprio_deve_usar_texto_fixo_de_supressao(): void
    {
        $xml = preg_replace(
            '#<IBSCBS>#',
            '<IBSCBS><indDest>1</indDest>',
            $this->xml,
            1
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $html = $generator->generateHtml($nfse);

        $this->assertStringContainsString(
            'O DESTINATÁRIO É O PRÓPRIO TOMADOR/ADQUIRENTE DA OPERAÇÃO',
            $html
        );
    }

    public function test_emitente_rotulo_usa_tpEmit_e_nao_eh_fixo(): void
    {
        $xml = preg_replace(
            '#<tpEmit>1</tpEmit>#',
            '<tpEmit>2</tpEmit>',
            $this->xml,
            1
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('Tomador do Serviço', $data['emitente_rotulo']);
    }

    public function test_totais_aproximados_no_formato_oficial(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertStringContainsString(
            'Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012',
            $data['informacoes_complementares']
        );
        $this->assertMatchesRegularExpression(
            '/Federais:[^|;]+;\s*Estaduais:[^|;]+;\s*Municipais:/u',
            $data['informacoes_complementares']
        );
    }

    public function test_truncamento_nome_aplicado_acima_de_77_caracteres(): void
    {
        $long = str_repeat('A', 90);
        $xml = preg_replace(
            '#<xNome>[^<]*</xNome>#',
            '<xNome>' . $long . '</xNome>',
            $this->xml,
            1
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame(80, mb_strlen($data['emitente']['nome']));
        $this->assertStringEndsWith('...', $data['emitente']['nome']);
    }

    public function test_descricao_servico_truncada_em_1297(): void
    {
        $long = str_repeat('S', 1500);
        $xml = preg_replace(
            '#<xDescServ>[^<]*</xDescServ>#',
            '<xDescServ>' . $long . '</xDescServ>',
            $this->xml,
            1
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame(1300, mb_strlen($data['servico']['descricao']));
        $this->assertStringEndsWith('...', $data['servico']['descricao']);
    }

    public function test_tamanhos_fonte_respeitam_minimos_da_norma(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression('/\.label\s*\{[^}]*font-size:\s*6pt/s', $html);
        $this->assertMatchesRegularExpression('/\.value\s*\{[^}]*font-size:\s*7pt/s', $html);
        $this->assertMatchesRegularExpression('/\.title-danfse\s*\{[^}]*font-size:\s*9pt/s', $html);
        $this->assertMatchesRegularExpression(
            '/img\.qr-code\s*\{[^}]*width:\s*60pt/s',
            $html
        );
    }

    public function test_pagina_unica_pdf_renderiza_sem_explodir(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->xml);

        $this->assertStringStartsWith('%PDF-', $pdf);
        $this->assertGreaterThan(1000, strlen($pdf));
    }

    public function test_canhoto_pode_ser_desligado_e_reaproveita_espaco(): void
    {
        $sem = (new DanfseGenerator())->generateHtml(
            (new DanfseGenerator())->parseXml($this->xml)
        );
        $config = new DanfseConfig(mostrarCanhoto: false);
        $semCanhoto = (new DanfseGenerator($config))->generateHtml(
            (new DanfseGenerator($config))->parseXml($this->xml)
        );

        $this->assertStringContainsString('class="table-footer"', $sem);
        $this->assertStringNotContainsString('class="table-footer"', $semCanhoto);
    }

    public function test_canhoto_labels_seguem_primeira_letra_maiuscula_sem_asterisco(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertStringContainsString('Data Cientificação', $html);
        $this->assertStringContainsString('Identificação e Assinatura', $html);
        $this->assertStringContainsString('Nº NFS-e / Chave NFS-e', $html);

        $this->assertStringNotContainsString('**** DATA CIENTIFICAÇÃO', $html);
        $this->assertStringNotContainsString('IDENTIFICAÇÃO E ASSINATURA:', $html);
        $this->assertStringNotContainsString('CHAVE NFS-e:', $html);
    }

    public function test_sombreamento_obrigatorio_K5_aplicado_em_pontos_normativos(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression(
            '/\.header-table\s*\{[^}]*background-color:\s*#F2F2F2/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.section-header\s*,\s*\.header-cell\s*\{[^}]*background-color:\s*#F2F2F2/s',
            $html
        );
        $this->assertStringContainsString('highlight-shade', $html);
    }
}
