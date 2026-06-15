<?php

namespace DanfseNacional\Dto;

readonly class GCBS
{
    public function __construct(
        public ?GCBSCredPres $gCBSCredPres = null,
        public string $vDifCBS = '',
        public string $vCBS = '',
    ) {}
}
