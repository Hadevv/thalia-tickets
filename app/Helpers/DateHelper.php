<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function formatScheduleDate($schedule)
    {
        $scheduleDate = Carbon::parse($schedule);

        return match(true) {
            $scheduleDate->isToday() => 'Aujourd\'hui',
            $scheduleDate->isYesterday() => 'Hier',
            $scheduleDate->isTomorrow() => 'Demain',
            default => $scheduleDate->format('d/m'),
        };
    }
}
