<?php

namespace App\Filament\Resources\Validations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ValidationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Type de document : FicheBesoin ou DemandeImpression
                Select::make('type')
                    ->label('Type de document')
                    ->options([
                        'fiche_besoin' => 'Fiche de besoin',
                        'demande_impression' => 'Demande d\'impression',
                    ])
                    ->required()
                    ->reactive()
                    ->disabled(),

                // Document sélectionné
                Select::make('document_id')
                    ->label('Document')
                    ->options(function (callable $get) {
                        $type = $get('type');
                        if ($type === 'fiche_besoin') {
                            return \App\Models\FicheBesoin::pluck('nom_structure', 'id');
                        } elseif ($type === 'demande_impression') {
                            return \App\Models\DemandeImpression::pluck('designation', 'id');
                        }
                        return [];
                    })
                    ->required()
                    ->disabled(),

                // Utilisateur qui valide
                Select::make('user_id')
                    ->label('Validateur')
                    ->relationship('user', 'name')
                    ->required(),

                // Statut
                Select::make('statut')
                    ->label('Statut')
                    ->options([
                        'en_attente' => 'En attente',
                        'validée' => 'Validée',
                    ])
                    ->default('en_attente')
                    ->required(),

                // Notes
                Textarea::make('notes')
                    ->label('Notes'),
                
                // Dates d'autorisation
                DatePicker::make('date_autorisation')
                    ->label('Date d\'autorisation'),
            ]);
    }
}
