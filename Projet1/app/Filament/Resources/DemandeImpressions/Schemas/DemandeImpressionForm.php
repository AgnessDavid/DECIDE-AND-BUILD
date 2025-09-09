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
               
                TextInput::make('agent_commercial'),
                TextInput::make('service'),
                
                Textarea::make('objet')
                    ->columnSpanFull(),

                DatePicker::make('date_visa_chef_service'),
                TextInput::make('nom_visa_chef_service'),

                DatePicker::make('date_autorisation'),
                Toggle::make('est_autorise_chef_informatique')
                    ->required(),

                TextInput::make('nom_visa_autorisateur'),

                DatePicker::make('date_impression'),

                TextInput::make('quantite_totale_imprimee')
                    ->numeric(),

                TextInput::make('nom_visa_agent_impression'),

                DatePicker::make('date_reception_stock'),

                TextInput::make('quantite_totale_receptionnee')
                    ->numeric(),

                Textarea::make('details_reception')
                    ->columnSpanFull(),

                Textarea::make('observations')
                    ->columnSpanFull(),

                TextInput::make('nom_signature_final'),
               
                TextInput::make('numero_ordre'),

                Textarea::make('designation')
                    ->required()
                    ->columnSpanFull(),


                Select::make('type_impression')
                    ->options([
                        'simple' => 'Impression simple',
                        'specifique' => 'Impression spécifique',
                    ])
                    ->required()
                    ->reactive(),

                Select::make('produit_id')
                    ->relationship('produit', 'nom_produit')
                    ->label('Produit existant')
                    ->visible(fn($get) => $get('type_impression') === 'simple')
                    ->required(fn($get) => $get('type_impression') === 'simple'),

                TextInput::make('produit_souhaite')
                    ->label('Produit souhaité')
                    ->visible(fn($get) => $get('type_impression') === 'specifique')
                    ->required(fn($get) => $get('type_impression') === 'specifique'),


                TextInput::make('quantite_demandee')
                    ->required()
                    ->numeric(),

                TextInput::make('quantite_imprimee')
                    ->numeric(),

                Select::make('statut')
                ->label('Statut')
                ->options([
                   'en_attente' => 'En attente',
                   'en_production' => 'En production',
                   'terminer' => 'Terminer',
                ])
                ->default('en_attente')
                ->required(),

           
                DatePicker::make('date_demande')
                    ->required(),
            ]);
    }
}
