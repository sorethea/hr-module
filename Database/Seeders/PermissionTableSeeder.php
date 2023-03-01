<?php

namespace Modules\HR\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\HR\Models\Company;
use Modules\HR\Models\Employee;
use Modules\LAM\Models\User;
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


        $employee = Role::findOrCreate("employee");
        $admin = Role::findByName("admin");
        $module = "hr";
        $models =[
            "hrs",
            "employees",
            "companies",
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
                        $admin->givePermissionTo($permission);
                    }
                }
            }
        }
        $user = User::firstOrCreate([
            "name"=>"Employee",
            "email"=>"employee@demo.com",
            "password"=>Hash::make("12345678"),
        ]);
        $user->assignRole($employee);
        $company = Company::firstOrCreate([
            "name"=>"Demo",
            "abbr"=>"DEMO",
        ]);
        Employee::firstOrCreate([
            "first_name"=>"Employee",
            "last_name"=>"Demo",
            "gender"=>"male",
            "is_system_user"=>true,
            "date_of_birth"=>"2000-01-01",
            "date_of_joining"=>"2020-01-01",
            "company_id"=>$company->id,
            "user_id"=>$user->id,
            "properties"=>[
                "email"=>"employee@demo.com",
                "password"=>"12345678"
            ]
        ]);
    }

    public function rollback(){
        try{
            $user = User::where("email","employee@demo.com")->first();
            if(!empty($user)){
                $user->removeRole("employee");
                $user->delete();
            }
            $role = Role::where("name","employee")->first();
            if(!empty($role)){
                $role->permissions()->detach();
                $role->delete();
            }
            Permission::where("module","hr")->delete();
        }catch (\Throwable $exception){
            info($exception->getMessage());
        }

    }
}
