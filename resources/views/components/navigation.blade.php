<nav class="p-4 shadow-md text-black"> {{-- Adjust background color --}}
    <div class="container mx-auto flex justify-between items-center">
        <div class=" text-2xl font-bold flex items-center"><a href="{{route('welcome')}}"><img src="{{ asset('logo-horizontal.png') }}" alt="Logo"
                class="h-20"></a></div>
        <div class="flex items-center space-x-12">
            <a href="{{route('welcome')}}" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Home</a>
            <a href="" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Blogs</a>

            {{-- Conditional display for logged-in user --}}
            @auth {{-- This is a Laravel Blade directive to check if a user is authenticated --}}
            <span class="">Welcome, {{ Auth::user()->name }}!</span>
            <form action="{{route('logout')}}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-md text-white px-8 py-3 bg-[#2C9A7A] rounded-md cursor-pointer hover:bg-[#03503A] transition-all">Logout</button>
            </form>
            @else
            <div class="space-x-4">
                <a href="{{route('login')}}" class="text-md text-white px-8 py-3 bg-[#2C9A7A] rounded-md cursor-pointer hover:bg-[#03503A] transition-all">Login</a>
                <a href="{{route('register')}}" class="text-md text-[#2C9A7A] px-8 py-3 border border-[#2C9A7A] hover:border-[#03503A] rounded-md cursor-pointer hover:bg-[#03503A] hover:text-white transition-all">Register</a>
            </div>
            @endauth
        </div>
    </div>
</nav>