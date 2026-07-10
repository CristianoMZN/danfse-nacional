<?php

namespace DanfseNacional\Config;

readonly class DanfseConfig
{
    public function __construct(
        public ?MunicipalityBranding $municipality = null,
    ) {}
}
