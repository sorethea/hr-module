<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description"
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\DesignationFactory::new();
    }
}
