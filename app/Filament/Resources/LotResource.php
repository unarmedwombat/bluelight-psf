<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LotResource\Pages;
use App\Filament\Resources\LotResource\RelationManagers;
use App\Models\Framework;
use App\Models\Lot;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class LotResource extends Resource
{
    protected static ?string $model = Lot::class;

    protected static ?string $navigationGroup = 'Frameworks';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-view-boards';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('framework_id')
//                    ->relationship('framework', 'title')
                    ->options((new Framework)->getAllDescriptions())
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('min_value')
                    ->prefix('£'),
                Forms\Components\TextInput::make('max_value')
                    ->prefix('£'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('framework.fullTitle'),
                Tables\Columns\TextColumn::make('fullTitle')->label('Title')->wrap(),
            ])
            ->filters([
//                SelectFilter
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\RegionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLots::route('/'),
            'create' => Pages\CreateLot::route('/create'),
            'edit' => Pages\EditLot::route('/{record}/edit'),
        ];
    }
}
