@extends('layouts.app')

@section('title', $task->name)

@section('content')
<h1 class="text-2xl font-bold mb-2">{{ $task->name }}</h1>
<p class="text-gray-600 mb-4">{{ $task->points }} points</p>
<div class="mb-6 bg-white p-4 rounded shadow prose">
  {!! nl2br(e($task->description)) !!}
</div>

<h2 class="text-xl font-semibold mb-2">Submit Your Solution</h2>
<form method="POST" action="{{ route('student.solutions.store', $task) }}">
  @csrf
  <div class="mb-4">
    <textarea name="content" rows="6"
              class="w-full border px-3 py-2 rounded"
              placeholder="Paste your solution here">{{ old('content') }}</textarea>
  </div>
  <button type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
    Submit
  </button>
</form>
@endsection
