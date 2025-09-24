<?php

namespace App\Filament\Resources\ImprimerieExpressionBesoins\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ImprimerieExpressionBesoinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('demande_expression_besoin_id')
    ->label('Demande d\'expression de besoin')
    ->relationship('demandeExpressionBesoin', 'id')
    ->required()
    ->reactive() // Permet de déclencher la mise à jour des champs liés
    ->afterStateUpdated(function ($state, $set) {
        if ($state) {
            $demande = \App\Models\DemandeExpressionBesoin::with('produit')->find($state);
            if ($demande) {
                // Remplit automatiquement les champs liés
                $set('produit_id', $demande->produit_id);
                $set('nom_produit', $demande->produit?->nom_produit);
                $set('quantite_demandee', $demande->quantite_demandee);
                $set('agent_commercial', $demande->agent_commercial);
                $set('service', $demande->service);
                $set('objet', $demande->objet);
                $set('date_demande', $demande->date_demande);
                $set('type_impression', $demande->type_impression);
            }
        }
    }),

                Select::make('produit_id')
                    ->relationship('produit', 'id'),
                TextInput::make('nom_produit'),
                TextInput::make('quantite_demandee')
                    ->numeric()
                    ->default(0),
                TextInput::make('quantite_imprimee')
                    ->numeric()
                    ->default(0),
                TextInput::make('valide_par'),
                TextInput::make('operateur'),
                DatePicker::make('date_impression'),
                Select::make('type_impression')
                    ->options(['simple' => 'Simple', 'specifique' => 'Specifique'])
                    ->required(),
                Select::make('statut')
                    ->options(['en_cours' => 'En cours', 'terminee' => 'Terminee'])
                    ->default('en_cours'),
                TextInput::make('agent_commercial'),
                TextInput::make('service'),
                TextInput::make('objet'),
                DatePicker::make('date_demande'),
            ]);
    }
}
