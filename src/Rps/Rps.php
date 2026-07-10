<?php

namespace DanfseNacional\Rps;

readonly class Rps
{
    public function __construct(
        public string $Id = '',
        public string $versao = '',
        public ?RpsInf $infRps = null,
    ) {}
}
