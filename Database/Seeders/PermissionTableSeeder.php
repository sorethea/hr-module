<?php

namespace Modules\HR\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Modules\HR\Models\Company;
use Modules\HR\Models\Employee;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $role = Role::findOrCreate("Employee");
        $module = "hr";
        $models =[
            "employee",
            "company",
        ];
        foreach ($models as $model){
            $levels = [
                'viewAny',
                'view',
                'create',
                'update',
                'delete',
                'forceDelete',
                'manager',
            ];
            foreach ($levels as $level){
                $permission = Permission::findOrCreate($model.'.'.$level);
                if(!empty($permission)){
                    $permission->module = $module;
                    $permission->save();
                    if($level=="manager"){
                        $role->givePermissionTo($permission);
                    }
                }
            }
        }
        $user = User::create([
            "name"=>"Employee",
            "email"=>"employee@demo.com",
            "password"=>Hash::make("12345678"),
        ]);
        $user->assignRole($role);
        $company = Company::created([
            "name"=>"Demo",
            "abbr"=>"DEMO",
        ]);
        Employee::create([
            "first_name"=>"Employee",
            "last_name"=>"Demo",
            "company_id"=>$company->id,
            "user_id"=>$user->id,
            "properties"=>[
                "email"=>"employee@demo.com",
                "password"=>"12345678"
            ]
        ]);
    }
}
