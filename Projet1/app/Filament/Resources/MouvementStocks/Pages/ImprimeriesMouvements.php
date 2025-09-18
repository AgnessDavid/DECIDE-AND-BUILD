<?php

namespace App\Filament\Resources\MouvementStocks\Pages;

use App\Filament\Resources\MouvementStocks\MouvementStockResource;
use App\Models\Imprimerie;
use Filament\Resources\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Concerns\InteractsWithTable;

class ImprimeriesMouvements extends Page
{
    use InteractsWithTable;

    protected static string $resource = MouvementStockResource::class;

protected string $view = 'filament.resources.mouvement-stocks.pages.imprimeries-mouvements';


    protected function getTableQuery()
    {
        return Imprimerie::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('nom_produit')->label('Produit'),
            TextColumn::make('type_impression')->label('Type'),
            TextColumn::make('quantite_demandee')->label('Qté demandée'),
            TextColumn::make('quantite_imprimee')->label('Qté imprimée'),
            TextColumn::make('agent_commercial')->label('Agent commercial'),
            TextColumn::make('service'),
            TextColumn::make('date_impression')->date(),
            TextColumn::make('valide_par')->label('Validé par'),
            BadgeColumn::make('statut')
                ->colors([
                    'warning' => 'en_cours',
                    'success' => 'terminee',
                ]),
        ];
    }
}
