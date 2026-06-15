<?php

namespace DanfseNacional\Enums;

enum RegApIBSCBSSN: string
{
    case IBS_CBS_SN = '1';
    case CBS_SN = '2';
    case PROPRIO = '3';

    public function label(): string
    {
        return match ($this) {
            self::IBS_CBS_SN => 'IBS e CBS no Simples Nacional',
            self::CBS_SN => 'Somente CBS no Simples Nacional',
            self::PROPRIO => 'Regime Próprio de Apuração',
        };
    }

    public static function labelFor(string $value): string
    {
        $case = self::tryFrom($value);
        return $case ? $case->label() : '-';
    }
}
