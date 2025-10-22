<?php

namespace App\Filament\Widgets;

use App\Models\CaisseOnline;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CaisseOnlineStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalOnline = CaisseOnline::sum('online_id');
        $totalMontant_ttc = CaisseOnline::sum('montant_ttc');
        $soldeActuel = $totalMontant_ttc;
        $totalTransactions = CaisseOnline::count();

        return [
            Stat::make('Solde Actuel', number_format($soldeActuel, 2, ',', ' ') . ' FCFA')
                ->description('Solde de la caisse en ligne')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($soldeActuel >= 0 ? 'success' : 'danger'),


            Stat::make('Comandes en ligne', $totalOnline)
                ->description('Nombre total de comandes en ligne')
                ->descriptionIcon('heroicon-m-document-chart-bar')
                ->color('primary'),

            Stat::make('Transactions', $totalTransactions)
                ->description('Nombre total d\'opérations')
                ->descriptionIcon('heroicon-m-document-chart-bar')
                ->color('primary'),
        ];
    }
}