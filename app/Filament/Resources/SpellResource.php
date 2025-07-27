<?php

namespace App\Filament\Resources;

use App\Enums\SpellComponents;
use App\Enums\SpellLevel;
use App\Enums\SpellRarity;
use App\Enums\SpellSchool;
use App\Filament\Resources\SpellResource\Pages;
use App\Models\Spell;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SpellResource extends Resource
{
    protected static ?string $model = Spell::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Spells';

    protected static ?string $modelLabel = 'Spell';

    protected static ?string $pluralModelLabel = 'Spells';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Spell Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter spell name'),
                        Forms\Components\Toggle::make('is_public')
                            ->label('Is this spell ready to be shared to the world?')
                            ->default(true),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Describe the spell effects...'),
                    ])->columns(2),

                Forms\Components\Section::make('Spell Details')
                    ->schema([
                        Forms\Components\Select::make('school')
                            ->label('Magic School')
                            ->options(collect(SpellSchool::cases())->mapWithKeys(fn($school) => [$school->value => $school->value])->toArray())
                            ->required()
                            ->searchable()
                            ->placeholder('Select magic school'),
                        Forms\Components\Select::make('level')
                            ->label('Spell Level')
                            ->options(collect(SpellLevel::cases())->mapWithKeys(fn($level) => [$level->value => $level->value])->toArray())
                            ->required()
                            ->searchable()
                            ->placeholder('Select spell level'),
                            Forms\Components\CheckboxList::make('components')
                                ->label('Spell Components')
                                ->options(collect(SpellComponents::cases())->mapWithKeys(fn($component) => [$component->value => $component->getLabel()])->toArray())
                                ->columns(3)
                                ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->accessibleTo(auth()->user()))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('school')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => SpellSchool::from($state)->getColor()),
                Tables\Columns\TextColumn::make('components')
                    ->label('Components')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rarity')
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => SpellRarity::from($state)->getColor()),
                Tables\Columns\TextColumn::make('level')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => SpellLevel::from($state)->getColor()),
                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Creator')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean()
                    ->trueIcon('heroicon-o-eye')
                    ->falseIcon('heroicon-o-eye-slash'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('school')
                    ->options(collect(SpellSchool::cases())->mapWithKeys(fn($school) => [$school->value => $school->value])->toArray()),
                Tables\Filters\SelectFilter::make('rarity')
                    ->options(collect(SpellRarity::cases())->mapWithKeys(fn($rarity) => [$rarity->value => $rarity->value])->toArray()),
                Tables\Filters\SelectFilter::make('level')
                    ->options(collect(SpellLevel::cases())->mapWithKeys(fn($level) => [$level->value => $level->value])->toArray()),
                Tables\Filters\TernaryFilter::make('is_public')
                    ->label('Public Status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (Spell $record): bool => auth()->user()->canModifySpell($record)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (Spell $record): bool => auth()->user()->canModifySpell($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->visible(fn (): bool => true),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpells::route('/'),
            'create' => Pages\CreateSpell::route('/create'),
            'view' => Pages\ViewSpell::route('/{record}'),
            'edit' => Pages\EditSpell::route('/{record}/edit'),
        ];
    }
}
