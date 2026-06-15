<?php

namespace DanfseNacional\Dto;

readonly class GLocacao
{
    public function __construct(
        public string $pCopropriedade = '',
        public string $vTotOper = '',
        public string $vDescIncondTot = '',
        public string $vDescCondTot = '',
        public string $dVencOrig = '',
    ) {}
}
