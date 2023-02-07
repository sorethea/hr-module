<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "abbr",
        "domain",
        "description",
        "is_group",
        "parent_id",
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\CompanyFactory::new();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class,'parent_id');
    }
}
