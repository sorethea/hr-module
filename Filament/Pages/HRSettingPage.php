<?php

namespace Modules\HR\Filament\Pages;

use Filament\Forms\Components\Card;
use Filament\Forms\Components\KeyValue;
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

    protected static function getNavigationLabel(): string
    {
        return config('hr.setting.label');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.navigation.name');
    }

    protected static string $settings = HRSetting::class;

    protected function getFormSchema(): array
    {
        return [
            Card::make([
                KeyValue::make("hr.gender"),
            ])
        ];
    }
}
