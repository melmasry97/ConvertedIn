<?php

namespace App\Repositories;

use App\Models\Statistic;
use App\Interfaces\StatisticInterface;
use App\Repositories\GeneralRepository;
use Illuminate\Database\Eloquent\Collection;

class StatisticRepository extends GeneralRepository implements StatisticInterface
{
    /**
     * @param Statistic $model
     */
    public function __construct(Statistic $model)
    {
        parent::__construct($model);
    }

    /**
     * get statistic limited by number
     * @param integer $number
     * @return Collection
     */
    public function topUserStatistics(int $number)
    {
        return $this->model->orderByDesc('count')
            ->limit($number)
            ->get();
    }
}
