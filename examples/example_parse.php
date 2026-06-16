<?php

require __DIR__ . '/../vendor/autoload.php';

use DanfseNacional\DanfseGenerator;
use DanfseNacional\XmlToArray;

$xmlPath = __DIR__ . '/nfse_exemplo.xml';
$xml     = file_get_contents($xmlPath);

// =========================================================================
// Exemplo 1: Parse para array associativo
// =========================================================================

echo "=== Parse para Array ===\n\n";

$converter = new XmlToArray();
$array = $converter->convert($xml);

echo "NFS-e número  : " . $array['infNFSe']['nNFSe'] . "\n";
echo "CNPJ Emitente : " . $array['infNFSe']['emit']['CNPJ'] . "\n";
echo "Nome Emitente : " . $array['infNFSe']['emit']['xNome'] . "\n";
echo "CNPJ Tomador  : " . $array['infNFSe']['DPS']['infDPS']['toma']['CNPJ'] . "\n";
echo "Nome Tomador  : " . $array['infNFSe']['DPS']['infDPS']['toma']['xNome'] . "\n";
echo "Valor Líquido : " . $array['infNFSe']['valores']['vLiq'] . "\n";
echo "Competência   : " . $array['infNFSe']['DPS']['infDPS']['dCompet'] . "\n";
echo "Ambiente      : " . ($array['infNFSe']['DPS']['infDPS']['tpAmb'] === '1' ? 'Produção' : 'Homologação') . "\n";

// =========================================================================
// Exemplo 2: Parse para objeto DTO tipado
// =========================================================================

echo "\n=== Parse para Objeto DTO ===\n\n";

$generator = new DanfseGenerator();
$nfse = $generator->parseXml($xml);

$inf = $nfse->infNFSe;

echo "NFS-e número  : " . $inf->nNFSe . "\n";
echo "CNPJ Emitente : " . $inf->emit->CNPJ . "\n";
echo "Nome Emitente : " . $inf->emit->xNome . "\n";
echo "CNPJ Tomador  : " . $inf->DPS->infDPS->toma->CNPJ . "\n";
echo "Nome Tomador  : " . $inf->DPS->infDPS->toma->xNome . "\n";
echo "Valor Líquido : R$ " . $inf->valores->vLiq . "\n";
echo "Competência   : " . $inf->DPS->infDPS->dCompet . "\n";
echo "Ambiente      : " . ($inf->DPS->infDPS->tpAmb === '1' ? 'Produção' : 'Homologação') . "\n";
echo "Descrição     : " . $inf->DPS->infDPS->serv->cServ->xDescServ . "\n";

// =========================================================================
// Exemplo 3: Parse de XML v2.0 com IBS/CBS
// =========================================================================

echo "\n=== XML v2.0 - IBS/CBS ===\n\n";

$xmlV2Path = __DIR__ . '/nfse_exemplo_v2.xml';
$xmlV2     = file_get_contents($xmlV2Path);

$nfseV2 = $generator->parseXml($xmlV2);
$ibsCbs = $nfseV2->infNFSe->IBSCBS;

echo "Base de cálculo     : R$ " . $ibsCbs->valores->vBC . "\n";
echo "Alíquota IBS UF     : " . $ibsCbs->valores?->uf?->pAliqEfetUF . "%\n";
echo "Alíquota IBS Mun    : " . $ibsCbs->valores?->mun?->pAliqEfetMun . "%\n";
echo "Alíquota CBS        : " . $ibsCbs->valores?->fed?->pAliqEfetCBS . "%\n";
echo "Total IBS           : R$ " . $ibsCbs->totCIBS?->gIBS?->vIBSTot . "\n";
echo "Total CBS           : R$ " . $ibsCbs->totCIBS?->gCBS?->vCBS . "\n";
