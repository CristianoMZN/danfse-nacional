<?php

namespace DanfseNacional\Dto;

readonly class GIBSCredPres
{
    public function __construct(
        public string $pCredPres = '',
        public string $vCredPres = '',
    ) {}
}
