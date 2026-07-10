<?php

namespace DanfseNacional\Rps;

readonly class RpsInf
{
    public function __construct(
        public string $Id = '',
        public string $tpAmb = '',
        public string $verAplic = '',
        public string $serie = '',
        public string $nRps = '',
        public string $dEmis = '',
        public ?RpsPrestador $prest = null,
        public ?RpsTomador $toma = null,
        public ?RpsServico $serv = null,
        public ?RpsValores $valores = null,
    ) {}
}
