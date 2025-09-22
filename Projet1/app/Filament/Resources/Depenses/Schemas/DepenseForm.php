<?php

namespace App\Filament\Resources\Depenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DepenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('designation')
                    ->required(),


                TextInput::make('montant')
                    ->required()
                    ->numeric(),


                TextInput::make('montant_total')
                    ->required()
                    ->numeric()
                    ->disabled()
                    ->default(function () {
        // Récupérer le dernier montant_total
        $dernierTotal = \App\Models\Depense::latest('id')->value('montant_total') ?? 0;
        return $dernierTotal;
    }),
                DatePicker::make('date_depense')
                    ->required(),

                TextInput::make('categorie'),
                Textarea::make('details')
                    ->columnSpanFull(),
            ]);
    }
}
