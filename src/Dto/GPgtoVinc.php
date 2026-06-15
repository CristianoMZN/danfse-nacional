<?php

namespace DanfseNacional\Dto;

readonly class GPgtoVinc
{
    /**
     * @param PgtoVinc[] $pgto
     */
    public function __construct(
        public array $pgto = [],
    ) {}
}
