<?php

namespace DanfseNacional\Dto;

readonly class GDif
{
    public function __construct(
        public string $pDifUF = '',
        public string $pDifMun = '',
        public string $pDifCBS = '',
    ) {}
}
