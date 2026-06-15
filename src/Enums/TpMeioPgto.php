<?php

namespace DanfseNacional\Enums;

enum TpMeioPgto: string
{
    case BOLETO = '15';
    case PIX = '17';
    case CARTAO_CREDITO = '18';
    case CARTAO_DEBITO = '19';
    case OUTROS = '99';

    public function label(): string
    {
        return match ($this) {
            self::BOLETO => 'Boleto',
            self::PIX => 'PIX',
            self::CARTAO_CREDITO => 'Cartão de Crédito',
            self::CARTAO_DEBITO => 'Cartão de Débito',
            self::OUTROS => 'Outros',
        };
    }

    public static function labelFor(string $value): string
    {
        $case = self::tryFrom($value);
        return $case ? $case->label() : '-';
    }
}
