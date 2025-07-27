<?php

return [
    /*
    |--------------------------------------------------------------------------
    | AI Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for AI-powered features like spell rarity determination
    |
    */

    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
        'model' => 'gemini-2.0-flash-001',
        'max_chars' => 10000,
        'max_iters' => 20,
    ],

    'spell_rarity' => [
        'search_weight' => 0.6,
        'description_weight' => 0.4,
        'min_references' => [
            'Common' => 1000,
            'Uncommon' => 500,
            'Rare' => 100,
            'Epic' => 50,
            'Legendary' => 10,
        ],
    ],
];
