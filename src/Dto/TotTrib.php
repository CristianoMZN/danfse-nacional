<?php

namespace DanfseNacional\Dto;

readonly class TotTrib
{
    public function __construct(
        public string $vTotTribFed = '',
        public string $vTotTribEst = '',
        public string $vTotTribMun = '',
        public ?TotTribPercent $pTotTrib = null,
        public string $indTotTrib = '',
        public string $pTotTribSN = '',
    ) {}
}
