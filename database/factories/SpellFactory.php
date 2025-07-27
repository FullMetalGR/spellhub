<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\CreatedBy;
use App\Models\Spell;
use App\Models\User;

class SpellFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Spell::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'school' => fake()->word(),
            'cost' => fake()->numberBetween(-10000, 10000),
            'rarity' => fake()->word(),
            'level' => fake()->numberBetween(-10000, 10000),
            'created_by' => CreatedBy::factory(),
            'user_id' => User::factory(),
        ];
    }
}
