<?php

namespace App\Models;

use App\Enums\SpellComponents;
use App\Enums\SpellLevel;
use App\Enums\SpellRarity;
use App\Enums\SpellSchool;
use App\Services\GeminiAIService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Spell extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'school',
        'components',
        'rarity',
        'level',
        'created_by',
        'is_public',
    ];

    /**
     * Boot the model and set up event listeners.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($spell) {
            if (!$spell->rarity) {
                $school = is_string($spell->school) ? SpellSchool::from($spell->school) : $spell->school;
                $level = is_string($spell->level) ? SpellLevel::from($spell->level) : $spell->level;
                $aiService = app(GeminiAIService::class);
                $spell->rarity = $aiService->determineSpellRarity(
                    $spell->name,
                    $spell->description,
                    $school,
                    $level
                );
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'created_by' => 'integer',
            'is_public' => 'boolean',
            'school' => SpellSchool::class,
            'level' => SpellLevel::class,
            'rarity' => SpellRarity::class,
            'components' => 'array',
        ];
    }

    /**
     * Get the user who created the spell.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get all users who have this spell (created or copied).
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'spell_user')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    /**
     * Get the school enum instance.
     */
    public function getSchoolEnum(): SpellSchool
    {
        return SpellSchool::from($this->school);
    }

    /**
     * Get the level enum instance.
     */
    public function getLevelEnum(): SpellLevel
    {
        return SpellLevel::from($this->level);
    }

    /**
     * Get the rarity enum instance.
     */
    public function getRarityEnum(): SpellRarity
    {
        return SpellRarity::from($this->rarity);
    }

    /**
     * Get the components as formatted string.
     */
    public function getComponentsString(): string
    {
        if (!$this->components || empty($this->components)) {
            return '';
        }

        // Handle both array and JSON string formats
        $components = $this->components;
        if (is_string($components)) {
            $components = json_decode($components, true);
        }

        if (!is_array($components)) {
            return '';
        }

        return implode(', ', $components);
    }

    /**
     * Get the components as enum instances.
     */
    public function getComponentEnums(): array
    {
        if (!$this->components || empty($this->components)) {
            return [];
        }

        $components = $this->components;
        if (is_string($components)) {
            $components = json_decode($components, true);
        }

        if (!is_array($components)) {
            return [];
        }

        return array_map(fn($component) => SpellComponents::from($component), $components);
    }

    /**
     * Get the components attribute for forms.
     */
    public function getComponentsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    /**
     * Set the components attribute for forms.
     */
    public function setComponentsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['components'] = json_encode($value);
        } else {
            $this->attributes['components'] = $value;
        }
    }

    /**
     * Scope to get public spells.
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope to get spells created by a specific user.
     */
    public function scopeCreatedBy($query, $userId)
    {
        return $query->where('created_by', $userId);
    }

    /**
     * Scope to get spells accessible to a specific user (created by them or copied by them).
     */
    public function scopeAccessibleTo($query, $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('created_by', $user->id)
              ->orWhereHas('users', function ($subQ) use ($user) {
                  $subQ->where('user_id', $user->id);
              });
        });
    }

    /**
     * Scope to get spells visible to a specific user (public spells or their own private spells).
     */
    public function scopeVisibleTo($query, $user)
    {
        return $query->where(function ($q) use ($user) {
            $q->where('is_public', true)
              ->orWhere('created_by', $user->id);
        });
    }

    /**
     * Check if a user can view this spell.
     */
    public function canBeViewedBy(User $user): bool
    {
        return $this->is_public || $this->created_by === $user->id;
    }

    /**
     * Check if a user can copy this spell.
     */
    public function canBeCopiedBy(User $user): bool
    {
        return $this->is_public && $this->created_by !== $user->id;
    }
}
