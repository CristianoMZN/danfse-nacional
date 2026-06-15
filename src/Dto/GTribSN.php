<?php

namespace DanfseNacional\Dto;

readonly class GTribSN
{
    public function __construct(
        public string $pIBSSN = '',
        public string $vIBSSN = '',
        public string $pCBSSN = '',
        public string $vCBSSN = '',
    ) {}
}
