<?php

namespace DanfseNacional\Rps;

readonly class RpsTomador
{
    public function __construct(
        public string $CNPJ = '',
        public string $CPF = '',
        public string $NIF = '',
        public string $xNome = '',
        public string $fone = '',
        public string $email = '',
    ) {}
}
