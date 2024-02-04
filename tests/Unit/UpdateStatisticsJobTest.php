<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Statistic;
use Database\Seeders\UserSeeder;
use App\Jobs\UpdateStatisticsJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateStatisticsJobTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test Background Job
     *
     * @return void
     */
    public function testUpdateStatisticsJob()
    {
        $this->seed(UserSeeder::class);
        $user = User::first();



        // Execute the job
        (new UpdateStatisticsJob($user->id))->handle();

        // Assert that the Statistic record was created or updated
        $this->assertDatabaseHas('statistics', [
            'user_id' => $user->id,
            'count' => 1, // Adjust this value based on your expectations
        ]);
    }
}
