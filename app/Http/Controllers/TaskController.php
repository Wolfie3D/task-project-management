<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return Inertia::render("Task/Index", [
            "tasks" => TaskResource::collection($tasks)->response()->getData(true),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::query()->orderBy('name', 'asc')->get();

        return Inertia::render('Task/Create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(StoreTaskRequest $request)
    { {
            $data = $request->validated();
            Task::create($data);
            return redirect()->route('task.index');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return Inertia::render('Task/Show', [
            'task' => new TaskResource($task),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $users = User::query()->orderBy('name', 'asc')->get();
        return Inertia::render(
            'Task/Edit',
            [
                'task' => new TaskResource($task),
                'users' => $users,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }
}