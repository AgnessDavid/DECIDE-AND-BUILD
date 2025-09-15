<?php

namespace App\Filament\Resources\Imprimeries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use App\Models\DemandeImpression; // <-- ajouté

class ImprimerieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('demande_id')
                ->label('Demande d\'impression')
                ->options(DemandeImpression::all()->pluck('designation', 'id')) // id => désignation
                ->searchable()
                ->required(),

            TextInput::make('quantite_a_imprimer')
                ->label('Quantité à imprimer')
                ->numeric()
                ->required(),

            TextInput::make('valide_par')
                ->label('Validé par')
                ->nullable(),

            TextInput::make('operateur')
                ->label('Opérateur')
                ->nullable(),

            DatePicker::make('date_impression')
                ->label('Date d\'impression')
                ->nullable(),
        ]);
    }
}
