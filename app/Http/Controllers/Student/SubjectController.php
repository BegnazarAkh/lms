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
