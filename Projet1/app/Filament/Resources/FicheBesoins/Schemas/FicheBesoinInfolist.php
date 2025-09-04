<?php

namespace App\Filament\Resources\FicheBesoins\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FicheBesoinInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nom_structure'),
                TextEntry::make('type_structure'),
                TextEntry::make('nom_interlocuteur'),
                TextEntry::make('fonction'),
                TextEntry::make('telephone'),
                TextEntry::make('cellulaire'),
                TextEntry::make('fax'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('nom_agent_bnetd'),
                TextEntry::make('date_entretien')
                    ->date(),
                IconEntry::make('commande_ferme')
                    ->boolean(),
                IconEntry::make('demande_facture_proforma')
                    ->boolean(),
                TextEntry::make('delai_souhaite') 
                   ->date(),
                TextEntry::make('date_livraison_prevue')
                    ->date(),
                TextEntry::make('date_livraison_reelle')
                    ->date(),
                TextEntry::make('signature_client'),
                TextEntry::make('signature_agent_bnetd'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
