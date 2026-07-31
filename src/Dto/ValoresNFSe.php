<?php

namespace DanfseNacional\Dto;

readonly class ValoresNFSe
{
    public function __construct(
        public string $vCalcAjusteBCISSQN = '',
        public string $vCalcDR = '',
        public string $tpBM = '',
        public string $vCalcBM = '',
        public string $vBC = '',
        public string $pAliqAplic = '',
        public string $vISSQN = '',
        public string $vTotalRet = '',
        public string $vLiq = '',
        public string $xOutInf = '',
    ) {}
}
