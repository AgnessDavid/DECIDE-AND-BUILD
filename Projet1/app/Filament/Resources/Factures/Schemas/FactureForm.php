<?php

namespace App\Filament\Resources\Factures\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FactureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('commande_id')
                    ->relationship('commande', 'id')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('numero_facture')
                    ->required(),
                DatePicker::make('date_facturation')
                    ->required(),
                TextInput::make('montant_ht')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('tva')
                    ->required()
                    ->numeric()
                    ->default(18.0),
                TextInput::make('montant_ttc')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Select::make('statut_paiement')
                    ->options(['non_paye' => 'Non paye', 'partiellement_paye' => 'Partiellement paye', 'paye' => 'Paye'])
                    ->default('non_paye')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
