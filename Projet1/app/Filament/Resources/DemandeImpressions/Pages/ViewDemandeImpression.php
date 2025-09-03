<?php

namespace App\Filament\Resources\DemandeImpressions\Pages;

use App\Filament\Resources\DemandeImpressions\DemandeImpressionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDemandeImpression extends ViewRecord
{
    protected static string $resource = DemandeImpressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
