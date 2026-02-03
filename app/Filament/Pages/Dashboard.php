<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Order;
use Illuminate\Support\Carbon;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    public ?string $timeRange = 'today';

    public function getStatistics(): array
    {
        $startDate = null;
        $endDate = null;

        match ($this->timeRange) {
            'today' => [
                $startDate = Carbon::today()->startOfDay(),
                $endDate = Carbon::today()->endOfDay(),
            ],
            'week' => [
                $startDate = Carbon::now()->startOfWeek(),
                $endDate = Carbon::now()->endOfWeek()->endOfDay(),
            ],
            'month' => [
                $startDate = Carbon::now()->startOfMonth(),
                $endDate = Carbon::now()->endOfMonth()->endOfDay(),
            ],
            'year' => [
                $startDate = Carbon::now()->startOfYear(),
                $endDate = Carbon::now()->endOfYear()->endOfDay(),
            ],
            default => [
                $startDate = Carbon::today()->startOfDay(),
                $endDate = Carbon::today()->endOfDay(),
            ],
        };

        $query = Order::whereBetween('created_at', [$startDate, $endDate]);

        $totalOrders = (clone $query)->count();
        $manualPayments = (clone $query)->where('status', 'paid')
            ->whereJsonContains('meta->payment_method', 'manual')
            ->sum('total');
        $midtransPayments = (clone $query)->where('status', 'paid')
            ->whereJsonContains('meta->payment_method', 'midtrans')
            ->sum('total');
        $totalRevenue = (clone $query)->where('status', 'paid')->sum('total');

        return [
            'totalOrders' => $totalOrders,
            'manualPayments' => $manualPayments ?? 0,
            'midtransPayments' => $midtransPayments ?? 0,
            'totalRevenue' => $totalRevenue ?? 0,
        ];
    }

    public function getLatestOrders(): array
    {
        return Order::with('product')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->toArray();
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-home';
    }

    public static function getNavigationSort(): ?int
    {
        return 0;
    }

    public static function canAccess(): bool
    {
        return true;
    }
}
