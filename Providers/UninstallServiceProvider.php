<?php

namespace Modules\HR\Providers;

use Modules\HR\Database\Migrations\CreateCompaniesTable;
use Modules\HR\Database\Migrations\CreateEmployeesTable;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSetting;
use Modules\HR\Database\Settings\CreateHRGenderSetting;
use Modules\LAM\Providers\BaseUninstallServiceProvider;

class UninstallServiceProvider extends BaseUninstallServiceProvider
{

    public function uninstall()
    {
        $seed =new HRDatabaseSeeder();
        $seed->rollback();
    }
}
