<nav class="p-4 shadow-md text-black"> {{-- Adjust background color --}}
    <div class="container mx-auto flex justify-between items-center">
        <div class=" text-2xl font-bold flex items-center"><a href={{route('welcome')}}><img src="{{ asset('logo-horizontal.png') }}" alt="Logo"
                class="h-20"></a></div>
        <div class="flex items-center space-x-12">
            <a href="{{route('welcome')}}" class="hover:text-[#2C9A7A] text-md font-bold">Home</a>

            {{-- Conditional display for logged-in user --}}
            @auth {{-- This is a Laravel Blade directive to check if a user is authenticated --}}
            <span class="">Welcome, {{ Auth::user()->name }}!</span>
            <form action="{{route('logout')}}" method="POST" class="inline">
                @csrf
                <button type="submit" class=" hover:text-[#2C9A7A] text-md font-bold">Logout</button>
            </form>
            @else
            <a href="{{route('login')}}" class=" hover:text-[#2C9A7A] text-md font-bold">Login</a>
            @endauth

            <!-- Contact Us -->
            <button class="text-md text-white px-8 py-3 bg-[#2C9A7A] rounded-md cursor-pointer hover:bg-[#03503A] transition-all">Contact Us</button>

            {{-- Social Media Icons and Links --}}
            <!-- <div class="flex space-x-3 ml-4">
                <a href="{{env('FACEBOOK_URL')}}" target="_blank" class=" hover:text-[#03503A]">
                    <img src="https://img.icons8.com/ios-filled/24/2C9A7A/facebook-new.png" alt="Facebook"
                        class="w-6 h-6" />
                </a>
                <a href="https://twitter.com" target="_blank" class=" hover:text-[#03503A]">
                    <img src="https://img.icons8.com/ios-filled/24/2C9A7A/twitter.png" alt="Twitter" class="w-6 h-6" />
                </a>
                <a href="https://instagram.com" target="_blank" class=" hover:text-[#03503A]">
                    <img src="https://img.icons8.com/ios-filled/24/2C9A7A/instagram-new--v1.png" alt="Instagram"
                        class="w-6 h-6" />
                </a>
            </div> -->
        </div>
    </div>
</nav>