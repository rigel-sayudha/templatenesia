<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

use App\Models\Order;
use Carbon\Carbon;

class MonthlySalesChart extends ChartWidget
{
    protected ?string $heading = 'Total Penjualan Bulanan';
    protected static ?int $sort = -1;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            
            $totalSales = Order::whereIn('status', ['processing', 'completed'])
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total');

            $data[] = $totalSales;
            $labels[] = $month->translatedFormat('M Y');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan Kotor (Rp)',
                    'data' => $data,
                    'backgroundColor' => 'rgba(139, 92, 246, 0.2)',
                    'borderColor' => '#8b5cf6',
                    'fill' => true,
                    'pointBackgroundColor' => '#fff',
                    'pointBorderColor' => '#8b5cf6',
                    'pointRadius' => 4,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'elements' => [
                'line' => [
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
