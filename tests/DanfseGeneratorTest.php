<?php

namespace DanfseNacional\Tests;

use DanfseNacional\DanfseGenerator;
use DanfseNacional\Dto\NFSe;
use PHPUnit\Framework\TestCase;

class DanfseGeneratorTest extends TestCase
{
    private string $xml;

    protected function setUp(): void
    {
        $path = __DIR__ . '/../examples/35489062255036530000181000000000653426072486424961.xml';
        $this->xml = file_get_contents($path);
        $this->assertNotFalse($this->xml, "XML canônico não encontrado em {$path}");
    }

    public function test_parse_xml_returns_nfse_dto(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $this->assertInstanceOf(NFSe::class, $nfse);
        $this->assertNotNull($nfse->infNFSe);
    }

    public function test_parsed_dto_fields_match_xml(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $inf = $nfse->infNFSe;
        $this->assertNotNull($inf);
        $this->assertSame('6534', $inf->nNFSe);
        $this->assertSame('São Carlos', $inf->xLocEmi);

        $emit = $inf->emit;
        $this->assertNotNull($emit);
        $this->assertSame('55036530000181', $emit->CNPJ);
        $this->assertSame('MAGALU CLOUD LTDA', $emit->xNome);

        $dps = $inf->DPS;
        $this->assertNotNull($dps);

        $infDps = $dps->infDPS;
        $this->assertNotNull($infDps);
        $this->assertSame('1', $infDps->tpAmb);
        $this->assertSame('17992', $infDps->nDPS);
        $this->assertSame('2026-07-07', $infDps->dCompet);

        $toma = $infDps->toma;
        $this->assertNotNull($toma);
        $this->assertSame('02507593067', $toma->CPF);
        $this->assertSame('ELSON CRISTIANO MOZENA', $toma->xNome);
    }

    public function test_generate_from_xml_returns_pdf_binary(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->xml);

        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_generate_with_config(): void
    {
        $config = new \DanfseNacional\Config\DanfseConfig(
            municipality: new \DanfseNacional\Config\MunicipalityBranding(
                name: 'Prefeitura de Niterói',
                department: 'Secretaria Municipal de Fazenda',
                email: 'iss@fazenda.niteroi.rj.gov.br',
            ),
        );
        $generator = new DanfseGenerator($config);
        $pdf = $generator->generateFromXml($this->xml);

        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_two_step_generation(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);
        $pdf = $generator->generatePdf($nfse);

        $this->assertStringStartsWith('%PDF-', $pdf);
    }

    public function test_template_data_matches_expected(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);

        $this->assertSame('35489062255036530000181000000000653426072486424961', $data['chave_acesso']);

        $this->assertSame('55.036.530/0001-81', $data['emitente']['cnpj_cpf']);
        $this->assertSame('MAGALU CLOUD LTDA', $data['emitente']['nome']);
        $this->assertSame('São Carlos / SP', $data['emitente']['municipio']);
        $this->assertSame('13561-384', $data['emitente']['cep']);
        $this->assertSame('3548906', $data['emitente']['codigo_ibge']);

        $this->assertSame('025.075.930-67', $data['tomador']['cnpj_cpf']);
        $this->assertSame('ELSON CRISTIANO MOZENA', $data['tomador']['nome']);

        $this->assertSame('01.03.01', $data['servico']['codigo_trib_nacional']);

        $this->assertSame('R$ 44,19', $data['totais']['valor_servico']);
        $this->assertSame('R$ 44,19', $data['totais']['valor_liquido']);

        $this->assertSame(1, $data['ambiente']);

        $this->assertSame('Operação Tributável', $data['tributacao_municipal']['tributacao_issqn']);
        $this->assertSame('Não Retido', $data['tributacao_municipal']['retencao_issqn']);
        $this->assertSame('Nenhum', $data['tributacao_municipal']['regime_especial']);
        $this->assertSame('São Carlos / SP / BR', $data['tributacao_municipal']['municipio_incidencia']);

        $this->assertSame('Não Optante', $data['emitente']['simples_nacional']);

        $this->assertSame('São Carlos / SP', $data['municipio_uf']);
        $this->assertSame('Sefin Nacional NFS-e', $data['ambiente_gerador']);
        $this->assertSame('Produção', $data['tipo_ambiente']);
        $this->assertSame('NFS-e Gerada', $data['situacao_nfse']);
        $this->assertSame('-', $data['finalidade']);

        $this->assertSame('-', $data['emitente']['nif']);
        $this->assertSame('3548906', $data['emitente']['codigo_ibge']);

        $this->assertTrue($data['tomador_identificado']);
        $this->assertSame('-', $data['tomador']['nif']);
        $this->assertSame('4311809', $data['tomador']['codigo_ibge']);

        $this->assertSame('mesmo_tomador', $data['destinatario_situacao']);

        $this->assertSame('115069000', $data['servico']['codigo_nbs']);

        $this->assertTrue($data['is_sujeita_issqn']);
        $this->assertFalse($data['suppress_regime_line']);
        $this->assertTrue($data['suppress_beneficio_line']);

        $this->assertSame('R$ 0,73', $data['tributacao_federal']['pis']);
        $this->assertSame('R$ 3,36', $data['tributacao_federal']['cofins']);

        $this->assertSame('R$ 44,19', $data['totais']['total_ibs_cbs']);
        $this->assertSame('R$ 44,19', $data['totais']['valor_liquido_ibs_cbs']);

        // Formato oficial (NT 008 Nota 10): "Totais Aproximados dos Tributos cfe.
        // Lei nº 12.741/2012: Federais: ...; Estaduais: ...; Municipais: ..."
        $this->assertStringContainsString(
            'Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012',
            $data['informacoes_complementares']
        );
        $this->assertStringContainsString('Federais:', $data['informacoes_complementares']);
        $this->assertStringContainsString('Estaduais:', $data['informacoes_complementares']);
        $this->assertStringContainsString('Municipais:', $data['informacoes_complementares']);
    }

    public function test_homologacao_environment_flag(): void
    {
        $xml = str_replace('<tpAmb>1</tpAmb>', '<tpAmb>2</tpAmb>', $this->xml);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);

        $this->assertSame(2, $data['ambiente']);
    }

    public function test_generate_pdf_size_is_reasonable(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->xml);

        $size = strlen($pdf);
        $this->assertGreaterThan(1000, $size, 'PDF parece muito pequeno');
        $this->assertLessThan(5_000_000, $size, 'PDF parece muito grande');
    }

    // ========== IBS/CBS (reforma tributária) ==========

    public function test_ibscbs_inf_fields_are_populated(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $inf = $nfse->infNFSe;
        $this->assertNotNull($inf);
        $this->assertNotNull($inf->IBSCBS);

        $ibsCbs = $inf->IBSCBS;
        $this->assertSame('4311809', $ibsCbs->cLocalidadeIncid);
        $this->assertNotNull($ibsCbs->valores);
        $this->assertSame('39.22', $ibsCbs->valores->vBC);

        $this->assertSame('0.10', $ibsCbs->valores->uf?->pAliqEfetUF);
        $this->assertSame('0.00', $ibsCbs->valores->mun?->pAliqEfetMun);
        $this->assertSame('0.90', $ibsCbs->valores->fed?->pAliqEfetCBS);

        $this->assertNotNull($ibsCbs->totCIBS);
        $this->assertSame('44.19', $ibsCbs->totCIBS->vTotNF);
        $this->assertSame('0.04', $ibsCbs->totCIBS->gIBS?->vIBSTot);
        $this->assertSame('0.04', $ibsCbs->totCIBS->gIBS?->gIBSUFTot?->vIBSUF);
        $this->assertSame('0.00', $ibsCbs->totCIBS->gIBS?->gIBSMunTot?->vIBSMun);
        $this->assertSame('0.35', $ibsCbs->totCIBS->gCBS?->vCBS);
    }

    public function test_dps_ibscbs_fields(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $dps = $nfse->infNFSe->DPS;
        $this->assertNotNull($dps);

        $infDps = $dps->infDPS;
        $this->assertNotNull($infDps);

        $ibsCbsDps = $infDps->IBSCBS;
        $this->assertNotNull($ibsCbsDps);
        $this->assertSame('000', $ibsCbsDps->valores?->trib?->gIBSCBS?->CST);
        $this->assertSame('000001', $ibsCbsDps->valores?->trib?->gIBSCBS?->cClassTrib);
    }

    public function test_prestador_regime_fields(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $infDps = $nfse->infNFSe->DPS->infDPS;
        $this->assertNotNull($infDps);

        $prest = $infDps->prest;
        $this->assertNotNull($prest);
        $this->assertSame('55036530000181', $prest->CNPJ);
        $this->assertSame('0', $prest->regTrib?->regEspTrib);
        $this->assertSame('1', $prest->regTrib?->opSimpNac);
    }

    public function test_template_data_ibscbs_section(): void
    {
        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($this->xml);

        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);

        $this->assertNotEmpty($data['ibs_cbs']);
        $this->assertSame('R$ 0,04', $data['ibs_cbs']['valor_ibs_uf']);
        $this->assertSame('R$ 0,00', $data['ibs_cbs']['valor_ibs_mun']);
        $this->assertSame('R$ 0,35', $data['ibs_cbs']['valor_cbs']);
        $this->assertSame('R$ 44,19', $data['ibs_cbs']['total_ibs_cbs']);
        $this->assertSame('0,10%', $data['ibs_cbs']['aliquota_ibs_uf']);
        $this->assertSame('0,00%', $data['ibs_cbs']['aliquota_ibs_mun']);
        $this->assertSame('0,90%', $data['ibs_cbs']['aliquota_cbs']);

        $this->assertSame('000', $data['ibs_cbs']['cst']);
        $this->assertSame('000001', $data['ibs_cbs']['c_class_trib']);
        $this->assertSame('100301', $data['ibs_cbs']['c_ind_op']);
        $this->assertSame('4311809', $data['ibs_cbs']['c_localidade_incid']);
        $this->assertSame('Marau', $data['ibs_cbs']['x_localidade_incid']);
        $this->assertSame('RS', $data['ibs_cbs']['c_sigla_uf']);
        $this->assertSame('0,10%', $data['ibs_cbs']['p_ibs_uf']);
        $this->assertSame('0,00%', $data['ibs_cbs']['p_ibs_mun']);
        $this->assertSame('0,90%', $data['ibs_cbs']['p_cbs']);
        $this->assertSame('R$ 39,22', $data['ibs_cbs']['v_bc_ibscbs']);
        $this->assertSame('-', $data['ibs_cbs']['p_red_aliq_uf']);
        $this->assertSame('-', $data['ibs_cbs']['p_red_aliq_mun']);
        $this->assertSame('-', $data['ibs_cbs']['p_red_aliq_cbs']);
        $this->assertSame('R$ 0,04', $data['ibs_cbs']['v_ibs_tot']);

        $this->assertSame('R$ 44,19', $data['totais']['total_ibs_cbs']);
        $this->assertSame('R$ 44,19', $data['totais']['valor_liquido_ibs_cbs']);
    }

    public function test_generate_pdf_with_ibscbs(): void
    {
        $generator = new DanfseGenerator();
        $pdf = $generator->generateFromXml($this->xml);

        $this->assertStringStartsWith('%PDF-', $pdf);

        $size = strlen($pdf);
        $this->assertGreaterThan(1000, $size, 'PDF com IBS/CBS parece muito pequeno');
        $this->assertLessThan(5_000_000, $size, 'PDF com IBS/CBS parece muito grande');
    }

    // ========== v1.01 sem bloco IBS/CBS ==========

    public function test_renders_without_ibscbs_block(): void
    {
        $xml = preg_replace(
            '#<IBSCBS>.*?</IBSCBS>#s',
            '',
            $this->xml
        );

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $pdf = $generator->generateFromXml($xml);

        $this->assertStringStartsWith('%PDF-', $pdf);
        $this->assertNotNull($nfse->infNFSe);
        $this->assertNull($nfse->infNFSe->IBSCBS);
        $this->assertNull($nfse->infNFSe->DPS->infDPS->IBSCBS);

        $template = new \DanfseNacional\Template\DanfseTemplate();
        $data = $template->buildData($nfse);
        $this->assertFalse($data['ibscbs_has_data']);
    }

    public function test_xml_without_ibscbs_is_loaded_from_fixture(): void
    {
        $path = __DIR__ . '/../examples/35503081225012398000107000001664015826030291827322.xml';
        $xml = file_get_contents($path);
        $this->assertNotFalse($xml);

        $generator = new DanfseGenerator();
        $nfse = $generator->parseXml($xml);
        $this->assertNull($nfse->infNFSe->IBSCBS);
        $this->assertNull($nfse->infNFSe->DPS->infDPS->IBSCBS);

        $pdf = $generator->generateFromXml($xml);
        $this->assertStringStartsWith('%PDF-', $pdf);
    }
}
