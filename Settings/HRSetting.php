<?php

namespace Modules\HR\Settings;
use Spatie\LaravelSettings\Settings;

class HRSetting extends Settings
{
    public array $gender = [];

    public static function group(): string
    {
        return 'hr';
    }
}
