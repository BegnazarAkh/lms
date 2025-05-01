<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Subject;

class TaskController extends Controller
{
    public function index(Subject $subject)
    {
        abort_unless(
            auth()->user()->enrolledSubjects()->where('subjects.id',$subject->id)->exists(),
            403,
            'Not enrolled'
        );

        $tasks = $subject->tasks()->latest()->get();
        return view('student.tasks.index', compact('subject','tasks'));
    }

    public function show(Task $task)
    {
        $user = auth()->user();

        // Ensure the student is enrolled in the subject
        if (! $user->enrolledSubjects()->where('subjects.id', $task->subject_id)->exists()) {
            abort(403, 'Not enrolled in this subject');
        }

        // Load the subject, teacher, and the student's past submissions
        $task->load('subject.teacher')
             ->load(['solutions' => fn($q) => $q->where('user_id', $user->id)->latest()]);

        return view('student.tasks.show', compact('task'));
    }
}
