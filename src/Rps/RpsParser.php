<?php

namespace DanfseNacional\Rps;

use DanfseNacional\XmlToArray;

class RpsParser
{
    public function parse(string $xml): Rps
    {
        $array = (new XmlToArray())->convert($xml);

        $root = $array['RPS'] ?? $array;
        $versao = (string) ($root['versao'] ?? '');
        $inf = $root['infRPS'] ?? [];

        return new Rps(
            Id: (string) ($inf['Id'] ?? ''),
            versao: $versao,
            infRps: new RpsInf(
                Id: (string) ($inf['Id'] ?? ''),
                tpAmb: (string) ($inf['tpAmb'] ?? ''),
                verAplic: (string) ($inf['verAplic'] ?? ''),
                serie: (string) ($inf['serie'] ?? ''),
                nRps: (string) ($inf['nRPS'] ?? ''),
                dEmis: (string) ($inf['dEmis'] ?? ''),
                prest: new RpsPrestador(
                    CNPJ: (string) ($inf['prest']['CNPJ'] ?? ''),
                    CPF: (string) ($inf['prest']['CPF'] ?? ''),
                    IM: (string) ($inf['prest']['IM'] ?? ''),
                    xNome: (string) ($inf['prest']['xNome'] ?? ''),
                ),
                toma: new RpsTomador(
                    CNPJ: (string) ($inf['toma']['CNPJ'] ?? ''),
                    CPF: (string) ($inf['toma']['CPF'] ?? ''),
                    NIF: (string) ($inf['toma']['NIF'] ?? ''),
                    xNome: (string) ($inf['toma']['xNome'] ?? ''),
                    fone: (string) ($inf['toma']['fone'] ?? ''),
                    email: (string) ($inf['toma']['email'] ?? ''),
                ),
                serv: new RpsServico(
                    cLocPrestacao: (string) ($inf['serv']['locPrest']['cLocPrestacao'] ?? ''),
                    cTribNac: (string) ($inf['serv']['cServ']['cTribNac'] ?? ''),
                    cNBS: (string) ($inf['serv']['cServ']['cNBS'] ?? ''),
                    xDescServ: (string) ($inf['serv']['cServ']['xDescServ'] ?? ''),
                ),
                valores: new RpsValores(
                    vServ: (string) ($inf['valores']['vServPrest']['vServ'] ?? ''),
                    vBC: (string) ($inf['valores']['trib']['tribMun']['vBC'] ?? ''),
                    pAliq: (string) ($inf['valores']['trib']['tribMun']['pAliq'] ?? ''),
                    vISSQN: (string) ($inf['valores']['trib']['tribMun']['vISSQN'] ?? ''),
                    vLiq: (string) ($inf['valores']['trib']['tribMun']['vISSQN'] ?? ''),
                ),
            ),
        );
    }
}
