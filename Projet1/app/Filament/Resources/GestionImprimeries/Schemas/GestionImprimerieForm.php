<?php

namespace App\Filament\Resources\GestionImprimeries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\ImprimerieExpressionBesoin;

class GestionImprimerieForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('imprimeries_expression_besoin_id')
                    ->label('Imprimerie Expression Besoin')
                    ->options(ImprimerieExpressionBesoin::all()->pluck('nom_produit', 'id'))
                    ->reactive() // rend le champ réactif
                    ->afterStateUpdated(function ($state, $set) {
                        // $state = id sélectionné
                        $impr = ImprimerieExpressionBesoin::find($state);
                        if ($impr) {
                            $set('produit_id', $impr->produit_id);
                            $set('designation', $impr->nom_produit);
                            $set('quantite_demandee', $impr->quantite_demandee);
                            $set('quantite_imprimee', $impr->quantite_imprimee);
                            $set('stock_minimum', $impr->produit->stock_minimum ?? 0);
                            $set('stock_maximum', $impr->produit->stock_maximum ?? 0);
                            $set('stock_actuel', $impr->produit->stock_actuel ?? 0);
                        }
                    }),

             Select::make('produit_id')
                    ->relationship('produit', 'nom_produit')
                    ->reactive() // <- important pour déclencher les mises à jour
                    ->afterStateUpdated(function ($state, $set) {
                        $produit = \App\Models\Produit::find($state);
                        if ($produit) {
                            $set('stock_actuel', $produit->stock_actuel);
                            $set('stock_minimum', $produit->stock_minimum);
                            $set('stock_maximum', $produit->stock_maximum);
                        }
                    }),

                TextInput::make('designation'),

                TextInput::make('quantite_entree')
                    ->numeric(),

                TextInput::make('quantite_sortie')
                    ->numeric(),

                DatePicker::make('date_mouvement')
                    ->required(),

                TextInput::make('numero_bon'),

                TextInput::make('type_mouvement')
                    ->required(),

                TextInput::make('stock_resultant')
                    ->numeric()
                    ->default(0),

                Textarea::make('details')
                    ->columnSpanFull(),

                TextInput::make('quantite_demandee')
                    ->numeric(),

                TextInput::make('quantite_imprimee')
                    ->numeric(),

                TextInput::make('stock_minimum')
                    ->numeric(),

                TextInput::make('stock_maximum')
                    ->numeric(),

                TextInput::make('stock_actuel')
                    ->numeric(),
            ]);
    }
}
