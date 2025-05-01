@extends('layouts.app')

@section('title', 'Solution Review')

@section('content')
<h1 class="text-2xl font-bold mb-4">Solution for “{{ $solution->task->name }}”</h1>

<div class="mb-6 bg-white p-4 rounded shadow">
    <h2 class="font-semibold mb-2">Submitted by:</h2>
    <p>{{ $solution->student->name }} at {{ $solution->created_at->format('Y-m-d H:i') }}</p>

    <h2 class="font-semibold mt-4 mb-2">Content:</h2>
    <div class="prose">
        {!! nl2br(e($solution->content)) !!}
    </div>
</div>

<div class="bg-white p-4 rounded shadow">
    <h2 class="font-semibold mb-2">Evaluate</h2>
    <form method="POST" action="{{ route('teacher.solutions.evaluate', $solution) }}">
        @csrf
        <div class="mb-4">
            <label>Points (max {{ $solution->task->points }}):</label>
            <input type="number" name="points_earned"
                   min="0" max="{{ $solution->task->points }}"
                   value="{{ old('points_earned', $solution->points_earned) }}"
                   class="w-full border px-3 py-2 rounded" required>
        </div>
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Submit Score
        </button>
    </form>
</div>
@endsection
