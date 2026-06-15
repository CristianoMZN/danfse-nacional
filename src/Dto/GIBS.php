<?php

namespace DanfseNacional\Dto;

readonly class GIBS
{
    public function __construct(
        public string $vIBSTot = '',
        public ?GIBSCredPres $gIBSCredPres = null,
        public ?GIBSUFTot $gIBSUFTot = null,
        public ?GIBSMunTot $gIBSMunTot = null,
    ) {}
}
