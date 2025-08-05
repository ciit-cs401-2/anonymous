@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-[#121212] px-4">
    <div class="bg-[#1e1e2f] p-8 rounded-lg shadow-lg w-full max-w-md text-white">

        {{-- Title --}}
        <h2 class="text-3xl font-bold mb-6 text-center text-green-400">Create Account</h2>

        {{-- Form --}}
        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm mb-1 text-green-200">Name</label>
                <input type="text" id="name" name="name"
                    class="w-full py-2 px-3 rounded bg-[#2c2f4a] text-white focus:outline-none focus:ring-2 focus:ring-green-400"
                    placeholder="Enter your name" required>
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm mb-1 text-green-200">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full py-2 px-3 rounded bg-[#2c2f4a] text-white focus:outline-none focus:ring-2 focus:ring-green-400"
                    placeholder="Enter your email" required>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm mb-1 text-green-200">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full py-2 px-3 rounded bg-[#2c2f4a] text-white focus:outline-none focus:ring-2 focus:ring-green-400"
                    placeholder="Enter your password" required>
            </div>

            {{-- Confirm Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm mb-1 text-green-200">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full py-2 px-3 rounded bg-[#2c2f4a] text-white focus:outline-none focus:ring-2 focus:ring-green-400"
                    placeholder="Confirm your password" required>
            </div>

            {{-- Register Button --}}
            <div>
                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded transition duration-200">
                    Register
                </button>
            </div>
        </form>

        {{-- Login Link --}}
        <p class="text-center text-sm text-green-200 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300 font-semibold">Login</a>
        </p>
    </div>
</div>
@endsection
