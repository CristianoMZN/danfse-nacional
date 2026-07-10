<?php

require __DIR__ . '/../vendor/autoload.php';

use DanfseNacional\DanfseGenerator;
use DanfseNacional\XmlToArray;

$xmlFiles = glob(__DIR__ . '/*.xml');
sort($xmlFiles);

if ($xmlFiles === []) {
    fwrite(STDERR, "Nenhum XML encontrado em " . __DIR__ . "\n");
    exit(1);
}

$converter = new XmlToArray();
$generator = new DanfseGenerator();

foreach ($xmlFiles as $xmlPath) {
    $chave = basename($xmlPath, '.xml');
    $xml   = file_get_contents($xmlPath);

    // =========================================================================
    // Exemplo 1: Parse para array associativo
    // =========================================================================

    echo "=== {$chave} : Parse para Array ===\n\n";

    $array = $converter->convert($xml);

    echo "NFS-e número  : " . $array['infNFSe']['nNFSe'] . "\n";
    echo "CNPJ Emitente : " . $array['infNFSe']['emit']['CNPJ'] . "\n";
    echo "Nome Emitente : " . $array['infNFSe']['emit']['xNome'] . "\n";
    $toma = $array['infNFSe']['DPS']['infDPS']['toma'];
    $docToma = $toma['CNPJ'] ?? ($toma['CPF'] ?? '');
    echo "CNPJ/CPF Tomador: " . $docToma . "\n";
    echo "Nome Tomador  : " . ($toma['xNome'] ?? '') . "\n";
    echo "Valor Líquido : " . $array['infNFSe']['valores']['vLiq'] . "\n";
    echo "Competência   : " . $array['infNFSe']['DPS']['infDPS']['dCompet'] . "\n";
    echo "Ambiente      : " . ($array['infNFSe']['DPS']['infDPS']['tpAmb'] === '1' ? 'Produção' : 'Homologação') . "\n";

    if (isset($array['infNFSe']['IBSCBS'])) {
        $ibsCbs = $array['infNFSe']['IBSCBS'];
        echo "IBS/CBS       : base R$ " . ($ibsCbs['valores']['vBC'] ?? '-')
            . ", alíq. UF " . ($ibsCbs['valores']['uf']['pAliqEfetUF'] ?? '-') . "%"
            . ", Mun " . ($ibsCbs['valores']['mun']['pAliqEfetMun'] ?? '-') . "%"
            . ", CBS " . ($ibsCbs['valores']['fed']['pAliqEfetCBS'] ?? '-') . "%\n";
    }

    // =========================================================================
    // Exemplo 2: Parse para objeto DTO tipado
    // =========================================================================

    echo "\n=== {$chave} : Parse para Objeto DTO ===\n\n";

    $nfse = $generator->parseXml($xml);

    $inf = $nfse->infNFSe;

    echo "NFS-e número  : " . $inf->nNFSe . "\n";
    echo "CNPJ Emitente : " . $inf->emit->CNPJ . "\n";
    echo "Nome Emitente : " . $inf->emit->xNome . "\n";
    $tomaDto = $inf->DPS->infDPS->toma;
    $docTomaDto = $tomaDto->CNPJ !== '' ? $tomaDto->CNPJ : ($tomaDto->CPF !== '' ? $tomaDto->CPF : '');
    echo "CNPJ/CPF Tomador: " . $docTomaDto . "\n";
    echo "Nome Tomador  : " . $tomaDto->xNome . "\n";
    echo "Valor Líquido : R$ " . $inf->valores->vLiq . "\n";
    echo "Competência   : " . $inf->DPS->infDPS->dCompet . "\n";
    echo "Ambiente      : " . ($inf->DPS->infDPS->tpAmb === '1' ? 'Produção' : 'Homologação') . "\n";
    echo "Descrição     : " . $inf->DPS->infDPS->serv->cServ->xDescServ . "\n";

    if ($inf->IBSCBS !== null) {
        $ibsCbs = $inf->IBSCBS;
        echo "IBS/CBS       : base R$ " . ($ibsCbs->valores?->vBC ?? '-')
            . ", alíq. UF " . ($ibsCbs->valores?->uf?->pAliqEfetUF ?? '-') . "%"
            . ", Mun " . ($ibsCbs->valores?->mun?->pAliqEfetMun ?? '-') . "%"
            . ", CBS " . ($ibsCbs->valores?->fed?->pAliqEfetCBS ?? '-') . "%\n";
    }

    echo "\n" . str_repeat('-', 78) . "\n\n";
}
