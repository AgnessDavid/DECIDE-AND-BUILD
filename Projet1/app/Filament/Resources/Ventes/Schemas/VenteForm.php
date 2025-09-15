<?php

namespace App\Filament\Resources\Ventes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;

class VenteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->label('Client')
                    ->relationship('client', 'nom')
                    ->reactive()
                    ->required(),

                Select::make('commande_id')
                    ->label('Commande')
                    ->options(fn(callable $get) =>
                        \App\Models\Commande::where('client_id', $get('client_id'))
                            ->pluck('numero_commande', 'id')
                    )
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Remplir automatiquement le montant_total avec la commande sélectionnée
                        $commande = \App\Models\Commande::find($state);
                        $set('montant_total', $commande?->montant_ttc ?? 0);
                    }),

                TextInput::make('montant_total')
                    ->label('Montant total')
                    ->numeric()
                    ->required(),

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
                        'en_attente' => 'En attente',
                        'payée' => 'Payée',
                    ])
                    ->default('en_attente')
                    ->required(),

                DateTimePicker::make('date_vente')
                    ->label('Date de vente')
                    ->required(),
            ]);
    }
}
