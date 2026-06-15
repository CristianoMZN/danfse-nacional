<?php

namespace DanfseNacional\Dto;

readonly class GEstornoCred
{
    public function __construct(
        public string $vIBSEstCred = '',
        public string $vCBSEstCred = '',
    ) {}
}
