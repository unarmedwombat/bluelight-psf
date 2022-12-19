<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrameworkResource\Pages;
use App\Filament\Resources\FrameworkResource\RelationManagers;
use App\Models\Framework;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class FrameworkResource extends Resource
{
    protected static ?string $model = Framework::class;

    protected static ?string $navigationGroup = 'Frameworks';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'default' => 1,
                'md' => 2,
                'xl' => 4,
            ])
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->columnSpan(['lg'=>2])
                    ->maxLength(255),
                BelongsToSelect::make('organisation_id')
                    ->relationship('organisation', 'title')
                    ->required(),
                Toggle::make('is_dps')
                    ->label('Is DPS?')
                    ->inline(false),

                Section::make('Details')
                    ->description('Other framework information')
                    ->extraAttributes(['class' => 'py-4 bg-white/80'])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                        'xl' => 4,
                    ])
                    ->collapsed()
                    ->schema([
                        TextInput::make('contact')
                            ->maxLength(255),
                        TextInput::make('job_title')
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('url')
                            ->columnSpan(['lg'=>2])
                            ->maxLength(255),
                        DatePicker::make('expiry')
                            ->displayFormat('j M Y'),
                        Textarea::make('extension_options')
                            ->rows(3)
                            ->maxLength(255),
                        TextInput::make('award_notice_title')
                            ->columnSpan(['lg'=>2])
                            ->maxLength(255),
                        TextInput::make('award_notice_url')
                            ->columnSpan(['lg'=>2]),
                        TextArea::make('calloff_routes')
                            ->rows(3)
                            ->maxLength(255),
                        Textarea::make('contract_types')
                            ->rows(3)
                            ->maxLength(65535),
                        Textarea::make('fee_notes')
                            ->rows(3)
                            ->maxLength(65535),
                        Textarea::make('levy')
                            ->rows(3)
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('organisation.title'),
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LotsRelationManager::class,
            RelationManagers\RegionsRelationManager::class,
       ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFrameworks::route('/'),
            'create' => Pages\CreateFramework::route('/create'),
            'edit' => Pages\EditFramework::route('/{record}/edit'),
            'opportunities' => Pages\Opportunities::route('/{record}/opportunities'),
            'contractors' => Pages\Contractors::route('/{record}/contractors'),
        ];
    }
}
