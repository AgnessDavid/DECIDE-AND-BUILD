<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom')
                    ->required(),
                Select::make('type')
                    ->options(['societe' => 'Societe', 'organisme' => 'Organisme', 'particulier' => 'Particulier'])
                    ->default('societe')
                    ->required(),
                TextInput::make('nom_interlocuteur'),
                TextInput::make('fonction'),
                TextInput::make('telephone')
                    ->tel(),
                TextInput::make('cellulaire'),
                TextInput::make('fax'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('ville'),
                TextInput::make('quartier_de_residence'),
                Select::make('usage')
                    ->options(['personnel' => 'Personnel', 'professionnel' => 'Professionnel']),
                TextInput::make('domaine_activite'),
            ]);
    }
}
