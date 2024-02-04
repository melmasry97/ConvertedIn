<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Task;
use App\Models\User;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TaskTest extends TestCase
{
    use DatabaseMigrations;
    protected $repository;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new TaskRepository(new Task());
    }

    public function testCanUserGetListOfTasks()
    {
        $tasksDataBase = Task::factory()->count(3)->create()->count();

        $tasks = $this->repository->getData();

        $this->assertEquals($tasksDataBase, count($tasks));
    }


    public function testUserCanCreateTask()
    {

        $task = $this->repository->create([
            'title' => 'task test',
            'description' => 'task description',
            'assigned_to_id' => User::factory()->create(['type' => User::USER])->id,
            'assigned_by_id' => User::factory()->create(['type' => User::ADMIN])->id,
        ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'task test',
            // Add other expected attributes as needed
        ]);
    }
}
