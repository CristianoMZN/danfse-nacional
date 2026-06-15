<?php

namespace DanfseNacional\Dto;

readonly class InfDPS
{
    public function __construct(
        public string $Id = '',
        public string $tpAmb = '',
        public string $dhEmi = '',
        public string $verAplic = '',
        public string $serie = '',
        public string $nDPS = '',
        public string $dCompet = '',
        public string $tpEmit = '',
        public string $cMotivoEmisTI = '',
        public string $finNFSe = '',
        public string $tpNFSeDebito = '',
        public string $tpNFSeCredito = '',
        public string $chNFSeRej = '',
        public string $cLocEmi = '',
        public ?Substituicao $subst = null,
        public ?Prestador $prest = null,
        public ?Tomador $toma = null,
        public ?Intermediario $interm = null,
        public ?Servico $serv = null,
        public ?Valores $valores = null,
        public ?DPS_IBSCBS $IBSCBS = null,
    ) {}
}
