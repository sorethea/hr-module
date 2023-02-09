<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHRSetting extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("hr.gender",["male"=>"Male","female"=>"Female"]);

    }
}
