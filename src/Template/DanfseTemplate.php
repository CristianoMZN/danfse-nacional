<?php

namespace DanfseNacional\Template;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use DanfseNacional\Config\DanfseConfig;
use DanfseNacional\Config\DefaultLogo;
use DanfseNacional\Dto\NFSe;
use DanfseNacional\Enums\AmbGer;
use DanfseNacional\Enums\CStat;
use DanfseNacional\Enums\FinNFSe;
use DanfseNacional\Enums\OpSimpNac;
use DanfseNacional\Enums\RegApTribSN;
use DanfseNacional\Enums\RegEspTrib;
use DanfseNacional\Enums\TpAmb;
use DanfseNacional\Enums\TpEmit;
use DanfseNacional\Enums\TpImunidadeISSQN;
use DanfseNacional\Enums\TpRetISSQN;
use DanfseNacional\Enums\TpRetPisCofins;
use DanfseNacional\Enums\TpSuspensaoISSQN;
use DanfseNacional\Enums\TribISSQN;
use DanfseNacional\Data\Municipios;
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
            ],
        ], $data);
        $logo = DefaultLogo::DATA_URI;
        $municipality = $config->municipality;
        $mostrarCanhoto = $config->mostrarCanhoto;
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

        // Endereço emitente (xLgr, nro, xCpl, xBairro conforme NT 008)
        $enderecoEmit = $this->concatEndereco(
            $enderEmit?->xLgr ?? '',
            $enderEmit?->nro ?? '',
            $enderEmit?->xCpl ?? '',
            $enderEmit?->xBairro ?? '',
        );

        $municipioEmit = Municipios::lookup($emit?->enderNac?->cMun ?? '');

        // Endereço tomador
        $enderecoToma = $this->concatEndereco(
            $endToma?->xLgr ?? '',
            $endToma?->nro ?? '',
            $endToma?->xCpl ?? '',
            $endToma?->xBairro ?? '',
        );

        $cepToma = $endToma?->endNac?->CEP ?? '';
        $ibgeToma = $endToma?->endNac?->cMun ?? '';

        // Endereço intermediário
        $enderecoInterm = $this->concatEndereco(
            $endInterm?->xLgr ?? '',
            $endInterm?->nro ?? '',
            $endInterm?->xCpl ?? '',
            $endInterm?->xBairro ?? '',
        );

        $cepInterm = $endInterm?->endNac?->CEP ?? '';

        // IBS/CBS no infNFSe (valores calculados pelo sistema)
        $ibsCbsValores = $ibscbsNfse?->valores;
        $ibsCbsTotCIBS = $ibscbsNfse?->totCIBS;
        $ibsCbsGIBS = $ibsCbsTotCIBS?->gIBS;
        $ibsCbsGCBS = $ibsCbsTotCIBS?->gCBS;

        // IBS/CBS no DPS (declarado pelo emitente)
        $ibsCbsDpsValores = $ibscbsDps?->valores?->trib?->gIBSCBS;

        // Totais aproximados de tributos (Lei 12.741/2012): R$ OU %, conforme disponibilidade
        $totTribValores = [
            'federais' => $totTrib?->vTotTribFed ? $this->fmt->currency($totTrib->vTotTribFed)
                : (($totTrib?->pTotTrib?->pTotTribFed ?? '') !== '' ? $this->fmt->percent($totTrib->pTotTrib->pTotTribFed) : '-'),
            'estaduais' => $totTrib?->vTotTribEst ? $this->fmt->currency($totTrib->vTotTribEst)
                : (($totTrib?->pTotTrib?->pTotTribEst ?? '') !== '' ? $this->fmt->percent($totTrib->pTotTrib->pTotTribEst) : '-'),
            'municipais' => $totTrib?->vTotTribMun ? $this->fmt->currency($totTrib->vTotTribMun)
                : (($totTrib?->pTotTrib?->pTotTribMun ?? '') !== '' ? $this->fmt->percent($totTrib->pTotTrib->pTotTribMun) : '-'),
        ];

        // Alíquotas IBS/CBS efetivas (do infNFSe/IBSCBS/valores)
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

        $enderecoDest = $this->concatEndereco(
            $endDest?->xLgr ?? '',
            $endDest?->nro ?? '',
            $endDest?->xCpl ?? '',
            $endDest?->xBairro ?? '',
        );

        $cepDest = $endDest?->endNac?->CEP ?? '';

        // Determina se tomador está identificado
        $tomadorIdentificado = $toma !== null && ($toma->CNPJ !== '' || $toma->CPF !== '' || $toma->NIF !== '' || $toma->xNome !== '');

        // Determina situação do destinatário (NT 008 §2.3.1 e §2.3.2):
        //   - mesmo_tomador: indDest=0 (declarado na DPS) OU documento do dest
        //     coincide com o do tomador;
        //   - nao_identificado: bloco dest ausente/vazio no XML — sem
        //     indicação explícita no arquivo, a NT 008 §2.1 proíbe afirmar
        //     que o destinatário é o próprio tomador;
        //   - identificado: bloco de destinatário preenchido com dados próprios.
        $destDoc = $dest?->CNPJ ?: ($dest?->CPF ?: ($dest?->NIF ?: ''));
        $tomaDoc = $toma?->CNPJ ?: ($toma?->CPF ?: ($toma?->NIF ?: ''));
        $destVazio = $dest === null || ($dest->CNPJ === '' && $dest->CPF === '' && $dest->NIF === '' && $dest->xNome === '');
        if ($indDest === '0' || ($destDoc !== '' && $tomaDoc !== '' && $destDoc === $tomaDoc)) {
            $destinatarioSituacao = 'mesmo_tomador';
        } elseif ($destVazio) {
            $destinatarioSituacao = 'nao_identificado';
        } else {
            $destinatarioSituacao = 'identificado';
        }

        // Verifica se a operação é sujeita ao ISSQN
        $isSujeitaISSQN = $tribMun !== null && $tribMun->tribISSQN !== '' && $tribMun->tribISSQN !== '4';

        // Verifica se precisa ocultar PIS/COFINS (Nota 6: apenas até 2026)
        $competenciaAno = $infDps?->dCompet ? (int) substr($infDps->dCompet, 0, 4) : 0;
        $hidePisCofins = $competenciaAno >= 2027;

        // Flags de supressão para linhas do ISSQN (Nota 5)
        $vRegime = RegEspTrib::labelFor($regTrib?->regEspTrib ?? '');
        $vTipoImunidade = TpImunidadeISSQN::labelFor($tribMun?->tpImunidade ?? '');
        $vSuspensao = TpSuspensaoISSQN::labelFor($tribMun?->suspExigibilidade ?? '');
        $vProcesso = $tribMun?->nProcessoSuspensao ?? '';
        $linhaRegimeVazia = $vRegime === '-' && ($vTipoImunidade === '' || $vTipoImunidade === '-') && ($vSuspensao === '' || $vSuspensao === '-') && $vProcesso === '';

        $vBeneficio = $valoresNfse?->tpBM ?? '';
        $vCalcBM = $valoresNfse?->vCalcBM !== null && $valoresNfse->vCalcBM !== ''
            ? $this->fmt->currency($valoresNfse->vCalcBM)
            : '-';
        $vTotalDeducoes = $this->sumCurrency(
            $tribMun?->vDeducao ?? '',
            $tribMun?->vOutDed ?? '',
        );
        $vDescIncondTrib = $tribMun?->vDescIncond ? $this->fmt->currency($tribMun->vDescIncond) : '-';
        $linhaBeneficioVazia = $vBeneficio === '' && $vCalcBM === '-' && $vTotalDeducoes === '-' && $vDescIncondTrib === '-';

        // Situação da NFS-e (cStat) — nunca usar tpEmis
        $cStatValue = $inf?->cStat ?? '';
        $situacaoNfse = CStat::labelFor($cStatValue);
        $isCancelada = CStat::isCancelada($cStatValue);
        $isSubstituida = CStat::isSubstituida($cStatValue);

        // Emitente da NFS-e — usar tpEmit conforme NT 008 (tam. máx. 13 chars)
        $emitenteRotulo = $this->fmt->limit(TpEmit::labelFor($infDps?->tpEmit ?? ''), 13);

        // Chave de acesso truncada mantém 50 dígitos; para "Situação"/"Finalidade" 37 chars.
        $situacaoNfse = $this->fmt->limit($situacaoNfse, 37);
        $finalidade = $this->fmt->limit(FinNFSe::labelFor($infDps?->finNFSe ?? ''), 37);

        return [
            // ===== Bloco 1: Cabeçalho e Identificação =====
            'chave_acesso' => $chaveAcesso,
            'numero_nfse' => $inf?->nNFSe ?: '-',
            'competencia' => $this->fmt->date($infDps?->dCompet ?? ''),
            'emissao_nfse' => $this->fmt->dateTime($inf?->dhProc ?? ''),
            'numero_dps' => $infDps?->nDPS ?: '-',
            'serie_dps' => $infDps?->serie ?: '-',
            'emissao_dps' => $this->fmt->dateTime($infDps?->dhEmi ?? ''),
            'municipio_uf' => $municipioEmit ?: '-',
            'ambiente_gerador' => AmbGer::labelFor($inf?->ambGer ?? ''),
            'tipo_ambiente' => TpAmb::labelFor((int) ($infDps?->tpAmb ?? 1)),
            'situacao_nfse' => $situacaoNfse,
            'finalidade' => $finalidade,
            'emitente_rotulo' => $emitenteRotulo,
            'ambiente' => (int) ($infDps?->tpAmb ?? 1),

            // Marca d'água NT 008 §2.5
            'is_cancelada' => $isCancelada,
            'is_substituida' => $isSubstituida,

            // ===== Bloco 2: Prestador / Fornecedor =====
            'emitente' => [
                'nome' => $this->fmt->limit($emit?->xNome ?? '-', 77),
                'cnpj_cpf' => $this->fmt->cnpjCpf($emit?->documento() ?? ''),
                'nif' => $emit?->NIF ?: '-',
                'im' => $emit?->IM ?: '-',
                'telefone' => $this->fmt->phone($emit?->fone ?? ''),
                'email' => ($emit?->email ?? '') !== '' ? strtolower($emit->email) : '-',
                'endereco' => $this->fmt->limit($enderecoEmit ?: '-', 77),
                'municipio' => $municipioEmit ?: '-',
                'codigo_ibge' => $enderEmit?->cMun ?: '-',
                'cep' => $this->fmt->cep($enderEmit?->CEP ?? ''),
                'simples_nacional' => $this->fmt->limit(OpSimpNac::labelFor($regTrib?->opSimpNac ?? ''), 37),
                'regime_sn' => $this->fmt->limit(RegApTribSN::labelFor($regTrib?->regApTribSN ?? ''), 77),
            ],

            // ===== Bloco 3: Tomador / Adquirente =====
            'tomador_identificado' => $tomadorIdentificado,
            'tomador' => [
                'nome' => $this->fmt->limit($toma?->xNome ?? '-', 77),
                'cnpj_cpf' => $this->fmt->cnpjCpf($toma?->documento() ?? ''),
                'nif' => $toma?->NIF ?: '-',
                'im' => $toma?->IM ?: '-',
                'telefone' => $this->fmt->phone($toma?->fone ?? ''),
                'email' => ($toma?->email ?? '') !== '' ? strtolower($toma->email) : '-',
                'endereco' => $this->fmt->limit($enderecoToma ?: '-', 77),
                'municipio' => $this->fmt->concatMunicipioUf($endToma?->endNac?->cMun ?? '', $endToma?->endNac?->UF ?? ''),
                'codigo_ibge' => $ibgeToma ?: '-',
                'cep' => $this->fmt->cep($cepToma),
            ],

            // ===== Bloco 4: Destinatário da Operação =====
            'destinatario_situacao' => $destinatarioSituacao,
            'destinatario' => [
                'nome' => $this->fmt->limit($dest?->xNome ?? '-', 77),
                'cnpj_cpf' => $this->fmt->cnpjCpf($dest?->CNPJ ?: ($dest?->CPF ?: ($dest?->NIF ?? ''))),
                'nif' => $dest?->NIF ?: '-',
                'telefone' => $this->fmt->phone($dest?->fone ?? ''),
                'email' => ($dest?->email ?? '') !== '' ? strtolower($dest->email) : '-',
                'endereco' => $this->fmt->limit($enderecoDest ?: '-', 77),
                'municipio' => $this->fmt->concatMunicipioUf($endDest?->endNac?->cMun ?? '', $endDest?->endNac?->UF ?? ''),
                'codigo_ibge' => $endDest?->endNac?->cMun ?: '-',
                'cep' => $this->fmt->cep($cepDest),
            ],

            // ===== Bloco 5: Intermediário da Operação =====
            'intermediario' => $interm !== null ? [
                'nome' => $this->fmt->limit($interm->xNome ?: '-', 77),
                'cnpj_cpf' => $this->fmt->cnpjCpf($interm->documento()),
                'nif' => $interm->NIF ?: '-',
                'im' => $interm->IM ?: '-',
                'telefone' => $this->fmt->phone($interm->fone),
                'email' => $interm->email !== '' ? strtolower($interm->email) : '-',
                'endereco' => $this->fmt->limit($enderecoInterm ?: '-', 77),
                'municipio' => $this->fmt->concatMunicipioUf($endInterm?->endNac?->cMun ?? '', $endInterm?->endNac?->UF ?? ''),
                'codigo_ibge' => $endInterm?->endNac?->cMun ?: '-',
                'cep' => $this->fmt->cep($cepInterm),
            ] : null,

            // ===== Bloco 6: Serviço Prestado =====
            'servico' => [
                'codigo_trib_nacional' => $this->fmt->codTribNacional($cServ?->cTribNac ?? ''),
                'desc_trib_nacional' => $this->fmt->limit(trim($inf?->xTribNac ?? ''), 167),
                'codigo_trib_municipal' => $cServ?->cTribMun ?: '-',
                'desc_trib_municipal' => $this->fmt->limit(trim($inf?->xTribMun ?? ''), 167),
                'codigo_nbs' => $cServ?->cNBS ?: '-',
                'local_prestacao' => $this->fmt->concatLocalPrestacao(
                    $locPrest?->cLocPrestacao ?? '',
                    $locPrest?->cPaisPrestacao ?? '',
                ),
                'pais_prestacao' => $locPrest?->cPaisPrestacao ?: '-',
                'descricao' => $this->fmt->limit(
                    $cServ?->xDescServ ?? '-',
                    $this->descricaoCap(mb_strlen($serv?->infoCompl?->xInfComp ?? ''))
                ),
            ],

            // ===== Bloco 7: Tributação Municipal (ISSQN) =====
            'is_sujeita_issqn' => $isSujeitaISSQN,
            'tributacao_municipal' => [
                'tributacao_issqn' => TribISSQN::labelFor($tribMun?->tribISSQN ?? ''),
                'municipio_incidencia' => $this->fmt->concatLocalIncidencia(
                    $inf?->xLocIncid ?? '',
                    $inf?->cLocIncid ?? '',
                ),
                'regime_especial' => $this->fmt->limit($vRegime, 27),
                'tipo_imunidade' => $this->fmt->limit($vTipoImunidade ?: '-', 37),
                'suspensao_exigibilidade' => $this->fmt->limit($vSuspensao ?: '-', 37),
                'num_processo_suspensao' => $vProcesso ?: '-',
                'beneficio_municipal' => $this->fmt->limit($vBeneficio ?: '-', 37),
                'calculo_bm' => $vCalcBM,
                'total_deducoes' => $vTotalDeducoes,
                'desconto_incondicionado' => $vDescIncondTrib,
                'valor_servico' => $this->fmt->currency($vServPrest?->vServ ?? ''),
                'bc_issqn' => $valoresNfse?->vBC ? $this->fmt->currency($valoresNfse->vBC) : '-',
                'aliquota' => $valoresNfse?->pAliqAplic !== null && $valoresNfse->pAliqAplic !== '' ? $this->fmt->percent($valoresNfse->pAliqAplic) : '-',
                'retencao_issqn' => TpRetISSQN::labelFor($tribMun?->tpRetISSQN ?? ''),
                'issqn_apurado' => $valoresNfse?->vISSQN ? $this->fmt->currency($valoresNfse->vISSQN) : '-',
            ],
            'suppress_regime_line' => $linhaRegimeVazia,
            'suppress_beneficio_line' => $linhaBeneficioVazia,

            // ===== Bloco 8: Tributação Federal (Exceto CBS) =====
            'hide_pis_cofins' => $hidePisCofins,
            'tributacao_federal' => [
                'irrf' => $tribFed?->vRetIRRF ? $this->fmt->currency($tribFed->vRetIRRF) : '-',
                'cp' => $tribFed?->vRetCP ? $this->fmt->currency($tribFed->vRetCP) : '-',
                'csll' => $tribFed?->vRetCSLL ? $this->fmt->currency($tribFed->vRetCSLL) : '-',
                'contrib_sociais' => $tribFed?->vRetCSLL !== null && $tribFed->vRetCSLL !== ''
                    ? $this->fmt->currency($tribFed->vRetCSLL)
                    : '-',
                'desc_contrib_sociais' => TpRetPisCofins::labelFor($tribFed?->piscofins?->tpRetPisCofins ?? ''),
                'pis' => $tribFed?->piscofins?->vPis ? $this->fmt->currency($tribFed->piscofins->vPis) : '-',
                'cofins' => $tribFed?->piscofins?->vCofins ? $this->fmt->currency($tribFed->piscofins->vCofins) : '-',
            ],

            // ===== Bloco 9: Tributação IBS / CBS =====
            // O bloco sempre é renderizado (NT 008 §2.4.5; lista de supressões
            // permitidas em suppression_rules.md não inclui este bloco);
            // campos sem informação no XML recebem '-' (Nota 12 §2.4.5).
            'ibs_cbs' => [
                'cst' => $ibsCbsDpsValores?->CST ?: '-',
                'c_class_trib' => $ibsCbsDpsValores?->cClassTrib ?: '-',
                'c_ind_op' => $ibscbsDps?->cIndOp ?: '-',
                'c_localidade_incid' => $ibscbsNfse?->cLocalidadeIncid ?: '-',
                'x_localidade_incid' => $ibscbsNfse?->xLocalidadeIncid ?: '-',
                'c_sigla_uf' => Municipios::uf($ibscbsNfse?->cLocalidadeIncid ?? ''),

                // Exclusões e Reduções da BC — somatório dos termos subtraídos
                // da BC do IBS/CBS conforme NT 008 §2.4.5 e fórmula da NT 009:
                //   vBC = vServ - descIncond - vCalcAjusteBCIBSCBS/LocImoveis
                //         - vISSQN - vPIS - vCOFINS (até 2026)
                // Os termos subtraídos são exatamente o que entra neste somatório.
                // PIS/COFINS só compõem até fim de 2026 (Nota 6 §2.4.5).
                'exclusoes_reducoes' => $this->sumCurrency(
                    $ibsCbsValores?->vCalcAjusteBCIBSCBS ?? '',
                    $ibsCbsValores?->vCalcAjusteBCLocImoveis ?? '',
                    $valores?->vDescCondIncond?->vDescIncond ?? '',
                    $valoresNfse?->vISSQN ?? '',
                    ...($hidePisCofins ? [] : [
                        $tribFed?->piscofins?->vPis ?? '',
                        $tribFed?->piscofins?->vCofins ?? '',
                    ]),
                ),

                // Percentuais de redução da alíquota
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
                // Total do IBS / CBS = vIBSTot + vCBS (NT 008 §2.4.5).
                // Não confundir com vTotNF (Valor Líquido da NFS-e + IBS/CBS).
                'total_ibs_cbs' => $this->sumCurrency(
                    $ibsCbsGIBS?->vIBSTot ?? '',
                    $ibsCbsGCBS?->vCBS ?? '',
                ),
            ],

            // ===== Bloco 10: Valor Total da NFS-e =====
            'totais' => [
                'valor_servico' => $this->fmt->currency($vServPrest?->vServ ?? ''),
                'desconto_condicionado' => $this->pickDesconto(
                    $valores?->vDescCondIncond?->vDescCond ?? '',
                    $tribMun?->vDescCond ?? '',
                ),
                'desconto_incondicionado' => $this->pickDesconto(
                    $valores?->vDescCondIncond?->vDescIncond ?? '',
                    $tribMun?->vDescIncond ?? '',
                ),
                'issqn_retido' => ($valoresNfse?->vISSQN && ($tribMun?->tpRetISSQN ?? '1') !== '1')
                    ? $this->fmt->currency($valoresNfse->vISSQN)
                    : '-',
                'retencoes_federais' => $valoresNfse?->vTotalRet
                    ? $this->fmt->currency($valoresNfse->vTotalRet)
                    : '-',
                'pis_cofins' => $this->sumCurrency(
                    $tribFed?->piscofins?->vPis ?? '',
                    $tribFed?->piscofins?->vCofins ?? '',
                ),
                'total_ibs_cbs' => $this->sumCurrency(
                    $ibsCbsGIBS?->vIBSTot ?? '',
                    $ibsCbsGCBS?->vCBS ?? '',
                ),
                'valor_liquido' => $this->fmt->currency($valoresNfse?->vLiq ?? ''),
                'valor_liquido_ibs_cbs' => $ibsCbsTotCIBS?->vTotNF ? $this->fmt->currency($ibsCbsTotCIBS->vTotNF) : $this->fmt->currency($valoresNfse?->vLiq ?? ''),
            ],

            // ===== Totais Aproximados (Lei 12.741/2012) =====
            'totais_tributos' => $totTribValores,

            // ===== Bloco 11: Informações Complementares =====
            'informacoes_complementares' => $this->buildInfoComplementares(
                $serv?->infoCompl?->xInfComp ?? '',
                $serv?->infoCompl?->docRef ?? '',
                $serv?->infoCompl?->idDocTec ?? '',
                $serv?->infoCompl?->xPed ?? '',
                $serv?->infoCompl?->gItemPed?->xItemPed ?? [],
                $this->resolveXOutInf($inf?->xOutInf ?? '', $valoresNfse?->xOutInf ?? ''),
                $totTribValores,
                $infDps?->subst?->chSubstda ?? '',
                $isSubstituida,
                $serv?->obra?->cObra ?? '',
                $serv?->obra?->inscImobFisc ?? '',
                $serv?->atvEvento?->idAtvEvt ?? '',
                mb_strlen($cServ?->xDescServ ?? ''),
                mb_strlen($serv?->infoCompl?->xInfComp ?? ''),
            ),
        ];
    }

    /**
     * Resolve `xOutInf` considerando tanto o caminho oficial
     * (`NFSe/infNFSe/xOutInf`, NT 008) quanto o caminho alternativo usado por
     * alguns emissores que aninham em `valores/xOutInf`. Mantém o valor
     * do caminho oficial quando ele existe; cai para o alternativo apenas
     * se o oficial estiver vazio.
     */
    private function resolveXOutInf(string $canonical, string $fallback): string
    {
        return $canonical !== '' ? $canonical : $fallback;
    }

    /**
     * Teto efetivo da Descrição do Serviço (xDescServ) para a página.
     * NT 008 §2.4.5 fixa o limite do campo em 1297 chars; aqui aplicamos
     * truncamento visual coordenado com `xInfComp` para garantir página
     * única (NT 008 §2.2). Quando o emitente preenche os dois campos com
     * textos longos (cenário típico de prestadores que repetem a base legal
     * em ambos), reduzimos o teto para caber na altura disponível do
     * bloco 6 — a perda fica visível com reticências.
     */
    private function descricaoCap(int $xInfCompLength): int
    {
        return $xInfCompLength > 500 ? 400 : 1297;
    }

    /**
     * Concatena as partes de endereço (xLgr, nro, xCpl, xBairro) descartando vazios.
     */
    private function concatEndereco(string $xLgr, string $nro, string $xCpl, string $xBairro): string
    {
        return implode(', ', array_filter(
            [$xLgr, $nro, $xCpl, $xBairro],
            fn($v) => $v !== ''
        ));
    }

    /**
     * Constrói o texto unificado de Informações Complementares na ordem oficial
     * definida pela NT 008/2026 (Nota 12 da tabela de campos), separados por " | ".
     * A linha de "Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012" é
     * obrigatória e vai sempre por último. O texto total é truncado em 1997
     * caracteres preservando a linha final de totais.
     *
     * Ordem oficial:
     *   Inf. Cont.: | NFS-e Subst.: | Doc. Ref.: | Cod. Obra: / Insc. Imob.:
     *   | Cod. Evt.: | Doc. Tec.: | Núm. Ped.: | Item Ped.: | Inf. A. T. Mun.:
     *   | Totais Aproximados ...
     *
     * O truncamento é coordenado com o tamanho da Descrição do Serviço
     * (xDescServ) para garantir página única (NT 008 §2.2): quando o emitente
     * preenche tanto xDescServ quanto xInfComp com textos longos (cenário
     * típico dos prestadores com base legal repetida em ambos os campos),
     * o orçamento do corpo é reduzido para que a soma visual não estoure
     * a altura disponível do bloco 11.
     */
    private function buildInfoComplementares(
        string $xInfComp,
        string $docRef,
        string $idDocTec,
        string $xPed,
        array $xItemPed,
        string $xOutInf,
        array $totaisTributos,
        string $chSubstda,
        bool $isSubstituida,
        string $codObra,
        string $inscImob,
        string $codEvt,
        int $xDescServLength,
        int $xInfCompLength,
    ): string {
        $partes = [];
        if ($xInfComp !== '') {
            $partes[] = 'Inf. Cont.: ' . $xInfComp;
        }
        if ($isSubstituida && $chSubstda !== '') {
            $partes[] = 'NFS-e Subst.: ' . $chSubstda;
        }
        if ($docRef !== '') {
            $partes[] = 'Doc. Ref.: ' . $docRef;
        }
        if ($codObra !== '') {
            $partes[] = 'Cod. Obra: ' . $codObra;
        }
        if ($inscImob !== '') {
            $partes[] = 'Insc. Imob.: ' . $inscImob;
        }
        if ($codEvt !== '') {
            $partes[] = 'Cod. Evt.: ' . $codEvt;
        }
        if ($idDocTec !== '') {
            $partes[] = 'Doc. Tec.: ' . $idDocTec;
        }
        if ($xPed !== '') {
            $partes[] = 'Núm. Ped.: ' . $xPed;
        }
        if ($xItemPed !== []) {
            $partes[] = 'Item Ped.: ' . implode(', ', $xItemPed);
        }
        if ($xOutInf !== '') {
            $partes[] = 'Inf. A. T. Mun.: ' . $xOutInf;
        }

        $totaisLine = 'Totais Aproximados dos Tributos cfe. Lei nº 12.741/2012: '
            . 'Federais: ' . ($totaisTributos['federais'] ?? '-') . ' ; '
            . 'Estaduais: ' . ($totaisTributos['estaduais'] ?? '-') . ' ; '
            . 'Municipais: ' . ($totaisTributos['municipais'] ?? '-');

        // Trunca o corpo (sem a linha de totais) preservando a linha final.
        $body = $partes ? implode(' | ', $partes) : '';
        $nt008Cap = 1997 - mb_strlen($totaisLine) - ($body !== '' ? 3 : 0);
        if ($nt008Cap < 0) {
            $nt008Cap = 0;
        }
        // Truncamento coordenado com xDescServ: quando ambos os campos
        // (Descrição do Serviço e Inf. Complementares) trazem textos longos
        // — cenário típico de prestadores com base legal repetida em ambos
        // os campos — reduzimos o orçamento do corpo para preservar página
        // única (NT 008 §2.2). A perda fica visível com reticências.
        $coordinatedCap = $nt008Cap;
        if ($xDescServLength > 500 && $xInfCompLength > 500) {
            $coordinatedCap = min($coordinatedCap, 500);
        }
        $bodyBudget = max(0, $coordinatedCap);
        if ($body !== '' && mb_strlen($body) > $bodyBudget) {
            $body = mb_substr($body, 0, max(0, $bodyBudget - 3)) . '...';
        }

        return $body !== '' ? $body . ' | ' . $totaisLine : $totaisLine;
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
     * Escolhe o primeiro valor monetário não vazio e devolve formatado.
     * Usado para os rótulos "Desconto Incondicionado" / "Desconto Condicionado"
     * do Bloco 10, que conforme NT 008 §2.3.3 têm como fonte primária o grupo
     * `valores/vDescCondIncond/` (vDescIncond/vDescCond). Aceita fallback para
     * `tribMun/vDescIncond/vDescCond` quando a fonte primária estiver vazia.
     */
    private function pickDesconto(string ...$values): string
    {
        foreach ($values as $v) {
            if ($v !== '') {
                return $this->fmt->currency($v);
            }
        }
        return '-';
    }

    /**
     * Gera QR Code como data URI SVG apontando para a consulta pública nacional.
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

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
