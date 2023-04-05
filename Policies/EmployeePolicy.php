<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;
use Modules\LAM\Policies\BasedPolicy;

class EmployeePolicy extends BasedPolicy
{
    protected string $model = "employees";
}
