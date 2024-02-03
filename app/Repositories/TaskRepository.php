<?php

namespace App\Repositories;

use App\Models\Task;
use App\Interfaces\TaskInterface;
use App\Repositories\GeneralRepository;

class TaskRepository extends GeneralRepository implements TaskInterface
{
    /**
     * @param Task $model
     */
    public function __construct(Task $model)
    {
        parent::__construct($model);
    }
}
