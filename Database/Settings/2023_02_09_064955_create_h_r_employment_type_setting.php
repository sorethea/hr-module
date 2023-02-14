<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHREmploymentTypeSetting extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('hr.employment_type',[
            'contract'=>'Contract',
            'full-time'=>'Full Time',
            'part-time'=>'Part Time',
        ]);
    }

    public function down(): void
    {
        $this->migrator->delete('hr.employment_type');
    }
}
