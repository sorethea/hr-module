<?php

namespace Modules\HR\Providers;

use Closure;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Providers\BaseInstallServiceProvider;
use Modules\HR\Database\Migrations\CreateCompanyTable;
use Modules\HR\Database\Migrations\CreateEmployeeTable;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSetting;
use Modules\HR\Database\Settings\CreateHRGenderSetting;
use Modules\HR\Filament\Resources\EmployeeResource\Pages\CreateEmployee;

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
