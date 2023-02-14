<?php

namespace Modules\HR\Providers;

use Modules\Core\Providers\BaseUninstallServiceProvider;
use Modules\HR\Database\Migrations\CreateCompaniesTable;
use Modules\HR\Database\Migrations\CreateEmployeesTable;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSetting;
use Modules\HR\Database\Settings\CreateHRGenderSetting;

class UninstallServiceProvider extends BaseUninstallServiceProvider
{
    protected $migrations = [
        CreateEmployeesTable::class,
        CreateCompaniesTable::class,
        CreateHRGenderSetting::class,
        CreateHREmploymentTypeSetting::class,
    ];
    public function uninstall()
    {

        $seed =new HRDatabaseSeeder();
        $seed->rollback();
        $this->dropSchema();
    }
}
