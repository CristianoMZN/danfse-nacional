<?php

namespace DanfseNacional\Event;

use DanfseNacional\XmlToArray;

class EventoParser
{
    public function parseCancelamento(string $xml): Cancelamento
    {
        $array = (new XmlToArray())->convert($xml);

        $inf = $array['pedidoCancelamento']['infPedidoCancelamento']
            ?? $array['infPedidoCancelamento']
            ?? $array;

        return new Cancelamento(
            Id: (string) ($inf['Id'] ?? ''),
            tpAmb: (string) ($inf['tpAmb'] ?? ''),
            verAplic: (string) ($inf['verAplic'] ?? ''),
            dhCancelamento: (string) ($inf['dhCancelamento'] ?? ''),
            nProt: (string) ($inf['nProt'] ?? ''),
            chNFSe: (string) ($inf['chNFSe'] ?? ''),
            cMotivo: (string) ($inf['cMotivo'] ?? ''),
            xMotivo: (string) ($inf['xMotivo'] ?? ''),
        );
    }
}
