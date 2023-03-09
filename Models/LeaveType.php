<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeaveType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'max_allocation_allowed',
        'max_consecutive_allowed',
        'carry_forward',
        'without_pay',
        'allow_encashment',
        'earned_leave',
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\LeaveTypeFactory::new();
    }
}
