<?php
namespace DanfseNacional\Enums;

enum AmbGer: string
{
    case PROPRIO = '1';
    case SEFIN = '2';
    

    public function label(): string
    {
        return match ($this) {
            self::PROPRIO => 'Sistema Próprio do Município',
            self::SEFIN => 'Sefin Nacional NFS-e',
            
        };
    }

    public static function labelFor(string $value): string
    {
        $case = self::tryFrom($value);
        return $case ? $case->label() : '-';
    }
}