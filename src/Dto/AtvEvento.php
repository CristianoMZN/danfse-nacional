<?php

namespace DanfseNacional\Dto;

readonly class AtvEvento
{
    public function __construct(
        public string $xNome = '',
        public string $dtIni = '',
        public string $dtFim = '',
        public string $idAtvEvt = '',
        public ?Endereco $end = null,
    ) {}
}
