<?php

namespace Modules\HR\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\HR\Models\Company;
use Modules\HR\Models\Department;
use Modules\HR\Models\Designation;
use Modules\HR\Models\Employee;
use Modules\HR\Models\LeaveType;
use Modules\HR\Policies\CompanyPolicy;
use Modules\HR\Policies\DepartmentPolicy;
use Modules\HR\Policies\DesignationPolicy;
use Modules\HR\Policies\EmployeePolicy;
use Modules\HR\Policies\HRPolicy;
use Modules\HR\Policies\LeaveTypePolicy;
use Modules\HR\Settings\HRSetting;
use Spatie\LaravelSettings\Settings;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies =[
        LeaveType::class => HRPolicy::class,
        Company::class => CompanyPolicy::class,
        Employee::class => EmployeePolicy::class,
        Department::class => HRPolicy::class,
        Designation::class => HRPolicy::class,
        HRSetting::class => HRPolicy::class,

    ];
    public function register()
    {
        $this->registerPolicies();
        parent::register();
    }
}
