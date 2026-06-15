<?php

namespace DanfseNacional\Dto;

readonly class DocAjusteBC
{
    public function __construct(
        public string $tpAjusteBC = '',
        public string $xTpAjusteBC = '',
        public string $vTotDoc = '',
        public string $vAjuteAplic = '',
    ) {}
}
