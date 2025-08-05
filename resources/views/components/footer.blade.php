<footer class="text-black pb-10 shadow-[0_-2px_10px_rgba(0,0,0,0.1)]"> {{-- Adjust background color --}}
    <div class="container mx-auto px-4 flex flex-col items-center gap-8">

        <!-- Above Divider -->
        <div class="border-b border-[#2C9A7A] w-full flex items-center justify-center flex-col gap-8 py-10">
            <div class="flex items-center justify-center">
                <img src="{{ asset('logo-horizontal.png') }}" alt="Logo" class="h-20" />
            </div>

            <!-- Footer Navigation -->
            <div class="flex gap-16">
                <a href="{{route('welcome')}}" class="transition-all text-md hover:text-[#2C9A7A] text-[#03503A]">Home</a>
                <a href="" class="transition-all text-md hover:text-[#2C9A7A] text-[#03503A]">Blogs</a>
                
                {{-- Conditional display for logged-in user --}}
                @auth {{-- This is a Laravel Blade directive to check if a user is authenticated --}}
                <span class="">Welcome, {{ Auth::user()->name }}!</span>
                <form action="{{route('logout')}}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="transition-all  hover:text-[#2C9A7A] text-md text-[#03503A]">Logout</button>
                </form>
                @else
                <a href="{{route('login')}}" class="transition-all  hover:text-[#2C9A7A] text-md text-[#03503A]">Login</a>
                <a href="{{route('register')}}" class="transition-all  hover:text-[#2C9A7A] text-md text-[#03503A]">Register</a>
                @endauth
            </div>

            <!-- Social Media Links -->
            <div class="flex gap-4 transition-all">
                <a href="https://facebook.com" target="_blank">
                    <div class="transition-all w-10 h-10 flex items-center justify-center rounded-full bg-[#2C9A7A] text-white font-bold hover:bg-[#03503A]">
                        FB
                    </div>
                </a>
                <a href="https://instagram.com" target="_blank">
                    <div class="transition-all w-10 h-10 flex items-center justify-center rounded-full bg-[#2C9A7A] text-white font-bold hover:bg-[#03503A]">
                        IG
                    </div>
                </a>
                <a href="https://tiktok.com" target="_blank">
                    <div class="transition-all w-10 h-10 flex items-center justify-center rounded-full bg-[#2C9A7A] text-white font-bold hover:bg-[#03503A]">
                        TK
                    </div>
                </a>
                <a href="https://youtube.com" target="_blank">
                    <div class="transition-all w-10 h-10 flex items-center justify-center rounded-full bg-[#2C9A7A] text-white font-bold hover:bg-[#03503A]">
                        YT
                    </div>
                </a>
            </div>
        </div>

        <!-- Below Divider -->
         <span class="text-[#03503A]">
            Copyright Anonymous Inc. © 2025. All Right Reserved
         </span>
    </div>
</footer>