<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
  <div class="min-h-screen flex flex-col justify-center items-center">
    <div class="w-full max-w-md bg-white shadow-md rounded p-6">
      <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>

      {{-- Validation Errors --}}
      @if($errors->any())
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
          <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Username --}}
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Username</label>
          <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name') }}"
            required
            autofocus
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
          />
        </div>

        {{-- Email --}}
        <div class="mb-4">
          <label for="email" class="block text-gray-700">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
          />
        </div>

        {{-- Role --}}
        <div class="mb-4">
          <label for="role" class="block text-gray-700">Register as</label>
          <select
            id="role"
            name="role"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
          >
            <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Select role --</option>
            <option value="student" {{ old('role') === 'student' ? 'selected' : '' }}>
              Student
            </option>
            <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>
              Teacher
            </option>
          </select>
        </div>

        {{-- Password --}}
        <div class="mb-4">
          <label for="password" class="block text-gray-700">Password</label>
          <input
            id="password"
            name="password"
            type="password"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
          />
        </div>

        {{-- Confirm Password --}}
        <div class="mb-6">
          <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
          <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200"
          />
        </div>

        <div class="flex items-center justify-between">
          <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">
            Already registered?
          </a>
          <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
          >
            Register
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
