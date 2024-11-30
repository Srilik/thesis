@extends('layouts.guest')

@section('title', 'Confirm Password')

@section('content')
<div class="mb-4 text-sm text-gray-600">
    This is a secure area of the application. Please confirm your password before continuing.
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
            id="password"
            type="password"
            name="password"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required
            autocomplete="current-password"
            autofocus
        />
        @error('password')
            <span class="mt-2 text-sm text-red-600">{{ $message }}</span>
        @enderror
    </div>

    <div class="flex justify-end mt-4">
        <button
            type="submit"
            class="px-4 py-2 font-medium text-white bg-indigo-500 rounded ms-4 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-200 disabled:opacity-25"
        >
            Confirm
        </button>
    </div>
</form>
@endsection
