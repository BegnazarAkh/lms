@extends('layouts.app')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    View Submission
  </h2>
@endsection

@section('content')
<div class="bg-white shadow rounded p-6 mb-8">
  <h1 class="text-2xl font-bold mb-4">
    {{ $solution->task->name }} &ndash; Submission
  </h1>

  <p class="mb-2"><strong>Subject:</strong>
    {{ $solution->task->subject->name }}
  </p>
  <p class="mb-2"><strong>Teacher:</strong>
    {{ $solution->task->subject->teacher->name }}
    ({{ $solution->task->subject->teacher->email }})
  </p>
  <p class="mb-2"><strong>Submitted At:</strong>
    {{ $solution->created_at->format('Y-m-d H:i') }}
  </p>

  <div class="mt-4 mb-4 p-4 bg-gray-50 rounded">
    <strong>Your Answer:</strong>
    <div class="mt-2 whitespace-pre-wrap">
      {{ $solution->content }}
    </div>
  </div>

  @if(! is_null($solution->points))
    <p class="mb-2"><strong>Grade:</strong>
      {{ $solution->points }} / {{ $solution->task->points }}
    </p>
  @else
    <p class="text-gray-600 mb-2"><em>Not yet graded.</em></p>
  @endif
</div>

<a href="{{ route('student.subjects.tasks.index', $solution->task->subject) }}"
   class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
  ← Back to Tasks
</a>
@endsection
