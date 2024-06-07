<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Inertia\Inertia;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;
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

        if (auth()->user()->role == 'admin') {
            return Inertia::render("Task/Index", [
                "tasks" => TaskResource::collection($tasks)->response()->getData(true),
            ]);
        } else {
            return redirect()->route('task.myTask');
        }
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
                'users' => $users
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

        if (auth()->user()->role == 'admin') {
            return redirect()->route('task.index');
        } else {
            return redirect()->route('task.myTask');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }


    public function myTask()
    {
        $user = Auth::user();
        $userTasks = Task::where('assigned_to', $user->id)->get();
        return Inertia::render('Task/Staff/Dashboard', [
            'myTasks' => $userTasks,
        ]);
    }
}