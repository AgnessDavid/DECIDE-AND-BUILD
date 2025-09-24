<?php

namespace App\Filament\Resources\GestionImpressions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Imprimerie;

class GestionImpressionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('imprimerie_id')
                    ->relationship('imprimerie', 'id')
                    ->required()
                    ->reactive() // rend le champ réactif
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $imprimerie = Imprimerie::find($state);

                            if ($imprimerie) {
                                // Remplir automatiquement les champs
                                $set('demande_id', $imprimerie->demande_id);
                                $set('produit_id', $imprimerie->produit_id);
                                $set('nom_produit', $imprimerie->nom_produit);
                                $set('quantite_demandee', $imprimerie->quantite_demandee);
                                $set('quantite_imprimee', $imprimerie->quantite_imprimee ?? 0);
                                $set('type_impression', $imprimerie->type_impression);
                                $set('statut', $imprimerie->statut ?? 'en_cours');
                                $set('date_impression', $imprimerie->date_impression);
                                $set('date_demande', $imprimerie->date_demande);
                                $set('valide_par', $imprimerie->valide_par);
                                $set('agent_commercial', $imprimerie->agent_commercial);
                                $set('service', $imprimerie->service);
                                $set('objet', $imprimerie->objet);
                              
                            }
                        }
                    }),

                Select::make('demande_id')
                    ->relationship('demande', 'id')
                    ->required(),

                Select::make('produit_id')
                    ->relationship('produit', 'id')
                    ->required(),

                TextInput::make('nom_produit')->required(),
                TextInput::make('quantite_demandee')->required()->numeric()->default(0),
                TextInput::make('quantite_imprimee')->numeric()->default(0),

                Select::make('type_impression')
                    ->options(['simple' => 'Simple', 'specifique' => 'Specifique'])
                    ->required(),

                Select::make('statut')
                    ->options(['en_cours' => 'En cours', 'terminee' => 'Terminee'])
                    ->default('en_cours')
                    ->required(),

                DatePicker::make('date_impression'),
                DatePicker::make('date_demande'),

                TextInput::make('valide_par'),
                TextInput::make('operateur'),
                TextInput::make('agent_commercial'),
                TextInput::make('service'),
                TextInput::make('objet'),
            ]);
    }
}
