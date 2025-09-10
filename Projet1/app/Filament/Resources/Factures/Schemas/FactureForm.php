<?php

namespace App\Filament\Resources\Factures\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use App\Models\Produit;

class FactureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Choix de la commande source
                Select::make('commande_id')
                    ->relationship('commande', 'numero_commande')
                    ->label('Commande')
                    ->required()
                    ->reactive(),

                // Agent responsable
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Agent')
                    ->required(),

                // Numéro de facture
                TextInput::make('numero_facture')
                    ->label('Numéro de facture')
                    ->required(),

                // Date de facturation
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

                // Montants
                TextInput::make('montant_ht')
                    ->label('Montant HT')
                    ->numeric()
                    ->required(),

                TextInput::make('tva')
                    ->label('TVA (%)')
                    ->numeric()
                    ->default(18.0)
                    ->required(),

                TextInput::make('montant_ttc')
                    ->label('Montant TTC')
                    ->numeric()
                    ->required(),

                // Produits liés à la facture
                Repeater::make('produits')
                    ->label('Produits commandés')
                    ->schema([
                        Select::make('produit_id')
                            ->relationship('produit', 'nom_produit')
                            ->label('Produit')
                            ->required()
                            ->reactive(),

                        TextInput::make('quantite')
                            ->label('Quantité')
                            ->numeric()
                            ->required()
                            ->reactive(),

                        TextInput::make('prix_unitaire_ht')
                            ->label('Prix unitaire HT')
                            ->numeric()
                            ->required()
                            ->reactive(),

                        TextInput::make('montant_ht')
                            ->label('Montant HT')
                            ->numeric()
                            ->disabled()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $set('montant_ht', $get('quantite') * $get('prix_unitaire_ht'));
                            }),

                        TextInput::make('montant_ttc')
                            ->label('Montant TTC')
                            ->numeric()
                            ->disabled()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                $set('montant_ttc', $get('quantite') * $get('prix_unitaire_ht') * 1.18);
                            }),
                    ]),

                // Notes facultatives
                Textarea::make('notes')
                    ->label('Notes')
                    ->columnSpanFull(),
            ]);
    }
}
