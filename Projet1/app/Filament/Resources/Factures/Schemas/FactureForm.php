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
                // On choisit la commande source
                Select::make('commande_id')
                    ->relationship('commande', 'numero_commande')
                    ->label('Commande')
                    ->required()
                    ->reactive(),

                // Agent qui génère la facture
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Agent')
                    ->required(),

                // Numéro de facture unique
                TextInput::make('numero_facture')
                    ->label('Numéro de facture')
                    ->required(),

                DatePicker::make('date_facturation')
                    ->label('Date de facturation')
                    ->required(),

                // Statut de paiement
                Select::make('statut_paiement')
                    ->options([
                        'non_paye' => 'Non payé',
                        'partiellement_paye' => 'Partiellement payé',
                        'paye' => 'Payé',
                    ])
                    ->default('non_paye')
                    ->required(),

                // Notes facultatives
                Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull(),
            ]);
    }
}
