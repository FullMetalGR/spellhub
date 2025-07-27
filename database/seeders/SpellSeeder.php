<?php

namespace Database\Seeders;

use App\Enums\SpellComponents;
use App\Enums\SpellLevel;
use App\Enums\SpellSchool;
use App\Models\Spell;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpellSeeder extends Seeder
{
    public function run(): void
    {
        $wizards = User::all();

        if ($wizards->isEmpty()) {
            $wizard = User::firstOrCreate(
                ['email' => 'gandalf@middle-earth.com'],
                [
                    'name' => 'Gandalf the Grey',
                    'password' => bcrypt('1234567890'),
                ]
            );
            $wizards = collect([$wizard]);
        }

        $spells = [
            // D&D Spells
            [
                'name' => 'Fireball',
                'description' => 'A bright streak flashes from your pointing finger to a point you choose within range and then blossoms with a low roar into an explosion of flame. Each creature in a 20-foot-radius sphere centered on that point must make a Dexterity saving throw.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Shield',
                'description' => 'An invisible barrier of magical force appears and protects you. Until the start of your next turn, you have a +5 bonus to AC, including against the triggering attack, and you take no damage from magic missile.',
                'school' => SpellSchool::ABJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Polymorph',
                'description' => 'This spell transforms a creature that you can see within range into a new form. An unwilling creature must make a Wisdom saving throw to avoid the effect. The spell has no effect on a shapechanger or a creature with 0 hit points.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Wish',
                'description' => 'Wish is the mightiest spell a mortal creature can cast. By simply speaking aloud, you can alter the very foundations of reality in accord with your desires. The basic use of this spell is to duplicate any other spell of 8th level or lower.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Teleport',
                'description' => 'This spell instantly transports you and up to eight willing creatures of your choice that you can see within range, or a single object that you can see within range, to a destination you select.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value],
                'level' => SpellLevel::ARCANE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Harry Potter Spells
            [
                'name' => 'Expecto Patronum',
                'description' => 'A silvery-white animal spirit erupts from your wand, providing protection against dark creatures and negative emotions. The form it takes is unique to the caster and represents their innermost positive qualities.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Lumos',
                'description' => 'A bright light emanates from the tip of your wand, illuminating the surrounding area. The light can be controlled and directed, making it useful for navigation in dark places.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::CANTRIP,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Avada Kedavra',
                'description' => 'A jet of green light bursts from your wand, striking your target with instant death. This unforgivable curse requires immense hatred and intent to kill to be effective.',
                'school' => SpellSchool::NECROMANCY,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::ELDRITCH,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Wingardium Leviosa',
                'description' => 'This charm allows you to levitate objects and creatures, making them float in the air. The spell requires precise wand movement and pronunciation to be effective.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Alohomora',
                'description' => 'This unlocking charm can open any lock, from simple door locks to complex magical seals. The spell works by temporarily disabling the locking mechanism.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Witcher Spells
            [
                'name' => 'Igni',
                'description' => 'A powerful fire spell that creates a controlled flame from your hand. The fire can be directed at enemies or used to light torches and campfires.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Quen',
                'description' => 'A protective shield spell that creates a magical barrier around the caster. The shield can absorb damage and protect against magical attacks.',
                'school' => SpellSchool::ABJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Aard',
                'description' => 'A telekinetic blast that pushes enemies away and can knock them off balance. The force can also be used to break down doors and clear obstacles.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Yrden',
                'description' => 'A magical trap that slows down enemies and reveals invisible creatures. The trap creates a glowing circle on the ground that affects all who enter it.',
                'school' => SpellSchool::ABJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Axii',
                'description' => 'A mind control spell that can charm enemies into fighting for you or simply walk away. The spell requires concentration to maintain control.',
                'school' => SpellSchool::ENCHANTMENT,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Lord of the Rings Spells
            [
                'name' => 'Light of Eärendil',
                'description' => 'A pure light spell that drives away darkness and evil creatures. The light is said to contain the essence of the morning star and can never be extinguished by darkness.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::FOCUS->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Shadow of the Past',
                'description' => 'This spell allows the caster to see into the past, revealing events that occurred in a specific location. The visions are often cryptic and require interpretation.',
                'school' => SpellSchool::DIVINATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Voice of Command',
                'description' => 'A powerful enchantment that compels others to follow your commands. The spell works best on those who are already inclined to obey authority.',
                'school' => SpellSchool::ENCHANTMENT,
                'components' => [SpellComponents::VERBAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Healing Touch',
                'description' => 'A gentle healing spell that mends wounds and restores vitality. The spell works by channeling positive energy into the target.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Storm of the West',
                'description' => 'A powerful weather control spell that summons storms and lightning. The spell can be used to create cover or to strike enemies from above.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::ARCANE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Discworld Spells
            [
                'name' => 'Luggage Summoning',
                'description' => 'A peculiar spell that summons a wooden chest with hundreds of little legs. The luggage is fiercely loyal and will follow its owner anywhere, even through impossible spaces.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Octavo Binding',
                'description' => 'A spell that binds powerful magical books so they cannot be opened by unauthorized readers. The book will actively resist attempts to read it.',
                'school' => SpellSchool::ABJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Death\'s Door',
                'description' => 'A spell that allows the caster to see and communicate with Death. The spell creates a temporary bridge between the living and the dead.',
                'school' => SpellSchool::NECROMANCY,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::ELDRITCH,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Turtle Recall',
                'description' => 'A spell that summons the Great A\'Tuin, the cosmic turtle that carries the Discworld through space. The spell is rarely used and its effects are unpredictable.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Narrativium Manipulation',
                'description' => 'A spell that bends the laws of narrative causality, making stories come true. The spell works by manipulating the fundamental story structure of reality.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::ELDRITCH,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // The Name of the Wind Spells
            [
                'name' => 'Sympathy',
                'description' => 'A form of sympathetic magic that links two objects together. When one object is affected, the other is affected in the same way, regardless of distance.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Naming',
                'description' => 'The most powerful form of magic, where knowing the true name of something gives you complete control over it. This requires deep understanding and connection.',
                'school' => SpellSchool::DIVINATION,
                'components' => [SpellComponents::VERBAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Alar',
                'description' => 'A mental discipline that allows the caster to split their mind into multiple parts, each capable of independent thought and action.',
                'school' => SpellSchool::ENCHANTMENT,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Heart of Stone',
                'description' => 'A mental state that removes all emotion and allows for perfect logical thinking. This state is essential for complex sympathy work.',
                'school' => SpellSchool::ENCHANTMENT,
                'components' => [SpellComponents::VERBAL->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Wind Binding',
                'description' => 'A spell that allows the caster to control the wind, creating gusts, breezes, or complete stillness. The wind responds to the caster\'s will.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Stormlight Archives Spells
            [
                'name' => 'Lashing',
                'description' => 'A spell that changes the direction of gravity for an object or person. The target can be made to fall in any direction, including upward.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Soulcasting',
                'description' => 'A spell that transforms one substance into another by convincing the object\'s soul to change. This requires understanding the nature of both materials.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::ARCANE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Surgebinding',
                'description' => 'A form of magic that manipulates the fundamental forces of nature. Each order of Surgebinders has access to two specific powers.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Stormlight Infusion',
                'description' => 'A spell that stores stormlight in gems, which can then be used to power other magical effects. The light glows with a soft, steady radiance.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Shardblade Summoning',
                'description' => 'A spell that summons a massive magical sword from another realm. The blade can cut through anything except living flesh, which it passes through harmlessly.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::ARCANE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Mistborn Spells
            [
                'name' => 'Allomancy',
                'description' => 'A form of magic that allows the caster to burn metals to gain various powers. Each metal provides different abilities, from enhanced senses to emotional manipulation.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Feruchemy',
                'description' => 'A magic system that allows the caster to store attributes in metal and retrieve them later. This creates a balance of giving and receiving.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Hemalurgy',
                'description' => 'A dark magic that steals powers from others by driving metal spikes through their bodies. The stolen abilities are then transferred to the spike wielder.',
                'school' => SpellSchool::NECROMANCY,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::ELDRITCH,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Coinshot Push',
                'description' => 'A spell that allows the caster to push on metal objects, launching them through the air. The force can be used for transportation or combat.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Tineye Enhancement',
                'description' => 'A spell that enhances the caster\'s senses, particularly hearing and sight. The enhancement allows for superhuman perception.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],

            // Additional Fantasy Spells
            [
                'name' => 'Dragon\'s Breath',
                'description' => 'A spell that allows the caster to breathe fire like a dragon. The flames are incredibly hot and can melt metal and stone.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Time Stop',
                'description' => 'A spell that temporarily stops the flow of time in a localized area. The caster can move freely while everything else remains frozen.',
                'school' => SpellSchool::TRANSMUTATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Mind Reading',
                'description' => 'A spell that allows the caster to read the thoughts of others. The spell can reveal memories, emotions, and current thoughts.',
                'school' => SpellSchool::DIVINATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::GREATER,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Invisibility',
                'description' => 'A spell that makes the target completely invisible to normal sight. The invisibility is broken if the target attacks or casts a spell.',
                'school' => SpellSchool::ILLUSION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::MINOR,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Resurrection',
                'description' => 'A powerful spell that can bring the dead back to life. The spell requires the body to be relatively intact and the soul to be willing to return.',
                'school' => SpellSchool::NECROMANCY,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Meteor Swarm',
                'description' => 'A devastating spell that calls down four meteors from the sky. Each meteor explodes on impact, dealing massive damage to everything in the area.',
                'school' => SpellSchool::EVOCATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Plane Shift',
                'description' => 'A spell that allows the caster to travel between different planes of existence. The spell can be used for exploration or escape.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Power Word Kill',
                'description' => 'A spell that kills a creature with a single word if it has fewer than 100 hit points. The spell requires no saving throw and works instantly.',
                'school' => SpellSchool::ENCHANTMENT,
                'components' => [SpellComponents::VERBAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Gate',
                'description' => 'A spell that creates a portal to another plane of existence. The gate can be used for travel or to summon creatures from other planes.',
                'school' => SpellSchool::CONJURATION,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::SOMATIC->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::DIVINE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
            [
                'name' => 'Mass Suggestion',
                'description' => 'A spell that allows the caster to suggest a course of action to multiple creatures at once. The suggestion must be reasonable and not harmful.',
                'school' => SpellSchool::ENCHANTMENT,
                'components' => [SpellComponents::VERBAL->value, SpellComponents::MATERIAL->value],
                'level' => SpellLevel::ARCANE,
                'created_by' => $wizards->random()->id,
                'is_public' => true,
            ],
        ];

        foreach ($spells as $spellData) {
            if (!Spell::where('name', $spellData['name'])->exists()) {
                $spellData['components'] = json_encode($spellData['components']);
                Spell::create($spellData);
            }
        }
    }
}
