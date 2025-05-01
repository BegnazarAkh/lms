@extends('layouts.app')
@section('title', 'New Task – ' . $subject->name)
@section('content')
  <h1 class="text-2xl font-bold mb-4">New Task for {{ $subject->name }}</h1>
  @include('teacher.tasks.form')
@endsection
