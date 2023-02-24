<?php

namespace Modules\HR\Providers;

use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSettings;
use Modules\HR\Database\Settings\CreateHRGenderSettings;
use Modules\HR\Database\Settings\CreateHRLeaveTypeSettings;
use Modules\LAM\Providers\BaseUninstallServiceProvider;

class UninstallServiceProvider extends BaseUninstallServiceProvider
{
    private array $settings = [
        CreateHREmploymentTypeSettings::class,
        CreateHRGenderSettings::class,
        CreateHRLeaveTypeSettings::class,
    ];

    public function uninstall()
    {
        $seed =new HRDatabaseSeeder();
        $seed?->rollback();

        foreach ($this->settings as $setting){
            $settingObj = new $setting();
            $settingObj?->down();
        }
    }
}
