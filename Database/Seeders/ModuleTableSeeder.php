<?php

namespace Modules\HR\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\Module;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        \Module::enable("hr");
        $module = Module::firstOrCreate(["name" => "HR"]);
        $module->installed = true;
        $module->save();
    }
}
