<?php

namespace DanfseNacional\Event;

readonly class Cancelamento
{
    public function __construct(
        public string $Id = '',
        public string $tpAmb = '',
        public string $verAplic = '',
        public string $dhCancelamento = '',
        public string $nProt = '',
        public string $chNFSe = '',
        public string $cMotivo = '',
        public string $xMotivo = '',
    ) {}
}
