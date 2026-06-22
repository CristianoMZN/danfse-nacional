<?php

namespace DanfseNacional\Enums;

enum TpEmis: int
{
    case NORMAL = 1;
    case SUBSTITUICAO = 2;
    case CANCELAMENTO = 3;

    public function label(): string
    {
        return match ($this) {
            self::NORMAL => 'NFS-e Normal',
            self::SUBSTITUICAO => 'NFS-e de Substituição',
            self::CANCELAMENTO => 'NFS-e Cancelada',
        };
    }

    public static function labelFor(string $value): string
    {
        $case = self::tryFrom((int) $value);
        return $case ? $case->label() : '-';
    }
}
