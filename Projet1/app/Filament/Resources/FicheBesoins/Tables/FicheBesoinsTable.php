<?php

namespace App\Filament\Resources\FicheBesoins\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FicheBesoinsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nom_structure')
                    ->searchable(),
                TextColumn::make('type_structure'),
                TextColumn::make('nom_interlocuteur')
                    ->searchable(),
                TextColumn::make('fonction')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->searchable(),
                TextColumn::make('cellulaire')
                    ->searchable(),
                TextColumn::make('fax')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('nom_agent_bnetd')
                    ->searchable(),
                TextColumn::make('date_entretien')
                    ->date()
                    ->sortable(),
                IconColumn::make('commande_ferme')
                    ->boolean(),
                IconColumn::make('demande_facture_proforma')
                    ->boolean(),
                TextColumn::make('delai_souhaite')
                    ->searchable(),
                TextColumn::make('date_livraison_prevue')
                    ->date()
                    ->sortable(),
                TextColumn::make('date_livraison_reelle')
                    ->date()
                    ->sortable(),
                TextColumn::make('signature_client')
                    ->searchable(),
                TextColumn::make('signature_agent_bnetd')
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
