<?php

namespace DanfseNacional\Dto;

readonly class TotCIBS
{
    public function __construct(
        public string $vTotNF = '',
        public ?GIBS $gIBS = null,
        public ?GCBS $gCBS = null,
        public ?GTribRegular $gTribRegular = null,
        public ?GTribCompraGov $gTribCompraGov = null,
        public ?GTribSN $gTribSN = null,
    ) {}
}
