<?php

namespace DanfseNacional\Dto;

readonly class IBSCBSFed
{
    public function __construct(
        public string $pCBS = '',
        public string $pRedAliqCBS = '',
        public string $pAliqEfetCBS = '',
    ) {}
}
