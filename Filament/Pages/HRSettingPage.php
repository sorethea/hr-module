<?php

namespace Modules\HR\Filament\Pages;

use Filament\Pages\SettingsPage;
use Modules\HR\Settings\HRSetting;

class HRSettingPage extends SettingsPage
{
    protected function getTitle(): string
    {
        return config('hr.setting.label');
    }

    protected static function getNavigationIcon(): string
    {
        return config('hr.setting.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.navigation.name');
    }

    protected static string $settings = HRSetting::class;

    protected function getFormSchema(): array
    {
        return [
            // ...
        ];
    }
}
