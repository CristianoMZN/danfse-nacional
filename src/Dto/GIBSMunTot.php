<?php

namespace DanfseNacional\Dto;

readonly class GIBSMunTot
{
    public function __construct(
        public string $vDifMun = '',
        public string $vIBSMun = '',
    ) {}
}
