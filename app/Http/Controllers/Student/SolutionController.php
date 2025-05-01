<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Solution;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    public function store(Request $request, Task $task)
    {
        // Ensure enrollment
        if (! auth()->user()->enrolledSubjects()->where('subjects.id', $task->subject_id)->exists()) {
            abort(403, 'Not enrolled in this subject');
        }

        // Validate
        $data = $request->validate([
            'content' => 'required|string|min:10',
        ]);

        // Create a new solution (multiple submissions allowed)
        Solution::create([
            'task_id'  => $task->id,
            'user_id'  => auth()->id(),
            'content'  => $data['content'],
        ]);

        return redirect()
            ->route('student.tasks.show', $task)
            ->with('success', 'Solution submitted successfully.');
    }

    public function show(Solution $solution)
    {
        // Ensure the student owns this solution
        if ($solution->user_id !== auth()->id()) {
            abort(403, 'Access denied');
        }

        // Eager-load the related task & subject for context
        $solution->load('task.subject.teacher');

        return view('student.solutions.show', compact('solution'));
    }

}
