<?php

namespace DanfseNacional\Dto;

readonly class Imovel
{
    public function __construct(
        public string $cMun = '',
        public ?GLocacao $gLocacao = null,
        /**
         * @var GUnidImob[]
         */
        public array $gUnidImob = [],
    ) {}
}
