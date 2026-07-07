<?php
// Servidor PHP embutido para teste rápido de geração de DANFSE a partir de XML

require __DIR__ . '/vendor/autoload.php';

use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Data\Municipios;
use DanfseNacional\DanfseGenerator;

ini_set('xdebug.var_display_max_depth', '-1');
ini_set('xdebug.var_display_max_children', '-1');
ini_set('xdebug.var_display_max_data', '-1');



$generator = new DanfseGenerator();
$xml = file_get_contents(__DIR__ . '/schemas/208_DALTEC_601.xml');
$data = $generator->parseXml($xml);

$municipio = Municipios::lookup($data->infNFSe->cLocIncid);

if (isset($_GET['html'])){
    $html = $generator->generateHtml($data);
    echo $html;
} else {
    var_dump($data);
}

