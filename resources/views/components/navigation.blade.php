<nav class="p-4 shadow-md text-black bg-white">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold flex items-center">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('logo-horizontal.png') }}" alt="Logo" class="h-20">
            </a>
        </div>

        <!-- Hamburger Button (Mobile Only) -->
        <button id="mobile-menu-button" class="sm:hidden text-[#03503A] focus:outline-none">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Desktop Nav Items -->
        <div class="hidden sm:flex items-center space-x-6">
            <a href="{{ route('welcome') }}" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Home</a>
            <a href="{{route('post.index')}}" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Blogs</a>

            @auth
                <span class="text-[#03503A] text-md font-bold">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('profile.index') }}"
                class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg transition-all hover:shadow-xl">
                    {{-- Either the user’s initial… --}}
                    <span class="text-xl font-bold text-[#03503A]">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>

                    {{-- …or swap it for your SVG icon (just center it) --}}
                    {{-- 
                    <svg class="w-8 h-8 text-[#03503A]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6…"/>
                    </svg>
                    --}}
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-md text-white px-6 py-2 bg-[#2C9A7A] rounded-md hover:bg-[#03503A] transition-all">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-md text-white px-6 py-2 bg-[#2C9A7A] rounded-md hover:bg-[#03503A] transition-all">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="text-md text-[#2C9A7A] px-6 py-2 border border-[#2C9A7A] hover:border-[#03503A] rounded-md hover:bg-[#03503A] hover:text-white transition-all">
                    Register
                </a>
            @endauth
        </div>
    </div>

    <!-- Mobile Nav (Hidden by Default) -->
    <div id="mobile-menu" class="sm:hidden hidden flex flex-col items-start space-y-4 px-6 mt-4">
        <a href="{{ route('welcome') }}" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold self-center">Home</a>
        <a href="{{route('post.index')}}" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold self-center">Blogs</a>

        @auth
                <span class="self-center text-[#03503A] text-md font-bold">Welcome, {{ Auth::user()->name }}!</span>
                <a href="{{ route('profile.index') }}"
                class="self-center w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg transition-all hover:shadow-xl">
                    {{-- Either the user’s initial… --}}
                    <span class="text-xl font-bold text-[#03503A]">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>

                    {{-- …or swap it for your SVG icon (just center it) --}}
                    {{-- 
                    <svg class="w-8 h-8 text-[#03503A]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6…"/>
                    </svg>
                    --}}
                </a>

                <form action="{{ route('logout') }}" method="POST" class="self-center inline">
                    @csrf
                    <button type="submit"
                        class="text-md text-white px-6 py-2 bg-[#2C9A7A] rounded-md hover:bg-[#03503A] transition-all">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-md text-white px-6 py-2 bg-[#2C9A7A] rounded-md hover:bg-[#03503A] transition-all">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="text-md text-[#2C9A7A] px-6 py-2 border border-[#2C9A7A] hover:border-[#03503A] rounded-md hover:bg-[#03503A] hover:text-white transition-all">
                    Register
                </a>
            @endauth
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
