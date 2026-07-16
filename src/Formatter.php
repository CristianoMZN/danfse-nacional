<?php

namespace DanfseNacional;

use DanfseNacional\Data\Municipios;

/**
 * Formatadores para padrões brasileiros (CNPJ, CPF, telefone, CEP, moeda, datas)
 */
class Formatter
{
    public function cnpjCpf(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        // Aceita CNPJ alfanumérico (NT 009): mantém letras nas posições onde antes
        // havia apenas dígitos, aplicando a máscara nn.nnn.nnn/nnnn-nn / nnn.nnn.nnn-nn.
        $onlyAlnum = preg_replace('/[^0-9A-Za-z]/', '', $value);

        $len = strlen($onlyAlnum);
        if ($len === 14) {
            return substr($onlyAlnum, 0, 2) . '.'
                . substr($onlyAlnum, 2, 3) . '.'
                . substr($onlyAlnum, 5, 3) . '/'
                . substr($onlyAlnum, 8, 4) . '-'
                . substr($onlyAlnum, 12, 2);
        }

        if ($len === 11) {
            return substr($onlyAlnum, 0, 3) . '.'
                . substr($onlyAlnum, 3, 3) . '.'
                . substr($onlyAlnum, 6, 3) . '-'
                . substr($onlyAlnum, 9, 2);
        }

        return $onlyAlnum !== '' ? $onlyAlnum : $value;
    }

    public function phone(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        $value = preg_replace('/\D/', '', $value);

        if (strlen($value) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
        }

        if (strlen($value) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $value);
        }

        return $value;
    }

    public function cep(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        $value = preg_replace('/\D/', '', $value);

        if (strlen($value) === 8) {
            return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $value);
        }

        return $value;
    }

    public function date(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        try {
            $dt = new \DateTimeImmutable($value);
            return $dt->format('d/m/Y');
        } catch (\Exception) {
            return $value;
        }
    }

    public function dateTime(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        try {
            $dt = new \DateTimeImmutable($value);
            return $dt->format('d/m/Y H:i:s');
        } catch (\Exception) {
            return $value;
        }
    }

    public function currency(string|float $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        return 'R$ ' . number_format((float) $value, 2, ',', '.');
    }

    /**
     * Formata código de tributação nacional para o padrão XX.XX.XX
     */
    public function codTribNacional(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        $value = preg_replace('/\D/', '', $value);

        if (strlen($value) === 6) {
            return preg_replace('/(\d{2})(\d{2})(\d{2})/', '$1.$2.$3', $value);
        }

        return $value;
    }

    public function limit(string $value, int $limit, string $end = '...'): string
    {
        if (mb_strlen($value) <= $limit) {
            return $value;
        }

        return mb_substr($value, 0, $limit) . $end;
    }

    /**
     * Formata valor percentual para o padrão brasileiro XX,XX%
     */
    public function percent(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }

        return number_format((float) $value, 2, ',', '.') . '%';
    }

    /**
     * Concatena Município / Sigla UF para os blocos do DANFSe
     * (Tomador, Destinatário, Intermediário). Quando faltam ambos, retorna '-'.
     * Usa `Municipios::nome()` para não duplicar a UF quando o chamador já
     * fornece a UF (vinda do XML) — evita "Cidade / UF / UF". Se a UF do XML
     * vier vazia mas o cMun existir, recai na UF da tabela IBGE para não
     * perder informação (era o comportamento histórico via `lookup()`).
     */
    public function concatMunicipioUf(string $cMun, string $uf): string
    {
        $municipio = $cMun !== '' ? Municipios::nome($cMun) : '';
        if ($uf === '' && $cMun !== '') {
            $uf = Municipios::uf($cMun);
        }
        $partes = array_filter(
            [$municipio, $uf],
            static fn(string $v): bool => $v !== '' && $v !== '-'
        );
        if ($partes === []) {
            return '-';
        }
        return implode(' / ', $partes);
    }

    /**
     * Concatena Local da Prestação / Sigla UF / País (ISO-2).
     * NT 008/2026 §2.4.5: bloco "Serviço Prestado" → "Local da Prestação /
     * Sigla UF / País". Default de país é "BR" quando o XML omite (operação
     * nacional sem cPaisPrestacao explícito). Para prestação internacional
     * (cPaisPrestacao ≠ 'BR') em que o código IBGE não existe na tabela,
     * a UF ausente ("-") é descartada para não poluir a linha.
     */
    public function concatLocalPrestacao(string $cLocPrestacao, string $cPais): string
    {
        $municipio = $cLocPrestacao !== '' ? Municipios::nome($cLocPrestacao) : '';
        $uf = $cLocPrestacao !== '' ? Municipios::uf($cLocPrestacao) : '';
        $pais = $cPais !== '' ? $cPais : 'BR';
        $partes = array_filter(
            [$municipio, $uf, $pais],
            static fn(string $v): bool => $v !== '' && $v !== '-'
        );
        if ($partes === []) {
            return '-';
        }
        return implode(' / ', $partes);
    }

    /**
     * Concatena Município / Sigla UF / País para o campo "Município/UF/País
     * de Incidência do ISSQN" do bloco 7. País defaulta em 'BR'.
     */
    public function concatLocalIncidencia(string $xLocIncid, string $cLocIncid): string
    {
        $uf = $cLocIncid !== '' ? Municipios::uf($cLocIncid) : '';
        $pais = 'BR';
        $partes = array_filter([$xLocIncid, $uf, $pais], static fn(string $v): bool => $v !== '');
        if ($partes === []) {
            return '-';
        }
        return implode(' / ', $partes);
    }
}
