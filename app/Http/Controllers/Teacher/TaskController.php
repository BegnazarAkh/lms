<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Subject $subject)
    {
        $this->authorize('view', $subject);
        $tasks = $subject->tasks()->latest()->get();
        return view('teacher.tasks.index', compact('subject','tasks'));
    }

    public function create(Subject $subject)
    {
        $this->authorize('update', $subject);
        return view('teacher.tasks.create', compact('subject'));
    }

    public function store(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $data = $request->validate([
            'name'        => 'required|string|min:5',
            'description' => 'nullable|string',
            'points'      => 'required|integer|min:1',
        ]);

        $subject->tasks()->create($data);

        return redirect()->route('teacher.subjects.tasks.index', $subject)
                         ->with('success', 'Task added.');
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task->subject);
        return view('teacher.tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task->subject);
        $data = $request->validate([
            'name'        => 'required|string|min:5',
            'description' => 'nullable|string',
            'points'      => 'required|integer|min:1',
        ]);

        $task->update($data);

        return redirect()->route('teacher.subjects.tasks.index', $task->subject)
                         ->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task->subject);
        $task->delete();
        return back()->with('success', 'Task removed.');
    }
}
