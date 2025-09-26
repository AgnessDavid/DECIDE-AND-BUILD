<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Notifications\Notification;

class CommandeForm
{
public static function configure(Schema $schema): Schema
{
    return $schema
        ->components([
            // Section 1 : Informations générales
            Section::make('Informations générales')
                ->schema([
                    Select::make('user_id')
                        ->relationship('user', 'name')
                        ->label('Agent')
                          ->searchable()
                        ->required(),

                    Select::make('client_id')
                        ->relationship('client', 'nom')
                        ->label('Client')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('nom')->label('Nom')->required(),
                            Select::make('type')->label('Type')->options(\App\Models\Client::TYPES)->required(),
                            TextInput::make('nom_interlocuteur')->label('Nom interlocuteur'),
                            TextInput::make('fonction')->label('Fonction'),
                            TextInput::make('telephone')->label('Téléphone'),
                            TextInput::make('cellulaire')->label('Cellulaire'),
                            TextInput::make('fax')->label('Fax'),
                            TextInput::make('email')->label('Email')->email(),
                            TextInput::make('ville')->label('Ville'),
                            TextInput::make('quartier_de_residence')->label('Quartier de résidence'),
                            Select::make('usage')->label('Usage')->options(\App\Models\Client::USAGES),
                            TextInput::make('domaine_activite')->label('Domaine d’activité'),
                        ]),

                    DatePicker::make('date_commande')->label('Date de commande')->required(),

                    TextInput::make('numero_commande')
                        ->label('Numéro de commande')
                        ->disabled()
                        ->default(fn () => 'CMD-BNET-XX')
                        ->required(),
                    ]),

                
            // Section 2 : Produits commandés
            Section::make('Produits commandés')
                ->schema([
                    Repeater::make('produits')
                        ->label('Produits ')
                        ->relationship('produits')
                        ->schema([
                            Select::make('produit_id')
                                ->relationship('produit', 'nom_produit')
                                ->label('Produit')
                                ->required()
                                ->searchable()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, $get) {
                                    // ton code de calcul, notifications et stock
                                })
                                ->columnSpan(2),

                            TextInput::make('quantite')
                                ->label('Quantité')
                                ->numeric()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, $get) {
                                    // calcul des montants et validation stock
                                })
                                ->columnSpan(2),

                            TextInput::make('stock_actuel')->label('Stock actuel')->disabled()->dehydrated(false)->columnSpan(2),
                            TextInput::make('stock_minimum')->label('Stock minimum')->disabled()->dehydrated(false)->columnSpan(2),
                            TextInput::make('stock_maximum')->label('Stock maximum')->disabled()->dehydrated(false)->columnSpan(2),
                            TextInput::make('prix_unitaire_ht')
                                ->label('Prix unitaire HT')
                                ->numeric()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, $get) {
                                    $set('montant_ht', $get('quantite') * ($state ?? 0));
                                    $set('montant_ttc', $get('quantite') * ($state ?? 0) * 1.18);
                                })
                                ->columnSpan(2),
                            TextInput::make('montant_ht')->label('Montant HT')->disabled()->default(0)->dehydrated(false)->columnSpan(2),
                            TextInput::make('montant_ttc')->label('Montant TTC')->disabled()->default(0)->dehydrated(false)->columnSpan(2),
                        ])
                        ->columns(6)
                        ->createItemButtonLabel('Ajouter un produit'),
                ]),

            // Section 3 : Informations supplémentaires
            Section::make('Informations supplémentaires')
                ->schema([
                    TextInput::make('produit_non_satisfait')->label('Produit non satisfait'),
                    Textarea::make('notes_internes')->label('Notes internes'),
                ]),

            // Section 4 : Paiement
            Section::make('Paiement')
                ->schema([
                    Select::make('moyen_de_paiement')
                        ->label('Mode de paiement')
                        ->options([
                            'en_ligne' => 'En ligne',
                            'especes' => 'Espèces',
                            'cheque' => 'Chèque',
                            'virement_bancaire' => 'Virement bancaire',
                        ])
                        ->required(),

                    Select::make('statut_paiement')
                        ->label('Statut paiement')
                        ->options([
                            'Impayé' => 'Impayé',
                            'payé' => 'Payé',
                        ])
                        ->default('Impayé')
                        ->required(),
                ]),
        ]);
}
}


