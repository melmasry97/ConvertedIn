<?php

namespace App\Repositories;

use App\Models\Statistic;
use App\Interfaces\StatisticInterface;
use App\Repositories\GeneralRepository;

class StatisticRepository extends GeneralRepository implements StatisticInterface
{
    /**
     * @param Statistic $model
     */
    public function __construct(Statistic $model)
    {
        parent::__construct($model);
    }
}
