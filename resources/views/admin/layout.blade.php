<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="./img/fav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" type="text/css" href="{{ asset('/admin/css/style.css') }}">
    <title>Welcome To Cleopatra</title>
    <meta name="csrf-token" content="{{csrf_token() }}"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body class="bg-gray-100">


<!-- start navbar -->
<div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">

    <!-- logo -->
    <div class="flex-none w-56 flex flex-row items-center">
        <img src="img/logo.png" class="w-10 flex-none">
        <strong class="capitalize ml-1 flex-1">cleopatra</strong>

        <button id="sliderBtn" class="flex-none text-right text-gray-900 hidden md:block">
            <i class="fad fa-list-ul"></i>
        </button>
    </div>
    <!-- end logo -->

    <!-- navbar content toggle -->
    <button id="navbarToggle" class="hidden md:block md:fixed right-0 mr-6">
        <i class="fad fa-chevron-double-down"></i>
    </button>
    <!-- end navbar content toggle -->

    <!-- navbar content -->
    <div id="navbar" class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center">
        <!-- left -->
        <div class="text-gray-600 md:w-full md:flex md:flex-row md:justify-evenly md:pb-10 md:mb-10 md:border-b md:border-gray-200">
        </div>
        <!-- end left -->

        <!-- right -->
        <div class="flex flex-row-reverse items-center">

            <!-- user -->
            <div class="dropdown relative md:static">

                <button class="menu-btn focus:outline-none focus:shadow-outline flex flex-wrap items-center">
                    <div class="w-8 h-8 overflow-hidden rounded-full">
                        <img class="w-full h-full object-cover" src="img/user.svg" >
                    </div>

                    <div class="ml-2 capitalize flex ">
                        <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{ \Illuminate\Support\Facades\Auth::user()->username }}</h1>
                        <i class="ml-2 fa-solid fa-caret-down"></i>
                    </div>
                </button>

                <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

                <div class="text-gray-500 menu hidden md:mt-10 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 animated faster">

                    <!-- item -->
                    <a href="/" class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="#">
                        <i class="fa-solid fa-sitemap mr-1"></i>
                        trở về website chính
                    </a>
                    <!-- end item -->

                    <hr>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-400 px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-red-900 transition-all duration-300 ease-in-out" href="#">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i>
                            đăng xuất
                        </a>
                    </form>
                    <!-- item -->

                    <!-- end item -->

                </div>
            </div>
            <!-- end user -->


        </div>
        <!-- end right -->
    </div>
    <!-- end navbar content -->

</div>
<!-- end navbar -->


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    <!-- start sidebar -->
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">


        <!-- sidebar content -->
        <div class="flex flex-col">

            <!-- sidebar toggle -->
            <div class="text-right hidden md:block mb-4">
                <button id="sideBarHideBtn">
                    <i class="fad fa-times-circle"></i>
                </button>
            </div>
            <!-- end sidebar toggle -->

            <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Thông tin chung</p>

            <!-- link -->
            <a href="{{ route('admin.index') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-house mr-3"></i>
                Trang chủ
            </a>

            <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Mặt hàng</p>

            <a href="{{ route('admin.index') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-boxes-stacked mr-3"></i>
                Vùng (Region)
            </a>

            <a href="{{ route('admin.products') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-box mr-3"></i>
                Sản phẩm
            </a>

            <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Thanh toán</p>

            <a href="{{ route('admin.orders') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-file-invoice-dollar mr-3"></i>
                Đơn hàng
            </a>

            <a href="{{ route('admin.accounts') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-table-cells mr-3"></i>
                Accounts
            </a>

            <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Nạp tiền</p>

            <a href="{{ route('admin.topup') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-credit-card mr-3"></i>
                Chuyển khoản
            </a>

            <a href="{{ route('admin.index') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">

                <i class="fa-solid fa-sim-card mr-3"></i>
                Thẻ cào
            </a>

            <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Cài đặt khác</p>

            <a href="{{ route('admin.levels') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-wand-sparkles mr-3"></i>
                Cấp bậc
            </a>

            <a href="{{ route('admin.index') }}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fa-solid fa-code mr-3"></i>
                Cấu hình website
            </a>
        </div>
        <!-- end sidebar content -->

    </div>
    <!-- end sidbar -->

    <div class="bg-gray-100 flex-1 p-6 md:mt-16">
        @yield('content')
    </div>
</div>
<!-- end content -->

</div>
<!-- end wrapper -->

<!-- script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('/admin/js/scripts.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    function shootToast(type, message)
    {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: type,
            title: message
        });
    }
</script>
@yield('javascript')
<!-- end script -->

</body>
