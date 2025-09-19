<?php

namespace App\Filament\Resources\Caisses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Commande;

class CaisseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Choix de la commande
                Select::make('commande_id')
                    ->relationship('commande', 'id')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $commande = Commande::with('client')->find($state);

                            if ($commande) {
                                $set('client_id', $commande->client_id);
                                $set('user_id', $commande->user_id);
                                $set('montant_ht', $commande->montant_ht);
                                $set('montant_ttc', $commande->montant_ttc);
                                $set('tva', 18.0);
                            }
                        }
                    }),

                // Ces champs vont se remplir automatiquement
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->required(),

                TextInput::make('montant_ht')
                    ->required()
                    ->numeric(),

                TextInput::make('tva')
                    ->required()
                    ->numeric()
                    ->default(18.0),

                TextInput::make('montant_ttc')
                    ->required()
                    ->numeric(),

                    
TextInput::make('entree')
    ->label('Montant Entré')
    ->numeric()
    ->reactive()
    ->afterStateUpdated(function ($state, callable $set, callable $get) {
        $set('sortie', $state - ($get('montant_ttc') ?? 0));
    }),

TextInput::make('sortie')
    ->label('Monnaie à rendre')
    ->numeric()
    ->disabled(), // on empêche la saisie manuelle


                Select::make('statut_paiement')
                    ->options([
                        'payé' => 'Payé',
                        'impayé' => 'Impayé',
                    ])
                    ->default('impayé')
                    ->required(),
            ]);
    }
}
