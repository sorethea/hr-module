<?php
namespace Modules\HR\Database\Settings;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateHRLeaveTypeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('hr.leave_type',[
            'sick-leave'=>'Sick Leave',
            'emergency-leave'=>'Emergency Leave',
        ]);
    }

    public function down(): void
    {
        $this->migrator->delete('hr.leave_type');
    }
}
