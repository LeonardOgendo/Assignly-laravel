@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md p-6 border border-gray-300 shadow-md rounded relative bg-[#1a1a1a]">

        <!-- Brand top-left -->
        <div class="absolute top-4 left-4">
            <h1 class="text-lg font-bold text-white">
                A<span style="letter-spacing: -0.15em">ssig</span><span class="text-[#e65100]">nly</span>
            </h1>
        </div>

        <!-- Heading -->
        <h2 class="text-xl font-semibold text-[#e65100] text-center mb-10 mt-10">
            Create a New Account
        </h2>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-white">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full bg-[#2a2a2a] text-white border-gray-300 rounded-md shadow-sm
                    @error('name') border-red-500 @enderror" />
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full bg-[#2a2a2a] text-white border-gray-300 rounded-md shadow-sm
                    @error('email') border-red-500 @enderror" />
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full bg-[#2a2a2a] text-white border-gray-300 rounded-md shadow-sm
                    @error('password') border-red-500 @enderror" />
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full bg-[#2a2a2a] text-white border-gray-300 rounded-md shadow-sm
                    @error('password_confirmation') border-red-500 @enderror" />
                @error('password_confirmation')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Register Button -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <a href="{{ route('login') }}" class="text-sm text-[#e65100] hover:underline text-center sm:text-left">
                    Already have an account?
                </a>

                <button type="submit"
                    class="w-full sm:w-auto px-4 py-2 bg-[#e65100] text-white rounded border border-[#e65100] hover:border-white transition">
                    Register
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
