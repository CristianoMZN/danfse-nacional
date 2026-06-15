<?php

namespace DanfseNacional\Dto;

readonly class TribDPS_IBSCBS
{
    public function __construct(
        public ?GIBSCBS_DPS $gIBSCBS = null,
        public ?GIBSCBSAjuste $gIBSCBSAjuste = null,
    ) {}
}
