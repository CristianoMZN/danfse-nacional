<?php

namespace DanfseNacional\Tests\Rps;

use DanfseNacional\Rps\RpsParser;
use PHPUnit\Framework\TestCase;

class RpsParserTest extends TestCase
{
    public function test_parse_rps(): void
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<RPS versao="1.01" xmlns="http://www.sped.fazenda.gov.br/nfse">
  <infRPS Id="RPS4311809261508808000179000000000000000001">
    <tpAmb>1</tpAmb>
    <verAplic>EmissorWeb_1.0</verAplic>
    <serie>1</serie>
    <nRPS>1</nRPS>
    <dEmis>2026-01-15</dEmis>
    <prest>
      <CNPJ>61508808000179</CNPJ>
      <IM>12345</IM>
      <xNome>EMPRESA TESTE LTDA</xNome>
    </prest>
    <toma>
      <CPF>02507593067</CPF>
      <xNome>JOAO DA SILVA</xNome>
      <fone>11999998888</fone>
      <email>joao@example.com</email>
    </toma>
    <serv>
      <locPrest>
        <cLocPrestacao>4311809</cLocPrestacao>
      </locPrest>
      <cServ>
        <cTribNac>080201</cTribNac>
        <cNBS>115069000</cNBS>
        <xDescServ>PLANO DE TREINAMENTO</xDescServ>
      </cServ>
    </serv>
    <valores>
      <vServPrest>
        <vServ>800.00</vServ>
      </vServPrest>
      <trib>
        <tribMun>
          <tribISSQN>1</tribISSQN>
          <tpRetISSQN>1</tpRetISSQN>
          <pAliq>2.00</pAliq>
          <vBC>800.00</vBC>
          <vISSQN>16.00</vISSQN>
        </tribMun>
      </trib>
    </valores>
  </infRPS>
</RPS>
XML;

        $rps = (new RpsParser())->parse($xml);

        $this->assertSame('1.01', $rps->versao);
        $this->assertSame('RPS4311809261508808000179000000000000000001', $rps->infRps->Id);
        $this->assertSame('1', $rps->infRps->tpAmb);
        $this->assertSame('1', $rps->infRps->serie);
        $this->assertSame('1', $rps->infRps->nRps);
        $this->assertSame('2026-01-15', $rps->infRps->dEmis);

        $this->assertSame('61508808000179', $rps->infRps->prest->CNPJ);
        $this->assertSame('12345', $rps->infRps->prest->IM);
        $this->assertSame('EMPRESA TESTE LTDA', $rps->infRps->prest->xNome);

        $this->assertSame('02507593067', $rps->infRps->toma->CPF);
        $this->assertSame('JOAO DA SILVA', $rps->infRps->toma->xNome);

        $this->assertSame('4311809', $rps->infRps->serv->cLocPrestacao);
        $this->assertSame('080201', $rps->infRps->serv->cTribNac);
        $this->assertSame('PLANO DE TREINAMENTO', $rps->infRps->serv->xDescServ);

        $this->assertSame('800.00', $rps->infRps->valores->vServ);
        $this->assertSame('800.00', $rps->infRps->valores->vBC);
        $this->assertSame('2.00', $rps->infRps->valores->pAliq);
        $this->assertSame('16.00', $rps->infRps->valores->vISSQN);
    }

    public function test_parse_rps_with_missing_fields_returns_empty_strings(): void
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<RPS xmlns="http://www.sped.fazenda.gov.br/nfse">
  <infRPS>
    <tpAmb>2</tpAmb>
  </infRPS>
</RPS>
XML;

        $rps = (new RpsParser())->parse($xml);

        $this->assertSame('', $rps->versao);
        $this->assertSame('2', $rps->infRps->tpAmb);
        $this->assertSame('', $rps->infRps->serie);
        $this->assertSame('', $rps->infRps->nRps);
        $this->assertSame('', $rps->infRps->prest->CNPJ);
        $this->assertSame('', $rps->infRps->toma->xNome);
        $this->assertSame('', $rps->infRps->serv->cTribNac);
        $this->assertSame('', $rps->infRps->valores->vServ);
    }
}
