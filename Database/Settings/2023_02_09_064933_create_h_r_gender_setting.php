<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHRGenderSetting extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('hr.gender',[
            'male'=>'Male',
            'female'=>'Female',
        ]);
    }

    public function down(): void
    {
        $this->migrator->delete('hr.gender');
    }
}
