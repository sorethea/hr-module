<?php

namespace Modules\HR\Filament\Resources\HolidayResource\Pages;

use Modules\HR\Filament\Resources\HolidayResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHoliday extends EditRecord
{
    protected static string $resource = HolidayResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
