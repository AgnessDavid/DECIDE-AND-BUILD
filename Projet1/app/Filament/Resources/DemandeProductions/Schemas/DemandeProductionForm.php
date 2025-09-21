<?php

namespace App\Filament\Resources\DemandeProductions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;

class DemandeProductionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('type_impression')
                ->label('Type de production')
                ->options([
                    'simple' => 'Simple',
                    'specifique' => 'Spécifique',
                ])
                ->required(),

            Select::make('produit_id')
                ->label('Produit')
                ->relationship('produit', 'nom_produit')
                ->required(fn ($get) => $get('type_impression') === 'simple'),

            TextInput::make('numero_ordre')
                ->label('Numéro d\'ordre')
                ->disabled() // lecture seule, sera généré automatiquement
                ->default(function () {
                    $prefix = 'ORD-IMP-';
                    $count = \App\Models\DemandeImpression::count() + 1;
                    return $prefix . str_pad($count, 4, '0', STR_PAD_LEFT);
                }),

            TextInput::make('designation')->label('Désignation')->required(),
            TextInput::make('quantite_demandee')->label('Quantité demandée')->numeric()->required(),
            TextInput::make('quantite_imprimee')->label('Quantité produite')->numeric()->default(0),
            DatePicker::make('date_demande')->label('Date de demande')->required(),
            DatePicker::make('date_impression')->label('Date production'),

            TextInput::make('agent_commercial')->label('Agent commercial')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    // Remplir automatiquement le service avec l'agent commercial
                    $set('service', $state);
                }),

            Select::make('service')
            ->label('Service concerné')
            ->options([
              'commercial' => 'Commercial',
              'production' => 'Production',
              'logistique' => 'Logistique',
              'qualite' => 'Qualité',
              'administration' => 'Administration',
        // ajoute ici tous les services disponibles
    ])
    ->required()
    ->default(fn ($get) => $get('agent_commercial')), // optionnel : remplir par défaut avec l'agent commercial

            TextInput::make('objet')->label('Objet'),
        ]);
    }
}
