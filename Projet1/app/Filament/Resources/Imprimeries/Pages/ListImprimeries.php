<?php

namespace App\Filament\Resources\Imprimeries\Pages;

use App\Filament\Resources\Imprimeries\ImprimerieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\ImprimerieStatsOverview;
class ListImprimeries extends ListRecords
{
    protected static string $resource = ImprimerieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
           ImprimerieStatsOverview::class,
           
        ];
    }



}
