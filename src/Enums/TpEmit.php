<?php

namespace DanfseNacional\Enums;

enum TpEmit: int
{
    case PRESTADOR = 1;
    case TOMADOR = 2;
    case INTERMEDIARIO = 3;

    public function label(): string
    {
        return match ($this) {
            self::PRESTADOR => 'Prestador do Serviço',
            self::TOMADOR => 'Tomador do Serviço',
            self::INTERMEDIARIO => 'Intermediário do Serviço',
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
