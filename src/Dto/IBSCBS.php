<?php

namespace DanfseNacional\Dto;

readonly class IBSCBS
{
    public function __construct(
        public string $cLocalidadeIncid = '',
        public string $xLocalidadeIncid = '',
        public string $pRedutor = '',
        public ?IBSCBSValores $valores = null,
        public ?TotCIBS $totCIBS = null,
    ) {}
}
