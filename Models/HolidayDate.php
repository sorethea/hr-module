<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HolidayDate extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($model){
            $holiday = $model->holiday;
            if($model->half_day){
                $holiday->total_holidays +=0.5;
            }else{
                $holiday->total_holidays +=1;
            }
            $holiday->save();
        });
        static::updated(function ($model){
            $holiday = $model->holiday;
            if($model->half_day){
                $holiday->total_holidays +=0.5;
            }else{
                $holiday->total_holidays +=1;
            }
            $holiday->save();
        });
//        static::updating(function ($model){
//            $holiday = $model->holiday;
//            if($model->half_day){
//                $holiday->total_holidays -=0.5;
//            }else{
//                $holiday->total_holidays -=1;
//            }
//            $holiday->save();
//        });
        static::deleted(function ($model){
            $holiday = $model->holiday;
            if($model->half_day){
                $holiday->total_holidays -=0.5;
            }else{
                $holiday->total_holidays -=1;
            }
            $holiday->save();
        });
    }

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
