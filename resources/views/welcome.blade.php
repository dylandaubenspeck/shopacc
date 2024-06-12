@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
@endsection
@section('content')
    <section class="header dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div style="color: rgb(237, 233, 225)" class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-white text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white" >
                    Lorem ipsum dolor sit amet</h1>
                <p class="max-w-2xl mb-6 font-light font-medium  text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400" style="color: rgb(237, 233, 225)  ">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo labore magnam voluptatibus quae
                    perspiciatis officiis? Nam molestias rerum harum. Fuga reprehenderit magni possimus modi eveniet
                    nemo! Eveniet quis ad sapiente?</p>

            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">

            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto py-8 z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 1 -->
            <div
                class=" mx-auto overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 hover:bright-outline">
                <div class="bg-white dark:bg-gray-800">
                    <div class="p-6 cardLeft">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Card Title</h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Lorem ipsum dolor sit amet, consectetur
                            adipiscing
                            elit. Integer vel molestie risus, eget tincidunt ligula.</p>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Type Acc</p>

                        <div class="typeAcc">
                            <button type="button" class="typeAcc_item text-white bg-red-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Purple</button>
                            <button type="button" class="typeAcc_item  text-white bg-red-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Purple</button>
                            <button type="button" class="typeAcc_item  text-white bg-red-700 hover:bg-purple-800 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Purple</button>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mx-auto overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition duration-300 transform hover:scale-105 hover:bright-outline">
                <div class="bg-white dark:bg-gray-800">
                    <div class="p-6  cardRight">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Card Title</h2>
                        <p class="mt-2 text-gray-600 dark:text-gray-300">Lorem ipsum dolor sit amet, consectetur
                            adipiscing
                            elit. Integer vel molestie risus, eget tincidunt ligula.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <section class="bg-white dark:bg-gray-900 trueIndex" >
        <div
            class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full"
                 src="https://preview.redd.it/ejqakw4uuns41.png?width=1920&format=png&auto=webp&s=7e228d4df99fbf8fa7019de1af80fdd10959723e"
                 alt="dashboard image">
            <div class="mt-4 md:mt-0">
                <h2 style="color: rgb(237, 233, 225)  " class=" mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Let's create more
                    tools and ideas that brings us together.</h2>
                <p style="color: rgba(237, 233, 225, 0.356)  " class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">Flowbite helps you connect with
                    friends and communities of people who share your interests. Connecting with your friends and family
                    as
                    well as discovering new ones is easy with features like Groups.</p>
                <button
                    class="rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span
                        class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0">
                        Đăng kí ngay
                    </span>
                </button>
            </div>
        </div>
    </section>

    <section
        class="bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 relative">
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Hệ thống trao quà theo cấp độ</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Here at
                Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and
                drive
                economic growth.</p>

            <ol class="items-center sm:flex">
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cấp 1</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web
                            components and interactive elements.</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cấp 5</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web
                            components and interactive elements.</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cấp 10</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web
                            components and interactive elements.</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center ">
                        <div
                            class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cấp 20</h3>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Get started with dozens of web
                            components and interactive elements.</p>
                    </div>
                </li>
            </ol>
        </div>

        <section class="bg-white dark:bg-gray-900 glare-border">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900 dark:text-white">
                        Bắt
                        đầu ngay hôm nay</h2>
                    <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Try Flowbite Platform for 30
                        days. No credit card required.</p>
                    <button
                        class="rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                        <span
                            class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0">
                            Đăng kí ngay
                        </span>
                    </button>
                </div>
            </div>
        </section>
    </section>
@endsection

@section('authJs')
    <script>
        $(document).ready(function (e) {

            $('.star-rating').each(function (e) {
                var startTime = performance.now()
                const starsAmount = $(this).attr('data-amount');
                for (let i = 0; i < starsAmount; i++) {
                    var star = ``;
                    star = `<svg class="h-5 w-5 fill-current text-yellow-500 my-auto" viewBox="0 0 24 24">
            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2M12 5V13L9.67 16.18L10.5 11.62L7.5 8.75L11.19 8.29L12 5Z" />
        </svg>`
                    $(this).append(star)
                }

                for (let i = 0; i < (5 - starsAmount); i++)
                {
                    var star = ``;
                    star = `        <svg class="h-5 w-5 fill-current text-gray-400 my-auto" viewBox="0 0 24 24">
            <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2M12 5V13L9.67 16.18L10.5 11.62L7.5 8.75L11.19 8.29L12 5Z" />
        </svg>`;
                    $(this).append(star)
                }

                $(this).append(`<span class="ml-2 text-gray-700 flex justify-center">${starsAmount}.0</span>`)
                var endTime = performance.now()
                console.log(`[debug] Khởi tạo trong ${Math.floor(endTime - startTime) / 100} mili giây.`)
            })
        })

        $('.actionBuy').click(function (e) {
            const productId = $(this).data('id')
            $('#confirmBuyButton').attr('data-productId', productId)
        })
        $('#confirmBuyButton').click(function (e) {
            const typeAcc = $(this).data('productid');
            $.ajax({
                url: "{{ route('buyOrder') }}",
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    productId: typeAcc
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    Swal.fire({
                        title: "Mua hàng thành công!",
                        text: data.data,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed && data.rateable !== false) {
                            location.reload()
                        }else{
                            window.location.href = '{{ route('feedbacks.create') }}';
                        }
                    });
                },
                error: function(error)
                {
                    data = error.responseJSON
                    msg = '';
                    switch (data.data)
                    {
                        case 'login':
                            msg = 'Vui lòng đăng nhập'
                            break;
                        case 'balance_not_enough':
                            msg = 'Không đủ số dư.'
                            break;
                        case 'product_not_available':
                            msg = 'Phân loại đã cháy hàng.'
                            break;
                        case 'product_not_found':
                            msg = 'Không tìm thấy sản phẩm.'
                            break;
                        default:
                            msg = data.data;
                            break;
                    }

                    toast('error', msg)
                }
            });
        })
    </script>
@endsection
