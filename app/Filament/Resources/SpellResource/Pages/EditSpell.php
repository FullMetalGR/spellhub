<?php

namespace App\Filament\Resources\SpellResource\Pages;

use App\Filament\Resources\SpellResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpell extends EditRecord
{
    protected static string $resource = SpellResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
