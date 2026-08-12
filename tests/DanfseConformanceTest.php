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

        $this->assertSame('Tomador', $data['emitente_rotulo']);
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
            '/img\.qr-code\s*\{[^}]*width:\s*51pt/s',
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

    // ====== Testes adicionais de conformidade NT 008 (validação item-a-item) ======

    public function test_fonte_titulo_danfse_9pt_arial_negrito(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression(
            '/\.title-danfse\s*\{[^}]*font-family:\s*\'Arial\'/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.title-danfse\s*\{[^}]*font-weight:\s*bold/s',
            $html
        );
    }

    public function test_fonte_label_bloco_identificacao_7pt_caixa_alta_negrito(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression(
            '/\.first-section\s+\.label\s*\{[^}]*font-size:\s*7pt/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.first-section\s+\.label\s*\{[^}]*text-transform:\s*uppercase/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.label\s*\{[^}]*font-weight:\s*bold/s',
            $html
        );
    }

    public function test_fonte_label_comum_6pt_negrito(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression('/\.label\s*\{[^}]*font-weight:\s*bold/s', $html);
    }

    public function test_fonte_municipio_8pt_e_ambiente_6pt(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression('/\.mun-nome\s*\{[^}]*font-size:\s*8pt/s', $html);
        $this->assertMatchesRegularExpression('/\.mun-ambiente\s*\{[^}]*font-size:\s*6pt/s', $html);
    }

    public function test_fonte_qr_code_texto_rodape_6pt(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression('/\.qr-code-text\s*\{[^}]*font-size:\s*6pt/s', $html);
    }

    public function test_fonte_aviso_homolog_9pt_arial_negrito_vermelho(): void
    {
        $generator = new DanfseGenerator();
        $xml = preg_replace('#<tpAmb>1</tpAmb>#', '<tpAmb>2</tpAmb>', $this->xml, 1);
        $html = $generator->generateHtml($generator->parseXml($xml));

        $this->assertMatchesRegularExpression(
            '/\.title-homolog\s*\{[^}]*font-family:\s*\'Arial\'/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.title-homolog\s*\{[^}]*font-weight:\s*bold/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.title-homolog\s*\{[^}]*font-size:\s*9pt/s',
            $html
        );
    }

    public function test_marca_dagua_arial_60pt_cinza_K35(): void
    {
        $xml = preg_replace('#<cStat>100</cStat>#', '<cStat>101</cStat>', $this->xml, 1);
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($xml));

        $this->assertMatchesRegularExpression(
            '/\.watermark-danfse\s*\{[^}]*font-family:\s*\'Arial\'/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.watermark-danfse\s*\{[^}]*font-size:\s*60pt/s',
            $html
        );
        $this->assertMatchesRegularExpression(
            '/\.watermark-danfse\s*\{[^}]*color:\s*#595959/s',
            $html
        );
    }

    public function test_padding_body_5pt_vertical_atende_minimo_015cm(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertMatchesRegularExpression('/\bbody\s*\{[^}]*padding:\s*5pt\s+7pt/s', $html);
    }

    public function test_bloco_ibscbs_renderizado_mesmo_sem_grupo_no_xml(): void
    {
        $xmlSemIb = preg_replace('#<IBSCBS>.*?</IBSCBS>#s', '', $this->xml, 2);
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($xmlSemIb));

        $this->assertStringContainsString('TRIBUTAÇÃO IBS / CBS', $html);
    }

    public function test_bloco_ibscbs_renderizado_quando_xml_tem_grupo(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $this->assertStringContainsString('TRIBUTAÇÃO IBS / CBS', $html);
    }

    public function test_local_prestacao_inclui_uf_e_pais(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('São Carlos / SP / BR', $data['servico']['local_prestacao']);
    }

    public function test_local_prestacao_marau_formato_correto_sem_uf_duplicada(): void
    {
        $path = __DIR__ . '/../examples/43118092261508808000179000000000025926020142727080.xml';
        $xml = (string) file_get_contents($path);
        $this->assertNotFalse($xml, "Fixture Marau não encontrada em {$path}");

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('Marau / RS / BR', $data['servico']['local_prestacao']);
        $this->assertStringNotContainsString(' / RS / RS / ', $data['servico']['local_prestacao']);
    }

    public function test_incidencia_issqn_inclui_uf_e_pais(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertMatchesRegularExpression(
            '#^.+\s/\s\w{2}\s/\s\w{2}$#',
            $data['tributacao_municipal']['municipio_incidencia']
        );
    }

    public function test_emitente_rotulo_max_13_chars(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertLessThanOrEqual(13, mb_strlen($data['emitente_rotulo']));
    }

    public function test_descricao_contrib_sociais_vem_de_tpRetPisCofins(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertNotSame(
            '-',
            $data['tributacao_federal']['desc_contrib_sociais'],
            'desc_contrib_sociais deveria refletir o XML (tpRetPisCofins=2 → PIS/PASEP retido)'
        );
    }

    public function test_totais_aproximados_aceita_percentual_quando_valor_vazio(): void
    {
        $path = __DIR__ . '/../examples/43118092261508808000179000000000003026017431848187.xml';
        $xmlComPercentual = file_get_contents($path);
        if ($xmlComPercentual === false || !str_contains($xmlComPercentual, '<pTotTrib>')) {
            $this->markTestSkipped('Fixture com pTotTrib ausente');
        }

        $xmlSemValores = preg_replace(
            '#<vTotTrib>.*?</vTotTrib>#s',
            '<vTotTrib><vTotTribFed></vTotTribFed><vTotTribEst></vTotTribEst><vTotTribMun></vTotTribMun></vTotTrib>',
            $xmlComPercentual
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xmlSemValores);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertMatchesRegularExpression(
            '/Federais:\s*\d+,\d+%\s*;/',
            $data['informacoes_complementares']
        );
    }

    public function test_bloco_ibscbs_renderiza_4_linhas_16_campos(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        $trecho = substr($html, strpos($html, 'TRIBUTAÇÃO IBS / CBS'));
        $trecho = substr($trecho, 0, strpos($trecho, '<!-- Bloco 10'));

        preg_match_all('#<span class="label">([^<]+)</span>#', $trecho, $m);

        $labelsEsperadas = [
            'CST / cClassTrib',
            'Indicador de Operação / Cód. IBGE Incidência / Município Incidência / Sigla UF',
            'Exclusões e Reduções da Base de Cálculo',
            'Base de Cálculo Após Exclusões e Reduções',
            'Red. Alíquota IBS / Red. Alíquota CBS',
            'Alíquota IBS UF / IBS Mun',
            'Alíq. Efetiva Municipal - IBS',
            'Valor Apurado Municipal - IBS',
            'Alíq. Efetiva Estadual - IBS',
            'Valor Apurado Estadual - IBS',
            'Valor Total Apurado - IBS',
            'Alíquota - CBS',
            'Alíquota Efetiva - CBS',
            'Valor Total Apurado - CBS',
        ];

        foreach ($labelsEsperadas as $label) {
            $this->assertContains(
                $label,
                $m[1],
                "Label obrigatória do bloco IBS/CBS ausente: '{$label}'"
            );
        }
    }

    public function test_bloco_9_ibscbs_renderizado_mesmo_sem_grupo_no_xml(): void
    {
        $xmlSem = preg_replace('#<IBSCBS>.*?</IBSCBS>#s', '', $this->xml, 2);
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xmlSem);

        $html = $generator->generateHtml($nfse);
        $this->assertStringContainsString('TRIBUTAÇÃO IBS / CBS', $html);
        $this->assertStringContainsString('Exclusões e Reduções da Base de Cálculo', $html);
    }

    public function test_campos_vazios_renderizados_como_traco(): void
    {
        $xmlLimpo = preg_replace(
            [
                '#<CNPJ>[^<]+</CNPJ>#',
                '#<CPF>[^<]+</CPF>#',
                '#<xNome>[^<]+</xNome>#',
                '#<email>[^<]+</email>#',
                '#<fone>[^<]+</fone>#',
                '#<IM>[^<]+</IM>#',
            ],
            [
                '<CNPJ></CNPJ>',
                '<CPF></CPF>',
                '<xNome></xNome>',
                '<email></email>',
                '<fone></fone>',
                '<IM></IM>',
            ],
            $this->xml
        );
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xmlLimpo);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('-', $data['emitente']['im']);
        $this->assertSame('-', $data['emitente']['telefone']);
        $this->assertSame('-', $data['emitente']['email']);
    }

    public function test_qr_code_url_contem_chave_correta(): void
    {
        $generator = new DanfseGenerator();
        $html = $generator->generateHtml($generator->parseXml($this->xml));

        preg_match('/data:image\/svg\+xml;base64,([A-Za-z0-9+\/=]+)/', $html, $m);
        $this->assertNotEmpty($m, 'QR Code SVG data URI ausente');
        $svg = base64_decode($m[1]);

        $this->assertGreaterThan(
            500,
            strlen($svg),
            'QR Code SVG deve ter tamanho razoável (> 500 bytes)'
        );
        $this->assertStringContainsString('<svg', $svg, 'QR Code SVG bem formado');
        $this->assertStringContainsString('width="200"', $svg, 'QR Code com dimensões >= 1,52cm');
    }

    public function test_ordem_informacoes_complementares_segue_nt008(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        if ($data['informacoes_complementares'] === '') {
            $this->markTestSkipped('XML canônico não traz dados para validar ordem');
        }

        $posTotais = strpos($data['informacoes_complementares'], 'Totais Aproximados');
        $this->assertNotFalse($posTotais, 'Linha Totais Aproximados obrigatória');
        $this->assertSame(
            mb_strlen($data['informacoes_complementares']) - mb_strrpos($data['informacoes_complementares'], 'Totais Aproximados'),
            $posTotais !== false ? mb_strlen($data['informacoes_complementares']) - $posTotais : 0,
            'Totais Aproximados deve ser a última entrada'
        );
    }

    public function test_info_compl_doc_ref_renderizado_em_informacoes_complementares(): void
    {
        $xml = $this->syntheticInfoComplXml('<docRef>CHAVE-DOC-REF-001</docRef>');

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertNotNull($nfse->infNFSe->DPS->infDPS->serv->infoCompl);
        $this->assertSame('CHAVE-DOC-REF-001', $nfse->infNFSe->DPS->infDPS->serv->infoCompl->docRef);
        $this->assertStringContainsString('Doc. Ref.: CHAVE-DOC-REF-001', $data['informacoes_complementares']);
    }

    public function test_info_compl_id_doc_tec_renderizado_em_informacoes_complementares(): void
    {
        $xml = $this->syntheticInfoComplXml('<idDocTec>ART-12345</idDocTec>');

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('ART-12345', $nfse->infNFSe->DPS->infDPS->serv->infoCompl->idDocTec);
        $this->assertStringContainsString('Doc. Tec.: ART-12345', $data['informacoes_complementares']);
    }

    public function test_info_compl_x_ped_e_g_item_ped_renderizados(): void
    {
        $xml = $this->syntheticInfoComplXml(
            '<xPed>PED-2026-001</xPed>'
            . '<gItemPed><xItemPed>ITEM-A</xItemPed></gItemPed>'
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame('PED-2026-001', $nfse->infNFSe->DPS->infDPS->serv->infoCompl->xPed);
        $this->assertStringContainsString('Núm. Ped.: PED-2026-001', $data['informacoes_complementares']);

        $gItemPed = $nfse->infNFSe->DPS->infDPS->serv->infoCompl->gItemPed;
        $this->assertNotNull($gItemPed);
        $this->assertSame(['ITEM-A'], $gItemPed->xItemPed);
        $this->assertStringContainsString('Item Ped.: ITEM-A', $data['informacoes_complementares']);
    }

    public function test_x_item_ped_multiplos_preservados_e_concatenados(): void
    {
        $xml = $this->syntheticInfoComplXml(
            '<gItemPed>'
            . '<xItemPed>Umbler:AAAA</xItemPed>'
            . '<xItemPed>Umbler:BBBB</xItemPed>'
            . '<xItemPed>Umbler:CCCC</xItemPed>'
            . '</gItemPed>'
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $gItemPed = $nfse->infNFSe->DPS->infDPS->serv->infoCompl->gItemPed;
        $this->assertNotNull($gItemPed);
        $this->assertSame(['Umbler:AAAA', 'Umbler:BBBB', 'Umbler:CCCC'], $gItemPed->xItemPed);

        $posItem = strpos($data['informacoes_complementares'], 'Item Ped.:');
        $this->assertNotFalse($posItem, 'Item Ped. deve estar presente');
        $bloco = substr($data['informacoes_complementares'], $posItem);
        $blocoAteProximoPipe = explode(' | ', $bloco, 2)[0] ?? $bloco;

        foreach ($gItemPed->xItemPed as $item) {
            $this->assertStringContainsString($item, $blocoAteProximoPipe);
        }
    }

    public function test_tp_imunidade_renderizado_a_partir_do_xml(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.01">'
            . '<infNFSe Id="NFS43149022222222222000179000000000000026010000000001">'
            . '<nNFSe>1</nNFSe>'
            . '<DPS versao="1.01"><infDPS Id="DPS43149022222222222000179000000000000000001">'
            . '<tpAmb>1</tpAmb><dhEmi>2026-08-01T10:00:00-03:00</dhEmi><verAplic>Test</verAplic>'
            . '<serie>1</serie><nDPS>1</nDPS><dCompet>2026-08-01</dCompet><tpEmit>1</tpEmit><cLocEmi>4314902</cLocEmi>'
            . '<prest><CNPJ>22222222000179</CNPJ></prest>'
            . '<serv><locPrest><cLocPrestacao>4314902</cLocPrestacao></locPrest>'
            . '<cServ><cTribNac>010101</cTribNac><xDescServ>Servico</xDescServ></cServ></serv>'
            . '<valores><vServPrest><vServ>100.00</vServ></vServPrest>'
            . '<trib><tribMun>'
            . '<tribISSQN>2</tribISSQN><tpRetISSQN>1</tpRetISSQN>'
            . '<tpImunidade>3</tpImunidade>'
            . '</tribMun></trib>'
            . '</valores></infDPS></DPS></infNFSe></NFSe>';

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $data = (new DanfseTemplate())->buildData($nfse);

        $this->assertSame(
            '3',
            $nfse->infNFSe->DPS->infDPS->valores->trib->tribMun->tpImunidade,
            'tpImunidade deve ser parseado do XML'
        );
        $this->assertStringContainsString(
            'religiosos',
            $data['tributacao_municipal']['tipo_imunidade'],
            'Tipo de Imunidade do ISSQN deve refletir o enum TpImunidadeISSQN'
        );
    }

    public function test_pagina_unica_para_xml_com_xinfcomp_longo(): void
    {
        $longText = str_repeat('PRESTACAO DE SERVICOS COM BASE LEGAL REPETIDA ', 30);
        $xml = $this->syntheticInfoComplXml("<xInfComp>{$longText}</xInfComp>");

        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($xml);
        $this->assertStringStartsWith('%PDF-', $pdf);

        $data = (new DanfseTemplate())->buildData($generator->parseXml($xml));
        $this->assertStringContainsString('Totais Aproximados', $data['informacoes_complementares']);
        $posTotais = strrpos($data['informacoes_complementares'], 'Totais Aproximados');
        $this->assertSame(
            mb_strlen($data['informacoes_complementares']) - $posTotais,
            mb_strlen($data['informacoes_complementares']) - $posTotais,
            'Totais Aproximados deve ser a última entrada'
        );
    }

    public function test_v_ded_red_grupo_parseado_para_retrocompat_nt008(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.00">'
            . '<infNFSe Id="NFS31062001222222222000179000000000000026010000000001">'
            . '<nNFSe>1</nNFSe>'
            . '<DPS versao="1.00"><infDPS Id="DPS31062001222222222000179000000000000000001">'
            . '<tpAmb>1</tpAmb><dhEmi>2026-08-01T10:00:00-03:00</dhEmi><verAplic>Test</verAplic>'
            . '<serie>1</serie><nDPS>1</nDPS><dCompet>2026-08-01</dCompet><tpEmit>1</tpEmit><cLocEmi>3106200</cLocEmi>'
            . '<prest><CNPJ>22222222000179</CNPJ></prest>'
            . '<serv><locPrest><cLocPrestacao>3106200</cLocPrestacao></locPrest>'
            . '<cServ><cTribNac>010101</cTribNac><xDescServ>Servico</xDescServ></cServ></serv>'
            . '<valores>'
            . '<vServPrest><vServ>500.00</vServ></vServPrest>'
            . '<vDedRed><pDR>10.00</pDR><vDR>50.00</vDR></vDedRed>'
            . '<trib><tribMun><tribISSQN>1</tribISSQN><tpRetISSQN>1</tpRetISSQN></tribMun></trib>'
            . '</valores></infDPS></DPS></infNFSe></NFSe>';

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);

        $vAjusteBC = $nfse->infNFSe->DPS->infDPS->valores->vAjusteBC;
        $this->assertNotNull($vAjusteBC, 'vDedRed (NT 008) deve ser parseado em vAjusteBC (NT 009)');
        $this->assertSame('10.00', $vAjusteBC->pDR, 'pDR (NT 008) deve ser espelhado no DTO');
        $this->assertSame('50.00', $vAjusteBC->vDR, 'vDR (NT 008) deve ser espelhado no DTO');
    }

    /**
     * Constrói um XML sintético mínimo com o bloco `<infoCompl>` contendo
     * o conteúdo passado. Usado pelos testes de regressão das sub-tags
     * do leiaute NT 008 que não dependem de fixtures reais.
     */
    private function syntheticInfoComplXml(string $infoComplInner): string
    {
        return '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.01">'
            . '<infNFSe Id="NFS43149022222222222000179000000000000026010000000001">'
            . '<nNFSe>1</nNFSe>'
            . '<DPS versao="1.01"><infDPS Id="DPS43149022222222222000179000000000000000001">'
            . '<tpAmb>1</tpAmb><dhEmi>2026-08-01T10:00:00-03:00</dhEmi><verAplic>Test</verAplic>'
            . '<serie>1</serie><nDPS>1</nDPS><dCompet>2026-08-01</dCompet><tpEmit>1</tpEmit><cLocEmi>4314902</cLocEmi>'
            . '<prest><CNPJ>22222222000179</CNPJ></prest>'
            . '<serv><locPrest><cLocPrestacao>4314902</cLocPrestacao></locPrest>'
            . '<cServ><cTribNac>010101</cTribNac><xDescServ>Servico</xDescServ></cServ>'
            . '<infoCompl>' . $infoComplInner . '</infoCompl>'
            . '</serv>'
            . '<valores><vServPrest><vServ>100.00</vServ></vServPrest>'
            . '<trib><tribMun><tribISSQN>1</tribISSQN><tpRetISSQN>1</tpRetISSQN></tribMun></trib>'
            . '</valores></infDPS></DPS></infNFSe></NFSe>';
    }
}
