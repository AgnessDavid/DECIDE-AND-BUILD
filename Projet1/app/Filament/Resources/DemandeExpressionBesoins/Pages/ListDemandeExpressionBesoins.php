<?php

namespace App\Filament\Resources\DemandeExpressionBesoins\Pages;

use App\Filament\Resources\DemandeExpressionBesoins\DemandeExpressionBesoinResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDemandeExpressionBesoins extends ListRecords
{
    protected static string $resource = DemandeExpressionBesoinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
