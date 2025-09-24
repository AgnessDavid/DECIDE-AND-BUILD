<?php

namespace App\Filament\Resources\ValidationFicheExpressionBesoins\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ValidationFicheExpressionBesoinsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fiche_besoin_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nom_structure')
                    ->searchable(),
                TextColumn::make('type_structure'),
                TextColumn::make('nom_interlocuteur')
                    ->searchable(),
                TextColumn::make('fonction')
                    ->searchable(),
                TextColumn::make('nom_agent_bnetd')
                    ->searchable(),
                TextColumn::make('date_entretien')
                    ->date()
                    ->sortable(),
                IconColumn::make('valide')
                    ->boolean(),
                TextColumn::make('type_carte')
                    ->searchable(),
                TextColumn::make('echelle')
                    ->searchable(),
                TextColumn::make('orientation')
                    ->searchable(),
                TextColumn::make('auteur')
                    ->searchable(),
                TextColumn::make('symbole')
                    ->searchable(),
                TextColumn::make('type_element')
                    ->searchable(),
                TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longitude')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('nom_zone')
                    ->searchable(),
                TextColumn::make('type_zone')
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
