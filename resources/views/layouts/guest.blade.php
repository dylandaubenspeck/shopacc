<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <meta name="csrf-token" content="{{csrf_token() }}"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <style>
        @import url(https://fonts.googleapis.com/css?family=Anton|Black+Han+Sans|Kanit:700|Noto+Sans+HK:900|Noto+Sans+JP:700|Noto+Sans+SC:700|Noto+Sans+TC:700|Oswald:700&display=swap&subset=chinese-hongkong,chinese-simplified,chinese-traditional,cyrillic,japanese,korean,thai,vietnamese);
        @font-face {
            font-family: 'Neue Frutiger';
            src: local('Neue Frutiger World Regular'), local('Neue-Frutiger-World-Regular'),
            url('{{ asset('/css/NeueFrutigerWorld-Regular.woff2') }}') format('woff2'),
            url('{{ asset('/css/NeueFrutigerWorld-Regular.woff') }}') format('woff'),
            url('{{ asset('/css/NeueFrutigerWorld-Regular.ttf') }}') format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        * {
            font-family: 'Neue Frutiger', serif;
        }

        .headerFont {

            font-size: 7rem;
            line-height: 1.3;

            font-family: Anton, sans-serif;

            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            letter-spacing: .08em !important;
        }

        #header.blurred {
            backdrop-filter: blur(10px) !important;
            transition: all 0.3s !important;
            background-color: transparent !important;
            border-bottom: #0f1923 1px solid;
        }

        @keyframes textShine {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        .browtf {
            background: linear-gradient(
                to right,
                #7953cd 20%,
                #00affa 30%,
                #0190cd 70%,
                #764ada 80%
            );
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-fill-color: transparent;
            background-size: 500% auto;
            animation: textShine 5s ease-in-out infinite
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/smooth-scrollbar@latest/dist/smooth-scrollbar.css">
    <script src="https://unpkg.com/smooth-scrollbar@latest/dist/smooth-scrollbar.js"></script>
    @yield('head')
</head>

<body class="font-sans bg-gray-100" id="bodyScrollbar">
@include('layouts.header')

@yield('content')
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // window.addEventListener('scroll', function() {
    //     var header = document.getElementById('header');
    //     if (window.scrollY > 0) {
    //         header.classList.add('blurred');
    //     } else {
    //         header.classList.remove('blurred');
    //     }
    // });
    // Burger menus
    document.addEventListener('DOMContentLoaded', function() {
        Scrollbar.initAll(document.querySelector('#bodyScrollbar'),  {
            damping: 0.09
        });
        // open
        const burger = document.querySelectorAll('.navbar-burger');
        const menu = document.querySelectorAll('.navbar-menu');

        if (burger.length && menu.length) {
            for (var i = 0; i < burger.length; i++) {
                burger[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }

        // close
        const close = document.querySelectorAll('.navbar-close');
        const backdrop = document.querySelectorAll('.navbar-backdrop');

        if (close.length) {
            for (var i = 0; i < close.length; i++) {
                close[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }

        if (backdrop.length) {
            for (var i = 0; i < backdrop.length; i++) {
                backdrop[i].addEventListener('click', function() {
                    for (var j = 0; j < menu.length; j++) {
                        menu[j].classList.toggle('hidden');
                    }
                });
            }
        }
    });

    function toast(type, msg, stuck = false)
    {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: stuck ? 9999999 : 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: type,
            title: msg
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
@yield('javascript')
@auth()
    @yield('authJs')
@endauth
</body>
</html>

