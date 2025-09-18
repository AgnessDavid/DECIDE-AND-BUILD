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
                    ->required(),
                TextInput::make('solde_initial')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('entrees')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('sorties')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('solde_final')
                    ->numeric(),
                Select::make('statut')
                    ->options(['ouvert' => 'Ouvert', 'fermé' => 'Fermé'])
                    ->default('ouvert'),
                DateTimePicker::make('ouvert_le')
                    ->required(),
                DateTimePicker::make('ferme_le'),
            ]);
    }
}
