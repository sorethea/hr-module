<?php

namespace Modules\HR\Filament\Resources\DesignationResource\Pages;

use Modules\HR\Filament\Resources\DesignationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesignations extends ListRecords
{
    protected static string $resource = DesignationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
