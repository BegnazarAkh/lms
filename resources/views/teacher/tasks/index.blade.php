@extends('layouts.app')

@section('title', $subject->name . ' – Tasks')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">{{ $subject->name }} – Tasks</h1>
    <a href="{{ route('teacher.subjects.tasks.create', $subject) }}"
       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        + New Task
    </a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-50">
        <tr>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Points</th>
            <th class="p-3 text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tasks as $task)
        <tr class="border-t">
            <td class="p-3">
                <a href="{{ route('teacher.tasks.edit', $task) }}"
                   class="text-blue-600 hover:underline">
                    {{ $task->name }}
                </a>
            </td>
            <td class="p-3">{{ $task->points }}</td>
            <td class="p-3 space-x-2 text-center">
                <a href="{{ route('teacher.tasks.edit', $task) }}"
                   class="text-indigo-600 hover:underline">
                    Edit
                </a>
                <form action="{{ route('teacher.tasks.destroy', $task) }}"
                      method="POST" class="inline" onsubmit="return confirm('Remove task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">
                        Delete
                    </button>
                </form>
                <a href="{{ route('teacher.solutions.index', $task) }}"
                   class="text-green-600 hover:underline">
                    Solutions
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="p-3 text-center text-gray-600">No tasks yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
