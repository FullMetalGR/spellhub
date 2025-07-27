<?php

namespace Database\Seeders;

use App\Models\Spell;
use App\Models\User;
use Illuminate\Database\Seeder;

class SpellUserSeeder extends Seeder
{
    public function run(): void
    {
        $spells = Spell::with('createdBy')->get();

        foreach ($spells as $spell) {
            $spell->users()->attach($spell->created_by, ['type' => 'created']);
        }

        $users = User::inRandomOrder()->take(3)->get();
        $spellsToCopy = Spell::inRandomOrder()->take(5)->get();

        foreach ($users as $user) {
            foreach ($spellsToCopy as $spell) {
                if ($spell->created_by !== $user->id) {
                    $existingRelationship = $user->spells()->where('spell_id', $spell->id)->exists();

                    if (!$existingRelationship) {
                        $user->spells()->attach($spell->id, ['type' => 'copied']);
                    }
                }
            }
        }
    }
}
