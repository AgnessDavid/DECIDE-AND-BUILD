<?php

namespace App\Filament\Resources\GestionImprimeries\Pages;

use App\Filament\Resources\GestionImprimeries\GestionImprimerieResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGestionImprimeries extends ListRecords
{
    protected static string $resource = GestionImprimerieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
