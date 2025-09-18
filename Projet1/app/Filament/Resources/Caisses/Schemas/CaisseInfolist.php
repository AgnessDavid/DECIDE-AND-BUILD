<?php

namespace App\Filament\Resources\Caisses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CaisseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Utilisateur ayant créé/enregistré
                TextEntry::make('user.name')
                    ->label('Utilisateur'),

                // Commande liée
                TextEntry::make('commande.numero_commande')
                    ->label('Commande'),

                // Client lié
                TextEntry::make('client.nom')
                    ->label('Client'),

                // Montants
                TextEntry::make('montant_ht')
                    ->label('Montant HT')
                    ->numeric()
                    ->money('XOF', true),

                TextEntry::make('tva')
                    ->label('TVA (%)')
                    ->numeric(),

                TextEntry::make('montant_ttc')
                    ->label('Montant TTC')
                    ->numeric()
                    ->money('XOF', true),

                TextEntry::make('entree')
                    ->label('Entrée')
                    ->numeric()
                    ->money('XOF', true),

                TextEntry::make('sortie')
                    ->label('Sortie')
                    ->numeric()
                    ->money('XOF', true),

                TextEntry::make('statut')
                    ->label('Statut'),

                // Dates
                TextEntry::make('created_at')
                    ->label('Créé le')
                    ->dateTime('d/m/Y H:i'),

                TextEntry::make('updated_at')
                    ->label('Modifié le')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
