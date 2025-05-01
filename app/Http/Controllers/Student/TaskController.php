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
        $subjectId = $task->subject_id;
        abort_unless(
            auth()->user()->enrolledSubjects()->where('subjects.id', $subjectId)->exists(),
            403
        );
        return view('student.tasks.show', compact('task'));
    }
}
