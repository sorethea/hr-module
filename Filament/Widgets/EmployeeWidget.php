<?php

namespace Modules\HR\Filament\Widgets;

use Filament\Widgets\Widget;

class EmployeeWidget extends Widget
{
    protected static ?int $sort = -2;
    protected static string $view = 'filament.widgets.employee-widget';
}
