<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_holidays',
        'from_date',
        'to_date',
        'properties',
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\HolidayFactory::new();
    }

    public function holidayDates(): HasMany
    {
        return $this->hasMany(HolidayDate::class);
    }
}
