<?php

namespace App\Filament\Resources\Caisses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CaisseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('paiement_id')
                    ->numeric(),
                Select::make('type')
                    ->options(['entree' => 'Entree', 'sortie' => 'Sortie'])
                    ->required(),
                TextInput::make('montant')
                    ->required()
                    ->numeric(),
                Textarea::make('motif')
                    ->required()
                    ->columnSpanFull(),
                DateTimePicker::make('date_mouvement')
                    ->required(),
            ]);
    }
}
