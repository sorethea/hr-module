<?php

namespace Modules\HR\Providers;


use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSetting;
use Modules\HR\Database\Settings\CreateHRGenderSetting;
use Modules\LAM\Providers\BaseInstallServiceProvider;


class InstallServiceProvider extends BaseInstallServiceProvider
{
    private $settings = [
        CreateHREmploymentTypeSetting::class,
        CreateHRGenderSetting::class,
    ];

    public function install()
    {
        $seed =new HRDatabaseSeeder();
        $seed->run();

        foreach ($this->settings as $setting){
            $settingObj = new $setting();
            $settingObj->up();
        }
    }
}
