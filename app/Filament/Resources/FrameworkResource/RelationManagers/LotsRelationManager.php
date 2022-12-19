<?php

namespace App\Filament\Resources\FrameworkResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class LotsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'lots';

    protected static ?string $recordTitleAttribute = 'fullTitle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->columnSpan(2)
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_value')->prefix('£'),
                Forms\Components\TextInput::make('max_value')->prefix('£'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullTitle')->label('Title'),
            ])
            ->filters([
                //
            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['min_value'] = number_format($data['min_value']);
        $data['max_value'] = number_format($data['max_value']);

        return $data;
    }

}
