<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Utility\Traits\HasAddress;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Company extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasAddress;

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
