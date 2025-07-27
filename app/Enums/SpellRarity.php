<?php

namespace App\Enums;

enum SpellRarity: string
{
    case COMMON = 'Common';
    case UNCOMMON = 'Uncommon';
    case RARE = 'Rare';
    case EPIC = 'Epic';
    case LEGENDARY = 'Legendary';

    public function getColor(): string
    {
        return match($this) {
            self::COMMON => 'gray',
            self::UNCOMMON => 'success',
            self::RARE => 'info',
            self::EPIC => 'primary',
            self::LEGENDARY => 'warning',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
