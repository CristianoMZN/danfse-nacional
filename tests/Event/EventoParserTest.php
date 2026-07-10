<?php

namespace DanfseNacional\Tests\Event;

use DanfseNacional\Event\EventoParser;
use PHPUnit\Framework\TestCase;

class EventoParserTest extends TestCase
{
    public function test_parse_cancelamento_event(): void
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<pedidoCancelamento versao="1.01" xmlns="http://www.sped.fazenda.gov.br/nfse">
  <infPedidoCancelamento Id="PC4311809261508808000179000000000100000001">
    <tpAmb>1</tpAmb>
    <verAplic>EmissorWeb_1.0</verAplic>
    <dhCancelamento>2026-01-15T10:00:00-03:00</dhCancelamento>
    <nProt>123456</nProt>
    <chNFSe>4311809261508808000179000000000000100000001</chNFSe>
    <cMotivo>2</cMotivo>
    <xMotivo>Erro operacional na emissão</xMotivo>
  </infPedidoCancelamento>
</pedidoCancelamento>
XML;

        $evento = (new EventoParser())->parseCancelamento($xml);

        $this->assertSame('PC4311809261508808000179000000000100000001', $evento->Id);
        $this->assertSame('1', $evento->tpAmb);
        $this->assertSame('EmissorWeb_1.0', $evento->verAplic);
        $this->assertSame('2026-01-15T10:00:00-03:00', $evento->dhCancelamento);
        $this->assertSame('123456', $evento->nProt);
        $this->assertSame('4311809261508808000179000000000000100000001', $evento->chNFSe);
        $this->assertSame('2', $evento->cMotivo);
        $this->assertSame('Erro operacional na emissão', $evento->xMotivo);
    }

    public function test_parse_cancelamento_with_missing_fields_returns_empty_strings(): void
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<pedidoCancelamento xmlns="http://www.sped.fazenda.gov.br/nfse">
  <infPedidoCancelamento>
    <tpAmb>2</tpAmb>
  </infPedidoCancelamento>
</pedidoCancelamento>
XML;

        $evento = (new EventoParser())->parseCancelamento($xml);

        $this->assertSame('2', $evento->tpAmb);
        $this->assertSame('', $evento->verAplic);
        $this->assertSame('', $evento->dhCancelamento);
        $this->assertSame('', $evento->nProt);
        $this->assertSame('', $evento->cMotivo);
        $this->assertSame('', $evento->xMotivo);
    }
}
