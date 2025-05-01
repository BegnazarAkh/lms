<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Solution;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SolutionController extends Controller
{
    public function show(Solution $solution)
    {
        $this->authorize('view', $solution->task->subject);
        return view('teacher.solutions.show', compact('solution'));
    }

    public function evaluate(Request $request, Solution $solution)
    {
        $this->authorize('update', $solution->task->subject);

        $data = $request->validate([
            'points_earned' => 'required|integer|min:0|max:' . $solution->task->points,
        ]);

        $solution->update([
            'points_earned' => $data['points_earned'],
            'evaluated_at'  => Carbon::now(),
        ]);

        return back()->with('success', 'Solution evaluated.');
    }
}
