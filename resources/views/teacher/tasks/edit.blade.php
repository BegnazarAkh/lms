@extends('layouts.app')
@section('title', 'Edit Task – ' . $task->name)
@section('content')
  <h1 class="text-2xl font-bold mb-4">Edit Task: {{ $task->name }}</h1>
  @include('teacher.tasks.form')
@endsection
