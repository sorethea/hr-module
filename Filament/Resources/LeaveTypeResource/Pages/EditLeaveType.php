<?php

namespace Modules\HR\Filament\Resources\LeaveTypeResource\Pages;

use Modules\HR\Filament\Resources\LeaveTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeaveType extends EditRecord
{
    protected static string $resource = LeaveTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
