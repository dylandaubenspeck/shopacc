@if (\Route::current()->getName() != 'login' && \Route::current()->getName() != 'register')
<header>
    <nav class="sticky top-0 left-0 z-[1100] w-full backdrop-blur bg-white/50 border border-bottom flex items-center justify-between px-4 py-2 glare-border z-50">
        <div class="flex items-center">
            <button id="toggleButton" data-collapse-toggle="navbar-default" type="button" class="md:hidden inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <img src="logo.png" alt="Logo" class="h-8 ml-4 md:ml-0" onclick="location.href = '/'"/>
        </div>
        @auth()
            <div class="hidden md:flex md:w-auto md:space-x-4" id="navbar-default">
                <ul class="flex items-center space-x-4">
                    <li><a href="{{ route('topup') }}" class="text-gray-600 hover:text-gray-900">Nạp tiền</a></li>
                    <li><a href="{{ route('profile') }}" class="text-gray-600 hover:text-gray-900">Tài khoản</a></li>
                    <li><a href="{{ route('level') }}" class="text-gray-600 hover:text-gray-900">Thưởng cấp</a></li>
                    <li><form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                        </form></li>

                </ul>
            </div>
        @endauth

        @guest()
            <form action="{{ route('login') }}">
                <div class="flex items-center space-x-4">
                    <button class="rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0">
                    Đăng Nhập
                    </span>
                    </button>
                </div>
            </form>
        @else
            <a class="text-gray-600 hover:text-gray-900">Welcome, {{ \Illuminate\Support\Facades\Auth::user()->username }} ({{ number_format(\Illuminate\Support\Facades\Auth::user()->balance) }}đ)</a>
        @endguest
    </nav>
{{--    <div class="flex items-center">--}}
{{--        <img src="logo.png" alt="Logo" class="h-8">--}}
{{--    </div>--}}


{{--    <div class="logAndres">--}}

{{--    </div>--}}

    <div class="md:hidden hidden" id="mobileMenu" style="
    border: 2px solid #f280b9ff;" >
        @auth()
        <ul class="flex flex-col items-center space-y-4">
            <li><a href="{{ route('topup') }}" class="text-gray-600 hover:text-gray-900">Top-up</a></li>
            <li><a href="{{ route('profile') }}" class="text-gray-600 hover:text-gray-900">Profile</a></li>
            <li><form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="text-gray-600 hover:text-gray-900" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                </form></li>
        </ul>
        @endauth
    </div>

    <script>
        const toggleButton = document.getElementById('toggleButton');
        const mobileMenu = document.getElementById('mobileMenu');
        toggleButton.addEventListener('click', function() {
            const isMenuOpen = mobileMenu.classList.contains('hidden');
            if (isMenuOpen) {
                mobileMenu.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
</header>
@endif
