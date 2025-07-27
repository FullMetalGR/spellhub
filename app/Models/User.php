<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Determine if the user can access the Filament panel.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // For development, allow all users
        // For production, you might want to restrict access
        return true;
    }

    /**
     * Get the spells created by this user.
     */
    public function createdSpells(): HasMany
    {
        return $this->hasMany(Spell::class, 'created_by');
    }

    /**
     * Get all spells associated with this user (created and copied).
     */
    public function spells(): BelongsToMany
    {
        return $this->belongsToMany(Spell::class, 'spell_user')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    /**
     * Get spells that this user has copied from others.
     */
    public function copiedSpells(): BelongsToMany
    {
        return $this->belongsToMany(Spell::class, 'spell_user')
                    ->wherePivot('type', 'copied')
                    ->withTimestamps();
    }

    /**
     * Check if user has access to a specific spell (created or copied).
     */
    public function hasSpell(Spell $spell): bool
    {
        return $this->spells()->where('spell_id', $spell->id)->exists();
    }

    /**
     * Check if user can modify a specific spell (only if they created it).
     */
    public function canModifySpell(Spell $spell): bool
    {
        return $this->id === $spell->created_by;
    }
}
