<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Spellbook';

    protected static string $view = 'filament.pages.dashboard';

    public function getTitle(): string
    {
        return 'My Spellbook';
    }
}
