<?php

namespace App\Filament\Resources\DemandeImpressions\Pages;

use App\Filament\Resources\DemandeImpressions\DemandeImpressionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemandeImpressions extends ListRecords
{
    protected static string $resource = DemandeImpressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
