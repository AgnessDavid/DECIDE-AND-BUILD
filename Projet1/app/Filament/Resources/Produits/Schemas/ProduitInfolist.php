<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class ProduitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Créé le'),

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Mis à jour le'),

                TextEntry::make('reference_produit')
                    ->label('Référence du produit'),

                TextEntry::make('nom_produit')
                    ->label('Nom du produit'),

                TextEntry::make('stock_minimum')
                    ->numeric()
                    ->label('Stock minimum'),

                TextEntry::make('stock_maximum')
                    ->numeric()
                    ->label('Stock maximum'),

                TextEntry::make('stock_actuel')
                    ->numeric()
                    ->label('Stock actuel'),

                TextEntry::make('prix_unitaire_ht')
                    ->numeric()
                    ->label('Prix unitaire HT'),

                ImageEntry::make('photo')
                    ->label('Photo / Carte')
                    ->url(fn ($record) => $record->photo_url) // Utilise l'attribut accessor du model
                    ->circular(), // Optionnel : bord arrondi pour la miniature
            ]);
    }
}
