<?php

namespace App\Filament\Resources\Paiements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PaiementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('facture_id')
                    ->relationship('facture', 'id')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('numero_recu')
                    ->required(),
                DatePicker::make('date_paiement')
                    ->required(),
                TextInput::make('montant_paye')
                    ->required()
                    ->numeric(),
                Select::make('moyen_de_paiement')
                    ->options([
            'especes' => 'Especes',
            'cheque' => 'Cheque',
            'virement_bancaire' => 'Virement bancaire',
            'en_ligne' => 'En ligne',
        ])
                    ->required(),
                TextInput::make('reference_paiement'),
                Textarea::make('objet')
                    ->columnSpanFull(),
            ]);
    }
}
