@extends('layouts.app')

@section('title', $subject->name . ' – Tasks')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $subject->name }} – Tasks</h1>

<ul class="space-y-4">
  @forelse($tasks as $task)
    <li class="bg-white p-4 rounded shadow">
      <a href="{{ route('student.tasks.show', $task) }}"
         class="text-blue-600 hover:underline text-lg font-semibold">
        {{ $task->name }}
      </a>
      <p class="text-sm text-gray-600">{{ $task->points }} points</p>
    </li>
  @empty
    <li class="text-gray-600">No tasks available.</li>
  @endforelse
</ul>
@endsection
