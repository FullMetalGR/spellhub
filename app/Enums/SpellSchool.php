<?php

namespace App\Enums;

enum SpellSchool: string
{
    case ABJURATION = 'Abjuration';
    case CONJURATION = 'Conjuration';
    case DIVINATION = 'Divination';
    case ENCHANTMENT = 'Enchantment';
    case EVOCATION = 'Evocation';
    case ILLUSION = 'Illusion';
    case NECROMANCY = 'Necromancy';
    case TRANSMUTATION = 'Transmutation';
    case PSYONIC = 'Psyonic';

    public function getColor(): string
    {
        return match($this) {
            self::ABJURATION => 'info',
            self::CONJURATION => 'success',
            self::DIVINATION => 'primary',
            self::ENCHANTMENT => 'info',
            self::EVOCATION => 'danger',
            self::ILLUSION => 'warning',
            self::NECROMANCY => 'gray',
            self::TRANSMUTATION => 'primary',
            self::PSYONIC => 'warning',
        };
    }

    public function getDescription(): string
    {
        return match($this) {
            self::ABJURATION => 'Protective magic that blocks, banishes, or protects',
            self::CONJURATION => 'Magic that brings creatures or objects to you',
            self::DIVINATION => 'Magic that reveals information',
            self::ENCHANTMENT => 'Magic that affects minds and emotions',
            self::EVOCATION => 'Magic that manipulates energy and creates effects',
            self::ILLUSION => 'Magic that deceives the senses or mind',
            self::NECROMANCY => 'Magic that manipulates life and death',
            self::TRANSMUTATION => 'Magic that changes the properties of creatures or objects',
            self::PSYONIC => 'Magic that affects the mind and psyche',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

