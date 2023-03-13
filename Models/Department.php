<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\DepartmentFactory::new();
    }

    public function parent(): BelongsTo{
        return $this->belongsTo(self::class,'parent_id','id');
    }
}
