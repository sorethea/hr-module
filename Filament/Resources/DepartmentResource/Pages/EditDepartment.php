<?php

namespace Modules\HR\Filament\Resources\DepartmentResource\Pages;

use Modules\HR\Filament\Resources\DepartmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDepartment extends EditRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
