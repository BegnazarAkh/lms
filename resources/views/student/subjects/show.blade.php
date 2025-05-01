@extends('layouts.app')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ $subject->name }} (Student View)
  </h2>
@endsection

@section('content')
<div class="bg-white shadow rounded p-6 mb-8">
  <h1 class="text-2xl font-bold mb-4">{{ $subject->name }}</h1>
  <p class="mb-2"><strong>Code:</strong> {{ $subject->code }}</p>
  <p class="mb-2"><strong>Credits:</strong> {{ $subject->credits }}</p>
  <p class="mb-2"><strong>Created:</strong> {{ $subject->created_at->format('Y-m-d H:i') }}</p>
  <p class="mb-4"><strong>Last Updated:</strong> {{ $subject->updated_at->format('Y-m-d H:i') }}</p>
  <p class="mb-4"><strong>Description:</strong><br>{{ $subject->description }}</p>
  <p class="mb-4"><strong>Enrolled Students:</strong> {{ $subject->students_count }}</p>

  <h3 class="text-lg font-semibold mt-6 mb-2">Teacher</h3>
  <p>{{ $subject->teacher->name }} ({{ $subject->teacher->email }})</p>

  <h3 class="text-lg font-semibold mt-6 mb-2">Class Roster</h3>
  @if($subject->students_count)
    <table class="w-full bg-gray-50 rounded shadow mb-8">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-2 text-left">Name</th>
          <th class="p-2 text-left">Email</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subject->students as $student)
          <tr class="border-t">
            <td class="p-2">{{ $student->name }}</td>
            <td class="p-2">{{ $student->email }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p class="text-gray-600 mb-8">No other students enrolled yet.</p>
  @endif

  {{-- Tasks Section --}}
  <div class="mt-8">
    <h3 class="text-xl font-semibold mb-4">Tasks</h3>

    @if($subject->tasks->isEmpty())
      <p class="text-gray-600">No tasks have been created yet.</p>
    @else
      <table class="w-full bg-white shadow rounded">
        <thead>
          <tr class="bg-gray-50">
            <th class="p-3 text-left">Task Name</th>
            <th class="p-3 text-left">Points</th>
            <th class="p-3 text-center">Status</th>
            <th class="p-3 text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($subject->tasks as $task)
            @php
              // We eager-loaded solutions filtered to this student
              $solution = $task->solutions->first();
            @endphp
            <tr class="border-t">
              <td class="p-3">{{ $task->name }}</td>
              <td class="p-3">{{ $task->points }}</td>
              <td class="p-3 text-center">
                @if($solution)
                  <span class="text-green-600 font-medium">Submitted</span>
                @else
                  <span class="text-gray-600 font-medium">Not Submitted</span>
                @endif
              </td>
              <td class="p-3 text-center">
                @if($solution)
                  <a href="{{ route('student.solutions.show', $solution) }}"
                     class="text-blue-600 hover:underline">
                    View Submission
                  </a>
                @else
                  <a href="{{ route('student.tasks.show', $task) }}"
                     class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Submit
                  </a>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>

  <a href="{{ route('student.subjects.index') }}"
     class="mt-6 inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
    ← Back to Subjects
  </a>
</div>
@endsection
