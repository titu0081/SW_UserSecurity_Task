<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:show tasks')->only(['index','show']);
        $this->middleware('permission:create tasks')->only(['create','store']);
        $this->middleware('permission:edit tasks')->only(['edit','update']);
        $this->middleware('permission:delete tasks')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::latest()->get();
        return view('task.index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
            'limit_date' => 'required|date',
        ]);

        Task::create([
            'title' => trim($validated['title']),
            'description' => trim($validated['description']),
            'limit_date' => $validated['limit_date'],
            'completed' => $request->boolean('completed'),
            'id_user' => Auth::id(),
        ]);

        return redirect()->route('task.index')->with('success', 'Task created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_task)
    {
        $task = Task::findOrFail($id_task);
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id_task)
    {
        $task = Task::findOrFail($id_task);
        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id_task)
    {
        $task = Task::findOrFail($id_task);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
            'limit_date' => 'required|date',
        ]);

        $task->update([
            'title' => trim($validated['title']),
            'description' => trim($validated['description']),
            'limit_date' => $validated['limit_date'],
            'completed' => $request->boolean('completed'),
        ]);

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_task)
    {
        $task = Task::findOrFail($id_task);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Task deleted successfully.'); 
    }
}
