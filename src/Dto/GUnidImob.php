<?php

namespace DanfseNacional\Dto;

readonly class GUnidImob
{
    public function __construct(
        public string $inscImobFisc = '',
        public string $cCIB = '',
        public string $CEP = '',
        public string $xLgr = '',
        public string $nro = '',
        public string $xCpl = '',
        public string $xBairro = '',
        /**
         * @var GAjusteBCLocImoveis[]
         */
        public array $gAjusteBCLocImoveis = [],
    ) {}
}
