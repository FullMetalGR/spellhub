<?php

namespace App\Console\Commands;

use App\Enums\SpellLevel;
use App\Enums\SpellSchool;
use App\Services\GeminiAIService;
use Illuminate\Console\Command;

class TestAIService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ai:test-rarity {spell_name} {description} {school} {level}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the AI service for spell rarity determination';

    /**
     * Execute the console command.
     */
    public function handle(GeminiAIService $aiService)
    {
        $spellName = $this->argument('spell_name');
        $description = $this->argument('description');
        $school = SpellSchool::from($this->argument('school'));
        $level = SpellLevel::from($this->argument('level'));

        $this->info("Testing AI Rarity Determination...");
        $this->info("Spell: {$spellName}");
        $this->info("School: {$school->value}");
        $this->info("Level: {$level->value}");
        $this->info("Description: {$description}");
        $this->info("");

        try {
            $rarity = $aiService->determineSpellRarity($spellName, $description, $school, $level);

            $this->info("✅ AI determined rarity: {$rarity->value}");
            $this->info("Color: {$rarity->getColor()}");

        } catch (\Exception $e) {
            $this->error("❌ AI service failed: " . $e->getMessage());
        }
    }
}
