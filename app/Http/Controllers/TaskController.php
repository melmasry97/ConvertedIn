<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Jobs\UpdateStatisticsJob;
use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{

    public function __construct(protected TaskRepository $taskRepository, protected UserRepository $userRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskRepository->getPaginated(['assignedUser:id,name', 'assignedBy:id,name'], 10);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users  = $this->userRepository->users(['id', 'name']);
        $admins = $this->userRepository->admins(['id', 'name']);

        return view('tasks.create', compact('users', 'admins'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {

        $task = $this->taskRepository->create($request->validated());
        // dd($task, $task->assigned_to_id);
        UpdateStatisticsJob::dispatch($task->assigned_to_id);
        return redirect()->route('tasks.index');
    }
}
