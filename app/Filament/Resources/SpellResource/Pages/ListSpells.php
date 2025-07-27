<?php

namespace App\Filament\Resources\SpellResource\Pages;

use App\Filament\Resources\SpellResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpells extends ListRecords
{
    protected static string $resource = SpellResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
