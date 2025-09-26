<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsCommandesWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\CaisseStatsOverview;
use App\Filament\Widgets\ClientStatsOverview;
class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            StatsCommandesWidget::class,
               CaisseStatsOverview::class,
                       ClientStatsOverview::class,
            // Ajoutez d'autres widgets ici
        ];
    }
}