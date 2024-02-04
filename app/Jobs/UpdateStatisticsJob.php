<?php

namespace App\Jobs;

use App\Models\Statistic;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateStatisticsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Statistic::updateOrCreate(
            ['user_id' => $this->id],
            ['count' => DB::raw('CASE WHEN count IS NULL THEN 1 ELSE count + 1 END')]
        );
    }
}
