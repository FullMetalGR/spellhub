<?php

namespace App\Enums;

enum SpellLevel: string
{
    case CANTRIP = 'Cantrip';
    case MINOR = 'Minor';
    case GREATER = 'Greater';
    case ARCANE = 'Arcane';
    case ELDRITCH = 'Eldritch';
    case DIVINE = 'Divine';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match($this) {
            self::CANTRIP => 'gray',
            self::MINOR => 'success',
            self::GREATER => 'danger',
            self::ARCANE => 'info',
            self::ELDRITCH => 'primary',
            self::DIVINE => 'warning',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
