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
    private $settings = [
        CreateHREmploymentTypeSetting::class,
        CreateHRGenderSetting::class,
    ];

    public function uninstall()
    {
        $seed =new HRDatabaseSeeder();
        $seed->rollback();

        foreach ($this->settings as $setting){
            $settingObj = new $setting();
            $settingObj->down();
        }
    }
}
