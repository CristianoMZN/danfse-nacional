<?php

namespace DanfseNacional\Dto;

readonly class ComExt
{
    public function __construct(
        public string $mdPrestacao = '',
        public string $vincPrest = '',
        public string $tpMoeda = '',
        public string $vServMoeda = '',
        public string $mecAFComexP = '',
        public string $mecAFComexT = '',
        public string $movTempBens = '',
        public string $nDI = '',
        public string $nRE = '',
        public string $mdic = '',
    ) {}
}
