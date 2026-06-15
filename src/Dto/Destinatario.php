<?php

namespace DanfseNacional\Dto;

readonly class Destinatario
{
    public function __construct(
        public string $CNPJ = '',
        public string $CPF = '',
        public string $NIF = '',
        public string $cNaoNIF = '',
        public string $xNome = '',
        public ?Endereco $end = null,
        public string $fone = '',
        public string $email = '',
    ) {}
}
