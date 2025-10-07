<?php

namespace App\Filament\Resources\ValidationFicheExpressionBesoins\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ValidationFicheExpressionBesoinInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('ficheBesoin.nom_fiche_besoin')
                ->label('Fiche de besoin'),

                TextEntry::make('user.name')
                    ->label('Utilisateur'),


                TextEntry::make('nom_structure'),
                TextEntry::make('produit_souhaite'),
                TextEntry::make('type_structure'),
                TextEntry::make('nom_interlocuteur'),
                TextEntry::make('fonction'),
                TextEntry::make('nom_agent_bnetd'),
                TextEntry::make('date_entretien')
                    ->date(),
                IconEntry::make('valide')
                    ->boolean(),
                TextEntry::make('Quantite_demandee')
                    ->numeric(),    
                TextEntry::make('type_carte'),
                TextEntry::make('echelle'),
                TextEntry::make('orientation'),
                TextEntry::make('auteur'),
                TextEntry::make('symbole'),
                TextEntry::make('type_element'),
                TextEntry::make('latitude')
                    ->numeric(),
                TextEntry::make('longitude')
                    ->numeric(),
                TextEntry::make('nom_zone'),
                TextEntry::make('type_zone'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
