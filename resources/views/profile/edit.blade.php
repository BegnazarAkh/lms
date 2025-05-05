{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Profile
  </h2>
@endsection

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded p-6">
  @if (session('status') === 'profile-updated')
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
      Profile successfully updated.
    </div>
  @endif

  <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    {{-- Username --}}
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Username</label>
      <input
        id="name"
        name="name"
        type="text"
        value="{{ old('name', auth()->user()->name) }}"
        required
        autofocus
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
      />
      @error('name')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Email --}}
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email</label>
      <input
        id="email"
        name="email"
        type="email"
        value="{{ old('email', auth()->user()->email) }}"
        required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
      />
      @error('email')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- New Password --}}
    <div class="mb-4">
      <label for="password" class="block text-gray-700">
        New Password <small>(leave blank to keep current)</small>
      </label>
      <input
        id="password"
        name="password"
        type="password"
        autocomplete="new-password"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
      />
      @error('password')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Confirm Password --}}
    <div class="mb-4">
      <label for="password_confirmation" class="block text-gray-700">Confirm New Password</label>
      <input
        id="password_confirmation"
        name="password_confirmation"
        type="password"
        autocomplete="new-password"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
      />
    </div>

    <div class="flex justify-end">
      <button
        type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
      >
        Save Changes
      </button>
    </div>
  </form>
</div>
@endsection
