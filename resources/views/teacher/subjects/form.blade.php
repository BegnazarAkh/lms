@php $isEdit = isset($subject); @endphp

<form method="POST"
      action="{{ $isEdit
        ? route('teacher.subjects.update', $subject)
        : route('teacher.subjects.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-4">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name', $subject->name ?? '') }}"
               class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Code (e.g. ABC-DEF123)</label>
        <input type="text" name="code" value="{{ old('code', $subject->code ?? '') }}"
               class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Credits</label>
        <input type="number" name="credits" min="1" max="10"
               value="{{ old('credits', $subject->credits ?? 1) }}"
               class="w-full border px-3 py-2 rounded" required>
    </div>

    <div class="mb-4">
        <label>Description</label>
        <textarea name="description"
                  class="w-full border px-3 py-2 rounded"
                  rows="4">{{ old('description', $subject->description ?? '') }}</textarea>
    </div>

    <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        {{ $isEdit ? 'Update Subject' : 'Create Subject' }}
    </button>
</form>
