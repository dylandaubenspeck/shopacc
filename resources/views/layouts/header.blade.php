@php($links = [
    "Trang chủ" => [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
  <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
</svg>
',
        "route" => "home",
        "new" => false
    ],
    "Daily Drop" => [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M9.375 3a1.875 1.875 0 0 0 0 3.75h1.875v4.5H3.375A1.875 1.875 0 0 1 1.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0 1 12 2.753a3.375 3.375 0 0 1 5.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 1 0-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3ZM11.25 12.75H3v6.75a2.25 2.25 0 0 0 2.25 2.25h6v-9ZM12.75 12.75v9h6.75a2.25 2.25 0 0 0 2.25-2.25v-6.75h-9Z" />
</svg>
',
        "route" => "level",
        "new" => false
],
    "Market" => [
        "icon" => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
  <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
</svg>
',
        "route" => "",
        "new" => false
],
"Hỗ trợ" => [
    "icon" => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
</svg>',
    "route" => "ticket.list",
    "new" => false
]
])
<header
    class="sticky top-0 left-0 z-[1100] w-full backdrop-blur  border-bottom flex items-center justify-between px-4 py-2 glare-border z-50">
    <div class="flex gap-8 items-center">
        <img src="/img/logoV.png" alt="Logo" class="h-8">
        @foreach($links as $key => $item)
            <a class="@if(request()->routeIs($item['route'])) text-red-400 @else text-white @endif  item_header  font-bold " href="{{ !empty($item['route']) ? route($item['route']) : '#' }}">
                @if(!empty($item['icon']))
                    <span class="flex justify-center @if($item['new']) browtf @endif">
                    {!! str_replace('w-6 h-6', 'w-4 h-4 my-auto', $item['icon'])  !!}
                    <span class="my-auto ml-3">{{ $key }}</span>
                </span>
                @else
                    {{ $key }}
                @endif
            </a>
        @endforeach
    </div>


    @guest
        <div class="logAndres ">
            <form action="{{ route('register') }}">
                <div class="flex  gap-6 items-center space-x-4 ">
                    <button type="submit" class="login text-black bg-white hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800  dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-1.5 text-center me-2 mb-2">ĐĂNG KÝ</button>
                </div>
            </form>
            <form action="{{ route('login') }}">
                <div class="flex items-center space-x-4">
                    <button type="submit" class="register text-black bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-1.5 text-center me-2 mb-2">ĐĂNG NHẬP</button>
                </div>
            </form>
        </div>
    @else
        <div class="logAndres mx-5">
            <button class="flex items-center" data-dropdown-toggle="dropdownAvatarName" data-dropdown-delay="0">
                <img class="w-10 h-10 rounded-full mr-4" src="https://cdnb.artstation.com/p/assets/images/images/051/262/665/large/kethaka-vidyananda-3.jpg?1656869285" alt="Avatar of Jonathan Reinink">
                <div class="text-sm">
                    <p class="text-white leading-none">{{ Auth::user()->username }}</p>
                    <p class="text-red-400">{{ number_format(Auth::user()->balance) }} VND</p>
                </div>
            </button>
        </div>

        <div id="dropdownAvatarName" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
            @if(Auth::user()->admin)
                <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    <div class="truncate rainbow_text_animated">
                        <a href="{{ route('admin.index') }}"> admin panel</a>
                    </div>
                </div>
            @endif
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                <li>
                    <a href="{{ route('topup') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Nạp tiền</a>
                </li>
                <li>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tài khoản</a>
            </ul>
            <div class="py-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                       href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Đăng xuất
                    </a>
                </form>
            </div>
        </div>
    @endguest
</header>
