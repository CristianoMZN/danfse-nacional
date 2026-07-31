<?php

namespace DanfseNacional\Tests;

use DanfseNacional\XmlToArray;
use PHPUnit\Framework\TestCase;

class XmlToArrayTest extends TestCase
{
    private XmlToArray $converter;

    protected function setUp(): void
    {
        $this->converter = new XmlToArray();
    }

    public function test_converts_simple_xml(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<root xmlns="http://www.sped.fazenda.gov.br/nfse">'
            . '<child>value</child>'
            . '</root>';

        $result = $this->converter->convert($xml);
        $this->assertSame('value', $result['child']);
    }

    public function test_extracts_attributes(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<root xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.01">'
            . '<child attr="test">value</child>'
            . '</root>';

        $result = $this->converter->convert($xml);
        $this->assertSame('1.01', $result['versao']);
    }

    public function test_excludes_signature_elements(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<root xmlns="http://www.sped.fazenda.gov.br/nfse">'
            . '<data>value</data>'
            . '<Signature xmlns="http://www.w3.org/2000/09/xmldsig#"><SignedInfo/></Signature>'
            . '</root>';

        $result = $this->converter->convert($xml);
        $this->assertSame('value', $result['data']);
        $this->assertArrayNotHasKey('Signature', $result);
    }

    public function test_parses_real_nfse_xml(): void
    {
        $xml = file_get_contents(__DIR__ . '/../examples/35489062255036530000181000000000653426072486424961.xml');
        $this->assertNotFalse($xml);

        $result = $this->converter->convert($xml);

        $this->assertArrayHasKey('infNFSe', $result);
        $inf = $result['infNFSe'];

        $this->assertSame('NFS35489062255036530000181000000000653426072486424961', $inf['Id']);
        $this->assertSame('6534', $inf['nNFSe']);
        $this->assertSame('São Carlos', $inf['xLocEmi']);
        $this->assertSame('55036530000181', $inf['emit']['CNPJ']);
        $this->assertSame('13561384', $inf['emit']['enderNac']['CEP']);

        $this->assertArrayHasKey('DPS', $inf);
        $this->assertSame('1', $inf['DPS']['infDPS']['tpAmb']);
        $this->assertSame('17992', $inf['DPS']['infDPS']['nDPS']);
        $this->assertSame('55036530000181', $inf['DPS']['infDPS']['prest']['CNPJ']);
        $this->assertArrayNotHasKey('CNPJ', $inf['DPS']['infDPS']['toma']);
        $this->assertSame('02507593067', $inf['DPS']['infDPS']['toma']['CPF']);
    }

    public function test_repeatable_xItemPed_preserves_all_occurrences(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse">'
            . '<DPS><infDPS><serv><infoCompl><gItemPed>'
            . '<xItemPed>Umbler:A</xItemPed>'
            . '<xItemPed>Umbler:B</xItemPed>'
            . '<xItemPed>Umbler:C</xItemPed>'
            . '</gItemPed></infoCompl></serv></infDPS></DPS>'
            . '</NFSe>';

        $result = $this->converter->convert($xml);

        $this->assertSame(
            ['Umbler:A', 'Umbler:B', 'Umbler:C'],
            $result['DPS']['infDPS']['serv']['infoCompl']['gItemPed']['xItemPed']
        );
    }

    public function test_repeatable_xItemPed_single_occurrence_is_also_list(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse">'
            . '<DPS><infDPS><serv><infoCompl><gItemPed>'
            . '<xItemPed>Umbler:only</xItemPed>'
            . '</gItemPed></infoCompl></serv></infDPS></DPS>'
            . '</NFSe>';

        $result = $this->converter->convert($xml);

        $this->assertSame(
            ['Umbler:only'],
            $result['DPS']['infDPS']['serv']['infoCompl']['gItemPed']['xItemPed']
        );
    }

    public function test_non_repeatable_element_keeps_scalar_even_with_multiple_occurrences(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse">'
            . '<infNFSe><nNFSe>1</nNFSe><nNFSe>2</nNFSe></infNFSe>'
            . '</NFSe>';

        $result = $this->converter->convert($xml);

        $this->assertSame('2', $result['infNFSe']['nNFSe']);
    }

    public function test_repeatable_refNFSe_in_gRefNFSe(): void
    {
        $xml = '<?xml version="1.0" encoding="utf-8"?>'
            . '<NFSe xmlns="http://www.sped.fazenda.gov.br/nfse">'
            . '<DPS><infDPS><IBSCBS><gRefNFSe>'
            . '<refNFSe>CHAVE-001</refNFSe>'
            . '<refNFSe>CHAVE-002</refNFSe>'
            . '</gRefNFSe></IBSCBS></infDPS></DPS>'
            . '</NFSe>';

        $result = $this->converter->convert($xml);

        $this->assertSame(
            ['CHAVE-001', 'CHAVE-002'],
            $result['DPS']['infDPS']['IBSCBS']['gRefNFSe']['refNFSe']
        );
    }
}
