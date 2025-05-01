@extends('layouts.app')

@section('title', 'My Subjects')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">My Subjects</h1>
    <a href="{{ route('teacher.subjects.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        + New Subject
    </a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-50">
        <tr>
            <th class="p-3 text-left">Code</th>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Credits</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($subjects as $subject)
        <tr class="border-t">
            <td class="p-3">{{ $subject->code }}</td>
            <td class="p-3">
                <a href="{{ route('teacher.subjects.tasks.index', $subject) }}"
                   class="text-blue-600 hover:underline">
                    {{ $subject->name }}
                </a>
            </td>
            <td class="p-3">{{ $subject->credits }}</td>
            <td class="p-3 space-x-2 text-center">
                <a href="{{ route('teacher.subjects.edit', $subject) }}"
                   class="hover:text-blue-600">Edit</a>
                <form action="{{ route('teacher.subjects.destroy', $subject) }}"
                      method="POST" class="inline" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="p-3 text-center text-gray-600">No subjects yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
