<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
</head>
<body>
    <nav class="sticky top-0 left-0 z-[1100] w-full backdrop-blur bg-white/50 border border-bottom flex items-center justify-between px-4 py-2 glare-border z-50">
        <div class="flex items-center">
            <button id="toggleButton" data-collapse-toggle="navbar-default" type="button" class="md:hidden inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
            <img src="logo.png" alt="Logo" class="h-8 ml-4 md:ml-0" />
        </div>
        <div class="hidden md:flex md:w-auto md:space-x-4" id="navbar-default">
            <ul class="flex items-center space-x-4">
                <li><a href="#" class="text-gray-600 hover:text-gray-900">Link 1</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-900">Link 2</a></li>
                <li><a href="#" class="text-gray-600 hover:text-gray-900">Link 3</a></li>
            </ul>
        </div>
        <form action="/ShopAccValorant/Login.html">
            <div class="flex items-center space-x-4">
                <button class="md:hidden rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0">Đăng Nhập</span>
                </button>
            </div>
        </form>
    </nav>

    <div class="md:hidden hidden" id="mobileMenu" style="
    border: 2px solid #f280b9ff;" > 
        <ul class="flex flex-col items-center space-y-4">
            <li><a href="#" class="text-gray-600 hover:text-gray-900">Link 1</a></li>
            <li><a href="#" class="text-gray-600 hover:text-gray-900">Link 2</a></li>
            <li><a href="#" class="text-gray-600 hover:text-gray-900">Link 3</a></li>
        </ul>
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
</body>
</html>
