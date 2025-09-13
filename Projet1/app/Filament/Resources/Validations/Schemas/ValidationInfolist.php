<?php

namespace App\Filament\Resources\Validations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ValidationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextEntry::make('statut')->label('Statut'),
            TextEntry::make('user.name')->label('Validé par'),
            TextEntry::make('ficheBesoin.nom_structure')->label('Fiche de besoin')->default('-'),
            TextEntry::make('demandeImpression.designation')->label('Demande d\'impression')->default('-'),
            TextEntry::make('date_visa_chef_service')->label('Date visa chef de service')->default('-'),
            TextEntry::make('nom_visa_chef_service')->label('Nom visa chef de service')->default('-'),
            TextEntry::make('date_autorisation')->label('Date autorisation')->default('-'),
            TextEntry::make('est_autorise_chef_informatique')->label('Autorisation chef informatique')->default('-'),
            TextEntry::make('nom_visa_autorisateur')->label('Nom autorisateur')->default('-'),
            TextEntry::make('date_impression')->label('Date impression')->default('-'),
            TextEntry::make('notes')->label('Notes')->default('-'),
        ]);
    }
}
