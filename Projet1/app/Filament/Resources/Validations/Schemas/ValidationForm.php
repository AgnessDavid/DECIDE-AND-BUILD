<?php

namespace App\Filament\Resources\Validations\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ValidationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

Select::make('user_id')
                ->label('Utilisateur')
                ->relationship('user', 'name')
                ->required(),

            Select::make('statut')
                ->label('Statut')
                ->options([
                    'en_attente' => 'En attente',
                    'validée'    => 'Validée',
                ])
                ->default('en_attente')
                ->required(),

            DatePicker::make('date_visa_chef_service')
                ->label('Date visa chef de service'),

            Textarea::make('nom_visa_chef_service')
                ->label('Nom visa chef de service'),

            DatePicker::make('date_autorisation')
                ->label('Date autorisation'),

            Select::make('est_autorise_chef_informatique')
                ->label('Autorisation chef informatique')
                ->options([1 => 'Oui', 0 => 'Non'])
                ->default(0),

            Textarea::make('nom_visa_autorisateur')
                ->label('Nom autorisateur'),

            DatePicker::make('date_impression')
                ->label('Date impression'),

            Textarea::make('notes')
                ->label('Notes'),
        ]);
    }
}
