<?php

namespace DanfseNacional\Dto;

readonly class GIBSCBSRegular
{
    public function __construct(
        public string $CSTReg = '',
        public string $cClassTribReg = '',
    ) {}
}
