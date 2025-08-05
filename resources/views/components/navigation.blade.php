<nav class="p-4 shadow-md text-black"> {{-- Adjust background color --}}
    <div class="container mx-auto flex justify-between items-center">
        <div class=" text-2xl font-bold flex items-center"><a href="{{route('welcome')}}"><img src="{{ asset('logo-horizontal.png') }}" alt="Logo"
                class="h-20"></a></div>
        <div class="flex items-center space-x-12">
            <a href="{{route('welcome')}}" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Home</a>

            {{-- Conditional display for logged-in user --}}
            @auth {{-- This is a Laravel Blade directive to check if a user is authenticated --}}
            <span class="">Welcome, {{ Auth::user()->name }}!</span>
            <form action="{{route('logout')}}" method="POST" class="inline">
                @csrf
                <button type="submit" class=" hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Logout</button>
            </form>
            @else
            <a href="{{route('login')}}" class=" hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Login</a>
            <a href="{{route('register')}}" class=" hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Register</a>
            @endauth

            <!-- Contact Us -->
            <button class="text-md text-white px-8 py-3 bg-[#2C9A7A] rounded-md cursor-pointer hover:bg-[#03503A] transition-all">Read Blogs</button>
        </div>
    </div>
</nav>