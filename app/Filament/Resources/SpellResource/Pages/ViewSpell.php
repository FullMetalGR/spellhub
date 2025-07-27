<?php

namespace App\Filament\Resources\SpellResource\Pages;

use App\Filament\Resources\SpellResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

class ViewSpell extends ViewRecord
{
    protected static string $resource = SpellResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn (): bool => auth()->user()->canModifySpell($this->record)),
        ];
    }

    public function getFooter(): ?View
    {
        return view('filament.pages.spell-footer', [
            'creatorName' => $this->record->createdBy->name,
            'rarity' => $this->record->getRarityEnum(),
        ]);
    }
}
