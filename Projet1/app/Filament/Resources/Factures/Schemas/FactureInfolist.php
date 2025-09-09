<?php

namespace App\Filament\Resources\Factures\Schemas;

use Filament\Infolists\Components\TextEntry;

use Filament\Schemas\Schema;

class FactureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            TextEntry::make('numero_facture')->label('Numéro de facture'),
            TextEntry::make('date_facturation')->label('Date de facturation')->date(),
            TextEntry::make('statut_paiement')->label('Statut')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'paye' => 'success',
                    'partiellement_paye' => 'warning',
                    'non_paye' => 'danger',
                    default => 'gray',
                }),

            TextEntry::make('commande.numero_commande')->label('Commande'),
            TextEntry::make('client.nom')->label('Client'),
            TextEntry::make('user.name')->label('Agent'),

            // Afficher les produits sous forme de texte
TextEntry::make('produits_lignes')
    ->label('Produits commandés')
    ->getStateUsing(fn($record) => collect($record->produits_lignes)
        ->map(fn($ligne) => "{$ligne['nom']} - {$ligne['quantite']} x {$ligne['prix_unitaire_ht']} = {$ligne['montant_ht']} FCFA")
        ->implode("\n") // les sauts de ligne seront affichés dans le TextEntry
    )
    ->formatStateUsing(fn($state) => nl2br(e($state))) // convertit les sauts de ligne en <br> HTML
    ->html(), // permet de rendre le HTML dans l'infolist


            TextEntry::make('montant_ht')->label('Montant HT')->money('XOF'),
            TextEntry::make('tva')->label('TVA (%)'),
            TextEntry::make('montant_ttc')->label('Montant TTC')->money('XOF'),

            TextEntry::make('created_at')->label('Créé le')->dateTime(),
            TextEntry::make('updated_at')->label('Mis à jour le')->dateTime(),
        ]);
    }
}
