<?php

namespace Modules\HR\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\PluginServiceProvider;
use Modules\HR\Filament\Resources\CompanyResource;
use Modules\HR\Filament\Resources\EmployeeResource;
use Spatie\LaravelPackageTools\Package;
use Modules\HR\Filament\Pages\HRPage;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function isEnabled(): bool{
        $module = \Module::find('hr');
        return $module->isEnabled();
    }
    protected array $pages = [];
    protected array $resources =[
        CompanyResource::class,
        EmployeeResource::class,
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
