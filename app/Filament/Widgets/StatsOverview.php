<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\ServiceOrder;
use App\Models\Testimonial;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class StatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        $customerQuery = User::query()->hasRole(UserRole::CUSTOMER->value)->select(['id']);
        $orderQuery = ServiceOrder::query()->select(['id']);
        $testimonialQuery = Testimonial::query()->select(['id']);

        $orderStats = $this->getStatsData($orderQuery);
        $customerStats = $this->getStatsData($customerQuery);
        $testimonialStats = $this->getStatsData($testimonialQuery);

        return [
            Stat::make(__('label.widget.customer.total'), number_format($customerStats['total']))
                ->description($customerStats['description'])
                ->descriptionIcon($customerStats['descriptionIcon'])
                ->chart($customerStats['chart'])
                ->color($customerStats['color']),
            Stat::make(__('label.widget.order.total'), number_format($orderStats['total']))
                ->description($orderStats['description'])
                ->descriptionIcon($orderStats['descriptionIcon'])
                ->chart($orderStats['chart'])
                ->color($orderStats['color']),
            Stat::make(__('label.widget.testimonial.total'), number_format($testimonialStats['total']))
                ->description($testimonialStats['description'])
                ->descriptionIcon($testimonialStats['descriptionIcon'])
                ->chart($testimonialStats['chart'])
                ->color($testimonialStats['color']),
        ];
    }

    private function getStatsData(Builder $query): array
    {
        // 1. Total model selama semua waktu
        $total = (clone $query)->count();

        // 2. Hitung tren: minggu ini vs minggu lalu
        $startOfThisWeek = now()->startOfWeek();
        $endOfThisWeek = now()->endOfWeek();
        $startOfLastWeek = now()->subWeek()->startOfWeek();
        $endOfLastWeek = now()->subWeek()->endOfWeek();

        $countThisWeek = (clone $query)->whereBetween('created_at', [$startOfThisWeek, $endOfThisWeek])
            ->count();
        $countLastWeek = (clone $query)->whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])
            ->count();

        $diff = $countThisWeek - $countLastWeek;
        $base    = max(1, $countLastWeek);
        $percent = round(($diff / $base) * 100);

        if ($diff > 0) {
            $description     = __('label.widget.increase') . $diff . " ({$percent}%)" . __('label.widget.weekly');
            $descriptionIcon = 'heroicon-m-arrow-trending-up';
            $color           = 'success';
        } elseif ($diff < 0) {
            $description     = __('label.widget.decrease') . abs($diff) . " ({$percent}%)" . __('label.widget.weekly');
            $descriptionIcon = 'heroicon-m-arrow-trending-down';
            $color           = 'danger';
        } else {
            // kasus netral: diff == 0
            $description     = __('label.widget.neutral');
            $descriptionIcon = 'heroicon-m-minus';
            $color           = 'warning';
        }

        // 3. Array 7 hari terakhir untuk chart
        $chartData = collect(range(6, 0))
            ->map(fn (int $daysAgo) => (clone $query)
                ->whereDate('created_at', today()->subDays($daysAgo))
                ->count()
            )
            ->toArray();

        return [
            'total'           => $total,
            'description'     => $description,
            'descriptionIcon' => $descriptionIcon,
            'color'           => $color,
            'chart'           => $chartData,
        ];
    }
}
