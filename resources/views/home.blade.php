
<x-guest-layout>
    <div class="max-w-3xl mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4">Welcome to the LMS</h1>
    <p class="mb-6">
        A simple Learning Management System for teachers and students.
    </p>
    <a href="{{ route('login') }}"
        class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
        Get Started
    </a>
    <a href="{{ route('contact') }}"
        class="ml-4 px-6 py-3 border border-blue-600 text-blue-600 rounded hover:bg-blue-50">
        Contact
    </a>
    </div>
</x-guest-layout>

