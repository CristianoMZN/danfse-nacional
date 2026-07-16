<?php

namespace DanfseNacional\Enums;

enum TpRetPisCofins: int
{
    case NENHUMA = 0;
    case RETIDO_PIS_COFINS = 1;
    case RETIDO_PIS = 2;
    case RETIDO_COFINS = 3;
    case RETIDO_PIS_NAO_CUMULATIVO = 4;
    case RETIDO_COFINS_NAO_CUMULATIVO = 5;
    case RETIDO_PIS_COFINS_NAO_CUMULATIVO = 6;
    case RETIDO_CONTRIBUICAO_PREVIDENCIARIA = 7;
    case RETIDO_PIS_COFINS_PREVIDENCIARIA = 8;
    case OUTRAS = 9;

    public function label(): string
    {
        return match ($this) {
            self::NENHUMA => 'Nenhuma retenção',
            self::RETIDO_PIS_COFINS => 'PIS/PASEP e COFINS retidos',
            self::RETIDO_PIS => 'PIS/PASEP retido',
            self::RETIDO_COFINS => 'COFINS retida',
            self::RETIDO_PIS_NAO_CUMULATIVO => 'PIS/PASEP retido por apuração não cumulativa',
            self::RETIDO_COFINS_NAO_CUMULATIVO => 'COFINS retida por apuração não cumulativa',
            self::RETIDO_PIS_COFINS_NAO_CUMULATIVO => 'PIS/PASEP e COFINS retidos por apuração não cumulativa',
            self::RETIDO_CONTRIBUICAO_PREVIDENCIARIA => 'Contribuição Previdenciária retida',
            self::RETIDO_PIS_COFINS_PREVIDENCIARIA => 'PIS/PASEP, COFINS e Contribuição Previdenciária retidos',
            self::OUTRAS => 'Outras retenções',
        };
    }

    public static function labelFor(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }
        $case = self::tryFrom((int) $value);
        return $case ? $case->label() : '-';
    }
}