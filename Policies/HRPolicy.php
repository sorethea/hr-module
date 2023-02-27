<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class HRPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("hrs.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("hrs.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("hrs.view");
    }

    public function create(User $user):bool{
        return $user->can('hrs.create');
    }

    public function update(User $user):bool{
        return $user->can('hrs.update');
    }
    public function delete(User $user):bool{
        return $user->can('hrs.delete');
    }
    public function restore(User $user):bool{
        return $user->can('hrs.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('hrs.forceDelete');
    }
}
