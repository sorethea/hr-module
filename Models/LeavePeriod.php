<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeavePeriod extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\LeavePeriodFactory::new();
    }
}
