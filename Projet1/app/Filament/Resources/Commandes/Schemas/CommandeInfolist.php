<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Infolists\Components\TextEntry;

use Filament\Schemas\Schema;

class CommandeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')->label('Agent'),
                TextEntry::make('client.nom')->label('Client'),
                TextEntry::make('ficheBesoin.nom_structure')->label('Fiche de besoin'),
                TextEntry::make('numero_commande')->label('Numéro de commande'),
                TextEntry::make('date_commande')->label('Date de commande')->date(),

                TextEntry::make('montant_ht')->label('Montant HT')->numeric(),
                TextEntry::make('tva')->label('TVA')->numeric(),
                TextEntry::make('montant_ttc')->label('Montant TTC')->numeric(),

                TextEntry::make('moyen_de_paiement')->label('Moyen de paiement'),
                TextEntry::make('statut')->label('Statut'),
                TextEntry::make('created_at')->label('Créé le')->dateTime(),
                TextEntry::make('updated_at')->label('Mis à jour le')->dateTime(),

                Repeater::make('produits')
                    ->label('Produits commandés')
                    ->relationship('produits') // relation hasMany vers CommandeProduit
                    ->schema([
                        TextEntry::make('produit.nom_produit')->label('Produit'),
                        TextEntry::make('quantite')->label('Quantité')->numeric(),
                        TextEntry::make('prix_unitaire_ht')->label('Prix unitaire HT')->numeric(),
                        TextEntry::make('montant_ht')->label('Montant HT')->numeric(),
                        TextEntry::make('montant_ttc')->label('Montant TTC')->numeric(),
                    ]),
            ]);
    }
}
