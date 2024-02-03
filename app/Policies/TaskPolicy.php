<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->Admin();
    }

}
