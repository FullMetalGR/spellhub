<?php

namespace App\Services;

use App\Enums\SpellRarity;
use App\Enums\SpellSchool;
use App\Enums\SpellLevel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiAIService
{
    private string $apiKey;
    private string $model;
    private int $maxIters;

    public function __construct()
    {
        $this->apiKey = config('ai.gemini.api_key');
        $this->model = config('ai.gemini.model');
        $this->maxIters = config('ai.gemini.max_iters');
    }

    /**
     * Determine spell rarity using AI analysis
     */
    public function determineSpellRarity(string $spellName, string $description, SpellSchool $school, SpellLevel $level): SpellRarity
    {
        try {
            $prompt = $this->buildRarityPrompt($spellName, $description, $school, $level);
            $response = $this->callGeminiAPI($prompt);

            return $this->parseRarityResponse($response);
        } catch (\Exception $e) {
            Log::error('AI rarity determination failed', [
                'spell_name' => $spellName,
                'error' => $e->getMessage()
            ]);
            return SpellRarity::COMMON;
        }
    }

    /**
     * Build the prompt for rarity determination
     */
    private function buildRarityPrompt(string $spellName, string $description, SpellSchool $school, SpellLevel $level): string
    {
        return <<<PROMPT
You are an expert in magical spell analysis and rarity determination. Analyze this spell and determine its rarity level.

SPELL INFORMATION:
- Name: {$spellName}
- Description: {$description}
- School: {$school->value}
- Level: {$level->value}

RARITY CRITERIA:
1. **Search Popularity (60% weight)**: How commonly known/referenced this spell is in fantasy literature, games, and media
2. **Ingenuity & Complexity (40% weight)**: How creative, unique, or complex the spell description and mechanics are

RARITY LEVELS (from most common to rarest):
- **Common**: Well-known spells with simple mechanics, frequently referenced (Fireball, Shield, Magic Missile)
- **Uncommon**: Moderately known spells with some complexity (Invisibility, Charm Person, Detect Magic)
- **Rare**: Less common spells with unique mechanics (Polymorph, Animate Dead, Teleport)
- **Epic**: Very rare spells with highly creative or powerful effects (Wish, Time Stop, Meteor Swarm)
- **Legendary**: Extremely rare spells, often unique or legendary in nature (The One Ring, Elder Wand, Philosopher's Stone)

ANALYSIS INSTRUCTIONS:
1. Consider the spell name's familiarity in fantasy contexts
2. Analyze the description's creativity and complexity
3. Evaluate how well the spell fits its school and level
4. Consider the overall power level and uniqueness

IMPORTANT: Based on the spell name "{$spellName}" and its description, determine the rarity.

RESPONSE FORMAT:
Respond with ONLY one of these exact values: Common, Uncommon, Rare, Epic, Legendary

No explanations, just the rarity level.
PROMPT;
    }

    /**
     * Call the Gemini API
     */
    private function callGeminiAPI(string $prompt): string
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1/models/{$this->model}:generateContent?key={$this->apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.3,
                'topK' => 1,
                'topP' => 0.8,
                'maxOutputTokens' => 50,
            ]
        ]);

        if (!$response->successful()) {
            throw new \Exception('Gemini API call failed: ' . $response->body());
        }

        $data = $response->json();

        if (!isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            throw new \Exception('Invalid response format from Gemini API');
        }

        return trim($data['candidates'][0]['content']['parts'][0]['text']);
    }

    /**
     * Parse the AI response to determine rarity
     */
    private function parseRarityResponse(string $response): SpellRarity
    {
        $response = trim(strtolower($response));

        return match($response) {
            'common' => SpellRarity::COMMON,
            'uncommon' => SpellRarity::UNCOMMON,
            'rare' => SpellRarity::RARE,
            'epic' => SpellRarity::EPIC,
            'legendary' => SpellRarity::LEGENDARY,
            default => SpellRarity::COMMON,
        };
    }
}
