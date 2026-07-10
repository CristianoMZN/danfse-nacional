<?php
/** @var array $data */
/** @var string $logo */
/** @var string $qrCode */
/** @var \DanfseNacional\Config\MunicipalityBranding $municipality */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>DANFSe - <?= $data['numero_nfse'] ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <style>
        html {
            height: auto;
            width: 100%;
            zoom: 80%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 0.67rem;
            color: #000;
            margin: 7pt;
            padding: 4pt 7pt;
            border: 1pt #000 solid;
            height: 100%;
            /* Transformando o body em um container flexível */
            display: flex;
            flex-direction: column;
        }
        .bordered-section:last-of-type {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Preenche o espaço vazio disponível */
            border-bottom: none;
        }
        .text-information {
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }

        td {
            padding: 1pt 2pt;
            border: none;
            vertical-align: top;
            border: hidden;
        }
        .table-data {
            width: 25%;
        }
        .table-footer {
            width: 100%;
            border: 1px solid #000;
            border-top: 0;
            page-break-inside: avoid;
            break-inside: avoid;
        }
        table > tbody > tr > td {
            padding-bottom: 3pt;
            width: 25%;
        }
        td[colspan="2"] {
            width: 50%;
        }
        td[colspan="3"] {
            width: 75%;
        }
        
        .footer-cell{
            border: 1px solid #000;
            margin: 0px;
        }
        .footer-cell > span.value {
            font-family: 'Roboto', sans-serif;
            font-size: 0.5rem;
        }
        .bordered-section {
            margin-bottom: 1pt;
            border-bottom: 1px solid #000;
        }

        .bordered-section:last-of-type {
            border-bottom: none;
        }

        /* Em tela: faz a seção de Informações Complementares crescer
           para empurrar o canhoto (table-footer) para o final do layout */
        .bordered-section:last-of-type > table {
            flex-grow: 1;
        }
        .bordered-section:last-of-type > table > tbody > tr:last-child > td {
            height: 100%;
        }

        .first-section table td {
            padding-bottom: 0 !important;
        }

        .label {
            font-family: 'Roboto', sans-serif;
            font-size: 0.58rem;
            font-weight: bold;
            color: #000;
            display: block;
            margin-bottom: 2pt;
        }

        .value {
            font-family: 'Roboto', sans-serif;
            font-size: 0.67rem;
            font-weight: normal;
            color: #000;
        }

        .section-header {
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            font-size: 0.75rem;
            text-align: left;
            padding: 3pt;
            background-color: #E0E0E0;
        }

        .section-title {
            font-family: 'Roboto', sans-serif;
            font-size: 0.67rem;
            font-weight: bold;
        }
        .header-cell {
            background-color: #E0E0E0;
        }
        .header-table {
            margin-bottom: 2pt;
            border-bottom: 1px solid #000;
            background-color: #E0E0E0;
        }

        .header-table td {
            border: none;
            padding-bottom: 1pt !important;
        }

        .logo-cell {
            width: 130pt;
            text-align: left;
        }

        .title-cell {
            text-align: center;
            vertical-align: middle;
        }

        .municipality-cell {
            width: 150pt;
            text-align: left;
            font-size: 0.5rem;
            vertical-align: top;
        }

        /* Watermark para homologação */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 4rem;
            font-weight: bold;
            color: rgba(200, 200, 200, 0.3);
            z-index: -1;
            white-space: nowrap;
        }

        .valor-liquido-highlight {
            font-weight: bold;
        }

        .ibs-cbs-section {
            background-color: #F5F5F5;
        }

        .fixed-text-block {
            text-align: center;
            font-weight: bold;
            font-size: 0.58rem;
            padding: 2pt;
        }

        @page {
            size: A4 portrait;
            margin: 7pt;
        }

        @media print {
            html { font-size: 100%; }
            html, body {
                height: 100%;
            }
            body {
                border: 1pt #000 solid;  /* restaura a moldura do DANFSE na folha A4 */
                margin: 0;
                padding: 4pt 7pt; /* espaço interno entre borda e conteúdo */
                box-sizing: border-box;
                min-height: calc(100vh - 14pt);    /* preenche a área imprimível (A4 - 7pt topo - 7pt base) */
            }

            /* Em impressão, o conteúdo flui naturalmente dentro da moldura;
               a última bordered-section cresce para empurrar o canhoto ao final. */
            .bordered-section:last-of-type,
            .bordered-section:last-of-type > table {
                flex-grow: 1;
            }

            /* Canhoto no fluxo natural (sem posicionamento fixo) para ficar
               dentro da moldura; largura 100% explícita para o Dompdf
               não colapsar a caixa. */
            .table-footer {
                width: 100%;
                border-top: 1pt dashed #000;
                page-break-inside: avoid;
                break-inside: avoid;
            }

        }
        img.qr-code {
                width: 96px !important; 
                height: 96px !important; 
                display: block; 
                margin: 0 auto;
            }
            p.qr-code-text {
                font-size: 0.58rem; 
                margin-top: 2pt;
            }
    </style>
</head>
<body>
    <?php if ($data['ambiente'] == 2): ?>
    <div class="watermark">HOMOLOGAÇÃO</div>
    <?php endif; ?>

    <!-- Header -->
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <img src="<?= htmlspecialchars($logo) ?>" alt="NFS-e" style="max-width: 130pt; max-height: 40pt;">
            </td>
            <td class="title-cell">
                <div style="font-family: Arial, Helvetica, sans-serif; font-size: 0.83rem; font-weight: bold;">DANFSe v2.0</div>
                <div style="font-family: Arial, Helvetica, sans-serif; font-size: 0.75rem; font-weight: bold;">Documento Auxiliar da NFS-e</div>
                <?php if ($data['ambiente'] == 2): ?>
                    <div style="font-family: Arial, Helvetica, sans-serif; color: #FF0000; font-weight: bold; font-size: 0.75rem;">NFS-e SEM VALIDADE JURÍDICA</div>
                <?php endif; ?>
            </td>
            <td class="municipality-cell">
                <?php if ($municipality): ?>
                <table>
                    <tr>
                        <?php if ($municipality->logoDataUri): ?>
                        <td><img style="height: 30pt; width: auto" src="<?= htmlspecialchars($municipality->logoDataUri) ?>" alt="Prefeitura" /></td>
                        <?php endif; ?>
                        <td style="font-size: 0.58rem;">
                            <?= htmlspecialchars($municipality->name) ?><br>
                            <?php if ($municipality->department): ?>
                            <?= htmlspecialchars($municipality->department) ?><br>
                            <?php endif; ?>
                            <?php if ($municipality->email): ?>
                            <?= htmlspecialchars($municipality->email) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <?php else: ?>
                <div>
                    <span class="label" style="font-size: 0.67rem; font-weight: 500;">
                        Município: <?= $data['municipio_uf'] ?>
                    </span>
                <?php endif; ?>
                <div>
                    <span class="value" style="font-size: 0.58rem;">
                        Ambiente Gerador: <?= $data['ambiente_gerador'] ?>
                    </span>
                    <br>
                    <span class="value" style="font-size: 0.58rem;">
                        Tipo de Ambiente: <?= $data['tipo_ambiente'] ?>
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <!-- Bloco 1: Grade de Identificação -->
    <div class="bordered-section first-section">
        <table style="min-height: 110px;">
            <tr>
                <td colspan="3">
                    <span class="label">Chave de Acesso da NFS-e</span>
                    <span class="value"><?= $data['chave_acesso'] ?></span>
                </td>
                <td style="width: 25%; position: relative;" rowspan="4">
                    <div style="text-align: center;">
                        <img 
                        class="qr-code" 
                        src="<?= htmlspecialchars($qrCode) ?>" 
                        alt="QR Code">
                        <p class="qr-code-text">
                            A autenticidade desta NFS-e pode ser verificada
pela leitura deste código QR ou pela consulta da
chave de acesso no portal nacional da NFS-e.
                        </p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="table-data">
                    <span class="label">Número da NFS-e</span>
                    <span class="value"><?= $data['numero_nfse'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Competência da NFS-e</span>
                    <span class="value"><?= $data['competencia'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Data e Hora da emissão da NFS-e</span>
                    <span class="value"><?= $data['emissao_nfse'] ?></span>
                </td>
            </tr>
            <tr>
                <td class="table-data">
                    <span class="label">Número do DPS</span>
                    <span class="value"><?= $data['numero_dps'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Série do DPS</span>
                    <span class="value"><?= $data['serie_dps'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Data e Hora da emissão da DPS</span>
                    <span class="value"><?= $data['emissao_dps'] ?></span>
                </td>
            </tr>
            <tr>
                <td class="header-cell table-data">
                    <span class="label section-title">EMITENTE DA NFS-e</span>
                    <span class="value">Prestador do Serviço</span>
                </td>
                <td class="table-data">
                    <span class="label">Situação da NFS-e</span>
                    <span class="value"><?= $data['situacao_nfse'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Finalidade</span>
                    <span class="value"><?= $data['finalidade'] ?></span>
                </td>
                
            </tr>
        </table>
    </div>

    <!-- Bloco 2: Prestador / Fornecedor -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="header-cell table-data">
                    <span class="label section-title">
                        PRESTADOR / FORNECEDOR
                    </span>
                </td>
                <td class="table-data">
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['emitente']['cnpj_cpf'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Inscrição Municipal</span>
                    <span class="value">
                        <?=  $data['emitente']['im'] ? $data['emitente']['im']:  '-' ?>
                    </span>
                </td>
                <td class="table-data">
                    <span class="label">Telefone</span>
                    <span class="value">
                        <?= $data['emitente']['telefone'] ?? '&ndash;' ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['emitente']['nome'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Município / Sigla UF</span>
                    <span class="value">
                        <?= $data['emitente']['municipio'] ?? '-' ?>
                    </span>
                </td>
                <td class="table-data">
                    <span class="label">Cód. IBGE / CEP</span>
                    <span class="value"><?= $data['emitente']['codigo_ibge'] ?> / <?= $data['emitente']['cep'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="width: 75%;">
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['emitente']['endereco'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">E-mail</span>
                    <span class="value">
                        <?= $data['emitente']['email'] ?? '-' ?>
                    </span>
                </td>
                
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Simples Nacional na Data de Competência</span>
                    <span class="value"><?= $data['emitente']['simples_nacional'] ?></span>
                </td>
                <td colspan="2">
                    <span class="label">Regime de Apuração Tributária pelo SN</span>
                    <span class="value"><?= $data['emitente']['regime_sn'] ?></span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bloco 3: Tomador / Adquirente -->
    <div class="bordered-section">
        <?php if ($data['tomador_identificado']): ?>
        <table>
            <tr>
                <td class="header-cell table-data">
                    <span class="section-title">TOMADOR / ADQUIRENTE</span>
                </td>
                <td>
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['tomador']['cnpj_cpf'] ?></span>
                </td>
                <td>
                    <span class="label">Inscrição Municipal</span>
                    <span class="value"><?= $data['tomador']['im'] ?></span>
                </td>
                <td>
                    <span class="label">Telefone</span>
                    <span class="value"><?= $data['tomador']['telefone'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['tomador']['nome'] ?></span>
                </td>
                <td>
                    <span class="label">E-mail</span>
                    <span class="value"><?= $data['tomador']['email'] ?></span>
                </td>
                <td>
                    <span class="label">Código IBGE / CEP</span>
                    <span class="value">
                        <?=  $data['tomador']['codigo_ibge'] ?> / <?= $data['tomador']['cep'] ?>
                        <span>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="width: 75%;">
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['tomador']['endereco'] ?></span>
                </td>
                <td>
                    <span class="label">Email</span>
                    <span class="value"><?= $data['tomador']['email'] ?></span>
                </td>
            </tr>
        </table>
        <?php else: ?>
        <div class="fixed-text-block">
            TOMADOR / ADQUIRENTE DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
        </div>
        <?php endif; ?>
    </div>

    <!-- Bloco 4: Destinatário da Operação -->
    <div class="bordered-section">
        <?php if ($data['destinatario_situacao'] === 'mesmo_tomador'): ?>
        <div class="fixed-text-block">
            O DESTINATÁRIO É O PRÓPRIO TOMADOR/ADQUIRENTE DA OPERAÇÃO
        </div>
        <?php elseif ($data['destinatario_situacao'] === 'nao_identificado'): ?>
        <div class="fixed-text-block">
            DESTINATÁRIO DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
        </div>
        <?php else: ?>
        <table>
            <tr>
                <td>
                    <span class="section-title">DESTINATÁRIO DA OPERAÇÃO</span>
                </td>
                <td >
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['destinatario']['cnpj_cpf'] ?></span>
                </td>
                <td >
                    <span class="label">Telefone</span>
                    <span class="value"><?= $data['destinatario']['telefone'] ?></span>
                </td>
                <td >
                    <span class="label">E-mail</span>
                    <span class="value"><?= $data['destinatario']['email'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['destinatario']['nome'] ?></span>
                </td>
                <td colspan="2">
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['destinatario']['endereco'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Município / UF</span>
                    <span class="value"><?= $data['destinatario']['municipio'] ?></span>
                </td>
                <td>
                    <span class="label">Código IBGE / CEP</span>
                    <span class="value"><?= $data['destinatario']['codigo_ibge'] ?> / <?= $data['destinatario']['cep'] ?></span>
                </td>
                <td colspan="2"></td>
            </tr>
        </table>
        <?php endif; ?>
    </div>

    <!-- Bloco 5: Intermediário da Operação -->
    <div class="bordered-section">
        <?php if ($data['intermediario'] !== null): ?>
        <table>
            <tr>
                <td >
                  <span class="section-title">INTERMEDIÁRIO DA OPERAÇÃO</span>
                </td>
                <td >
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['intermediario']['cnpj_cpf'] ?></span>
                </td>
                <td >
                    <span class="label">Inscrição Municipal</span>
                    <span class="value"><?= $data['intermediario']['im'] ?></span>
                </td>
                <td >
                    <span class="label">Telefone</span>
                    <span class="value"><?= $data['intermediario']['telefone'] ?></span>
                </td>
            </tr>
            <tr>
                <td >
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['intermediario']['nome'] ?></span>
                </td>
                <td >
                    <span class="label">E-mail</span>
                    <span class="value"><?= $data['intermediario']['email'] ?></span>
                </td>
            </tr>
            <tr>
                <td >
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['intermediario']['endereco'] ?></span>
                </td>
                <td >
                    <span class="label">Município / UF</span>
                    <span class="value"><?= $data['intermediario']['municipio'] ?></span>
                </td>
                <td >
                    <span class="label">Código IBGE / CEP</span>
                    <span class="value"><?= $data['intermediario']['codigo_ibge'] ?> / <?= $data['intermediario']['cep'] ?></span>
                </td>
            </tr>
        </table>
        <?php else: ?>
        <div class="fixed-text-block">
            INTERMEDIÁRIO DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
        </div>
        <?php endif; ?>
    </div>

    <!-- Bloco 6: Serviço Prestado -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="section-header">
                  <span class="section-title">SERVIÇO PRESTADO</span>
                </td>
                <td>
                    <span class="label">
                        Código de Tributação Nacional / Municipal
                    </span>
                    <span class="value">
                        <?= $data['servico']['codigo_trib_nacional'] ?>
                    </span>
                </td>
                <td>
                    <span class="label">Código da NBS</span>
                    <span class="value">
                        <?= $data['servico']['codigo_nbs'] ?>
                    </span>
                </td>
                <td>
                    <span class="label">Local da Prestação / Sigla UF / País</span>
                    <span class="value"><?= $data['servico']['local_prestacao'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    
                    <?= $data['servico']['desc_trib_municipal']?$data['servico']['desc_trib_municipal']:$data['servico']['desc_trib_nacional'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="label">Descrição do Serviço</span>
                    <span class="value">
                        <?= $data['servico']['descricao'] ?>
                </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bloco 7: Tributação Municipal (ISSQN) -->
    <div class="bordered-section">
        <?php if (!$data['is_sujeita_issqn']): ?>
        <div class="fixed-text-block">
            TRIBUTAÇÃO MUNICIPAL (ISSQN) - OPERAÇÃO NÃO SUJEITA AO ISSQN
        </div>
        <?php else: ?>
        <table>
            <tr>
                <td class="section-header">
                  <span class="section-title">TRIBUTAÇÃO MUNICIPAL (ISSQN)</span>
                </td>
                <td >
                    <span class="label">
                        Tipo de Tributação do ISSQN
                    </span>
                    <span class="value"><?= $data['tributacao_municipal']['tipo_tributacao_issqn'] ?? '-' ?></span>
                </td>
                <td colspan="2" >
                    <span class="label">
                        Município / Sigla UF / País de Incidência do ISSQN
                    </span>
                    <span class="value">
                        <?= $data['tributacao_municipal']['municipio_incidencia'] ?? '-' ?>
                    </span>
                </td>
            </tr>
            <?php if (!$data['suppress_regime_line']): ?>
            <tr>
                <td>
                    <span class="label">Regime Especial de Tributação</span>
                    <span class="value">
                        <?= $data['tributacao_municipal']['regime_especial'] ?? '-' ?>
                    </span>
                </td>
                <td>
                    <span class="label">
                        Tipo de Imunidade do ISSQN
                </span>
                    <span class="value">
                        <?= $data['tributacao_municipal']['tipo_imunidade'] ?? '-' ?>
                    </span>
                </td>
                <td>
                    <span class="label">Suspensão da Exigibilidade do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['suspensao_exigibilidade'] ?? '-' ?></span>
                </td>

                <td>
                    <span class="label">Número Processo Suspensão</span>
                    <span class="value"><?= $data['tributacao_municipal']['num_processo_suspensao'] ?? '-' ?></span>
                </td>
            </tr>
            <?php endif; ?>
            <?php if (!$data['suppress_beneficio_line']): ?>
            <tr>
                <td>
                    <span class="label">Benefício Municipal</span>
                    <span class="value"><?= $data['tributacao_municipal']['beneficio_municipal'] ?? '-' ?></span>
                </td>
                <td>
                    <span class="label">Cálculo do BM</span>
                    <span class="value"><?= $data['tributacao_municipal']['calculo_bm'] ?? '-' ?></span>
                </td>
                <td>
                    <span class="label">Total Deduções/Reduções</span>
                    <span class="value"><?= $data['tributacao_municipal']['total_deducoes'] ?? '-' ?></span>
                </td>
                <td>
                    <span class="label">Desconto Incondicionado</span>
                    <span class="value"><?= $data['tributacao_municipal']['desconto_incondicionado'] ?? '-' ?></span>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>
                    <span class="label">BC ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['bc_issqn'] ?? '-' ?></span>
                </td>
                <td>
                    <span class="label">Alíquota Aplicada</span>
                    <span class="value"><?= $data['tributacao_municipal']['aliquota'] ?? '-' ?></span>
                </td>
                <td>
                    <span class="label">Retenção ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['retencao_issqn'] ?? '-' ?></span>
                </td>
                <td>
                    <span class="label">ISSQN Apurado</span>
                    <span class="value"><?= $data['tributacao_municipal']['issqn_apurado'] ?? '-' ?></span>
                </td>
            </tr>
        </table>
        <?php endif; ?>
    </div>

    <!-- Bloco 8: Tributação Federal (Exceto CBS) -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="section-header">
                    <span class="section-title">
                        TRIBUTAÇÃO FEDERAL (EXCETO CBS)
                    </span>
                </td>
                <td >
                    <span class="label">IRRF</span>
                    <span class="value"><?= $data['tributacao_federal']['irrf'] ?? '-' ?></span>
                </td>
                <td >
                    <span class="label">Contribuição Previdenciária - Retida</span>
                    <span class="value"><?= $data['tributacao_federal']['cp'] ?? '-' ?></span>
                </td>
                <td >
                    <span class="label">Contribuições Sociais - Retidas</span>
                    <span class="value"><?= $data['tributacao_federal']['contrib_sociais'] ?? '-' ?></span>
                </td>
                
            </tr>
            <?php if (!$data['hide_pis_cofins']): ?>
            <tr>
                <td>
                    <span class="label">
                        PIS - Débito Apuração Própria
                    </span>
                    <span class="value"><?= $data['tributacao_federal']['pis'] ?? '-' ?></span>
                </td>
                <td >
                    <span class="label">
                        COFINS - Débito Apuração Própria
                    </span>
                    <span class="value"><?= $data['tributacao_federal']['cofins'] ?? '-' ?></span>
                </td>
                <td >
                    <span class="label">
                        Descrição Contrib. Sociais - Retidas
                    </span>
                    <span class="value"><?= $data['tributacao_federal']['desc_contrib_sociais'] ?? '-' ?></span>
                </td>
                <td></td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <!-- Bloco 9: Tributação IBS / CBS (sempre exibido) -->
    <div class="bordered-section ibs-cbs-section">
        <table>
            <tr>
                <td class="section-header">
                  <span class="section-title">
                    TRIBUTAÇÃO IBS / CBS
                </span>
                </td>
                <td >
                    <span class="label">CST / cClassTrib</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['cst'] ?> / <?= $data['ibs_cbs']['c_class_trib'] ?>
                    </span>
                </td>
                <td colspan="2" style="width: 50%;">
                    <span class="label">Indicador de Operação / Código IBGE Incidência / Município Incidência / Sigla UF</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['c_ind_op'] ?> / <?= $data['ibs_cbs']['c_localidade_incid'] ?> / <?= $data['ibs_cbs']['x_localidade_incid'] ?> / <?= $data['ibs_cbs']['c_sigla_uf'] ?>
                    </span>
                </td>
            </tr>
            <tr>

                <td>
                    <span class="label">Exclusões e Reduções BC (UF/Mun/CBS)</span>
                    <span class="value"><?= $data['ibs_cbs']['p_red_aliq_uf'] ?> / <?= $data['ibs_cbs']['p_red_aliq_mun'] ?> / <?= $data['ibs_cbs']['p_red_aliq_cbs'] ?></span>
                </td>
                <td>
                    <span class="label">Base de Cálculo Após Exclusões e Reduções</span>
                    <span class="value"><?= $data['ibs_cbs']['v_bc_ibscbs'] ?></span>
                </td>
                <td>
                    <span class="label">Red. Alíquota IBS / Red. Alíquota CBS</span>
                    <span class="value"><?= $data['ibs_cbs']['p_red_aliq_uf'] ?> / <?= $data['ibs_cbs']['p_red_aliq_cbs'] ?></span>
                </td>
                <td>
                    <span class="label">
                        Alíquota – IBS UF / IBS Mun
                    </span>
                    <span class="value">
                        <?= $data['ibs_cbs']['p_ibs_uf'] ?> / <?= $data['ibs_cbs']['p_ibs_mun'] ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Alíq. Efetiva Municipal – IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['aliquota_ibs_mun'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Apurado Municipal – IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['valor_ibs_mun'] ?></span>
                </td>
                <td>
                    <span class="label">Alíq. Efetiva Estadual – IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['aliquota_ibs_uf'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Apurado Estadual – IBS</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['valor_ibs_uf'] ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Valor Total Apurado IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['v_ibs_tot'] ?></span>
                </td>
                <td>
                    <span class="label">Alíquota CBS</span>
                    <span class="value"><?= $data['ibs_cbs']['p_cbs'] ?></span>
                </td>
                <td>
                    <span class="label">Alíquota Efetiva CBS</span>
                    <span class="value"><?= $data['ibs_cbs']['aliquota_cbs'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Total Apurado CBS</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['valor_cbs'] ?>
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bloco 10: Valor Total da NFS-e -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="section-header">
                    <span class="section-title">VALOR TOTAL DA NFS-e</span>
                </td>
                
                <td>
                    <span class="label">VALOR DA OPERAÇÃO / SERVIÇO</span>
                    <span class="value"><?= $data['totais']['valor_servico'] ?></span>
                </td>
                <td >
                    <span class="label">Desconto Incondicionado</span>
                    <span class="value"><?= $data['totais']['desconto_incondicionado'] ?></span>
                </td>
                <td >
                    <span class="label">Desconto Condicionado</span>
                    <span class="value"><?= $data['totais']['desconto_condicionado'] ?></span>
                </td>
                
            </tr>
            <tr>
                <td>
                    <span class="label">
                        Total das Retenções (ISSQN / Federais)
                    </span>
                    <span class="value"><?= $data['totais']['retencoes_federais'] ?? '-' ?></span>
                </td>
                <td class="valor-liquido-highlight">
                    <span class="label">Valor Líquido da NFS-e</span>
                    <span class="value" style="font-weight: bold;">
                        <?= $data['totais']['valor_liquido'] ?>
                    </span>
                </td>
                <td>
                    <span class="label">Total do IBS / CBS</span>
                    <span class="value">
                        <?= $data['totais']['total_ibs_cbs'] ?? '-' ?>
                    </span>
                </td>
                
                <td colspan="2" class="valor-liquido-highlight">
                    <span class="label">Valor Líquido da NFS-e + IBS/CBS</span>
                    <span class="value" style="font-weight: bold;">
                        <?= $data['totais']['valor_liquido_ibs_cbs'] ?>
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bloco 11: Informações Complementares (inclui Totais Aproximados Lei 12.741/2012) -->
    <div class="bordered-section">
        <table class="text-information">
            <tr>
                <td class="section-header">
                  <span class="section-title">INFORMAÇÕES COMPLEMENTARES</span>
                </td>
            </tr>
            <tr>
                <td style="min-height: 30pt; padding: 5pt;">
                    <span class="value"><?= $data['informacoes_complementares'] ?></span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Rodapé / Canhoto da NFS-e (último filho de <body>;
         em impressão usa position: fixed aparecendo na última página A4) -->
    <table class="table-footer">
        <tr>
            <td class="footer-cell">
                <span class="label">**** DATA CIENTIFICAÇÃO:</span>
                <span class="value"></span>
            </td>
            <td class="footer-cell">
                <span class="label">IDENTIFICAÇÃO E ASSINATURA:</span>
                <span class="value"></span>
            </td>
            <td class="footer-cell">
                <span class="label">Nº NFS-e / CHAVE NFS-e:</span>
                <span class="value">
                    <?= $data['numero_nfse'] ?? '-' ?> / <?= $data['chave_acesso'] ?? '-' ?>
                </span>
            </td>
        </tr>
    </table>

</body>
</html>
