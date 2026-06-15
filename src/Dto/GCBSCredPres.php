<?php

namespace DanfseNacional\Dto;

readonly class GCBSCredPres
{
    public function __construct(
        public string $pCredPresCBS = '',
        public string $vCredPresCBS = '',
    ) {}
}
