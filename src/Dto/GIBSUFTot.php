<?php

namespace DanfseNacional\Dto;

readonly class GIBSUFTot
{
    public function __construct(
        public string $vDifUF = '',
        public string $vIBSUF = '',
    ) {}
}
