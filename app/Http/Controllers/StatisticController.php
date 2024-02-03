<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Repositories\StatisticRepository;
use App\Http\Requests\StoreStatisticRequest;
use App\Http\Requests\UpdateStatisticRequest;

class StatisticController extends Controller
{

    public function __construct(protected StatisticRepository $statisticRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = $this->statisticRepository->withData(['user:id,name'])->topUserStatistics(10);

        // dd($statistics);
        return view('statistics.index', compact('statistics'));
    }
}
