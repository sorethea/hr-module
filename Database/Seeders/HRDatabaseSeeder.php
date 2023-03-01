<?php

namespace Modules\HR\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HRDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(PermissionTableSeeder::class);
    }
    public function rollback()
    {
        $permissionTableSeeder = new PermissionTableSeeder();
        $permissionTableSeeder->rollback();
        info("uninstall HR module");
    }
}
