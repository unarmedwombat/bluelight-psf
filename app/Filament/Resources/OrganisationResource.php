<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrganisationResource\Pages;
use App\Filament\Resources\OrganisationResource\RelationManagers;
use App\Models\Organisation;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class OrganisationResource extends Resource
{
    protected static ?string $model = Organisation::class;

    protected static ?string $navigationGroup = 'Frameworks';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-duplicate';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->columnSpan(2)->required()->extraAttributes(['class' => 'rounded-sm']),
                Textarea::make('overview')->columnSpan(2)->rows(4),
                Textarea::make('social_values')->rows(5),
                Textarea::make('benefits')->label('Benefits & notes')->rows(5),
                TextInput::make('contact')->required(),
                TextInput::make('job_title')->required(),
                TextInput::make('phone')->required(),
                TextInput::make('email')->email()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('contact')
                    ->url(fn (Organisation $record): string => 'mailto:'.$record->email),
                TextColumn::make('phone'),
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListOrganisations::route('/'),
            'create' => Pages\CreateOrganisation::route('/create'),
            'edit' => Pages\EditOrganisation::route('/{record}/edit'),
        ];
    }
}
