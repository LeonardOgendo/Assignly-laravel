@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6 border border-gray-300 shadow-md rounded">
        <h2 class="text-xl font-semibold text-[#e65100] text-center mb-6">Create a New Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-white">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('password_confirmation')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm text-[#e65100] hover:underline">Already have an account?</a>
                <button type="submit"
                    class="px-4 py-2 bg-[#e65100] text-white rounded border border-[#e65100] hover:border-white">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
