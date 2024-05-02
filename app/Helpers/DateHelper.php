<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    // Helper pour formater la date de la représentation en fonction de la date actuelle (aujourd'hui, hier, demain, date)
    public static function formatScheduleDate($schedule, $format = 'd/m H:i')
    {
        $scheduleDate = Carbon::parse($schedule);

        return match(true) {
            $scheduleDate->isToday() => 'Aujourd\'hui ' . $scheduleDate->format('H:i'),
            $scheduleDate->isYesterday() => 'Hier ' . $scheduleDate->format('H:i'),
            $scheduleDate->isTomorrow() => 'Demain ' . $scheduleDate->format('H:i'),
            default => $scheduleDate->format($format),
        };
    }

    public static function formatScheduleTime($schedule)
    {
        $scheduleTime = Carbon::parse($schedule);

        return $scheduleTime->format('H:i');
    }

    public static function formatScheduleDateTime($schedule)
    {
        $scheduleDateTime = Carbon::parse($schedule);

        return $scheduleDateTime->format('d/m H:i');
    }

    public static function formatScheduleDay($schedule)
    {
        $scheduleDay = Carbon::parse($schedule);

        return $scheduleDay->format('l');
    }

    public static function formatScheduleMonth($schedule)
    {
        $scheduleMonth = Carbon::parse($schedule);

        return $scheduleMonth->format('F');
    }

    public static function formatScheduleYear($schedule)
    {
        $scheduleYear = Carbon::parse($schedule);

        return $scheduleYear->format('Y');
    }

    public static function formatScheduleFull($schedule)
    {
        $scheduleFull = Carbon::parse($schedule);

        return $scheduleFull->format('l d F Y H:i');
    }

    public static function formatScheduleShort($schedule)
    {
        $scheduleShort = Carbon::parse($schedule);

        return $scheduleShort->format('d/m H:i');
    }

}
