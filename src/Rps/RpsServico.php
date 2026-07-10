<?php

namespace DanfseNacional\Rps;

readonly class RpsServico
{
    public function __construct(
        public string $cLocPrestacao = '',
        public string $cTribNac = '',
        public string $cNBS = '',
        public string $xDescServ = '',
    ) {}
}
