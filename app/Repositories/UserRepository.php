<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;
use App\Repositories\GeneralRepository;


class UserRepository extends GeneralRepository implements UserInterface
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve all regular user types.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function users(array $attributes = ['*'])
    {
        return $this->model->user()->get($attributes);
    }

    /**
     * Retrieve all admin users.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function admins(array $attributes = ['*'])
    {
        return $this->model->admin()->get($attributes);
    }
}
