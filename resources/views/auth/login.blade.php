@extends('layouts.master')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-[#0f172a] px-4">
    <div class="bg-[#1e293b] p-8 rounded-xl shadow-xl w-full max-w-md text-white">

        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="mb-2">
                {{-- Financial icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-[#10B981]" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 14l2-2 4 4M7 8h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold mb-1 text-[#10B981]">Welcome Back</h2>
            <p class="text-sm text-gray-400">Manage your finances securely</p>
        </div>

        {{-- Login Form --}}
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" id="email" name="email"
                    class="w-full py-2.5 px-4 rounded-lg bg-[#334155] text-gray-100 border border-transparent focus:outline-none focus:ring-2 focus:ring-[#10B981] transition duration-200"
                    placeholder="Username@example.com">
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full py-2.5 px-4 rounded-lg bg-[#334155] text-gray-100 border border-transparent focus:outline-none focus:ring-2 focus:ring-[#10B981] transition duration-200"
                    placeholder="••••••••">
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-[#10B981] hover:bg-[#0e9f6e] transition duration-200 text-white font-semibold py-2.5 rounded-lg shadow-md">
                Login
            </button>

            {{-- Divider --}}
            <div class="flex items-center justify-center my-4">
                <div class="h-px w-1/4 bg-gray-600"></div>
                <span class="mx-2 text-sm text-gray-400">or</span>
                <div class="h-px w-1/4 bg-gray-600"></div>
            </div>

            {{-- Register --}}
            <p class="text-center text-sm text-gray-300">
                Don’t have an account?
                <a href="{{ route('register') }}"
                    class="text-[#10B981] hover:text-[#0e9f6e] font-semibold transition">
                    Register here
                </a>
            </p>
        </form>
    </div>
</div>
@endsection
