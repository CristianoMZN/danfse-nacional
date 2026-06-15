<?php

namespace DanfseNacional\Dto;

readonly class GIBSCBS_DPS
{
    public function __construct(
        public string $CST = '',
        public string $cClassTrib = '',
        public string $cCredPres = '',
        public ?GIBSCBSAjuste $gIBSCBSAjuste = null,
        public ?GIBSCBSRegular $gTribRegular = null,
        public ?GDif $gDif = null,
        public ?GEstornoCred $gEstornoCred = null,
        public ?GPagAntecipado $gPagAntecipado = null,
    ) {}
}
