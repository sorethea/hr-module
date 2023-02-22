<?php
namespace Modules\HR\Database\Settings;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHREmploymentTypeSettings extends SettingsMigration
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
