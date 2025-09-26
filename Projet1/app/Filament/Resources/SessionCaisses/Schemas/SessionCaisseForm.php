<?php

namespace App\Filament\Resources\SessionCaisses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class SessionCaisseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1 : Caissier et ouverture
                Section::make('Informations du caissier')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->label('Caissier'),

                        DateTimePicker::make('ouvert_le')
                            ->required()
                            ->label('Ouvert le'),

                        DateTimePicker::make('ferme_le')
                            ->label('Fermé le'),

                        TextInput::make('statut')
                            ->disabled()
                            ->default('fermé'),
                    ]),

                // Section 2 : Solde
                Section::make('Solde et mouvements')
                    ->schema([
                        TextInput::make('solde_initial')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->formatStateUsing(fn($state) => number_format($state ?? 0, 0, ',', '.')),

                        TextInput::make('entrees')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set, $get) =>
                                $set('solde_final', ($get('solde_initial') ?? 0) + ($state ?? 0) - ($get('sorties') ?? 0))
                            )
                            ->formatStateUsing(fn($state) => number_format($state ?? 0, 0, ',', '.')),

                        TextInput::make('sorties')
                            ->numeric()
                            ->default(0)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set, $get) =>
                                $set('solde_final', ($get('solde_initial') ?? 0) + ($get('entrees') ?? 0) - ($state ?? 0))
                            )
                            ->formatStateUsing(fn($state) => number_format($state ?? 0, 0, ',', '.')),

                        TextInput::make('solde_final')
                            ->numeric()
                            ->disabled()
                            ->label('Solde Final')
                            ->formatStateUsing(fn($state) => number_format($state ?? 0, 0, ',', '.')),
                    ]),
            ]);
    }
}
