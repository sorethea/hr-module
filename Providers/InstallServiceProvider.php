<?php

namespace Modules\HR\Providers;


use Modules\HR\Database\Seeders\HRDatabaseSeeder;
use Modules\HR\Database\Settings\CreateHREmploymentTypeSettings;
use Modules\HR\Database\Settings\CreateHRGenderSettings;
use Modules\LAM\Providers\BaseInstallServiceProvider;


class InstallServiceProvider extends BaseInstallServiceProvider
{
    private array $settings = [
        CreateHREmploymentTypeSettings::class,
        CreateHRGenderSettings::class,
    ];

    public function install()
    {
        $seed =new HRDatabaseSeeder();
        $seed?->run();

        foreach ($this->settings as $setting){
            $settingObj = new $setting();
            $settingObj?->up();
        }
    }
}
