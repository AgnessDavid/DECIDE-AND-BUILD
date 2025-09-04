<?php

namespace App\Filament\Resources\FicheBesoins\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FicheBesoinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nom_structure')
                    ->required(),
                Select::make('type_structure')
                    ->options(['societe' => 'Societe', 'organisme' => 'Organisme', 'particulier' => 'Particulier'])
                    ->required(),
                TextInput::make('nom_interlocuteur')
                    ->required(),
                TextInput::make('fonction'),
                TextInput::make('telephone')
                    ->tel(),
                TextInput::make('cellulaire'),
                TextInput::make('fax'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('nom_agent_bnetd')
                    ->required(),
                DatePicker::make('date_entretien')
                    ->required(),
                Textarea::make('objectifs_vises')
                    ->columnSpanFull(),
                Toggle::make('commande_ferme')
                    ->required(),
                Toggle::make('demande_facture_proforma')
                    ->required(),
                DatePicker::make('delai_souhaite')
                    ->required(),
                DatePicker::make('date_livraison_prevue'),
                DatePicker::make('date_livraison_reelle'),
                TextInput::make('signature_client'),
                TextInput::make('signature_agent_bnetd'),
            ]);
    }
}
