<?php

namespace Modules\HR\Filament\Pages;

use Filament\Pages\SettingsPage;
use Modules\HR\Settings\HRSetting;

class HRSettingPage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = HRSetting::class;

    protected function getFormSchema(): array
    {
        return [
            // ...
        ];
    }
}
