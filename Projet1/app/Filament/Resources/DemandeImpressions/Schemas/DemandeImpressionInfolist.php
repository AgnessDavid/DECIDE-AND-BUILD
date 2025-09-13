<?php

namespace App\Filament\Resources\DemandeImpressions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DemandeImpressionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    TextEntry::make('type_impression')->label('Type d\'impression'),
            TextEntry::make('ficheBesoin.nom_structure')->label('Fiche de besoin'),
            TextEntry::make('produit.nom_produit')->label('Produit'),
            TextEntry::make('numero_ordre')->label('Numéro d\'ordre'),
            TextEntry::make('designation')->label('Désignation'),
            TextEntry::make('quantite_demandee')->label('Quantité demandée'),
            TextEntry::make('quantite_imprimee')->label('Quantité imprimée'),
            TextEntry::make('date_demande')->label('Date de demande')->date(),
            
            TextEntry::make('agent_commercial')->label('Agent commercial'),
            TextEntry::make('service')->label('Service concerné'),
            TextEntry::make('objet')->label('Objet'),
            ]);
    }
}
