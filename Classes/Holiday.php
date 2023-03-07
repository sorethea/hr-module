<?php

namespace Modules\HR\Classes;


use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Modules\HR\Models\HolidayDate;

class Holiday
{
    /**
     * @var array|string[]
     */
    private static array $isDayOfWeekList = [
        "Sunday" => "Sunday",
        "Monday" => "Monday",
        "Tuesday" => "Tuesday",
        "Wednesday" => "Wednesday",
        "Thursday" => "Thursday",
        "Friday" => "Friday",
        "Saturday" => "Saturday"
    ];

    public static function getDayOfWeekList(): array
    {
        return self::$isDayOfWeekList;
    }
    public static function generateWeekDayHolidays(Model $holiday, bool $isHalfDay, string $dayOfWeek): void
    {
        $fromDate = $holiday->from_date;
        $toDate = $holiday->to_date;
        $dates =CarbonPeriod::between($fromDate,$toDate)->filter(function (Carbon $date, string $dayOfWeek){
            info($dayOfWeek);
            return match ($dayOfWeek) {
                "Monday" => $date->isMonday(),
                "Tuesday" => $date->isTuesday(),
                "Wednesday" => $date->isWednesday(),
                "Thursday" => $date->isThursday(),
                "Friday" => $date->isFriday(),
                "Saturday" => $date->isSaturday(),
                "Sunday" => $date->isSunday(),
            };
        });
        foreach ($dates as $date){
            HolidayDate::firstOrCreate([
                'holiday_id' => $holiday->id,
                "name" => $dayOfWeek,
                "holiday_date" => $date->format('Y-m-d'),
                "half_day" => $isHalfDay,
            ]);
        }
    }
}
