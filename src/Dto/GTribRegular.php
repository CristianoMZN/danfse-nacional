<?php

namespace DanfseNacional\Dto;

readonly class GTribRegular
{
    public function __construct(
        public string $pAliqEfeRegIBSUF = '',
        public string $vTribRegIBSUF = '',
        public string $pAliqEfeRegIBSMun = '',
        public string $vTribRegIBSMun = '',
        public string $pAliqEfeRegCBS = '',
        public string $vTribRegCBS = '',
    ) {}
}
