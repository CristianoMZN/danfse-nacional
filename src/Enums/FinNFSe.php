<?php

namespace DanfseNacional\Enums;

enum FinNFSe: string
{
    case REGULAR = '0';
    case CREDITO = '1';
    case DEBITO = '2';

    public function label(): string
    {
        return match ($this) {
            self::REGULAR => 'NFS-e Regular',
            self::CREDITO => 'NFS-e de Ajuste de Crédito',
            self::DEBITO => 'NFS-e de Ajuste de Débito',
        };
    }

    public static function labelFor(string $value): string
    {
        $case = self::tryFrom($value);
        return $case ? $case->label() : '-';
    }
}
