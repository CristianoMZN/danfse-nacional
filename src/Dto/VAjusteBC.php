<?php

namespace DanfseNacional\Dto;

readonly class VAjusteBC
{
    public function __construct(
        public string $pAjusteBCISSQN = '',
        public string $vAjusteBCISSQN = '',
    ) {}
}
