<?php

namespace Modules\HR\Providers;

use Closure;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Providers\BaseInstallServiceProvider;
use Modules\HR\Database\Migrations\CreateCompaniesTable;
use Modules\HR\Database\Migrations\CreateEmployeesTable;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSetting;
use Modules\HR\Database\Settings\CreateHRGenderSetting;


class InstallServiceProvider extends BaseInstallServiceProvider
{
    protected $migrations = [
        CreateEmployeesTable::class,
        CreateCompaniesTable::class,
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
