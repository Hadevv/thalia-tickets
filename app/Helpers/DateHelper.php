<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    // Helper pour formater la date de la représentation en fonction de la date actuelle (aujourd'hui, hier, demain, date)
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
