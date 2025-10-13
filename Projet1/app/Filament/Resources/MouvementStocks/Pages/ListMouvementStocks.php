<?php

namespace App\Filament\Resources\MouvementStocks\Pages;

use App\Filament\Resources\MouvementStocks\MouvementStockResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\MouvementStockStatsOverview;

class ListMouvementStocks extends ListRecords
{
    protected static string $resource = MouvementStockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [

        MouvementStockStatsOverview::class,


        ];
    }



}
