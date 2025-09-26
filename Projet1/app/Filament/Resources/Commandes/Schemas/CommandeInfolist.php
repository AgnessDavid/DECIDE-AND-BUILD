<?php

namespace App\Filament\Resources\Commandes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CommandeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Agent'),

                TextEntry::make('client.nom')
                    ->label('Client'),

                TextEntry::make('numero_commande')
                    ->label('Numéro de commande'),

                TextEntry::make('date_commande')
                    ->label('Date de commande')
                    ->date(),

                TextEntry::make('montant_ht')
                    ->label('Montant HT')
                    ->getStateUsing(fn($record) => number_format(round($record->montant_ht), 0, ',', ' ') . ' FCFA'),

                TextEntry::make('tva')
                    ->label('TVA (%)')
                    ->numeric(),

                TextEntry::make('produit_non_satisfait')
                    ->label('Produit non satisfait'),

                TextEntry::make('montant_ttc')
                    ->label('Montant TTC')
                    ->getStateUsing(fn($record) => number_format(round($record->montant_ttc), 0, ',', ' ') . ' FCFA'),

                TextEntry::make('moyen_de_paiement')->label('Moyen de paiement'),
                TextEntry::make('statut_paiement')->label('Statut paiement'),

                TextEntry::make('created_at')->label('Créé le')->dateTime(),
                TextEntry::make('updated_at')->label('Mis à jour le')->dateTime(),

                // Liste des produits commandés avec multi-lignes et mise en forme
                TextEntry::make('produits_lignes')
                    ->label('Produits commandés')
                    ->getStateUsing(function ($record) {
                        return $record->produits->map(function ($ligne) {
                            return "• Produit : {$ligne->produit->nom_produit}\n"
                                 . "  Quantité : {$ligne->quantite}\n"
                                 . "  Prix unitaire : " . number_format(round($ligne->prix_unitaire_ht), 0, ',', ' ') . " FCFA\n"
                                 . "  Montant HT : " . number_format(round($ligne->montant_ht), 0, ',', ' ') . " FCFA\n";
                        })->implode("\n"); // chaque produit sur plusieurs lignes
                    })
                , // optionnel pour custom Blade si besoin
            ]);
    }
}
