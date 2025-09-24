<?php

namespace App\Filament\Resources\ImprimerieExpressionBesoins\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImprimerieExpressionBesoinsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('demandeExpressionBesoin.id')
                    ->searchable(),
                TextColumn::make('produit.id')
                    ->searchable(),
                TextColumn::make('nom_produit')
                    ->searchable(),
                TextColumn::make('quantite_demandee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quantite_imprimee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('valide_par')
                    ->searchable(),
                TextColumn::make('operateur')
                    ->searchable(),
                TextColumn::make('date_impression')
                    ->date()
                    ->sortable(),
                TextColumn::make('type_impression'),
                TextColumn::make('statut'),
                TextColumn::make('agent_commercial')
                    ->searchable(),
                TextColumn::make('service')
                    ->searchable(),
                TextColumn::make('objet')
                    ->searchable(),
                TextColumn::make('date_demande')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
