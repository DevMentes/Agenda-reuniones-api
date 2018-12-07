<?php

namespace Babilonia\Context\Agenda\Domain\Agenda;

class Weekdays
{
    const MONDAY = 'Monday';
    const TUESDAY = 'Tuesday';
    const WEDNESDAY = 'Wednesday';
    const THURSDAY = 'Thursday';
    const FRIDAY = 'Friday';
    const SATURDAY = 'Saturday';
    const SUNDAY = 'Sunday';

    public static function dayFromDate(string $date):string
    {
        return date('l', strtotime($date));
    }
}
