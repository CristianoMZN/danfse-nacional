<?php

namespace DanfseNacional\Dto;

readonly class VDescCondIncond
{
    public function __construct(
        public string $vDescIncond = '',
        public string $vDescCond = '',
    ) {}
}