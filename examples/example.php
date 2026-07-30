<?php

require __DIR__ . '/../vendor/autoload.php';

use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\MunicipalityBranding;
use DanfseNacional\DanfseGenerator;

$xmlFiles = glob(__DIR__ . '/*.xml');
sort($xmlFiles);

if ($xmlFiles === []) {
    fwrite(STDERR, "Nenhum XML encontrado em " . __DIR__ . "\n");
    exit(1);
}

$config = new DanfseConfig(
    municipality: new MunicipalityBranding(
        name: 'Prefeitura de Niterói',
        department: 'Secretaria Municipal de Fazenda',
        email: 'iss@fazenda.niteroi.rj.gov.br',
    ),
);

foreach ($xmlFiles as $xmlPath) {
    $chave   = basename($xmlPath, '.xml');
    $xml     = file_get_contents($xmlPath);
    $generator = new DanfseGenerator();

    // --- Exemplo 1: geração simples, sem configuração ---

    $pdf = $generator->generateFromXml($xml);

    $outputSimples = __DIR__ . "/danfse_simples_{$chave}.pdf";
    file_put_contents($outputSimples, $pdf);
    echo "PDF simples gerado: {$outputSimples} (" . number_format(strlen($pdf) / 1024, 1) . " KB)\n";

    // --- Exemplo 2: inspecionar os dados antes de gerar ---

    $nfse = $generator->parseXml($xml);
    $inf  = $nfse->infNFSe;

    echo "\nDados extraídos do XML ({$chave}):\n";
    echo "  NFS-e número : " . $inf->nNFSe . "\n";
    echo "  Emitente     : " . $inf->emit->xNome . "\n";
    echo "  CNPJ         : " . $inf->emit->CNPJ . "\n";
    echo "  Tomador      : " . ($inf->DPS->infDPS->toma?->xNome ?? '') . "\n";
    echo "  Valor líquido: R$ " . $inf->valores->vLiq . "\n";
    echo "  Competência  : " . $inf->DPS->infDPS->dCompet . "\n";
    echo "  Ambiente     : " . ($inf->DPS->infDPS->tpAmb === '1' ? 'Produção' : 'Homologação') . "\n";

    // --- Exemplo 3: com identificação do município ---

    $generator = new DanfseGenerator($config);
    $pdf = $generator->generateFromXml($xml);

    $outputConfig = __DIR__ . "/danfse_com_config_{$chave}.pdf";
    file_put_contents($outputConfig, $pdf);

    $nfse = $generator->parseXml($xml);
    $html = $generator->generateHtml($nfse);
    file_put_contents(__DIR__ . "/danfse_com_config_{$chave}.html", $html);

    echo "\nPDF: {$outputConfig} (" . number_format(strlen($pdf) / 1024, 1) . " KB)\n";
    echo str_repeat('-', 78) . "\n\n";
}

echo "Concluído. PDFs/HTMLs salvos em " . __DIR__ . "\n";
