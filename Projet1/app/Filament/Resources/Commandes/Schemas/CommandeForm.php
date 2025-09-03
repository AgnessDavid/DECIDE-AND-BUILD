<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->required(),
                Select::make('fiche_besoin_id')
                    ->relationship('ficheBesoin', 'id')
                    ->required(),
                TextInput::make('numero_commande')
                    ->required(),
                DatePicker::make('date_commande')
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
                Select::make('moyen_de_paiement')
                    ->options([
            'en_ligne' => 'En ligne',
            'especes' => 'Especes',
            'cheque' => 'Cheque',
            'virement_bancaire' => 'Virement bancaire',
        ]),
                Select::make('statut')
                    ->options([
            'brouillon' => 'Brouillon',
            'validee' => 'Validee',
            'partiellement_facturee' => 'Partiellement facturee',
            'facturee' => 'Facturee',
            'annulee' => 'Annulee',
        ])
                    ->default('brouillon')
                    ->required(),
                Textarea::make('notes_internes')
                    ->columnSpanFull(),
            ]);
    }
}
