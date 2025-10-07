<?php

namespace App\Filament\Resources\GestionImpressions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use App\Models\Imprimerie;

class GestionImpressionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Section 1 : Sélection de l'imprimerie et de la demande
                Section::make('Informations de base')
                    ->schema([
                        Select::make('imprimerie_id')
                            ->relationship('imprimerie', 'id')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $imprimerie = Imprimerie::find($state);

                                    if ($imprimerie) {
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
                            ->relationship('produit', 'nom_produit')
                            ->required(),
                    ]),

                // Section 2 : Détails du produit
                Section::make('Détails du produit')
                    ->schema([
                        TextInput::make('nom_produit')->required(),
                        TextInput::make('quantite_demandee')->required()->numeric()->default(0),
                        TextInput::make('quantite_imprimee')->numeric()->default(0),
                        Select::make('type_impression')
                            ->options(['simple' => 'Simple', 'specifique' => 'Specifique'])
                            ->required(),
                        Select::make('statut')
                            ->options(['en_cours' => 'En cours', 'terminee' => 'Terminée'])
                            ->default('en_cours')
                            ->required(),
                    ]),

                // Section 3 : Dates importantes
                Section::make('Dates')
                    ->schema([
                        DatePicker::make('date_demande')->label('Date de demande'),
                        DatePicker::make('date_impression')->label('Date d’impression'),
                    ]),

                // Section 4 : Informations supplémentaires
                Section::make('Informations supplémentaires')
                    ->schema([
                        TextInput::make('valide_par')->label('Validé par'),
                        TextInput::make('operateur')->label('Opérateur'),
                        TextInput::make('agent_commercial')->label('Agent commercial'),
                        TextInput::make('service')->label('Service'),
                        TextInput::make('objet')->label('Objet'),
                    ]),
            ]);
    }
}
