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
            try {
                \DB::beginTransaction();
                $holiday = $model->holiday;
                if($model->half_day){
                    $holiday->total_holidays +=0.5;
                }else{
                    $holiday->total_holidays +=1;
                }
                $holiday->save();
                \DB::commit();
            }catch (\Throwable $exception){
                \DB::rollBack();
            }

        });
        static::updated(function ($model){
            try {
                \DB::beginTransaction();
                $holiday = $model->holiday;
                if($model->half_day){
                    $holiday->total_holidays +=0.5;
                }else{
                    $holiday->total_holidays +=1;
                }
                $holiday->save();
                \DB::commit();
            }catch (\Throwable $exception){
                \DB::rollBack();
            }

        });
        static::updating(function ($model){
            try {
                \DB::beginTransaction();
                $old = self::find($model->id);
                $holiday = $model->holiday;
                if($old->half_day){
                    $holiday->total_holidays -=0.5;
                }else{
                    $holiday->total_holidays -=1;
                }
                $holiday->save();
                \DB::commit();
            }catch (\Throwable $exception){
                \DB::rollBack();
            }

        });
        static::deleted(function ($model){
            try {
                \DB::beginTransaction();
                $holiday = $model->holiday;
                if($model->half_day){
                    $holiday->total_holidays -=0.5;
                }else{
                    $holiday->total_holidays -=1;
                }
                $holiday->save();
                \DB::commit();
            }catch (\Throwable $exception){
                \DB::rollBack();
            }

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
