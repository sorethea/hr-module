<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHRSetting extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("hr.gender",[
            "male"=>"Male",
            "female"=>"Female"
        ]);
        $this->migrator->add("hr.employee_type",[
            "contract"=>"Contract",
            "full-time"=>"Full Time",
            "part-time"=>"Part Time",
            ]);
    }
}
