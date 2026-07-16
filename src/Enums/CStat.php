<?php

namespace DanfseNacional\Enums;

enum CStat: string
{
    case AUTORIZADA = '100';
    case CANCELADA = '101';
    case SUBSTITUIDA = '102';
    case INUTILIZADA = '103';

    public function label(): string
    {
        return match ($this) {
            self::AUTORIZADA => 'NFS-e Autorizada',
            self::CANCELADA => 'NFS-e Cancelada',
            self::SUBSTITUIDA => 'NFS-e Substituída',
            self::INUTILIZADA => 'NFS-e Inutilizada',
        };
    }

    public static function labelFor(string $value): string
    {
        if ($value === '' || $value === '-') {
            return '-';
        }
        $case = self::tryFrom($value);
        return $case ? $case->label() : $value;
    }

    public static function isCancelada(string $value): bool
    {
        return $value === self::CANCELADA->value;
    }

    public static function isSubstituida(string $value): bool
    {
        return $value === self::SUBSTITUIDA->value;
    }
}
