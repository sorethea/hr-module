<?php

namespace Modules\HR\Providers;

use Closure;


use Modules\HR\Database\Migrations\CreateCompaniesTable;
use Modules\HR\Database\Migrations\CreateEmployeesTable;
use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSetting;
use Modules\HR\Database\Settings\CreateHRGenderSetting;
use Modules\LAM\Providers\BaseInstallServiceProvider;


class InstallServiceProvider extends BaseInstallServiceProvider
{

    public function install()
    {
        $seed =new HRDatabaseSeeder();
        $seed->run();
    }
}
