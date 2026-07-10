<?php

namespace DanfseNacional\Rps;

readonly class RpsPrestador
{
    public function __construct(
        public string $CNPJ = '',
        public string $CPF = '',
        public string $IM = '',
        public string $xNome = '',
    ) {}
}
