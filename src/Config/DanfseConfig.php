<?php

namespace DanfseNacional\Config;

readonly class DanfseConfig
{
    /**
     * @param MunicipalityBranding|null $municipality Identificação/branding complementar do
     *        ente emitente. NÃO substitui o município do emitente (que é obrigatório pela
     *        NT 008/2026); apenas adiciona logo/departamento/e-mail ao cabeçalho.
     * @param bool $mostrarCanhoto Exibe o bloco de canhoto (Nota 11 da NT 008). Quando
     *        desligado, o espaço é redistribuído para "Descrição do Serviço" /
     *        "Informações Complementares".
     */
    public function __construct(
        public ?MunicipalityBranding $municipality = null,
        public bool $mostrarCanhoto = true,
    ) {}
}
