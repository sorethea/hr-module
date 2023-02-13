<?php

namespace Modules\HR\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

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
        "properties",
        "active",
    ];

    protected $casts = [
        "properties" => "encrypted:array"
    ];

    protected static function newFactory()
    {
        return \Modules\HR\Database\factories\EmployeeFactory::new();
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }
}
