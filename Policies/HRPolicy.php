<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;
use Modules\LAM\Policies\BasedPolicy;

class HRPolicy extends BasedPolicy
{
    protected string $model ="hrs";
}
