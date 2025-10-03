<?php

namespace App\Filament\Widgets;

use App\Models\SessionCaisse;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SessionCaisseStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $sessionsOuvertes = SessionCaisse::where('statut', 'ouvert')->count();
        $sessionsFermees = SessionCaisse::where('statut', 'fermé')->count();
        $totalSessions = SessionCaisse::count();

        $totalEntrees = SessionCaisse::sum('entrees');
        $totalSorties = SessionCaisse::sum('sorties');
        $soldeGlobal = $totalEntrees - $totalSorties;

        return [
            Stat::make('Sessions ouvertes', $sessionsOuvertes)
                ->description('Sessions en cours')
                ->descriptionIcon('heroicon-m-play-circle')
                ->color('success')
                ->chart($this->getSessionsChartData()),

            Stat::make('Sessions fermées', $sessionsFermees)
                ->description('Sessions terminées')
                ->descriptionIcon('heroicon-m-stop-circle')
                ->color('gray'),

            Stat::make('Total sessions', $totalSessions)
                ->description('Toutes les sessions')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Solde global', number_format($soldeGlobal, 0, ',', ' ') . ' F CFA')
                ->description('Entrées: ' . number_format($totalEntrees, 0, ',', ' ') . ' | Sorties: ' . number_format($totalSorties, 0, ',', ' '))
                ->descriptionIcon('heroicon-m-scale')
                ->color($soldeGlobal >= 0 ? 'success' : 'danger'),
        ];
    }

    protected function getSessionsChartData(): array
    {
        return [2, 3, 5, 4, 6, 7, 8];
    }
}