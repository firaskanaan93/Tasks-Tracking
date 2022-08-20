<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks.index');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'assigned_by_id' => 'required|numeric|exists:users,id',
            'assigned_to_id' => 'required|numeric|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ], [
            'assigned_by_id.required' => 'Admin is required',
            'assigned_to_id.required' => 'User is required'
        ]);
        Task::create($validatedData);

        return redirect(route('tasks.index'));

    }

    public function statistics()
    {
        $users = Task::query()
            ->groupBy('assigned_to_id')
            ->join('users', 'users.id', '=', 'tasks.assigned_to_id')
            ->select('assigned_to_id', 'users.name', DB::raw('count(*) as tasks_count'))
            ->orderBy('tasks_count', 'desc')
            ->take(10)
            ->get();
        if (request()->ajax()) {
            return ['results' => $users];
        }

        return view('tasks.statistics', compact('users'));
    }
}
