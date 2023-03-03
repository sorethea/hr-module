<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class HolidayPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("holidays.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("holidays.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("holidays.view");
    }

    public function create(User $user):bool{
        return $user->can('holidays.create');
    }

    public function update(User $user):bool{
        return $user->can('holidays.update');
    }
    public function delete(User $user):bool{
        return $user->can('holidays.delete');
    }
    public function restore(User $user):bool{
        return $user->can('holidays.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('holidays.forceDelete');
    }
}
