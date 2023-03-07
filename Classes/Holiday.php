<?php

namespace Modules\HR\Classes;


use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Modules\HR\Models\HolidayDate;

class Holiday
{
    /**
     * @var array|string[]
     */
    private static array $isDayOfWeekList = [
        "isSunday" => "Sunday",
        "isMonday" => "Monday",
        "isTuesday" => "Tuesday",
        "isWednesday" => "Wednesday",
        "isThursday" => "Thursday",
        "isFriday" => "Friday",
        "isSaturday" => "Saturday"
    ];

    public static function getDayOfWeekList(): array
    {
        return self::$isDayOfWeekList;
    }
    public static function generateWeekDayHolidays(Model $holiday, bool $isHalfDay,string $isDayOfWeek): void
    {
        $fromDate = $holiday->from_date;
        $toDate = $holiday->to_date;
        $dates =CarbonPeriod::between($fromDate,$toDate)->filter($isDayOfWeek);
        foreach ($dates as $date){
            HolidayDate::firstOrCreate([
                'holiday_id' => $holiday->id,
                "name" => self::getDayOfWeekList()[$isDayOfWeek],
                "holiday_date" => $date->format('Y-m-d'),
                "half_day" => $isHalfDay,
            ]);
        }
    }
}
