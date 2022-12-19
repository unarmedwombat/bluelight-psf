<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OpportunityResource\Pages;
use App\Filament\Resources\OpportunityResource\RelationManagers;
use App\Models\Opportunity;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;

class OpportunityResource extends Resource
{
    protected static ?string $model = Opportunity::class;

    protected static ?string $navigationGroup = 'Frameworks';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationIcon = 'heroicon-o-globe';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('full_title')
                    ->disabled()->label('Opportunity title')
                    ->extraAttributes(['class' => 'bg-transparent font-bold border-0 shadow-none resize-none'])
                    ->columnSpan(2)->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('lot.extended_title')->wrap(),
                Tables\Columns\TextColumn::make('region.title')->searchable(['regions.title']),
            ])
            ->filters([
//                SelectFilter::make('lot')->label('Lot')->relationship('lot', 'title')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ContractorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOpportunities::route('/'),
            'create' => Pages\CreateOpportunity::route('/create'),
            'edit' => Pages\EditOpportunity::route('/{record}/edit'),
        ];
    }

    protected function getTableFilters(): array
    {
        //
    }
}
