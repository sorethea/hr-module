<?php

namespace Modules\HR\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\PluginServiceProvider;
use Modules\HR\Filament\Pages\HRSettingPage;
use Modules\HR\Filament\Resources\CompanyResource;
use Modules\HR\Filament\Resources\DepartmentResource;
use Modules\HR\Filament\Resources\DesignationResource;
use Modules\HR\Filament\Resources\EmployeeResource;
use Modules\HR\Filament\Resources\HolidayResource;
use Modules\HR\Filament\Resources\LeaveTypeResource;
use Modules\HR\Filament\Widgets\EmployeeWidget;
use Modules\HR\Filament\Widgets\HRWidget;
use Modules\HR\Filament\Widgets\LeaveWidget;
use Spatie\LaravelPackageTools\Package;
use Modules\HR\Filament\Pages\HRPage;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function isEnabled(): bool{
        $module = \Module::find('hr');
        info($module->isEnabled());
        if(!empty($module)){
            return $module?->isEnabled();
        }else{
            return false;
        }
    }
    protected array $pages = [
        HRSettingPage::class,
    ];
    protected array $resources =[
        CompanyResource::class,
        EmployeeResource::class,
        DepartmentResource::class,
        DesignationResource::class,
        HolidayResource::class,
        LeaveTypeResource::class,
    ];
    protected array $widgets =[
        EmployeeWidget::class,
        LeaveWidget::class,
        HRWidget::class,
    ];
    public function configurePackage(Package $package): void
    {
        $package->name('hr');
    }

    public function getResources(): array
    {
        return ($this->isEnabled())?$this->resources:[];
    }

    public function getPages(): array
    {
        return ($this->isEnabled())?$this->pages:[];
    }

    public function boot()
    {
        Filament::serving(function (){
            if(config('hr.navigation.enabled'))
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label(config('hr.navigation.name'))
            ]);
        });
        return parent::boot();
    }
}
