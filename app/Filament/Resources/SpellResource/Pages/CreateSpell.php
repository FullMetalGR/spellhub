<?php

namespace App\Filament\Resources\SpellResource\Pages;

use App\Filament\Resources\SpellResource;
use App\Models\Spell;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateSpell extends CreateRecord
{
    protected static string $resource = SpellResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }

    protected function beforeCreate(): void
    {
        // Check if a spell with the same name already exists for this user
        $existingSpell = Spell::where('name', $this->data['name'])
            ->where('created_by', auth()->id())
            ->first();

        if ($existingSpell) {
            Notification::make()
                ->title('Spell Already Exists')
                ->body("You already have a spell named '{$this->data['name']}'. Please choose a different name.")
                ->color('warning')
                ->icon('heroicon-o-exclamation-triangle')
                ->send();

            $this->halt();
        }
    }

    protected function afterCreate(): void
    {
        $this->record->users()->attach(auth()->id(), ['type' => 'created']);

        Notification::make()
            ->title("Congratulations! 🎉")
            ->body("You created a **{$this->record->rarity->value}** spell!")
            ->color($this->record->rarity->getColor())
            ->icon('heroicon-o-sparkles')
            ->duration(6000)
            ->send();
    }
}
