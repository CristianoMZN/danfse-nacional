<?php

namespace DanfseNacional\Dto;

readonly class DPS_IBSCBS
{
    public function __construct(
        public string $indFinal = '',
        public string $cIndOp = '',
        public string $indZFMALC = '',
        public string $tpOper = '',
        public ?RefNFSe $gRefNFSe = null,
        public string $tpEnteGov = '',
        public string $indDoacao = '',
        public string $indDest = '',
        public ?Destinatario $dest = null,
        public ?Imovel $imovel = null,
        /**
         * @var BensMoveis[]
         */
        public array $bensMoveis = [],
        public ?ValoresDPS_IBSCBS $valores = null,
        public ?GPgtoVinc $gPgtoVinc = null,
    ) {}
}
