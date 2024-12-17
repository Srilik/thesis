{{--  <form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="role" placeholder="Role" required>
    <button type="submit">Login</button>
</form>  --}}

@extends('layouts.guest')

@section('title', 'Log in')

@section('content')
    <div class="mb-4">
        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <input-label for="email" :value="__('Email')" />

                <text-input
                    id="email"
                    type="email"
                    name="email"
                    class="block w-full mt-1"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                />

                <input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <input-label for="password" :value="__('Password')" />

                <text-input
                    id="password"
                    type="password"
                    name="password"
                    class="block w-full mt-1"
                    required
                    autocomplete="current-password"
                />

                <input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500"
                        name="remember"
                    >
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <primary-button class="ml-4">
                    {{ __('Log in') }}
                </primary-button>
            </div>
        </form>
    </div>
@endsection
