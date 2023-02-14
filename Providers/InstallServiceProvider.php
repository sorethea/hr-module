<?php

namespace Modules\HR\Providers;

use Closure;
use CreateCompanyTable;
use CreateEmployeeTable;
use CreateHREmploymentTypeSetting;
use CreateHRGenderSetting;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Providers\BaseInstallServiceProvider;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;


class InstallServiceProvider extends BaseInstallServiceProvider
{
    protected $migrations = [
        CreateEmployeeTable::class,
        CreateCompanyTable::class,
        CreateHRGenderSetting::class,
        CreateHREmploymentTypeSetting::class,
    ];
    public function install()
    {
        $this->migrate();
        $seed =new HRDatabaseSeeder();
        $seed->run();
    }
}
