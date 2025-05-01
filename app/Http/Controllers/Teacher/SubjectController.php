<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = auth()->user()->taughtSubjects()->latest()->get();
        return view('teacher.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('teacher.subjects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|min:3',
            'description' => 'nullable|string',
            'code'        => 'required|string|unique:subjects,code|regex:/^[A-Z]{3}-[A-Z]{3}\d{3}$/',
            'credits'     => 'required|integer|min:1|max:10',
        ]);

        auth()->user()->taughtSubjects()->create($data);

        return redirect()->route('teacher.subjects.index')
                         ->with('success', 'Subject created.');
    }

    public function edit(Subject $subject)
    {
        $this->authorize('update', $subject);
        return view('teacher.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $data = $request->validate([
            'name'        => 'required|string|min:3',
            'description' => 'nullable|string',
            'code'        => 'required|string|unique:subjects,code,' . $subject->id,
            'credits'     => 'required|integer|min:1|max:10',
        ]);

        $subject->update($data);

        return redirect()->route('teacher.subjects.index')
                         ->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();

        return back()->with('success', 'Subject deleted.');
    }
}
