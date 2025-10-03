<?php

namespace App\Filament\Widgets;

use App\Models\Facture;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FactureStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalFactures = Facture::count();
        $totalMontantTTC = Facture::sum('montant_ttc');
        $facturesPayees = Facture::where('statut_paiement', 'payé')->count();
        $facturesImpayees = Facture::where('statut_paiement', 'impayé')->count();

        $tauxPaiement = $totalFactures > 0 ? round(($facturesPayees / $totalFactures) * 100, 1) : 0;

        return [
            Stat::make('Total des factures', $totalFactures)
                ->description('Nombre total de factures')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart($this->getFacturesChartData()),

            Stat::make('Chiffre d\'affaires', number_format($totalMontantTTC, 0, ',', ' ') . ' F CFA')
                ->description('Montant total TTC')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Factures payées', $facturesPayees)
                ->description($tauxPaiement . '% du total')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Factures impayées', $facturesImpayees)
                ->description(($totalFactures > 0 ? round(($facturesImpayees / $totalFactures) * 100, 1) : 0) . '% du total')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('danger'),
        ];
    }

    protected function getFacturesChartData(): array
    {
        return [5, 8, 12, 10, 15, 18, 20];
    }
}