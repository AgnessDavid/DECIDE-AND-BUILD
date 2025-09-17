<?php

namespace App\Filament\Resources\Commandes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommandeExport;

class CommandesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('client.id')->searchable(),
                TextColumn::make('produit.id')->searchable(),
                TextColumn::make('ficheBesoin.id')->searchable(),
                TextColumn::make('numero_commande')->searchable(),
                TextColumn::make('date_commande')->date()->sortable(),
                TextColumn::make('montant_ht')->numeric()->sortable(),
                TextColumn::make('tva')->numeric()->sortable(),
                TextColumn::make('montant_ttc')->numeric()->sortable(),
                TextColumn::make('moyen_de_paiement'),
                TextColumn::make('statut'),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),

                // ✅ Bouton PDF
                Action::make('downloadPdf')
                    ->label('PDF')
                    ->icon('heroicon-o-document')
                    ->action(function ($record) {
                        $pdf = Pdf::loadView('exports.commande_pdf', [
                            'commande' => $record,
                        ]);

                        return response()->streamDownload(
                            fn() => print($pdf->output()),
                            "commande-{$record->id}.pdf"
                        );
                    }),

                // ✅ Bouton Excel
                Action::make('downloadExcel')
                    ->label('Excel')
                    ->icon('heroicon-o-document')
                    ->action(function ($record) {
                        return Excel::download(
                            new CommandeExport($record),
                            "commande-{$record->id}.xlsx"
                        );
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
