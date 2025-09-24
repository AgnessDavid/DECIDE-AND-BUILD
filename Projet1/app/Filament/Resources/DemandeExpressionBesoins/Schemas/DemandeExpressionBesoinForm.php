<?php

namespace App\Filament\Resources\DemandeExpressionBesoins\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DemandeExpressionBesoinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('produit_id')
                    ->relationship('produit', 'id'),
                Select::make('type_impression')
                    ->options(['simple' => 'Simple', 'specifique' => 'Specifique'])
                    ->default('simple')
                    ->required(),
                TextInput::make('numero_ordre'),
                TextInput::make('designation'),
                TextInput::make('quantite_demandee')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('quantite_imprimee')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('date_demande'),
                TextInput::make('agent_commercial'),
                TextInput::make('service'),
                TextInput::make('objet'),
            ]);
    }
}
