<?php

namespace DanfseNacional;

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
}
