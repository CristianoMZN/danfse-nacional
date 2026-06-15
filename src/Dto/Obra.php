<?php

namespace DanfseNacional\Dto;

readonly class Obra
{
    public function __construct(
        public string $inscImobFisc = '',
        public string $cObra = '',
        public string $cCIB = '',
        public ?Endereco $end = null,
    ) {}
}
