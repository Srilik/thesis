@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        Forgot your password? No problem. Just let us know your email address, and we will email you a password reset
        link that will allow you to choose a new one.
    </div>

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />

            @error('email')
                <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <button
                type="submit"
                class="px-4 py-2 font-medium text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-200 disabled:opacity-25"
            >
                Email Password Reset Link
            </button>
        </div>
    </form>
@endsection
