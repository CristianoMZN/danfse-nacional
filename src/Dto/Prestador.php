<?php

namespace DanfseNacional\Dto;

readonly class Prestador
{
    public function __construct(
        public string $CNPJ = '',
        public string $CPF = '',
        public string $NIF = '',
        public string $cNaoNIF = '',
        public string $CAEPF = '',
        public string $IM = '',
        public string $xNome = '',
        public ?Endereco $end = null,
        public string $fone = '',
        public string $email = '',
        public ?RegTrib $regTrib = null,
    ) {}

    public function documento(): string
    {
        return $this->CNPJ ?: $this->CPF;
    }
}
