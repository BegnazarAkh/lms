@php $isEdit = isset($task); @endphp

<form method="POST"
      action="{{ $isEdit
          ? route('teacher.tasks.update', $task)
          : route('teacher.subjects.tasks.store', $subject) }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name"
               value="{{ old('name', $task->name ?? '') }}"
               class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Points</label>
        <input type="number" name="points" min="1"
               value="{{ old('points', $task->points ?? 1) }}"
               class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Description</label>
        <textarea name="description"
                  class="w-full border px-3 py-2 rounded"
                  rows="4">{{ old('description', $task->description ?? '') }}</textarea>
    </div>

    <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        {{ $isEdit ? 'Update Task' : 'Create Task' }}
    </button>
</form>
