<?php

namespace App\Http\Controllers;

use App\Models\Spell;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SpellController extends Controller
{
    /**
     * Copy a spell to the user's collection.
     */
    public function copy(Request $request, Spell $spell): JsonResponse
    {
        $user = auth()->user();

        // Check if user is authenticated
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to copy spells.'
            ], 401);
        }

        // Check if spell can be copied
        if (!$spell->canBeCopiedBy($user)) {
            return response()->json([
                'success' => false,
                'message' => 'This spell cannot be copied.'
            ], 403);
        }

        // Check if user already has this spell
        if ($user->hasSpell($spell)) {
            return response()->json([
                'success' => false,
                'message' => 'You already have this spell in your collection.'
            ], 400);
        }

        // Copy the spell
        $user->spells()->attach($spell->id, ['type' => 'copied']);

        return response()->json([
            'success' => true,
            'message' => 'Spell copied to your collection successfully!'
        ]);
    }

    /**
     * Remove a copied spell from the user's collection.
     */
    public function remove(Request $request, Spell $spell): JsonResponse
    {
        $user = auth()->user();

        // Check if user is authenticated
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to remove spells.'
            ], 401);
        }

        // Check if user has this spell as copied
        $userSpell = $user->spells()->where('spell_id', $spell->id)->first();

        if (!$userSpell || $userSpell->pivot->type !== 'copied') {
            return response()->json([
                'success' => false,
                'message' => 'You can only remove spells you have copied.'
            ], 403);
        }

        // Remove the spell
        $user->spells()->detach($spell->id);

        return response()->json([
            'success' => true,
            'message' => 'Spell removed from your collection successfully!'
        ]);
    }
}
