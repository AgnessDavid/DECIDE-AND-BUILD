<?php

namespace App\Filament\Resources\DemandeImpressions\Pages;

use App\Filament\Resources\DemandeImpressions\DemandeImpressionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDemandeImpression extends EditRecord
{
    protected static string $resource = DemandeImpressionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
