<?php

namespace App\Interfaces;

use App\Interfaces\GeneralInterface;


interface UserInterface extends GeneralInterface
{
    public function admins(array $attributes = ['*']);

    public function users(array $attributes = ['*']);
    
}
