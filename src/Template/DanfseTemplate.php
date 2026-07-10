<?php

namespace DanfseNacional\Template;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Dto\NFSe;
use DanfseNacional\Enums\FinNFSe;
use DanfseNacional\Enums\OpSimpNac;
use DanfseNacional\Enums\RegApTribSN;
use DanfseNacional\Enums\RegEspTrib;
use DanfseNacional\Enums\TpEmis;
use DanfseNacional\Enums\TpRetISSQN;
use DanfseNacional\Enums\TribISSQN;
use DanfseNacional\Enums\AmbGer;
use DanfseNacional\Data\Municipios;
use DanfseNacional\Enums\TpAmb;
use DanfseNacional\Formatter;

/**
 * Constrói o array de dados para o template e gera o QR Code.
 */
class DanfseTemplate
{
    private Formatter $fmt;

    public function __construct()
    {
        $this->fmt = new Formatter();
    }

    /**
     * Renderiza o template e retorna o HTML completo
     */
    public function render(NFSe $nfse, DanfseConfig $config): string
    {
        $data = $this->buildData($nfse);
        $data = array_replace_recursive([
            'ambiente' => 1,
            'ibs_cbs' => [
                'c_sigla_uf' => '-',
                'p_red_aliq_ibs' => '-',
            ],
        ], $data);
        $logo = $config->logoDataUri;
        $municipality = $config->municipality;
        $qrCode = $this->generateQrCode($data['chave_acesso']);
        array_walk_recursive($data, fn(&$v) => $v = is_string($v) ? htmlspecialchars($v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') : $v);

        $templatePath = __DIR__ . '/danfse.php';

        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    /**
     * Constrói o array de dados para o template a partir dos DTOs
     */
    public function buildData(NFSe $nfse): array
    {
        $inf = $nfse->infNFSe;
        $dps = $inf?->DPS;
        $infDps = $dps?->infDPS;
        $prest = $infDps?->prest;
        $regTrib = $prest?->regTrib;
        $emit = $inf?->emit;
        $enderEmit = $emit?->enderNac;
        $toma = $infDps?->toma;
        $endToma = $toma?->end;
        $interm = $infDps?->interm;
        $endInterm = $interm?->end;
        $serv = $infDps?->serv;
        $locPrest = $serv?->locPrest;
        $cServ = $serv?->cServ;
        $valores = $infDps?->valores;
        $vServPrest = $valores?->vServPrest;
        $trib = $valores?->trib;
        $tribMun = $trib?->tribMun;
        $tribFed = $trib?->tribFed;
        $totTrib = $trib?->totTrib;
        $valoresNfse = $inf?->valores;

        // Grupos IBS/CBS (v2.0)
        $ibscbsNfse = $inf?->IBSCBS;
        $ibscbsDps = $infDps?->IBSCBS;

        // Chave de acesso (remove prefixo "NFS")
        $id = $inf?->Id ?? '';
        $chaveAcesso = str_starts_with($id, 'NFS') ? substr($id, 3) : $id;

        // Endereço emitente
        $enderecoEmit = implode(', ', array_filter([
            $enderEmit?->xLgr ?? '',
            $enderEmit?->nro ?? '',
            $enderEmit?->xBairro ?? '',
        ], fn($v) => $v !== ''));

        $municipioEmit = Municipios::lookup($emit?->enderNac->cMun ?? '');
        

        // Endereço tomador
        $enderecoToma = implode(', ', array_filter([
            $endToma?->xLgr ?? '',
            $endToma?->nro ?? '',
            $endToma?->xBairro ?? '',
        ], fn($v) => $v !== ''));

        $cepToma = $endToma?->endNac?->CEP ?? '';
        $ibgeToma = $endToma?->endNac?->cMun ?? '';
        // Endereço intermediário
        $enderecoInterm = implode(', ', array_filter([
            $endInterm?->xLgr ?? '',
            $endInterm?->nro ?? '',
            $endInterm?->xBairro ?? '',
        ], fn($v) => $v !== ''));

        $cepInterm = $endInterm?->endNac?->CEP ?? '';

        // IBS/CBS no infNFSe (valores calculados pelo sistema)
        $ibsCbsValores = $ibscbsNfse?->valores;
        $ibsCbsTotCIBS = $ibscbsNfse?->totCIBS;
        $ibsCbsGIBS = $ibsCbsTotCIBS?->gIBS;
        $ibsCbsGCBS = $ibsCbsTotCIBS?->gCBS;

        // IBS/CBS no DPS (declarado pelo emitente)
        $ibsCbsDpsValores = $ibscbsDps?->valores?->trib?->gIBSCBS;

        // Totais aproximados de tributos
        $totTribPercent = $totTrib?->pTotTrib;
        $totTribValores = [
            'federais' => $totTrib?->vTotTribFed ? $this->fmt->currency($totTrib->vTotTribFed) : '-',
            'estaduais' => $totTrib?->vTotTribEst ? $this->fmt->currency($totTrib->vTotTribEst) : '-',
            'municipais' => $totTrib?->vTotTribMun ? $this->fmt->currency($totTrib->vTotTribMun) : '-',
        ];

        // Alíquotas IBS/CBS (do infNFSe/IBSCBS/valores)
        $aliquotaIBSUF = $ibsCbsValores?->uf?->pAliqEfetUF ?? '';
        $aliquotaIBSMun = $ibsCbsValores?->mun?->pAliqEfetMun ?? '';
        $aliquotaCBS = $ibsCbsValores?->fed?->pAliqEfetCBS ?? '';

        // Valores IBS/CBS
        $vIBSUF = $ibsCbsGIBS?->gIBSUFTot?->vIBSUF ?? '';
        $vIBSMun = $ibsCbsGIBS?->gIBSMunTot?->vIBSMun ?? '';
        $vCBS = $ibsCbsGCBS?->vCBS ?? '';

        // Destinatário da operação
        $dest = $ibscbsDps?->dest;
        $indDest = $ibscbsDps?->indDest ?? '';
        $endDest = $dest?->end;

        $enderecoDest = implode(', ', array_filter([
            $endDest?->xLgr ?? '',
            $endDest?->nro ?? '',
            $endDest?->xBairro ?? '',
        ], fn($v) => $v !== ''));

        $cepDest = $endDest?->endNac?->CEP ?? '';

        // Determina situação do destinatário
        if ($indDest === '1' || $toma !== null) {
            $destinatarioSituacao = 'mesmo_tomador';
        } elseif ($dest === null || ($dest->CNPJ === '' && $dest->CPF === '' && $dest->NIF === '' && $dest->xNome === '')) {
            $destinatarioSituacao = 'nao_identificado';
        } else {
            $destinatarioSituacao = 'identificado';
        }

        // Determina se tomador está identificado
        $tomadorIdentificado = $toma !== null && ($toma->CNPJ !== '' || $toma->CPF !== '' || $toma->NIF !== '' || $toma->xNome !== '');

        // Verifica se a operação é sujeita ao ISSQN
        $isSujeitaISSQN = $tribMun !== null && $tribMun->tribISSQN !== '' && $tribMun->tribISSQN !== '4';

        // Verifica se precisa ocultar PIS/COFINS (competência >= 2027)
        $competenciaAno = $infDps?->dCompet ? (int) substr($infDps->dCompet, 0, 4) : 0;
        $hidePisCofins = $competenciaAno >= 2027;

        // Flags de supressão para linhas do ISSQN (Nota 5)
        $vRegime = RegEspTrib::labelFor($regTrib?->regEspTrib ?? '');
        $vTipoImunidade = $tribMun?->tipoImunidade ?? '';
        $vSuspensao = $tribMun?->suspExigibilidade ?? '';
        $vProcesso = $tribMun?->nProcessoSuspensao ?? '';
        $linhaRegimeVazia = $vRegime === '-' && $vTipoImunidade === '' && $vSuspensao === '' && $vProcesso === '';

        $vBeneficio = $tribMun?->beneficioMunicipal ?? '';
        $vCalcBM = ($valoresNfse?->tpBM ?? '') !== '' || ($valoresNfse?->vCalcBM ?? '') !== ''
            ? ($valoresNfse->tpBM ?: '-') . ' / ' . ($valoresNfse->vCalcBM ? $this->fmt->currency($valoresNfse->vCalcBM) : '-')
            : '-';
        $vTotalDeducoes = $this->sumCurrency(
            $tribMun?->vDeducao ?? '',
            $tribMun?->vOutDed ?? '',
        );
        $vDescIncondTrib = $tribMun?->vDescIncond ? $this->fmt->currency($tribMun->vDescIncond) : '-';
        $linhaBeneficioVazia = $vBeneficio === '' && ($vCalcBM === '-' || $vCalcBM === '- / -') && $vTotalDeducoes === '-' && $vDescIncondTrib === '-';

        return [
            // ===== Bloco 1: Cabeçalho e Identificação =====
            'chave_acesso' => $chaveAcesso,
            'numero_nfse' => $inf?->nNFSe ?? '-',
            'competencia' => $this->fmt->date($infDps?->dCompet ?? ''),
            'emissao_nfse' => $this->fmt->dateTime($inf?->dhProc ?? ''),
            'numero_dps' => $infDps?->nDPS ?? '-',
            'serie_dps' => $infDps?->serie ?? '-',
            'emissao_dps' => $this->fmt->dateTime($infDps?->dhEmi ?? ''),
            'municipio_uf' => $municipioEmit ?: '-',
            'ambiente_gerador' => AmbGer::labelFor($inf?->ambGer ?? ''),
            'tipo_ambiente' => TpAmb::labelFor((int) ($infDps?->tpAmb ?? 1)),
            'situacao_nfse' => TpEmis::labelFor($inf?->tpEmis ?? ''),
            'finalidade' => FinNFSe::labelFor($infDps?->finNFSe ?? ''),
            'ambiente' => (int) ($infDps?->tpAmb ?? 1),

            // ===== Bloco 2: Prestador / Fornecedor =====
            'emitente' => [
                'nome' => $emit?->xNome ?? '-',
                'cnpj_cpf' => $this->fmt->cnpjCpf($emit?->documento() ?? ''),
                'nif' => $emit?->NIF ?: false,
                'im' => $emit?->IM ?? false,
                'telefone' => $this->fmt->phone($emit?->fone ?? ''),
                'email' => strtolower($emit?->email ?? ''),
                'endereco' => $enderecoEmit ?: '-',
                'municipio' => $municipioEmit ?: '-',
                'codigo_ibge' => $enderEmit?->cMun ?: '-',
                'cep' => $this->fmt->cep($enderEmit?->CEP ?? ''),
                'simples_nacional' => OpSimpNac::labelFor($regTrib?->opSimpNac ?? ''),
                'regime_sn' => RegApTribSN::labelFor($regTrib?->regApTribSN ?? ''),
            ],

            // ===== Bloco 3: Tomador / Adquirente =====
            'tomador_identificado' => $tomadorIdentificado,
            'tomador' => [
                'nome' => $toma?->xNome ?? '-',
                'cnpj_cpf' => $this->fmt->cnpjCpf($toma?->documento() ?? ''),
                'nif' => $toma?->NIF ?: '-',
                'im' => $toma?->IM ?: '-',
                'telefone' => $this->fmt->phone($toma?->fone ?? ''),
                'email' => strtolower($toma?->email ?? ''),
                'endereco' => $enderecoToma ?: '-',
                'municipio' => $endToma?->endNac?->cMun ? Municipios::lookup($endToma->endNac->cMun) : '-',
                'codigo_ibge' => $ibgeToma ?: '-',
                'cep' => $this->fmt->cep($cepToma),
            ],

            // ===== Bloco 4: Destinatário da Operação =====
            'destinatario_situacao' => $destinatarioSituacao,
            'destinatario' => [
                'nome' => $dest?->xNome ?? '-',
                'cnpj_cpf' => $this->fmt->cnpjCpf($dest?->CNPJ ?: $dest?->CPF ?? ''),
                'nif' => $dest?->NIF ?: '-',
                'telefone' => $this->fmt->phone($dest?->fone ?? ''),
                'email' => strtolower($dest?->email ?? ''),
                'endereco' => $enderecoDest ?: '-',
                'municipio' => $endDest?->endNac?->cMun ? Municipios::lookup($endDest->endNac->cMun) : '-',
                'codigo_ibge' => $endDest?->endNac?->cMun ?: '-',
                'cep' => $this->fmt->cep($cepDest),
            ],

            // ===== Bloco 5: Intermediário da Operação =====
            'intermediario' => $interm !== null ? [
                'nome' => $interm->xNome ?: '-',
                'cnpj_cpf' => $this->fmt->cnpjCpf($interm->documento()),
                'nif' => $interm->NIF ?: '-',
                'im' => $interm->IM ?: '-',
                'telefone' => $this->fmt->phone($interm->fone),
                'email' => strtolower($interm->email),
                'endereco' => $enderecoInterm ?: '-',
                'municipio' => $endInterm?->endNac?->cMun ? Municipios::lookup($endInterm->endNac->cMun) : '-',
                'codigo_ibge' => $endInterm?->endNac?->cMun ?: '-',
                'cep' => $this->fmt->cep($cepInterm),
            ] : null,

            // ===== Bloco 6: Serviço Prestado =====
            

            'servico' => [
                'codigo_trib_nacional' => $this->fmt->codTribNacional($cServ?->cTribNac ?? ''),
                'desc_trib_nacional' => $this->fmt->limit(trim($inf?->xTribNac ?? ''), 60),
                'codigo_trib_municipal' => $cServ?->cTribMun ?? '-',
                'desc_trib_municipal' => $this->fmt->limit(trim($inf?->xTribMun ?? ''), 60),
                'codigo_nbs' => $cServ?->cNBS ?: '-',
                'local_prestacao' => $locPrest->cLocPrestacao ? Municipios::lookup($locPrest->cLocPrestacao) : '-',
                'pais_prestacao' => $locPrest?->cPaisPrestacao ?? '-',
                'descricao' => $cServ?->xDescServ ?? '-',
            ],

            // ===== Bloco 7: Tributação Municipal (ISSQN) =====
            'is_sujeita_issqn' => $isSujeitaISSQN,
            'tributacao_municipal' => [
                'tributacao_issqn' => TribISSQN::labelFor($tribMun?->tribISSQN ?? ''),
                'municipio_incidencia' => $inf?->xLocIncid ?? '-',
                'regime_especial' => $vRegime,
                'tipo_tributacao_issqn' => $tribMun?->tpTribISSQN ?? '-',
                'tipo_imunidade' => $vTipoImunidade ?: '-',
                'suspensao_exigibilidade' => $vSuspensao ?: '-',
                'num_processo_suspensao' => $vProcesso ?: '-',
                'beneficio_municipal' => $vBeneficio ?: '-',
                'calculo_bm' => $vCalcBM,
                'total_deducoes' => $vTotalDeducoes,
                'desconto_incondicionado' => $vDescIncondTrib,
                'valor_servico' => $this->fmt->currency($vServPrest?->vServ ?? ''),
                'bc_issqn' => $tribMun?->vBC ? $this->fmt->currency($tribMun->vBC) : '-',
                'aliquota' => $tribMun?->pAliq ? $tribMun->pAliq . '%' : '-',
                'retencao_issqn' => TpRetISSQN::labelFor($tribMun?->tpRetISSQN ?? ''),
                'issqn_apurado' => $tribMun?->vISSQN ? $this->fmt->currency($tribMun->vISSQN) : '-',
            ],
            'suppress_regime_line' => $linhaRegimeVazia,
            'suppress_beneficio_line' => $linhaBeneficioVazia,

            // ===== Bloco 8: Tributação Federal (Exceto CBS) =====
            'hide_pis_cofins' => $hidePisCofins,
            'tributacao_federal' => [
                'irrf' => $tribFed?->vRetIRRF ? $this->fmt->currency($tribFed->vRetIRRF) : '-',
                'cp' => $tribFed?->vRetCP ? $this->fmt->currency($tribFed->vRetCP) : '-',
                'csll' => $tribFed?->vRetCSLL ? $this->fmt->currency($tribFed->vRetCSLL) : '-',
                'contrib_sociais' => $this->sumCurrency(
                    $tribFed?->vRetCSLL ?? '',
                    $tribFed?->vRetCP ?? '',
                ),
                'desc_contrib_sociais' => ($tribFed?->vRetCSLL ?? '') !== '' || ($tribFed?->vRetCP ?? '') !== '' ? 'CSLL e Contribuição Previdenciária' : '-',
                'pis' => $tribFed?->piscofins?->vPis ? $this->fmt->currency($tribFed->piscofins->vPis) : '-',
                'cofins' => $tribFed?->piscofins?->vCofins ? $this->fmt->currency($tribFed->piscofins->vCofins) : '-',
            ],

            // ===== Bloco 9: Tributação IBS / CBS =====
            'ibscbs_has_data' => $ibscbsNfse !== null || $ibscbsDps !== null,
            'ibs_cbs' => [
                // Dados do DPS (Bloco 9)
                'cst' => $ibsCbsDpsValores?->CST ?: '-',
                'c_class_trib' => $ibsCbsDpsValores?->cClassTrib ?: '-',
                'c_ind_op' => $ibscbsDps?->cIndOp ?: '-',
                'c_localidade_incid' => $ibscbsNfse?->cLocalidadeIncid ?: '-',
                'x_localidade_incid' => $ibscbsNfse?->xLocalidadeIncid ?: '-',
                'c_sigla_uf' => Municipios::uf($ibscbsNfse?->cLocalidadeIncid ?? ''),
                'p_red_aliq_ibs' => '-',
                // Exclusões e reduções
                'p_red_aliq_uf' => ($ibsCbsValores?->uf?->pRedAliqUF ?? '') !== '' ? $this->fmt->percent($ibsCbsValores->uf->pRedAliqUF) : '-',
                'p_red_aliq_mun' => ($ibsCbsValores?->mun?->pRedAliqMun ?? '') !== '' ? $this->fmt->percent($ibsCbsValores->mun->pRedAliqMun) : '-',
                'p_red_aliq_cbs' => ($ibsCbsValores?->fed?->pRedAliqCBS ?? '') !== '' ? $this->fmt->percent($ibsCbsValores->fed->pRedAliqCBS) : '-',
                // Base de cálculo
                'v_bc_ibscbs' => ($ibsCbsValores?->vBC ?? '') !== '' ? $this->fmt->currency($ibsCbsValores->vBC) : '-',
                // Alíquotas regulares
                'p_ibs_uf' => ($ibsCbsValores?->uf?->pIBSUF ?? '') !== '' ? $this->fmt->percent($ibsCbsValores->uf->pIBSUF) : '-',
                'p_ibs_mun' => ($ibsCbsValores?->mun?->pIBSMun ?? '') !== '' ? $this->fmt->percent($ibsCbsValores->mun->pIBSMun) : '-',
                'p_cbs' => ($ibsCbsValores?->fed?->pCBS ?? '') !== '' ? $this->fmt->percent($ibsCbsValores->fed->pCBS) : '-',
                // Alíquotas efetivas
                'aliquota_ibs_uf' => $aliquotaIBSUF !== '' ? $this->fmt->percent($aliquotaIBSUF) : '-',
                'aliquota_ibs_mun' => $aliquotaIBSMun !== '' ? $this->fmt->percent($aliquotaIBSMun) : '-',
                'aliquota_cbs' => $aliquotaCBS !== '' ? $this->fmt->percent($aliquotaCBS) : '-',
                // Valores apurados
                'valor_ibs_uf' => $vIBSUF !== '' ? $this->fmt->currency($vIBSUF) : '-',
                'valor_ibs_mun' => $vIBSMun !== '' ? $this->fmt->currency($vIBSMun) : '-',
                'v_ibs_tot' => ($ibsCbsGIBS?->vIBSTot ?? '') !== '' ? $this->fmt->currency($ibsCbsGIBS->vIBSTot) : '-',
                'valor_cbs' => $vCBS !== '' ? $this->fmt->currency($vCBS) : '-',
                'total_ibs_cbs' => $ibsCbsTotCIBS?->vTotNF ? $this->fmt->currency($ibsCbsTotCIBS->vTotNF) : '-',
            ],

            // ===== Bloco 10: Valor Total da NFS-e =====
            'totais' => [
                'valor_servico' => $this->fmt->currency($vServPrest?->vServ ?? ''),
                'desconto_condicionado' => $tribMun?->vDescCond ? $this->fmt->currency($tribMun->vDescCond) : '-',
                'desconto_incondicionado' => $tribMun?->vDescIncond ? $this->fmt->currency($tribMun->vDescIncond) : '-',
                'issqn_retido' => ($tribMun?->vISSQN && ($tribMun?->tpRetISSQN ?? '1') !== '1')
                    ? $this->fmt->currency($tribMun->vISSQN)
                    : '-',
                'retencoes_federais' => $this->sumCurrency(
                    $tribFed?->vRetIRRF ?? '',
                    $tribFed?->vRetCP ?? '',
                    $tribFed?->vRetCSLL ?? '',
                ),
                'pis_cofins' => $this->sumCurrency(
                    $tribFed?->piscofins?->vPis ?? '',
                    $tribFed?->piscofins?->vCofins ?? '',
                ),
                'total_ibs_cbs' => $ibsCbsTotCIBS?->vTotNF ? $this->fmt->currency($ibsCbsTotCIBS->vTotNF) : '-',
                'valor_liquido' => $this->fmt->currency($valoresNfse?->vLiq ?? ''),
                'valor_liquido_ibs_cbs' => $ibsCbsTotCIBS?->vTotNF ? $this->fmt->currency($ibsCbsTotCIBS->vTotNF) : $this->fmt->currency($valoresNfse?->vLiq ?? ''),
            ],

            // ===== Totais Aproximados (Lei 12.741/2012) =====
            'totais_tributos' => $totTribValores,

            // ===== Bloco 11: Informações Complementares =====
            'informacoes_complementares' => $this->buildInfoComplementares(
                $serv?->infoCompl?->xInfComp ?? '',
                $inf?->xOutInf ?? '',
                $totTribValores,
            ),
        ];
    }

    /**
     * Constrói o texto unificado de Informações Complementares
     * União dos campos textuais separados por pipes |,
     * contendo a linha fixa dos Totais Aproximados dos Tributos (Lei nº 12.741/2012).
     */
    private function buildInfoComplementares(string $xInfComp, string $xOutInf, array $totaisTributos): string
    {
        $partes = array_filter([
            $xInfComp,
            $xOutInf,
        ], fn($v) => $v !== '');

        $texto = $partes ? implode(' | ', $partes) : '';

        $totaisLine = 'Totais Aproximados dos Tributos (Lei nº 12.741/2012): '
            . 'Federal: ' . ($totaisTributos['federais'] ?? '-') . ' / '
            . 'Estadual: ' . ($totaisTributos['estaduais'] ?? '-') . ' / '
            . 'Municipal: ' . ($totaisTributos['municipais'] ?? '-');

        if ($texto !== '') {
            $texto .= ' | ' . $totaisLine;
        } else {
            $texto = $totaisLine;
        }

        return $texto;
    }

    /**
     * Soma valores monetários e retorna formatado, ou '-' se todos forem vazios.
     */
    private function sumCurrency(string ...$values): string
    {
        $sum = 0.0;
        $hasValue = false;
        foreach ($values as $v) {
            if ($v !== '') {
                $sum += (float) $v;
                $hasValue = true;
            }
        }
        return $hasValue ? $this->fmt->currency((string) $sum) : '-';
    }

    /**
     * Gera QR Code como data URI PNG
     */
    private function generateQrCode(string $chaveAcesso): string
    {
        $url = "https://www.nfse.gov.br/ConsultaPublica/?tpc=1&chave={$chaveAcesso}";

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd(),
        );
        $writer = new Writer($renderer);
        $svg = $writer->writeString($url);

        // Retorna como SVG embutido em data URI
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
