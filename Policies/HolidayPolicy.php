<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;
use Modules\LAM\Policies\BasedPolicy;

class HolidayPolicy extends BasedPolicy
{
    protected string $model = "holidays";
}
