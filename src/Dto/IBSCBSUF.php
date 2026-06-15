<?php

namespace DanfseNacional\Dto;

readonly class IBSCBSUF
{
    public function __construct(
        public string $pIBSUF = '',
        public string $pRedAliqUF = '',
        public string $pAliqEfetUF = '',
    ) {}
}
