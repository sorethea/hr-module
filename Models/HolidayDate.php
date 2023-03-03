<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HolidayDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'holiday_id',
        'holiday_date',
        'half_day',
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\HolidayDateFactory::new();
    }

    public function holiday(): BelongsTo
    {
        return $this->belongsTo(Holiday::class);
    }
}
