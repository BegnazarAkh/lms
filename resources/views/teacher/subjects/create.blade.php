@extends('layouts.app')

@section('title', 'New Subject')

@section('content')
<h1 class="text-2xl font-bold mb-4">New Subject</h1>
@include('teacher.subjects.form')
@endsection
