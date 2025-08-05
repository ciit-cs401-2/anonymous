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
            <a href="#" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold">Blogs</a>

            @auth
                <span class="text-[#03503A] text-sm font-semibold">Welcome, {{ Auth::user()->name }}!</span>
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
        <a href="#" class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold self-center">Blogs</a>

        @auth
            <span class="text-[#03503A] text-sm font-semibold self-center">Welcome, {{ Auth::user()->name }}!</span>
            <form action="{{ route('logout') }}" method="POST" class="inline self-center">
                @csrf
                <button type="submit"
                    class="text-md text-white px-6 py-2 bg-[#2C9A7A] rounded-md hover:bg-[#03503A] transition-all">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold self-center">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="hover:text-[#2C9A7A] text-[#03503A] text-md font-bold self-center">
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
