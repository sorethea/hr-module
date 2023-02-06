<?php

namespace Modules\HR\Filament\Resources\EmployeeResource\Pages;

use Modules\HR\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
}
