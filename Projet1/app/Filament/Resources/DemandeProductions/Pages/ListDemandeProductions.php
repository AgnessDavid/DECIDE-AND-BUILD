<?php

namespace App\Filament\Resources\DemandeProductions\Pages;

use App\Filament\Resources\DemandeProductions\DemandeProductionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemandeProductions extends ListRecords
{
    protected static string $resource = DemandeProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
