<?php

namespace Modules\HR\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("companies.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("companies.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("companies.view");
    }

    public function create(User $user):bool{
        return $user->can('companies.create');
    }

    public function update(User $user):bool{
        return $user->can('companies.update');
    }
    public function delete(User $user):bool{
        return $user->can('companies.delete');
    }
    public function restore(User $user):bool{
        return $user->can('companies.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('companies.forceDelete');
    }
}
