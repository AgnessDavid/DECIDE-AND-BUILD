<?php

namespace App\Filament\Widgets;

use App\Models\CommandeOnline;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class CommandeRevenueChart extends ChartWidget
{
    protected  ?string $heading = 'Évolution du Chiffre d\'Affaire';

    protected function getData(): array
    {
        $data = $this->getRevenueData();

        return [
            'datasets' => [
                [
                    'label' => 'Chiffre d\'affaire (FCFA)',
                    'data' => $data['values'],
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $data['labels'],
        ];
    }

    protected function getRevenueData(): array
    {
        $revenues = CommandeOnline::select(
            DB::raw('MONTH(date_commande) as month'),
            DB::raw('YEAR(date_commande) as year'),
            DB::raw('SUM(total_ttc) as total')
        )
            ->whereYear('date_commande', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Créer un tableau pour tous les mois de l'année
        $monthlyData = array_fill(1, 12, 0);
        $monthLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($revenues as $revenue) {
            $monthlyData[$revenue->month] = $revenue->total;
        }

        return [
            'values' => array_values($monthlyData),
            'labels' => $monthLabels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}