<?php

namespace App\Filament\Resources\FicheExpressionBesoins\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\Produit;

class FicheExpressionBesoinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('nom_structure')->label('Nom de la structure')->required(),
            Select::make('type_structure')
                ->label('Type de structure')
                ->options([
                    'societe' => 'Société',
                    'organisme' => 'Organisme',
                    'particulier' => 'Particulier',
                ])
                ->required(),
            TextInput::make('nom_interlocuteur')->label('Nom de l’interlocuteur')->required(),
            TextInput::make('fonction')->label('Fonction'),

            TextInput::make('telephone')->label('Téléphone'),
            TextInput::make('cellulaire')->label('Cellulaire'),
            TextInput::make('fax')->label('Fax'),
            TextInput::make('email')->label('Email'),

            TextInput::make('nom_agent_bnetd')->label('Nom de l’agent BNETD')->required(),
            DatePicker::make('date_entretien')->label('Date de l’entretien')->required(),
            Textarea::make('objectifs_vises')->label('Objectifs visés'),

            Toggle::make('commande_ferme')->label('Commande fermée')->default(false),
            Toggle::make('demande_facture_proforma')->label('Demande de facture proforma')->default(false),

            DatePicker::make('delai_souhaite')->label('Délai souhaité'),
            DatePicker::make('date_livraison_prevue')->label('Date de livraison prévue'),
            DatePicker::make('date_livraison_reelle')->label('Date de livraison réelle'),

            TextInput::make('signature_client')->label('Signature client'),
            TextInput::make('signature_agent_bnetd')->label('Signature agent BNETD'),

           TextInput::make('produit_souhaite')
              ->label('Produit souhaité')
              ->required(),

        ]);
    }
}


