<?php

namespace App\Filament\Resources\Imprimeries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ImprimerieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('validation_id')
                    ->relationship('validation', 'id'),
                TextInput::make('demande_id')
                    ->numeric(),
                TextInput::make('nom_produit'),
                TextInput::make('quantite_demandee')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('valide_par'),
                TextInput::make('operateur'),
                DatePicker::make('date_impression'),
                Select::make('produit_id')
                    ->relationship('produit', 'id')
                    ->required(),
                TextInput::make('quantite_imprimee')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
