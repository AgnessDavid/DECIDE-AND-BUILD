<?php

namespace App\Filament\Resources\Depenses\Pages;

use App\Filament\Resources\Depenses\DepenseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDepenses extends ListRecords
{
    protected static string $resource = DepenseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
