<?php

namespace App\Filament\Resources\FrameworkResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class RegionsRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'regions';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $inverseRelationship = 'frameworks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                BelongsToSelect::make('region_id')
//                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ]);
    }
}
