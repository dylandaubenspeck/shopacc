@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
@endsection
@section('content')
    @auth()
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Bạn có chắc muốn mua sản phẩm này?</h3>
                    <button id="confirmBuyButton" data-productId="" data-modal-hide="popup-modal" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Có
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Không</button>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <section class="header dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Lorem ipsum dolor sit amet</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo labore magnam voluptatibus quae
                    perspiciatis officiis? Nam molestias rerum harum. Fuga reprehenderit magni possimus modi eveniet
                    nemo! Eveniet quis ad sapiente?</p>

            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/489809172867113.648700e428a59.png"
                     alt="mockup">
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container mx-auto py-8 z-10">

        @php($listGroup = \App\Models\Categories::where('status', 1)->get())

        <div class="flex justify-center mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                @foreach($listGroup as $item)
                    <li class="me-2 text-center">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg @if($loop->index > 0) hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 @endif"
                            id="{{str_replace(' ', '_', $item->name) . '_' . $item->id}}-tab"
                            data-tabs-target="#{{str_replace(' ', '_', $item->name) . '_' . $item->id}}"
                            type="button" role="tab"
                            aria-controls="profile"
                            aria-selected="false">Region: <strong>{{ $item->name }}</strong></button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="default-tab-content">
            @foreach($listGroup as $item)
            @php($products = \App\Models\Products::where([['groupId', $item->id], ['status', 1]])->get())
            <div class="hidden gap-5 p-4 rounded-lg @if(count($products) > 0) flex justify-center grid justify-items-center grid-flow-col auto-cols-max @endif w-full md:w-2/4" id="{{str_replace(' ', '_', $item->name) . '_' . $item->id}}" role="tabpanel" aria-labelledby="{{str_replace(' ', '_', $item->name) . '_' . $item->id}}-tab">
                @if(count($products) > 0)
                    @foreach($products as $product)
                    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">{{ $product->productName }}</h5>
                        <div class="flex items-baseline text-gray-900 dark:text-white">
                            <span class="text-5xl font-extrabold tracking-tight">{{ number_format($product->productPrice) }}</span>
                            <span class="text-3xl font-semibold">đ</span>
                        </div>
                        <ul role="list" class="space-y-5 mt-7 mb-3">
                            <li class="flex items-center">
                                <svg class="flex-shrink-0 w-4 h-4 text-blue-700 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                <span class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 ms-3">{{ number_format(\App\Http\Controllers\UtilsController::countStock($product->stockName)['data']) }} account đang có sẵn.</span>
                            </li>
                        </ul>
                        @php($rating = \App\Models\Feedbacks::where('product', $product->id)->count())
                        @if($rating > 0)
                            @php($avgRate = \App\Models\Feedbacks::where('product', $product->id)->sum('stars'))
                            <div class="flex items-center mb-3 justify-center">
                                <div class="flex star-rating" data-amount="{{ floor($avgRate / $rating) }}">
                                </div>
                            </div>
                        @endif

                    @auth()
                        <button type="button"
                            @if(\App\Http\Controllers\UtilsController::countStock($product->stockName)['data'] > 0)
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center actionBuy" data-id="{{ $product->id }}" data-modal-target="popup-modal" data-modal-toggle="popup-modal">Mua ngay</button>
                                @else
                                    disabled=""
                                class="text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Đã hết hàng</button>
                            @endif
                        @else
                            <p class="text-center text-red-400">Vui lòng đăng nhập</p>
                        @endauth
                    </div>
                    @endforeach
                @else
                    <div class="w-1/2 mx-auto text-center   ">
                        Chưa có sản phẩm.
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    </main>

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full"
                 src="https://preview.redd.it/ejqakw4uuns41.png?width=1920&format=png&auto=webp&s=7e228d4df99fbf8fa7019de1af80fdd10959723e"
                 alt="dashboard image">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Let's create more
                    tools and ideas that brings us together.</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">Flowbite helps you connect with
                    friends and communities of people who share your interests. Connecting with your friends and family as
                    well as discovering new ones is easy with features like Groups.</p>
                <button onclick="location.href = '{{ route('register') }}'" class="rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                <span class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0">
                Đăng kí ngay
                </span>
                </button>
            </div>
        </div>
    </section>

    <section
        class="bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 relative">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Hệ thống trao quà theo cấp độ</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Here at
                Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive
                economic growth.</p>

            <div class="overflow-x-auto">
                <div class="flex items-center space-x-8 py-8 justify-center">
                @foreach(\App\Models\Levels::all() as $item)
                    <div class="relative w-52">
                        <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -ml-3 w-6 h-6 rounded-full bg-gray-500"></div>
                        <div class="bg-white p-4 rounded-lg shadow-md max-w-xs">
                            <h2 class="text-lg font-semibold">{{ $item->levelName }}</h2>
                            <p class="mt-2">Yêu cầu: {{ number_format($item->expNeeded) }} EXP</p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>

        <section class="bg-white dark:bg-gray-900 glare-border">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-sm text-center">
                    <h2 class="mb-4 text-4xl tracking-tight font-extrabold leading-tight text-gray-900 dark:text-white">Bắt
                        đầu ngay hôm nay</h2>
                    <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Try Flowbite Platform for 30
                        days. No credit card required.</p>
                    <button onclick="location.href = '{{ route('register') }}'" class="rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                <span class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0">
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
