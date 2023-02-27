<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("employees.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("employees.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("employees.view");
    }

    public function create(User $user):bool{
        return $user->can('employees.create');
    }

    public function update(User $user):bool{
        return $user->can('employees.update');
    }
    public function delete(User $user):bool{
        return $user->can('employees.delete');
    }
    public function restore(User $user):bool{
        return $user->can('employees.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('employees.forceDelete');
    }
}
