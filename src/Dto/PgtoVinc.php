<?php

namespace DanfseNacional\Dto;

readonly class PgtoVinc
{
    public function __construct(
        public string $nPag = '',
        public string $idTransacao = '',
        public string $tpMeioPgto = '',
        public string $CNPJReceb = '',
        public string $CNPJBasePSP = '',
    ) {}
}
