<?php

namespace App\Interfaces;

use App\Interfaces\GeneralInterface;


interface StatisticInterface extends GeneralInterface
{
    public function topUsersStatistics(int $number);
}
