<?php

namespace DanfseNacional\Enums;

enum TpAmb: int
{
    case PRODUCAO = 1;
    case HOMOLOGACAO = 2;

    public function label(): string
    {
        return match ($this) {
            self::PRODUCAO => 'Produção',
            self::HOMOLOGACAO => 'Homologação',
        };
    }

    public static function labelFor(int $value): string
    {
        $case = self::tryFrom((int) $value);
        return $case ? $case->label() : '-';
    }
}
