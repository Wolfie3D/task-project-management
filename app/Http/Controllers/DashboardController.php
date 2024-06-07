<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $myTasks = Task::where('assigned_to', $user->id)->limit(10)->get();
        $role = $user->role;
        $all_tasks = Task::all();


        return inertia('Dashboard', [
            'role' => $role,
            'all_tasks' =>  TaskResource::collection($all_tasks)->response()->getData(true),
            'my_tasks' => $myTasks,

        ]);
    }
}
