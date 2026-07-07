<?php
// Servidor PHP embutido para teste rápido de geração de DANFSE a partir de XML

require __DIR__ . '/vendor/autoload.php';

use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Data\Municipios;
use DanfseNacional\DanfseGenerator;

ini_set('xdebug.var_display_max_depth', '-1');
ini_set('xdebug.var_display_max_children', '-1');
ini_set('xdebug.var_display_max_data', '-1');



try {
    $generator = new DanfseGenerator();
    $key = $_GET['key'] ?? '';
    if(!$key) {
        throw new Exception("Parâmetro 'key' é obrigatório. Exemplo: ?key=123456");
    }
    $xml = file_get_contents(__DIR__ . "/schemas/{$key}.xml");
    $data = $generator->parseXml($xml);

    $municipio = Municipios::lookup($data->infNFSe->cLocIncid);

    if (isset($_GET['html'])){
        $html = $generator->generateHtml($data);
        echo $html;
    } else {
        var_dump($data);
    }
} catch (Exception $e) {
    ?>
    <html>
    <head>
        <title>Erro ao gerar DANFSE</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            h1 {
                color: #ff7300;
            }
        </style>
    </head>
    <body>
        <h1>Erro ao gerar DANFSE</h1>
        <p><?= htmlspecialchars($e->getMessage()) ?></p>
    </body>
    </html>
    <?php
} catch (Throwable $t) {
    ?>
    <html>
    <head>
        <title>Erro inesperado</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            h1 {
                color: #ff0000;
            }
        </style>
    </head>
    <body>
        <h1>Erro inesperado</h1>
        <p><?= htmlspecialchars($t->getMessage()) ?></p>
    </body>
    </html>
    <?php
}

