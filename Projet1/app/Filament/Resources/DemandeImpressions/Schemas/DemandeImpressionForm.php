<?php

namespace App\Filament\Resources\DemandeImpressions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class DemandeImpressionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               
              // Type d'impression réactif
            Select::make('type_impression')
                ->label('Type d\'impression')
                ->options([
                    'simple' => 'Simple',
                    'specifique' => 'Spécifique',
                ])
                ->reactive() // 🔹 rend le champ réactif instantanément
                ->required(),

            // Produit visible uniquement si simple
            Select::make('produit_id')
                ->label('Produit')
                ->relationship('produit', 'nom_produit')
                ->visible(fn ($get) => $get('type_impression') === 'simple')
                ->required(fn ($get) => $get('type_impression') === 'simple'),

            // Fiche de besoin visible uniquement si spécifique
            Select::make('fiche_besoin_id')
                ->label('Fiche de besoin')
                ->relationship('ficheBesoin', 'nom_structure')
                ->reactive() // 🔹 pour affichage instantané
                ->visible(fn ($get) => $get('type_impression') === 'specifique')
                ->required(fn ($get) => $get('type_impression') === 'specifique'),
            TextInput::make('numero_ordre')
                ->label('Numéro d\'ordre')
                ->required(),

            TextInput::make('designation')
                ->label('Désignation')
                ->required(),

            TextInput::make('quantite_demandee')
                ->label('Quantité demandée')
                ->numeric()
                ->minValue(0)
                ->required(),

            TextInput::make('quantite_imprimee')
                ->label('Quantité imprimée')
                ->numeric()
                ->default(0),

            DatePicker::make('date_demande')
                ->label('Date de demande')
                ->required(),

            DatePicker::make('date_impression')
                ->label('Date impression'),

            TextInput::make('agent_commercial')
                ->label('Agent commercial'),

            TextInput::make('service')
                ->label('Service concerné'),

            TextInput::make('objet')
                ->label('Objet'),
            ]);
    }
}
