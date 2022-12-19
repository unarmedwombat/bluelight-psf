<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;
use App\Models\Application;
use App\Models\Client;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-o-user-add';

    public static function form(Form $form): Form
    {
        return $form
            ->columns([
                'default' => 2,
            ])
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('client')
                    ->label('Organisation')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(User::class),
                TextInput::make('phone')
                    ->required()
                    ->maxLength(255),
                TextInput::make('job_title'),
                Select::make('job_category')
                    ->options(config('app.job_categories')),
                Select::make('client_id')
                    ->label('Client')
                    ->required()
                    ->options(Client::all()->pluck('title', 'id')),
                TextInput::make('password')
                    ->default(generatePassword())
                    ->required(),
                Textarea::make('notes')
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client'),
                TextColumn::make('name'),
                TextColumn::make('email')
                    ->url(function(Application $record) {
                        return 'mailto:' . $record->email;
                    }),
                TextColumn::make('phone'),
                TextColumn::make('created_at')->label('Applied on')->date('jS M Y'),
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

}
