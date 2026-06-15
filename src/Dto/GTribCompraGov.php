<?php

namespace DanfseNacional\Dto;

readonly class GTribCompraGov
{
    public function __construct(
        public string $pIBSUF = '',
        public string $vIBSUF = '',
        public string $pIBSMun = '',
        public string $vIBSMun = '',
        public string $pCBS = '',
        public string $vCBS = '',
    ) {}
}
