@extends('layouts.guest')

@section('title', 'Email Verification')

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we
        just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-green-600">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="flex items-center justify-between mt-4">
            <button
                type="submit"
                class="px-4 py-2 font-medium text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-200 disabled:opacity-25"
                {{ session('status') === 'verification-link-sent' ? 'disabled' : '' }}
            >
                Resend Verification Email
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Log Out
                </button>
            </form>
        </div>
    </form>
@endsection
