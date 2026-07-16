<?php

namespace DanfseNacional\Enums;

enum TpSuspensaoISSQN: int
{
    case DECISAO_JUDICIAL = 1;
    case DECISAO_ADMINISTRATIVA = 2;
    case PROCEDIMENTO_ADMINISTRATIVO = 3;
    case CONVENIO = 4;
    case OUTROS = 5;

    public function label(): string
    {
        return match ($this) {
            self::DECISAO_JUDICIAL => 'Decisão Judicial',
            self::DECISAO_ADMINISTRATIVA => 'Decisão Administrativa',
            self::PROCEDIMENTO_ADMINISTRATIVO => 'Procedimento Administrativo',
            self::CONVENIO => 'Convênio',
            self::OUTROS => 'Outros',
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