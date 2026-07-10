<?php

namespace DanfseNacional\Rps;

readonly class RpsValores
{
    public function __construct(
        public string $vServ = '',
        public string $vBC = '',
        public string $pAliq = '',
        public string $vISSQN = '',
        public string $vLiq = '',
    ) {}
}
