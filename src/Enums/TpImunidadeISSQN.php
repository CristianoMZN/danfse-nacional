<?php

namespace DanfseNacional\Enums;

enum TpImunidadeISSQN: int
{
    case PATRIMONIO_RENDA_IMOVEIS = 1;
    case TAXI = 2;
    case ENTIDADES_RELIGIOSAS = 3;
    case ENTIDADES_SOCIAIS = 4;
    case OUTRAS = 5;

    public function label(): string
    {
        return match ($this) {
            self::PATRIMONIO_RENDA_IMOVEIS => 'Patrimônio, renda ou serviços derivados e decorrentes de imóveis',
            self::TAXI => 'Serviços de transporte público urbano de passageiros, prestados diretamente ou por meio de cooperativa, por táxi ou veículo afim',
            self::ENTIDADES_RELIGIOSAS => 'Atividades e serviços religiosos prestados por templos de qualquer culto',
            self::ENTIDADES_SOCIAIS => 'Atividades das entidades beneficentes, recreativas, culturais e de assistência social',
            self::OUTRAS => 'Outras',
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