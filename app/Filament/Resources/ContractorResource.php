<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractorResource\Pages;
use App\Models\Contractor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ContractorResource extends Resource
{
    protected static ?string $model = Contractor::class;

    protected static ?string $navigationGroup = 'Contractors';

    protected static ?string $navigationIcon = 'heroicon-o-table';

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'default' => 1,
                'md' => 2,
                'xl' => 4,
            ])
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpan(['md' => 2])
                    ->maxLength(255),
                Forms\Components\TextInput::make('url')
                    ->columnSpan(['md' => 2])
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('job_title')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Textarea::make('comments')
                    ->columnSpan(['md' => 2, 'xl' => 3])
                    ->maxLength(65535),
                Forms\Components\ToggleD::make('alert')
                    ->label('Set alert?')
                    ->inline(false),
                Forms\Components\Textarea::make('internal_notes')
                    ->columnSpan(['md' => 2, 'xl' => 3])
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('alert')
                    ->label('')
                    ->options(['heroicon-s-x-circle' => 1])
                    ->colors(['danger' => 1])
                ->extraAttributes(['class' => 'w-4 pl-1 pr-1']),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->url(fn (Contractor $record): ?string => $record->url),
                Tables\Columns\TextColumn::make('contact_name')
                    ->url(fn (Contractor $record): ?string => 'mailto:'.$record->email),
                Tables\Columns\TextColumn::make('job_title'),
                Tables\Columns\TextColumn::make('phone'),
            ])
            ->defaultSort('title')
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
            'index' => Pages\ListContractors::route('/'),
            'create' => Pages\CreateContractor::route('/create'),
            'edit' => Pages\EditContractor::route('/{record}/edit'),
            'frameworks' => Pages\Frameworks::route('/{record}/frameworks'),
        ];
    }
}
