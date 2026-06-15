<?php

namespace DanfseNacional\Dto;

readonly class BensMoveis
{
    public function __construct(
        public string $cNCMBemMovel = '',
        public string $xNCMBemMovel = '',
        public string $qtdNCMBemMovel = '',
    ) {}
}
