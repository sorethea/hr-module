<?php

namespace Modules\HR\Classes;


use Carbon\CarbonPeriod;
use Modules\HR\Models\HolidayDate;

class Holiday
{
    public static array $isDayOfWeekList = [
        "isSunday" => "Sunday",
        "isMonday" => "Monday",
        "isTuesday" => "Tuesday",
        "isWednesday" => "Wednesday",
        "isThursday" => "Thursday",
        "isFriday" => "Friday",
        "isSaturday" => "Saturday"
    ];

//    public static function getDayOfWeekList(){
//
//        return self::$isDayOfWeekList;
//    }
    public static function generatWeekDayHolidays(Holiday $holiday, bool $isHalfDay,string $isDayOfWeek){
        $fromDate = $holiday->from_date;
        $toDate = $holiday->to_date;
        $dates =CarbonPeriod::between($fromDate,$toDate)->filter($isDayOfWeek);
        foreach ($dates as $date){
            HolidayDate::firstOrCreate([
                'holiday_id' => $holiday->id,
                "name" => self::$isDayOfWeekList[$isDayOfWeek],
                "holiday_date" => $date->format('Y-m-d'),
                "half_day" => $isHalfDay,
            ]);
        }
    }
}
