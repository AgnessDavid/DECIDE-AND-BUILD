<?php

namespace App\Filament\Resources\Validations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ValidationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('fiche_besoin_id')
                    ->relationship('ficheBesoin', 'id')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('statut')
                    ->options(['en_attente' => 'En attente', 'validée' => 'Validée'])
                    ->default('en_attente')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
