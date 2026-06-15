<?php

namespace DanfseNacional\Dto;

readonly class IBSCBSMun
{
    public function __construct(
        public string $pIBSMun = '',
        public string $pRedAliqMun = '',
        public string $pAliqEfetMun = '',
    ) {}
}
