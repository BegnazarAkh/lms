@extends('layouts.app')

@section('title', 'Available Subjects')

@section('content')
<h1 class="text-2xl font-bold mb-6">Subjects</h1>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  @foreach($all as $subj)
    <div class="bg-white p-4 rounded shadow">
      <h2 class="text-lg font-semibold">{{ $subj->name }} ({{ $subj->code }})</h2>
      <p class="mb-2">{{ $subj->credits }} credits</p>
      @if(in_array($subj->id, $enrolled))
        <form method="POST" action="{{ route('student.subjects.leave', $subj) }}">
          @csrf
          <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Leave</button>
          <a href="{{ route('student.tasks.index', $subj) }}" class="ml-2 hover:underline">View Tasks</a>
        </form>
      @else
        <form method="POST" action="{{ route('student.subjects.enroll', $subj) }}">
          @csrf
          <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Enroll</button>
        </form>
      @endif
    </div>
  @endforeach
</div>
@endsection
