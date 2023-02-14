<?php

namespace Modules\HR\Providers;

use Closure;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Providers\BaseInstallServiceProvider;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;

class InstallServiceProvider extends BaseInstallServiceProvider
{
    public function boot()
    {
        \Artisan::call("module:migrate HR");
        $seed =new HRDatabaseSeeder();
        $seed->run();
        parent::boot();
    }
}
