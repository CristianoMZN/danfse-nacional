<?php

namespace DanfseNacional\Dto;

readonly class GIBSCBSAjuste
{
    public function __construct(
        public string $vIBS = '',
        public string $vCBS = '',
    ) {}
}
