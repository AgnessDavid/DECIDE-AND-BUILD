<?php

namespace App\Filament\Resources\Ventes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VentesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.nom')
                    ->label('Client')
                    ->searchable(),

                TextColumn::make('commande.numero_commande')
                    ->label('Commande')
                    ->searchable(),

                TextColumn::make('montant_total')
                    ->label('Montant total'),

                TextColumn::make('mode_paiement')
                    ->label('Mode de paiement'),

                TextColumn::make('statut')
                    ->label('Statut'),

                TextColumn::make('date_vente')
                    ->label('Date vente')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
