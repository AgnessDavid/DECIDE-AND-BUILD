<?php

namespace App\Filament\Resources\Produits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\BadgeEntry;
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

                TextEntry::make('description')
                    ->label('Description'),

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
                    ->url(fn ($record) => $record->photo_url)
                    ->circular(),

                // ================== Informations sur la carte ==================
     
                TextEntry::make('type')
    ->label('Type de carte')
    ->color(fn ($record) => match($record->type) {
        'ville' => 'primary',
        'region' => 'success',
        'pays' => 'warning',
        'continent' => 'danger',
        default => 'secondary',
    }),


                TextEntry::make('echelle')
                    ->label('Échelle'),

                TextEntry::make('orientation')
                    ->label('Orientation'),

                TextEntry::make('auteur')
                    ->label('Auteur / Source'),

                TextEntry::make('symbole')
                    ->label('Symbole'),

                TextEntry::make('type_element')
                    ->label('Type d’élément'),

                TextEntry::make('latitude')
                    ->numeric()
                    ->label('Latitude'),

                TextEntry::make('longitude')
                    ->numeric()
                    ->label('Longitude'),

                TextEntry::make('nom_zone')
                    ->label('Nom de la zone'),

                TextEntry::make('type_zone')
                    ->label('Type de zone'),

                TextEntry::make('date_creation')
                    ->date()
                    ->label('Date de création'),
            ]);
    }
}
