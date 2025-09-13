<?php

namespace App\Filament\Resources\Validations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ValidationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('source')
                    ->label('Source')
                    ->getStateUsing(function ($record) {
                        if ($record->demande_id) {
                            return $record->demandeImpression->designation ?? 'N/A';
                        } elseif ($record->fiche_besoin_id) {
                            return $record->ficheBesoin->nom_structure ?? 'RAS';
                        }
                        return '-';
                    })
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Validé par')
                    ->searchable(),

                TextColumn::make('statut'),

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
