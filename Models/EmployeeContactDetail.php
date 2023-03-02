<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeContactDetail extends Model
{
    use HasFactory;

    protected $table = "employee_contact_details";

    protected $fillable = [
        'employee_id',
        'mobile_number',
        'personal_email',
        'company_email',
        'permanent_address',
        'current_address',
        'properties',
        'is_default',
        'active',
    ];
    protected $casts = [
        'employee_id'=>'int',
        'mobile_number'=>'string',
        'personal_email'=>'string',
        'company_email'=>'string',
        'permanent_address'=>'string',
        'current_address'=>'string',
        'properties'=>'json',
        'is_default'=>'boolean',
        'active'=>'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\EmployeeContactDetailFactory::new();
    }
}
