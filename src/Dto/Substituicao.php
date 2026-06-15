<?php

namespace DanfseNacional\Dto;

readonly class Substituicao
{
    public function __construct(
        public string $chSubstda = '',
        public string $cMotivo = '',
        public string $xMotivo = '',
    ) {}
}
