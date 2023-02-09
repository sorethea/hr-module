<?php

namespace Modules\HR\Settings;
use Spatie\LaravelSettings\Settings;

class HRSetting extends Settings
{

    public static function group(): string
    {
        return 'hr';
    }
}
