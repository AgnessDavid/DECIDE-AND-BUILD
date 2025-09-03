<?php

namespace App\Filament\Resources\DemandeImpressions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DemandeImpressionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('demande_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('numero_ordre')
                    ->searchable(),
                TextColumn::make('quantite_demandee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('quantite_imprimee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('date_demande')
                    ->date()
                    ->sortable(),
                TextColumn::make('agent_commercial')
                    ->searchable(),
                TextColumn::make('service')
                    ->searchable(),
                TextColumn::make('date_visa_chef_service')
                    ->date()
                    ->sortable(),
                TextColumn::make('nom_visa_chef_service')
                    ->searchable(),
                TextColumn::make('date_autorisation')
                    ->date()
                    ->sortable(),
                IconColumn::make('est_autorise_chef_informatique')
                    ->boolean(),
                TextColumn::make('nom_visa_autorisateur')
                    ->searchable(),
                TextColumn::make('date_impression')
                    ->date()
                    ->sortable(),
                TextColumn::make('quantite_totale_imprimee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nom_visa_agent_impression')
                    ->searchable(),
                TextColumn::make('date_reception_stock')
                    ->date()
                    ->sortable(),
                TextColumn::make('quantite_totale_receptionnee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nom_signature_final')
                    ->searchable(),
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
