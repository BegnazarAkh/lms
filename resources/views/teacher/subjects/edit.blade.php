@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Subject</h1>
@include('teacher.subjects.form', ['subject' => $subject])
@endsection
