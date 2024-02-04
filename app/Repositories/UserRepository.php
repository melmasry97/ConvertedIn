<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;
use Illuminate\Support\Facades\Cache;
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
        return Cache::remember('users', now()->addMinutes(10), function () use ($attributes) {
            return User::user()->get($attributes);
        });
    }

    /**
     * Retrieve all admin users.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function admins(array $attributes = ['*'])
    {
        return Cache::remember('admins', now()->addMinutes(10), function () use ($attributes) {
            return User::admin()->get($attributes);
        });
    }
}
