<?php

namespace App\Http\Controllers;

use App\Enums\SpellLevel;
use App\Enums\SpellRarity;
use App\Enums\SpellSchool;
use App\Models\Spell;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Spell::public();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('school', 'like', "%{$search}%")
                  ->orWhere('rarity', 'like', "%{$search}%");
            });
        }

        if ($request->filled('school') && $request->school !== 'all') {
            $query->where('school', $request->school);
        }

        if ($request->filled('rarity') && $request->rarity !== 'all') {
            $query->where('rarity', $request->rarity);
        }

        if ($request->filled('level') && $request->level !== 'all') {
            $query->where('level', $request->level);
        }

        $spells = $query->with('createdBy')
                       ->orderBy('created_at', 'desc')
                       ->paginate(12)
                       ->withQueryString();

        if (auth()->check()) {
            $user = auth()->user();
            $copiedSpellIds = $user->copiedSpells()->pluck('spells.id')->toArray();
            $spells->getCollection()->transform(function ($spell) use ($copiedSpellIds) {
                $spell->is_copied = in_array($spell->id, $copiedSpellIds);
                $spell->can_copy = $spell->canBeCopiedBy(auth()->user());
                return $spell;
            });
        }

        $schools = collect(SpellSchool::cases())->map(fn($school) => $school->value)->sort()->values();
        $rarities = collect(SpellRarity::cases())->map(fn($rarity) => $rarity->value)->sort()->values();
        $levels = collect(SpellLevel::cases())->map(fn($level) => $level->value)->sort()->values();

        return view('home', compact('spells', 'schools', 'rarities', 'levels'));
    }
}
