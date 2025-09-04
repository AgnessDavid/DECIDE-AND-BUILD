<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;

class CommandeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Agent')
                    ->required(),

                Select::make('client_id')
                    ->relationship('client', 'nom')
                    ->label('Client')
                    ->required(),

                DatePicker::make('date_commande')
                    ->label('Date de commande')
                    ->required(),

                TextInput::make('numero_commande')
                    ->label('Numéro de commande')
                    ->required(),

                Repeater::make('produits')
    ->label('Produits commandés')
    ->relationship('produits') // <-- ici on utilise la relation hasMany vers CommandeProduit
    ->schema([
        Select::make('produit_id')
            ->relationship('produit', 'nom_produit') // relation du pivot vers Produit
            ->label('Produit')
            ->required()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set, $get) {
                if ($state) {
                    $produit = \App\Models\Produit::find($state);
                    if ($produit) {
                        $set('prix_unitaire_ht', $produit->prix_unitaire_ht);
                        $set('montant_ht', $produit->prix_unitaire_ht * ($get('quantite') ?? 1));
                        $set('montant_ttc', $produit->prix_unitaire_ht * ($get('quantite') ?? 1) * 1.18);
                    }
                }
            }),

        TextInput::make('quantite')
            ->label('Quantité')
            ->numeric()
            ->required()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set, $get) {
                $set('montant_ht', $state * ($get('prix_unitaire_ht') ?? 0));
                $set('montant_ttc', $state * ($get('prix_unitaire_ht') ?? 0) * 1.18);
            }),

        TextInput::make('prix_unitaire_ht')
            ->label('Prix unitaire HT')
            ->numeric()
            ->required()
            ->reactive()
            ->afterStateUpdated(function ($state, callable $set, $get) {
                $set('montant_ht', $get('quantite') * ($state ?? 0));
                $set('montant_ttc', $get('quantite') * ($state ?? 0) * 1.18);
            }),

        TextInput::make('montant_ht')
            ->label('Montant HT')
            ->disabled()
            ->default(0)
            ->dehydrated(false),

        TextInput::make('montant_ttc')
            ->label('Montant TTC')
            ->disabled()
            ->default(0)
            ->dehydrated(false),
    ])
    ->columns(5)
    ->createItemButtonLabel('Ajouter un produit'),
                Textarea::make('notes_internes')
                    ->label('Notes internes'),

                        Select::make('moyen_de_paiement')
                    ->label('Mode de paiement')
                    ->options([
                        'en_ligne' => 'En ligne',
                        'especes' => 'Espèces',
                        'cheque' => 'Chèque',
                        'virement_bancaire' => 'Virement bancaire',
                    ])
                    ->required(),

                Select::make('statut')
                    ->label('Statut')
                    ->options([
                        'payé' => 'Payé',
                        
                    ])
                    ->default('en_attente')
                    ->required(),
            ]);
    }
}
