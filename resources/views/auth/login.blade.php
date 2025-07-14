@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-6 border border-gray-300 shadow-md rounded">
        <h2 class="text-xl font-semibold text-[#e65100] text-center mb-6">Login to your account</h2>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-white">Email</label>
                <input id="email" type="email" name="email"
                    value="{{ old('email') }}" required autofocus
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                    @error('email') border-red-500 @enderror">

                @error('email')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block font-medium text-sm text-white">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                    @error('password') border-red-500 @enderror">

                @error('password')
                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Login Button -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="px-4 py-2 bg-[#e65100] text-white rounded border border-[#e65100] hover:border-white">Login</button>

                <a href="{{ route('register') }}" class="text-sm text-[#e65100] hover:underline">No account? Register</a>
            </div>
        </form>
    </div>
</div>
@endsection
