@extends('layouts.app')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ $task->subject->name }} &mdash; {{ $task->name }}
  </h2>
@endsection

@section('content')
<div class="bg-white shadow rounded p-6 mb-8">
  <!-- Task & Context -->
  <h1 class="text-2xl font-bold mb-2">{{ $task->name }}</h1>
  <p class="mb-1"><strong>Subject:</strong> {{ $task->subject->name }}</p>
  <p class="mb-1"><strong>Teacher:</strong>
    {{ $task->subject->teacher->name }}
    ({{ $task->subject->teacher->email }})
  </p>
  <p class="mb-1"><strong>Points:</strong> {{ $task->points }}</p>
  <p class="mb-4"><strong>Description:</strong><br>{{ $task->description }}</p>

  <!-- Flash -->
  @if(session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
      {{ session('success') }}
    </div>
  @endif

  <!-- Previous Submissions -->
  @if($task->solutions->isNotEmpty())
    <div class="mb-6">
      <h3 class="font-semibold mb-2">Your Previous Submissions</h3>
      <ul class="list-disc pl-6 space-y-2">
        @foreach($task->solutions as $sol)
          <li>
            <span class="font-medium">{{ $sol->created_at->format('Y-m-d H:i') }}:</span>
            {{ Str::limit($sol->content, 100) }}
            <a href="{{ route('student.solutions.show', $sol) }}"
               class="text-blue-600 hover:underline ml-2">
              View
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Submission Form -->
  <form method="POST" action="{{ route('student.solutions.store', $task) }}">
    @csrf
    <div class="mb-4">
      <label for="content" class="block font-medium mb-1">Your Solution</label>
      <textarea id="content"
                name="content"
                rows="6"
                required
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200">{{ old('content') }}</textarea>
      @error('content')
        <p class="text-red-600 mt-1">{{ $message }}</p>
      @enderror
    </div>
    <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
      Submit Solution
    </button>
  </form>
</div>

<a href="{{ route('student.subjects.tasks.index', $task->subject) }}"
   class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
  ← Back to Tasks
</a>
@endsection
