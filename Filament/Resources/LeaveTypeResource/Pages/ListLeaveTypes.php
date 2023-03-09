<?php

namespace Modules\HR\Filament\Resources\LeaveTypeResource\Pages;

use Modules\HR\Filament\Resources\LeaveTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaveTypes extends ListRecords
{
    protected static string $resource = LeaveTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
