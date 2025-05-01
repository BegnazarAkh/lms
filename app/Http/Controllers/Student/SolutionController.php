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
        // Ensure enrolled
        abort_unless(
            auth()->user()->enrolledSubjects()
                        ->where('subjects.id',$task->subject_id)
                        ->exists(),
            403
        );

        $data = $request->validate([
            'content' => 'required|string|min:10',
        ]);

        Solution::create([
            'task_id' => $task->id,
            'user_id' => auth()->id(),
            'content' => $data['content'],
        ]);

        return back()->with('success','Solution submitted.');
    }
}
