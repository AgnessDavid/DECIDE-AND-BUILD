<?php

namespace App\Filament\Resources\ValidationFicheExpressionBesoins\Schemas;

use App\Models\FicheBesoin;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ValidationFicheExpressionBesoinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            // 🔹 Sélection de la fiche
Select::make('fiche_besoin_id')
    ->label('Fiche d\'expression de besoin')
    ->required()
    ->options(FicheBesoin::pluck('nom_structure', 'id'))
    ->searchable()
    ->reactive()
    ->afterStateUpdated(function ($state, $set) {
        if ($state) {
            $fiche = FicheBesoin::with('produit')->find($state); // Charger produit avec la fiche
            if ($fiche) {
                // 🔹 Infos structure
                $set('nom_structure', $fiche->nom_structure);
                $set('type_structure', $fiche->type_structure);
                $set('nom_interlocuteur', $fiche->nom_interlocuteur);
                $set('fonction', $fiche->fonction);

                // 🔹 Entretien
                $set('nom_agent_bnetd', $fiche->nom_agent_bnetd);
                $set('date_entretien', $fiche->date_entretien);
                $set('objectifs_vises', $fiche->objectifs_vises);

                // 🔹 Informations cartographiques / produit
                $set('type_carte', $fiche->type_carte ?? null);
            $set('produit_souhaite', $fiche->produit?->produit_souhaite ?? $fiche->produit_souhaite ?? null);
            $set('echelle', $fiche->echelle ?? null);
            $set('orientation', $fiche->orientation ?? null);
            $set('auteur', $fiche->auteur ?? null);
            $set('symbole', $fiche->symbole ?? null);
            $set('type_element', $fiche->type_element ?? null);
            $set('latitude', $fiche->latitude ?? null);
            $set('longitude', $fiche->longitude ?? null);
            $set('nom_zone', $fiche->nom_zone ?? null);
            $set('type_zone', $fiche->type_zone ?? null);
            }
        }
    }),



            // 🔹 Sélection de l’utilisateur
            Select::make('user_id')
                ->label('Utilisateur')
                ->required()
                ->options(User::pluck('name', 'id'))
                ->searchable(),

            // 🔹 Informations sur la structure
            Section::make('Informations sur la structure')->schema([
                TextInput::make('nom_structure')->required(),
                Select::make('type_structure')
                    ->options([
                        'societe' => 'Société',
                        'organisme' => 'Organisme',
                        'particulier' => 'Particulier',
                    ])
                    ->required(),
                TextInput::make('nom_interlocuteur')->required(),
                TextInput::make('fonction'),
            ])->columns(2),

            // 🔹 Entretien
            Section::make('Entretien')->schema([
                TextInput::make('nom_agent_bnetd')->required(),
                DatePicker::make('date_entretien')->required(),
                Textarea::make('objectifs_vises')->columnSpanFull(),
            ]),

            // 🔹 Validation
            Section::make('Validation')->schema([
                Toggle::make('valide')->required(),
                Textarea::make('commentaire')->columnSpanFull(),
            ]),

            // 🔹 Informations cartographiques / produit
            Section::make('Informations cartographiques')->schema([
                TextInput::make('type_carte'),
                 TextInput::make('produit_souhaite'),
                TextInput::make('echelle'),
                TextInput::make('orientation'),
                TextInput::make('auteur'),
                TextInput::make('symbole'),
                TextInput::make('type_element'),
                TextInput::make('latitude')->numeric(),
                TextInput::make('longitude')->numeric(),
                TextInput::make('nom_zone'),
                TextInput::make('type_zone'),
            ])->columns(2),
        ]);
    }
}
