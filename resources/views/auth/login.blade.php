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
            Login to your account
        </h2>

        <!-- Session status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-white">Email</label>
                <input id="email" type="email" name="email"
                    value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full bg-[#2a2a2a] text-white border-gray-300 rounded-md shadow-sm
                    @error('email') border-red-500 @enderror">

                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block font-medium text-sm text-white">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full bg-[#2a2a2a] text-white border-gray-300 rounded-md shadow-sm
                    @error('password') border-red-500 @enderror">

                @error('password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit + Register -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <button type="submit"
                    class="w-full sm:w-auto px-5 py-1 bg-[#e65100] text-white rounded border border-[#e65100] hover:border-white transition">
                    Login
                </button>

                <a href="{{ route('register') }}" class="text-sm text-[#e65100] hover:underline text-center sm:text-left">
                    No account? Register
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
