<?php
/** @var array $data */
/** @var string $logo */
/** @var string $qrCode */
/** @var \DanfseNacional\Config\MunicipalityBranding|null $municipality */
/** @var bool $mostrarCanhoto */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>DANFSe - <?= $data['numero_nfse'] ?></title>
    <style>
        /*
         * Fontes conforme NT 008/2026 §2.4:
         *   - Títulos/labels: Arial
         *   - Conteúdo:      Microsoft Sans Serif
         *
         * A lib distribui Liberation Sans como equivalente métrico do Arial e
         * usa DejaVu Sans (embutida no Dompdf) como equivalente do Microsoft
         * Sans Serif. Vide DanfseGenerator::registerFonts() e README.
         */
        html {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'MicrosoftSansSerif', 'DejaVu Sans', sans-serif;
            font-size: 7pt;
            color: #000000;
            margin: 5pt;
            padding: 5pt 7pt;
            border: 1pt #000 solid;
            box-sizing: border-box;
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
        }
        .table-data { width: 25%; }
        td[colspan="2"] { width: 50%; }
        td[colspan="3"] { width: 75%; }
        table > tbody > tr > td { padding-bottom: 3pt; width: 25%; }

        /* ------------------------------------------------------------------
         *  Cabeçalho, blocos e sombreamentos (K5 = ~#F2F2F2 conforme §2.4)
         * ------------------------------------------------------------------ */
        .header-table {
            margin-bottom: 2pt;
            border-bottom: 0.5pt solid #000000;
            background-color: #F2F2F2;
        }
        .header-table td {
            border: none;
            padding-bottom: 1pt !important;
        }
        .logo-cell { width: 130pt; text-align: left; }
        .title-cell { text-align: center; vertical-align: middle; }
        .municipality-cell {
            width: 155pt;
            text-align: left;
            vertical-align: top;
        }
        .municipality-cell .mun-nome {
            font-family: 'MicrosoftSansSerif', 'DejaVu Sans', sans-serif;
            font-size: 8pt;
            display: block;
        }
        .municipality-cell .mun-ambiente {
            font-family: 'MicrosoftSansSerif', 'DejaVu Sans', sans-serif;
            font-size: 6pt;
            display: block;
        }
        .title-danfse {
            font-family: 'Arial', 'LiberationSans', sans-serif;
            font-size: 9pt;
            font-weight: bold;
        }
        .title-homolog {
            font-family: 'Arial', 'LiberationSans', sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #FF0000;
            margin-top: 1pt;
        }

        /* Bordas e blocos */
        .bordered-section {
            margin-bottom: 1pt;
            border-bottom: 0.5pt solid #000000;
        }
        .bordered-section.none{
            border-bottom: none;
        }
        .bordered-section:last-of-type { border-bottom: none; }
        .bordered-section:last-of-type > table { flex-grow: 1; }
        .bordered-section:last-of-type > table > tbody > tr:last-child > td { height: 100%; }
        .first-section table td { padding-bottom: 0 !important; }

        /* ------------------------------------------------------------------
         *  Labels e valores (§2.4: labels 6pt bold, conteúdo 7pt normal)
         * ------------------------------------------------------------------ */
        .label {
            font-family: 'Arial', 'LiberationSans', sans-serif;
            font-size: 6pt;
            font-weight: bold;
            color: #000000;
            display: block;
            margin-bottom: 1pt;
        }
        .value {
            font-family: 'MicrosoftSansSerif', 'DejaVu Sans', sans-serif;
            font-size: 7pt;
            font-weight: normal;
            color: #000000;
        }

        /* Títulos de bloco (§2.4: 7pt CAIXA ALTA negrito, sombreado K5) */
        .section-header,
        .header-cell {
            background-color: #F2F2F2;
        }
        .section-title {
            font-family: 'Arial', 'LiberationSans', sans-serif;
            font-size: 7pt;
            font-weight: bold;
            text-transform: uppercase;
        }

        /* Labels dos campos de identificação (§2.4: 7pt CAIXA ALTA negrito) */
        .first-section .label {
            font-size: 7pt;
            text-transform: uppercase;
        }

        /* Campos com sombreamento obrigatório (§Sombreamento) */
        .highlight-shade {
            background-color: #F2F2F2;
        }

        /* Texto fixo de supressão (§2.3) — mesmas caixas com texto centralizado */
        .fixed-text-block {
            text-align: center;
            font-family: 'Arial', 'LiberationSans', sans-serif;
            font-weight: bold;
            font-size: 7pt;
            padding: 4pt;
            min-height: 9pt;
        }

        /* QR Code (§2.4.3) */
        img.qr-code {
            width: 51pt !important;   /* ~1,80cm — acima do mínimo 1,52cm */
            height: 51pt !important;
            display: block;
            margin: 0 auto;
        }
        p.qr-code-text {
            font-family: 'MicrosoftSansSerif', 'DejaVu Sans', sans-serif;
            font-size: 6pt;
            margin-top: 2pt;
            text-align: center;
        }

        /* ------------------------------------------------------------------
         *  Marcas d'água NT 008 §2.5 (CANCELADA / SUBSTITUÍDA)
         *  Arial, mínimo 50pt, cinza K35 (~#595959), na diagonal.
         * ------------------------------------------------------------------ */
        .watermark-danfse {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-family: 'Arial', 'LiberationSans', sans-serif;
            font-size: 60pt;
            font-weight: bold;
            color: #595959;
            z-index: -1;
            white-space: nowrap;
            opacity: 0.55;
        }

        /* Canhoto (§2.3.3 e Nota 11 — opcional) */
        .table-footer {
            width: 100%;
            border: 0.5pt solid #000000;
            border-top: 1pt dashed #000000;
            page-break-inside: avoid;
            break-inside: avoid;
            margin-top: auto;
        }
        .footer-cell {
            border: 0.5pt solid #000000;
            margin: 0;
        }
        .footer-cell > span.value {
            font-family: 'MicrosoftSansSerif', 'DejaVu Sans', sans-serif;
            font-size: 7pt;
        }
        .text-information { width: 100%; }
        .text-information-value {
            min-height: 30pt;
            padding: 5pt;
        }

        @page {
            size: A4 portrait;
            margin: 5pt;
        }

        @media print {
            html { margin: 5pt; }
            html, body { min-height: 100%; }
            body {
                border: 1pt #000 solid;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                min-height: 832pt;
            }
            .page {
                position: relative;
                height: 818pt;
            }
            .bordered-section:last-of-type,
            .bordered-section:last-of-type > table { flex-grow: 1; }
            .table-footer {
                position: absolute;
                bottom: 12pt;
                left: 0;
                right: 0;
                width: 100%;
                border: 0.5pt solid #000000;
                border-top: 1pt dashed #000000;
                page-break-inside: avoid;
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <?php if (!empty($data['is_cancelada'])): ?>
    <div class="watermark-danfse">CANCELADA</div>
    <?php elseif (!empty($data['is_substituida'])): ?>
    <div class="watermark-danfse">SUBSTITUÍDA</div>
    <?php endif; ?>

    <div class="page">

    <!-- Cabeçalho (§2.4.3) -->
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <img src="<?= htmlspecialchars($logo) ?>" alt="NFS-e" style="max-width: 130pt; max-height: 34pt;">
            </td>
            <td class="title-cell">
                <div class="title-danfse">DANFSe v2.0</div>
                <div class="title-danfse">Documento Auxiliar da NFS-e</div>
                <?php if ($data['ambiente'] == 2): ?>
                    <div class="title-homolog">NFS-e SEM VALIDADE JURÍDICA</div>
                <?php endif; ?>
            </td>
            <td class="municipality-cell">
                <?php if ($municipality !== null && $municipality->logoDataUri): ?>
                    <img style="height: 26pt; width: auto; float: left; margin-right: 4pt;"
                         src="<?= htmlspecialchars($municipality->logoDataUri) ?>" alt="Ente Emitente" />
                <?php endif; ?>
                <span class="mun-nome">
                    Município: <?= $data['municipio_uf'] ?>
                </span>
                <?php if ($municipality !== null): ?>
                    <span class="mun-ambiente"><?= htmlspecialchars($municipality->name) ?></span>
                    <?php if ($municipality->department): ?>
                    <span class="mun-ambiente"><?= htmlspecialchars($municipality->department) ?></span>
                    <?php endif; ?>
                <?php endif; ?>
                <span class="mun-ambiente">
                    Ambiente Gerador: <?= $data['ambiente_gerador'] ?>
                </span>
                <span class="mun-ambiente">
                    Tipo de Ambiente: <?= $data['tipo_ambiente'] ?>
                </span>
            </td>
        </tr>
    </table>

    <!-- Bloco 1: Dados de Identificação da NFS-e -->
    <div class="bordered-section first-section">
        <table style="min-height: 110px;">
            <tr>
                <td colspan="3">
                    <span class="label">Chave de Acesso da NFS-e</span>
                    <span class="value"><?= $data['chave_acesso'] ?></span>
                </td>
                <td style="width: 25%; position: relative;" rowspan="4">
                    <div style="text-align: center;">
                        <img class="qr-code" src="<?= htmlspecialchars($qrCode) ?>" alt="QR Code">
                        <p class="qr-code-text">
                            A autenticidade desta NFS-e pode ser verificada pela leitura deste código QR ou pela consulta da chave de acesso no portal nacional da NFS-e
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
                    <span class="label">Data e Hora da Emissão da NFS-e</span>
                    <span class="value"><?= $data['emissao_nfse'] ?></span>
                </td>
            </tr>
            <tr>
                <td class="table-data">
                    <span class="label">Número da DPS</span>
                    <span class="value"><?= $data['numero_dps'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Série da DPS</span>
                    <span class="value"><?= $data['serie_dps'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Data e Hora da Emissão da DPS</span>
                    <span class="value"><?= $data['emissao_dps'] ?></span>
                </td>
            </tr>
            <tr>
                <td class="highlight-shade table-data">
                    <span class="label">Emitente da NFS-e</span>
                    <span class="value"><?= $data['emitente_rotulo'] ?></span>
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
                <td class="section-header table-data">
                    <span class="section-title">PRESTADOR / FORNECEDOR</span>
                </td>
                <td class="table-data">
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['emitente']['cnpj_cpf'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Inscrição Municipal</span>
                    <span class="value"><?= $data['emitente']['im'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Telefone</span>
                    <span class="value"><?= $data['emitente']['telefone'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['emitente']['nome'] ?></span>
                </td>
                <td class="table-data">
                    <span class="label">Município / Sigla UF</span>
                    <span class="value"><?= $data['emitente']['municipio'] ?></span>
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
                    <span class="value"><?= $data['emitente']['email'] ?></span>
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
                <td class="section-header table-data">
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
                    <span class="label">Município / Sigla UF</span>
                    <span class="value"><?= $data['tomador']['municipio'] ?></span>
                </td>
                <td>
                    <span class="label">Cód. IBGE / CEP</span>
                    <span class="value"><?= $data['tomador']['codigo_ibge'] ?> / <?= $data['tomador']['cep'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="width: 75%;">
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['tomador']['endereco'] ?></span>
                </td>
                <td>
                    <span class="label">E-mail</span>
                    <span class="value"><?= $data['tomador']['email'] ?></span>
                </td>
            </tr>
        </table>
        <?php else: ?>
        <div class="fixed-text-block">
            TOMADOR/ADQUIRENTE DA OPERAÇÃO NÃO IDENTIFICADO NA NFS-e
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
                <td class="section-header table-data">
                    <span class="section-title">DESTINATÁRIO DA OPERAÇÃO</span>
                </td>
                <td>
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['destinatario']['cnpj_cpf'] ?></span>
                </td>
                <td>
                    <span class="label">Telefone</span>
                    <span class="value"><?= $data['destinatario']['telefone'] ?></span>
                </td>
                <td>
                    <span class="label">E-mail</span>
                    <span class="value"><?= $data['destinatario']['email'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['destinatario']['nome'] ?></span>
                </td>
                <td>
                    <span class="label">Município / Sigla UF</span>
                    <span class="value"><?= $data['destinatario']['municipio'] ?></span>
                </td>
                <td>
                    <span class="label">Cód. IBGE / CEP</span>
                    <span class="value"><?= $data['destinatario']['codigo_ibge'] ?> / <?= $data['destinatario']['cep'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['destinatario']['endereco'] ?></span>
                </td>
            </tr>
        </table>
        <?php endif; ?>
    </div>

    <!-- Bloco 5: Intermediário da Operação -->
    <div class="bordered-section">
        <?php if ($data['intermediario'] !== null): ?>
        <table>
            <tr>
                <td class="section-header table-data">
                    <span class="section-title">INTERMEDIÁRIO DA OPERAÇÃO</span>
                </td>
                <td>
                    <span class="label">CNPJ / CPF / NIF</span>
                    <span class="value"><?= $data['intermediario']['cnpj_cpf'] ?></span>
                </td>
                <td>
                    <span class="label">Inscrição Municipal</span>
                    <span class="value"><?= $data['intermediario']['im'] ?></span>
                </td>
                <td>
                    <span class="label">Telefone</span>
                    <span class="value"><?= $data['intermediario']['telefone'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="label">Nome / Nome Empresarial</span>
                    <span class="value"><?= $data['intermediario']['nome'] ?></span>
                </td>
                <td>
                    <span class="label">Município / Sigla UF</span>
                    <span class="value"><?= $data['intermediario']['municipio'] ?></span>
                </td>
                <td>
                    <span class="label">Cód. IBGE / CEP</span>
                    <span class="value"><?= $data['intermediario']['codigo_ibge'] ?> / <?= $data['intermediario']['cep'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <span class="label">Endereço</span>
                    <span class="value"><?= $data['intermediario']['endereco'] ?></span>
                </td>
                <td>
                    <span class="label">E-mail</span>
                    <span class="value"><?= $data['intermediario']['email'] ?></span>
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
                <td class="section-header table-data">
                    <span class="section-title">SERVIÇO PRESTADO</span>
                </td>
                <td>
                    <span class="label">Código de Tributação Nacional / Municipal</span>
                    <span class="value">
                        <?= $data['servico']['codigo_trib_nacional'] ?> / <?= $data['servico']['codigo_trib_municipal'] ?>
                    </span>
                </td>
                <td>
                    <span class="label">Código da NBS</span>
                    <span class="value"><?= $data['servico']['codigo_nbs'] ?></span>
                </td>
                <td>
                    <span class="label">Local da Prestação / Sigla UF / País</span>
                    <span class="value"><?= $data['servico']['local_prestacao'] ?></span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="value">
                        <?= $data['servico']['desc_trib_municipal'] !== '' ? $data['servico']['desc_trib_municipal'] : $data['servico']['desc_trib_nacional'] ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <span class="label">Descrição do Serviço</span>
                    <span class="value"><?= $data['servico']['descricao'] ?></span>
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
                <td class="section-header table-data">
                    <span class="section-title">TRIBUTAÇÃO MUNICIPAL (ISSQN)</span>
                </td>
                <td>
                    <span class="label">Tipo de Tributação do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['tributacao_issqn'] ?></span>
                </td>
                <td colspan="2">
                    <span class="label">Município / Sigla UF / País de Incidência do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['municipio_incidencia'] ?></span>
                </td>
            </tr>
            <?php if (!$data['suppress_regime_line']): ?>
            <tr>
                <td>
                    <span class="label">Regime Especial de Tributação do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['regime_especial'] ?></span>
                </td>
                <td>
                    <span class="label">Tipo de Imunidade do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['tipo_imunidade'] ?></span>
                </td>
                <td>
                    <span class="label">Suspensão da Exigibilidade do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['suspensao_exigibilidade'] ?></span>
                </td>
                <td>
                    <span class="label">Número Processo Suspensão</span>
                    <span class="value"><?= $data['tributacao_municipal']['num_processo_suspensao'] ?></span>
                </td>
            </tr>
            <?php endif; ?>
            <?php if (!$data['suppress_beneficio_line']): ?>
            <tr>
                <td>
                    <span class="label">Benefício Municipal</span>
                    <span class="value"><?= $data['tributacao_municipal']['beneficio_municipal'] ?></span>
                </td>
                <td>
                    <span class="label">Cálculo do BM</span>
                    <span class="value"><?= $data['tributacao_municipal']['calculo_bm'] ?></span>
                </td>
                <td>
                    <span class="label">Total Deduções/Reduções</span>
                    <span class="value"><?= $data['tributacao_municipal']['total_deducoes'] ?></span>
                </td>
                <td>
                    <span class="label">Desconto Incondicionado</span>
                    <span class="value"><?= $data['tributacao_municipal']['desconto_incondicionado'] ?></span>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>
                    <span class="label">BC ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['bc_issqn'] ?></span>
                </td>
                <td>
                    <span class="label">Alíquota Aplicada</span>
                    <span class="value"><?= $data['tributacao_municipal']['aliquota'] ?></span>
                </td>
                <td>
                    <span class="label">Retenção do ISSQN</span>
                    <span class="value"><?= $data['tributacao_municipal']['retencao_issqn'] ?></span>
                </td>
                <td>
                    <span class="label">ISSQN Apurado</span>
                    <span class="value"><?= $data['tributacao_municipal']['issqn_apurado'] ?></span>
                </td>
            </tr>
        </table>
        <?php endif; ?>
    </div>

    <!-- Bloco 8: Tributação Federal (Exceto CBS) -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="section-header table-data">
                    <span class="section-title">TRIBUTAÇÃO FEDERAL (EXCETO CBS)</span>
                </td>
                <td>
                    <span class="label">IRRF</span>
                    <span class="value"><?= $data['tributacao_federal']['irrf'] ?></span>
                </td>
                <td>
                    <span class="label">Contribuição Previdenciária - Retida</span>
                    <span class="value"><?= $data['tributacao_federal']['cp'] ?></span>
                </td>
                <td>
                    <span class="label">Contribuições Sociais - Retidas</span>
                    <span class="value"><?= $data['tributacao_federal']['contrib_sociais'] ?></span>
                </td>
            </tr>
            <?php if (!$data['hide_pis_cofins']): ?>
            <tr>
                <td>
                    <span class="label">PIS - Débito Apuração Própria</span>
                    <span class="value"><?= $data['tributacao_federal']['pis'] ?></span>
                </td>
                <td>
                    <span class="label">COFINS - Débito Apuração Própria</span>
                    <span class="value"><?= $data['tributacao_federal']['cofins'] ?></span>
                </td>
                <td colspan="2">
                    <span class="label">Descrição Contrib. Sociais - Retidas</span>
                    <span class="value"><?= $data['tributacao_federal']['desc_contrib_sociais'] ?></span>
                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <!-- Bloco 9: Tributação IBS / CBS (sempre renderizado — NT 008 §2.4.5;
         este bloco não está na lista de supressões permitidas de
         suppression_rules.md; campos sem dado no XML exibem '-' via Nota 12) -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="section-header table-data">
                    <span class="section-title">TRIBUTAÇÃO IBS / CBS</span>
                </td>
                <td>
                    <span class="label">CST / cClassTrib</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['cst'] ?> / <?= $data['ibs_cbs']['c_class_trib'] ?>
                    </span>
                </td>
                <td colspan="2">
                    <span class="label">Indicador de Operação / Cód. IBGE Incidência / Município Incidência / Sigla UF</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['c_ind_op'] ?> / <?= $data['ibs_cbs']['c_localidade_incid'] ?> / <?= $data['ibs_cbs']['x_localidade_incid'] ?> / <?= $data['ibs_cbs']['c_sigla_uf'] ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Exclusões e Reduções da Base de Cálculo</span>
                    <span class="value"><?= $data['ibs_cbs']['exclusoes_reducoes'] ?></span>
                </td>
                <td>
                    <span class="label">Base de Cálculo Após Exclusões e Reduções</span>
                    <span class="value"><?= $data['ibs_cbs']['v_bc_ibscbs'] ?></span>
                </td>
                <td>
                    <span class="label">Red. Alíquota IBS / Red. Alíquota CBS</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['p_red_aliq_uf'] ?> / <?= $data['ibs_cbs']['p_red_aliq_mun'] ?> / <?= $data['ibs_cbs']['p_red_aliq_cbs'] ?>
                    </span>
                </td>
                <td>
                    <span class="label">Alíquota IBS UF / IBS Mun</span>
                    <span class="value">
                        <?= $data['ibs_cbs']['p_ibs_uf'] ?> / <?= $data['ibs_cbs']['p_ibs_mun'] ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Alíq. Efetiva Municipal - IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['aliquota_ibs_mun'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Apurado Municipal - IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['valor_ibs_mun'] ?></span>
                </td>
                <td>
                    <span class="label">Alíq. Efetiva Estadual - IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['aliquota_ibs_uf'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Apurado Estadual - IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['valor_ibs_uf'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Valor Total Apurado - IBS</span>
                    <span class="value"><?= $data['ibs_cbs']['v_ibs_tot'] ?></span>
                </td>
                <td>
                    <span class="label">Alíquota - CBS</span>
                    <span class="value"><?= $data['ibs_cbs']['p_cbs'] ?></span>
                </td>
                <td>
                    <span class="label">Alíquota Efetiva - CBS</span>
                    <span class="value"><?= $data['ibs_cbs']['aliquota_cbs'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Total Apurado - CBS</span>
                    <span class="value"><?= $data['ibs_cbs']['valor_cbs'] ?></span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bloco 10: Valor Total da NFS-e -->
    <div class="bordered-section">
        <table>
            <tr>
                <td class="section-header table-data">
                    <span class="section-title">VALOR TOTAL DA NFS-e</span>
                </td>
                <td>
                    <span class="label">Valor da Operação / Serviço</span>
                    <span class="value"><?= $data['totais']['valor_servico'] ?></span>
                </td>
                <td>
                    <span class="label">Desconto Incondicionado</span>
                    <span class="value"><?= $data['totais']['desconto_incondicionado'] ?></span>
                </td>
                <td>
                    <span class="label">Desconto Condicionado</span>
                    <span class="value"><?= $data['totais']['desconto_condicionado'] ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="label">Total das Retenções (ISSQN / Federais)</span>
                    <span class="value"><?= $data['totais']['retencoes_federais'] ?></span>
                </td>
                <td>
                    <span class="label">Valor Líquido da NFS-e</span>
                    <span class="value"><?= $data['totais']['valor_liquido'] ?></span>
                </td>
                <td>
                    <span class="label">Total do IBS / CBS</span>
                    <span class="value"><?= $data['totais']['total_ibs_cbs'] ?></span>
                </td>
                <td class="highlight-shade">
                    <span class="label">Valor Líquido da NFS-e + IBS/CBS</span>
                    <span class="value"><?= $data['totais']['valor_liquido_ibs_cbs'] ?></span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Bloco 11: Informações Complementares (inclui Totais Aproximados Lei 12.741/2012) -->
    <div class="bordered-section none">
        <table class="text-information">
            <tr>
                <td class="section-header text-information-title">
                    <span class="section-title">INFORMAÇÕES COMPLEMENTARES</span>
                </td>
            </tr>
            <tr>
                <td class="text-information-value">
                    <span class="value"><?= $data['informacoes_complementares'] ?></span>
                </td>
            </tr>
        </table>
    </div>

    <?php if ($mostrarCanhoto): ?>
    <!-- Canhoto (§2.3.3, Nota 11 — opcional). Larguras conforme NT 008/2026. -->
    <table class="table-footer">
        <tr>
            <td class="footer-cell" style="width: 5.09cm;">
                <span class="label">Data Cientificação</span>
                <span class="value">&nbsp;</span>
            </td>
            <td class="footer-cell" style="width: 5.09cm;">
                <span class="label">Identificação e Assinatura</span>
                <span class="value">&nbsp;</span>
            </td>
            <td class="footer-cell " style="width: 9cm;">
                <span class="label">Nº NFS-e / Chave NFS-e</span>
                <span class="value">
                    <?= $data['numero_nfse'] ?> / <?= $data['chave_acesso'] ?>
                </span>
            </td>
        </tr>
    </table>
    <?php endif; ?>

    </div>
</body>
</html>
