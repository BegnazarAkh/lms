<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        // Show all subjects, marking which are enrolled
        $all = Subject::withTrashed()->get();
        $enrolled = auth()->user()->enrolledSubjects()->pluck('subjects.id')->toArray();

        return view('student.subjects.index', compact('all','enrolled'));
    }

    public function show(Subject $subject)
{
    $user = auth()->user();

    // Ensure the student is enrolled
    if (! $user->enrolledSubjects()->where('subjects.id', $subject->id)->exists()) {
        abort(403, 'Not enrolled in this subject');
    }

    // Load tasks and any existing solution for this student
    $subject->load([
        'tasks' => fn($q) => $q->latest(),
        'tasks.solutions' => fn($q) => $q->where('user_id', $user->id),
        'teacher',
        'students',
    ])->loadCount('students');

    return view('student.subjects.show', compact('subject'));
}


    public function enroll(Subject $subject)
    {
        auth()->user()->enrolledSubjects()->attach($subject->id);
        return back()->with('success','Enrolled successfully.');
    }

    public function leave(Subject $subject)
    {
        auth()->user()->enrolledSubjects()->detach($subject->id);
        return back()->with('success','Left the subject.');
    }
}
