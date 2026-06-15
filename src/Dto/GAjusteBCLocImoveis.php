<?php

namespace DanfseNacional\Dto;

readonly class GAjusteBCLocImoveis
{
    public function __construct(
        public string $tpAjusteBCLocImoveis = '',
        public string $xTpAjusteBCLocImoveis = '',
        public string $vAjusteBCLocImoveis = '',
    ) {}
}
