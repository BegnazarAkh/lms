@extends('layouts.app')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Solutions for “{{ $task->name }}”
  </h2>
@endsection

@section('content')
  <div class="bg-white shadow rounded p-6 mb-6">
    <h1 class="text-2xl font-bold mb-4">{{ $task->name }} ({{ $task->points }} pts)</h1>

    @if($solutions->isEmpty())
      <p class="text-gray-600">No submissions yet.</p>
    @else
      <table class="w-full bg-gray-50 shadow rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-3 text-left">Student</th>
            <th class="p-3 text-left">Submitted At</th>
            <th class="p-3 text-left">Score</th>
            <th class="p-3 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($solutions as $sol)
            <tr class="border-t">
              <td class="p-3">{{ $sol->student->name }}</td>
              <td class="p-3">{{ $sol->created_at->format('Y-m-d H:i') }}</td>
              <td class="p-3">
                {{ $sol->points_earned ?? '–' }} / {{ $task->points }}
              </td>
              <td class="p-3 text-center">
                <a href="{{ route('teacher.solutions.show', $sol) }}"
                   class="text-blue-600 hover:underline">
                  Review
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <a href="{{ route('teacher.subjects.tasks.index', $task->subject) }}"
     class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
    ← Back to Tasks
  </a>
@endsection
