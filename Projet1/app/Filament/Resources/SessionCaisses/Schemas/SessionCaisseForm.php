<?php

namespace App\Filament\Resources\SessionCaisses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SessionCaisseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->label('Caissier'),

                TextInput::make('solde_initial')
                    ->required()
                    ->numeric()
                    ->default(0),

TextInput::make('entrees')
    ->numeric()
    ->default(0)
    ->reactive()
    ->afterStateUpdated(fn ($state, callable $set, $get) => $set('solde_final', ($state ?? 0) - ($get('sorties') ?? 0)))
    ->formatStateUsing(fn ($state) => number_format($state ?? 0, 0, ',', '.')),


TextInput::make('sorties')
    ->numeric()
    ->default(0)
    ->label('Sorties')
    ->reactive() // <-- rend le champ réactif
    ->afterStateUpdated(fn ($state, callable $set, $get) => $set('solde_final', ($get('entrees') ?? 0) - ($state ?? 0))),

TextInput::make('solde_final')
    ->numeric()
    ->disabled()
    ->label('Solde Final'),


                TextInput::make('statut')
                    ->disabled()
                    ->default('ouvert'),

                DateTimePicker::make('ouvert_le')
                    ->required()
                    ->label('Ouvert le'),

                DateTimePicker::make('ferme_le')
                    ->label('Fermé le'),
            ]);
    }
}
