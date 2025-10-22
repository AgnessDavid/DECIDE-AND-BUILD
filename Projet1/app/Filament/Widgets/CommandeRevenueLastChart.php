<?php

namespace App\Filament\Widgets;

use App\Models\CommandeOnline;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Collection;

class CommandeRevenueLastChart extends ChartWidget
{
    protected ?string $heading = 'Chiffre d\'Affaire Mensuel';

    protected function getData(): array
    {
        $data = $this->getMonthlyRevenue();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue (FCFA)',
                    'data' => $data->pluck('total')->toArray(),
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getMonthlyRevenue(): Collection
    {
        return CommandeOnline::query()
            ->selectRaw('
                DATE_FORMAT(date_commande, "%Y-%m") as period,
                MONTHNAME(date_commande) as month, 
                SUM(total_ttc) as total
            ')
            ->where('date_commande', '>=', now()->subMonths(6))
            ->groupBy('period', 'month')
            ->orderBy('period')
            ->get()
            ->map(function ($item) {
                // Formater le nom du mois en français
                $item->month = $this->formatFrenchMonth($item->month);
                return $item;
            });
    }

    protected function formatFrenchMonth(string $month): string
    {
        $months = [
            'January' => 'Jan',
            'February' => 'Fév',
            'March' => 'Mar',
            'April' => 'Avr',
            'May' => 'Mai',
            'June' => 'Juin',
            'July' => 'Juil',
            'August' => 'Août',
            'September' => 'Sep',
            'October' => 'Oct',
            'November' => 'Nov',
            'December' => 'Déc'
        ];

        return $months[$month] ?? $month;
    }

    protected function getType(): string
    {
        return 'bar';
    }
}