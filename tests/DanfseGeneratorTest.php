<?php

namespace DanfseNacional\Tests;

use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\MunicipalityBranding;
use DanfseNacional\DanfseGenerator;
use DanfseNacional\Dto\NFSe;
use PHPUnit\Framework\TestCase;

class DanfseGeneratorTest extends TestCase
{
    private string $realXml;
    private string $v2Xml;

    protected function setUp(): void
    {
        $path = __DIR__ . '/../examples/nfse_exemplo.xml';
        $this->realXml = file_get_contents($path);
        $this->assertNotFalse($this->realXml, "real_nfse.xml não encontrado em $path");

        $v2Path = __DIR__ . '/../examples/nfse_exemplo_v2.xml';
        $this->v2Xml = file_get_contents($v2Path);
        $this->assertNotFalse($this->v2Xml, "nfse_exemplo_v2.xml não encontrado em $v2Path");
    }

    public function test_parse_xml_returns_nfse_dto(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->realXml);

        $this->assertInstanceOf(NFSe::class, $nfse);
        $this->assertNotNull($nfse->infNFSe);
    }

    public function test_parsed_dto_fields_match_xml(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->realXml);

        $inf = $nfse->infNFSe;
        $this->assertNotNull($inf);
        $this->assertSame('10', $inf->nNFSe);
        $this->assertSame('Niterói', $inf->xLocEmi);

        $emit = $inf->emit;
        $this->assertNotNull($emit);
        $this->assertSame('11222333000181', $emit->CNPJ);
        $this->assertSame('EMPRESA EXEMPLO DESENVOLVIMENTO LTDA', $emit->xNome);

        $dps = $inf->DPS;
        $this->assertNotNull($dps);

        $infDps = $dps->infDPS;
        $this->assertNotNull($infDps);
        $this->assertSame('1', $infDps->tpAmb);
        $this->assertSame('5', $infDps->nDPS);
        $this->assertSame('2026-01-15', $infDps->dCompet);

        $toma = $infDps->toma;
        $this->assertNotNull($toma);
        $this->assertSame('91712343000134', $toma->CNPJ);
        $this->assertSame('CLIENTE FICTICIO COMERCIO S.A.', $toma->xNome);
    }

    public function test_generate_from_xml_returns_pdf_binary(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->realXml);

        // Verifica assinatura do PDF (%PDF-)
        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_generate_with_config(): void
    {
        $config = new DanfseConfig(
            municipality: new MunicipalityBranding(
                name: 'Prefeitura de Niterói',
                department: 'Secretaria Municipal de Fazenda',
                email: 'iss@fazenda.niteroi.rj.gov.br',
            ),
        );
        $generator = new DanfseGenerator($config);
        $pdf = $generator->generateFromXml($this->realXml);

        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_two_step_generation(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->realXml);
        $pdf = $generator->generatePdf($nfse);

        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_template_data_matches_expected(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->realXml);

        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);

        // Chave de acesso (sem prefixo NFS)
        $this->assertSame('3303302112233450000195000000000000100000000001', $data['chave_acesso']);

        // Emitente
        $this->assertSame('11.222.333/0001-81', $data['emitente']['cnpj_cpf']);
        $this->assertSame('EMPRESA EXEMPLO DESENVOLVIMENTO LTDA', $data['emitente']['nome']);
        $this->assertSame('Niterói - RJ', $data['emitente']['municipio']);
        $this->assertSame('24020-005', $data['emitente']['cep']);

        // Tomador
        $this->assertSame('91.712.343/0001-34', $data['tomador']['cnpj_cpf']);
        $this->assertSame('CLIENTE FICTICIO COMERCIO S.A.', $data['tomador']['nome']);

        // Serviço
        $this->assertSame('01.07.00', $data['servico']['codigo_trib_nacional']);

        // Totais
        $this->assertSame('R$ 1.500,00', $data['totais']['valor_servico']);
        $this->assertSame('R$ 1.292,75', $data['totais']['valor_liquido']);

        // Ambiente
        $this->assertSame(1, $data['ambiente']);

        // Tributação municipal
        $this->assertSame('Operação Tributável', $data['tributacao_municipal']['tributacao_issqn']);
        $this->assertSame('Retido pelo Tomador', $data['tributacao_municipal']['retencao_issqn']);
        $this->assertSame('Sociedade de Profissionais', $data['tributacao_municipal']['regime_especial']);
        $this->assertSame('Niterói', $data['tributacao_municipal']['municipio_incidencia']);

        // Emitente: Simples Nacional
        $this->assertSame(
            'Não Optante',
            $data['emitente']['simples_nacional'],
        );

        // Header novos campos
        $this->assertSame('Niterói - RJ', $data['municipio_uf']);
        $this->assertSame('1', $data['ambiente_gerador']);
        $this->assertSame('Produção', $data['tipo_ambiente']);
        $this->assertSame('NFS-e Normal', $data['situacao_nfse']);
        $this->assertSame('-', $data['finalidade']);

        // Emitente: NIF e código IBGE
        $this->assertSame('-', $data['emitente']['nif']);
        $this->assertSame('3303302', $data['emitente']['codigo_ibge']);

        // Tomador: identificado
        $this->assertTrue($data['tomador_identificado']);
        $this->assertSame('-', $data['tomador']['nif']);
        $this->assertSame('3550308', $data['tomador']['codigo_ibge']);

        // Destinatário: mesmo tomador
        $this->assertSame('mesmo_tomador', $data['destinatario_situacao']);

        // Serviço: NBS
        $this->assertSame('-', $data['servico']['codigo_nbs']);

        // Tributação municipal: suppress lines
        $this->assertTrue($data['is_sujeita_issqn']);
        $this->assertFalse($data['suppress_regime_line']);
        $this->assertFalse($data['suppress_beneficio_line']);

        // Tributação federal: contrib_sociais
        $this->assertSame('R$ 30,00', $data['tributacao_federal']['contrib_sociais']);
        $this->assertSame('CSLL e Contribuição Previdenciária', $data['tributacao_federal']['desc_contrib_sociais']);

        // Totais: novo campo
        $this->assertSame('-', $data['totais']['total_ibs_cbs']);
        $this->assertSame('R$ 1.292,75', $data['totais']['valor_liquido_ibs_cbs']);

        // Informações complementares contém Totais Aproximados
        $this->assertStringContainsString('Totais Aproximados dos Tributos', $data['informacoes_complementares']);
        $this->assertStringContainsString('Federal:', $data['informacoes_complementares']);
    }

    public function test_homologacao_environment_flag(): void
    {
        // Substitui tpAmb=1 (produção) por tpAmb=2 (homologação)
        $xml = str_replace('<tpAmb>1</tpAmb>', '<tpAmb>2</tpAmb>', $this->realXml);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);

        $this->assertSame(2, $data['ambiente']);
    }

    public function test_generate_pdf_size_is_reasonable(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->realXml);

        // Um PDF de A4 válido deve ter pelo menos 1KB e no máximo ~5MB
        $size = strlen($pdf);
        $this->assertGreaterThan(1000, $size, 'PDF parece muito pequeno');
        $this->assertLessThan(5_000_000, $size, 'PDF parece muito grande');
    }

    // ========== v2.0 (NT 008/2026 + NT 009/2026) ==========

    public function test_v2_parse_returns_nfse_dto(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);

        $this->assertInstanceOf(NFSe::class, $nfse);
        $this->assertNotNull($nfse->infNFSe);
    }

    public function test_v2_ibscbs_fields_are_populated(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);

        $inf = $nfse->infNFSe;
        $this->assertNotNull($inf);
        $this->assertNotNull($inf->IBSCBS);

        // IBSCBS valores
        $ibsCbs = $inf->IBSCBS;
        $this->assertSame('3303302', $ibsCbs->cLocalidadeIncid);
        $this->assertNotNull($ibsCbs->valores);
        $this->assertSame('1500.00', $ibsCbs->valores->vBC);

        // Alíquotas
        $this->assertSame('1.00', $ibsCbs->valores->uf?->pAliqEfetUF);
        $this->assertSame('2.00', $ibsCbs->valores->mun?->pAliqEfetMun);
        $this->assertSame('8.00', $ibsCbs->valores->fed?->pAliqEfetCBS);

        // TotCIBS
        $this->assertNotNull($ibsCbs->totCIBS);
        $this->assertSame('1500.00', $ibsCbs->totCIBS->vTotNF);
        $this->assertSame('45.00', $ibsCbs->totCIBS->gIBS?->vIBSTot);
        $this->assertSame('15.00', $ibsCbs->totCIBS->gIBS?->gIBSUFTot?->vIBSUF);
        $this->assertSame('30.00', $ibsCbs->totCIBS->gIBS?->gIBSMunTot?->vIBSMun);
        $this->assertSame('120.00', $ibsCbs->totCIBS->gCBS?->vCBS);
    }

    public function test_v2_dps_ibscbs_fields(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);

        $dps = $nfse->infNFSe->DPS;
        $this->assertNotNull($dps);

        $infDps = $dps->infDPS;
        $this->assertNotNull($infDps);
        $this->assertSame('1', $infDps->finNFSe);

        $ibsCbsDps = $infDps->IBSCBS;
        $this->assertNotNull($ibsCbsDps);
        $this->assertSame('1', $ibsCbsDps->indFinal);
        $this->assertSame('100', $ibsCbsDps->valores?->trib?->gIBSCBS?->CST);
    }

    public function test_v2_prestador_and_intermediario_new_fields(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);

        $infDps = $nfse->infNFSe->DPS->infDPS;
        $this->assertNotNull($infDps);

        // Prestador: IM, xNome, regApIBSCBSSN
        $prest = $infDps->prest;
        $this->assertNotNull($prest);
        $this->assertSame('0001234', $prest->IM);
        $this->assertSame('EMPRESA EXEMPLO DESENVOLVIMENTO LTDA', $prest->xNome);
        $this->assertSame('1', $prest->regTrib?->regApIBSCBSSN);

        // Intermediário: IM (renomeado de IMPrestMun)
        $interm = $infDps->interm;
        $this->assertNotNull($interm);
        $this->assertSame('654321', $interm->IM);
    }

    public function test_v2_totais_tributos_values(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);

        $totTrib = $nfse->infNFSe->DPS->infDPS->valores?->trib?->totTrib;
        $this->assertNotNull($totTrib);
        $this->assertSame('67.50', $totTrib->vTotTribFed);
        $this->assertSame('2.70', $totTrib->vTotTribEst);
        $this->assertSame('27.00', $totTrib->vTotTribMun);
    }

    public function test_v2_template_data_ibscbs_section(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->v2Xml);

        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);

        // IBS/CBS section should be populated
        $this->assertNotEmpty($data['ibs_cbs']);
        $this->assertSame('R$ 15,00', $data['ibs_cbs']['valor_ibs_uf']);
        $this->assertSame('R$ 30,00', $data['ibs_cbs']['valor_ibs_mun']);
        $this->assertSame('R$ 120,00', $data['ibs_cbs']['valor_cbs']);
        $this->assertSame('R$ 1.500,00', $data['ibs_cbs']['total_ibs_cbs']);
        $this->assertSame('1,00%', $data['ibs_cbs']['aliquota_ibs_uf']);
        $this->assertSame('2,00%', $data['ibs_cbs']['aliquota_ibs_mun']);
        $this->assertSame('8,00%', $data['ibs_cbs']['aliquota_cbs']);

        // IBS/CBS expanded fields
        $this->assertSame('100', $data['ibs_cbs']['cst']);
        $this->assertSame('0001', $data['ibs_cbs']['c_class_trib']);
        $this->assertSame('-', $data['ibs_cbs']['c_ind_op']);
        $this->assertSame('3303302', $data['ibs_cbs']['c_localidade_incid']);
        $this->assertSame('Niterói', $data['ibs_cbs']['x_localidade_incid']);
        $this->assertSame('1,00%', $data['ibs_cbs']['p_ibs_uf']);
        $this->assertSame('2,00%', $data['ibs_cbs']['p_ibs_mun']);
        $this->assertSame('8,00%', $data['ibs_cbs']['p_cbs']);
        $this->assertSame('R$ 1.500,00', $data['ibs_cbs']['v_bc_ibscbs']);
        $this->assertSame('0,00%', $data['ibs_cbs']['p_red_aliq_uf']);
        $this->assertSame('0,00%', $data['ibs_cbs']['p_red_aliq_mun']);
        $this->assertSame('0,00%', $data['ibs_cbs']['p_red_aliq_cbs']);
        $this->assertSame('R$ 45,00', $data['ibs_cbs']['v_ibs_tot']);

        // IBS/CBS no totais
        $this->assertSame('R$ 1.500,00', $data['totais']['total_ibs_cbs']);
        $this->assertSame('R$ 1.500,00', $data['totais']['valor_liquido_ibs_cbs']);
    }

    public function test_v2_generate_pdf(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->v2Xml);

        $this->assertStringStartsWith('%PDF-', $pdf);

        $size = strlen($pdf);
        $this->assertGreaterThan(1000, $size, 'v2.0 PDF parece muito pequeno');
        $this->assertLessThan(5_000_000, $size, 'v2.0 PDF parece muito grande');
    }

    public function test_v1_and_v2_coexist(): void
    {
        $generator = new DanfseGenerator();

        $pdfV1 = $generator->generateFromXml($this->realXml);
        $pdfV2 = $generator->generateFromXml($this->v2Xml);

        $this->assertStringStartsWith('%PDF-', $pdfV1);
        $this->assertStringStartsWith('%PDF-', $pdfV2);

        // v2.0 should produce a different (likely larger) PDF due to IBS/CBS section
        $this->assertNotSame($pdfV1, $pdfV2);
    }
}
