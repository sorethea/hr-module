<?php

namespace Modules\HR\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

//    protected static function booted()
//    {
//        static::saved(function ($model){
//            if(!empty($model->properties)){
//                $email = $model->properties['email']??'';
//                $password = $model->properties['password']??'';
//                if(!empty($email) && !empty($password) && empty($model->user_id)){
//                    $user = User::where("email",$email)->firstOrNew([
//                        "name" => $model->first_name." ".$model->last_name,
//                        "email" => $email,
//                        "password" => \Hash::make($password),
//                    ]);
//                    $model->user_id = $user->id;
//                    $model->save();
//                }
//            }
//        });
//    }

    protected $fillable = [
        "company_id",
        "user_id",
        "first_name",
        "last_name",
        "gender",
        "employment_type",
        "is_system_user",
        "date_of_birth",
        "date_of_joining",
        "work_experiences",
        "educations",
        "contact_details",
        "properties",
        "active",
    ];

    protected $casts = [
        "contact_details" => "json",
        "educations" => "json",
        "work_experiences" => "json",
        "properties" => "encrypted:json",
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\EmployeeFactory::new();
    }

    public function user(): BelongsTo{
        return $this->belongsTo(\Modules\LAM\Models\User::class);
    }

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }
    public function designation(): BelongsTo{
        return $this->belongsTo(Designation::class);
    }
    public function department(): BelongsTo{
        return $this->belongsTo(Department::class);
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }
}
