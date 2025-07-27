<?php

namespace App\Enums;

enum SpellComponents: string
{
    case VERBAL = 'V';
    case SOMATIC = 'S';
    case MATERIAL = 'M';
    case FOCUS = 'F';
    case RITUAL = 'R';

    public function getLabel(): string
    {
        return match($this) {
            self::VERBAL => 'Verbal',
            self::SOMATIC => 'Somatic',
            self::MATERIAL => 'Material',
            self::FOCUS => 'Focus',
            self::RITUAL => 'Ritual',
        };
    }

    public function getDescription(): string
    {
        return match($this) {
            self::VERBAL => 'Words of power that must be spoken clearly',
            self::SOMATIC => 'Hand gestures and body movements',
            self::MATERIAL => 'Physical components consumed or used',
            self::FOCUS => 'A special item that channels the spell',
            self::RITUAL => 'A ritual that must be performed',
        };
    }

    public function getAbbreviation(): string
    {
        return $this->value;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

