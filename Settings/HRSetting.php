<?php

namespace Modules\HR\Settings;
use Spatie\LaravelSettings\Settings;

class HRSetting extends Settings
{
    public array $gender = [];
    public array $employment_type =[];
    public array $leave_type=[];

    public static function group(): string
    {
        return 'hr';
    }
}
