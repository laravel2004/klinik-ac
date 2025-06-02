<?php

namespace App\Services;

use App\Models\ServiceOrder;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ReservationService
{
    public function getAvailableTimesForDate(string $date): array
    {
        $date                  = Carbon::parse($date);

        // Hari Minggu tidak tersedia
        if ($date->isSunday()) {
            return [];
        }

        $startPeriod           = $date->copy()->hour(8);
        $endPeriod             = $date->copy()->hour(17);
        $times                 = CarbonPeriod::create($startPeriod, '1 hour', $endPeriod);
        $availableReservations = [];

        $reservations = ServiceOrder::whereDate('start_time', $date)
            ->pluck('start_time')
            ->toArray();

        $availableTimes = $times->filter(function ($time) use ($reservations) {
            return ! in_array($time, $reservations);
        })->toArray();

        foreach ($availableTimes as $time) {
            $key                         = $time->format('H');
            $availableReservations[$key] = $time->format('H:i');
        }

        return $availableReservations;
    }
}
