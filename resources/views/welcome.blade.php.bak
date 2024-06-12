@extends('layouts.guest')
@section('head')
@endsection
@section('content')
    @auth()
        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500">Bạn có chắc muốn mua sản phẩm này?</h3>
                        <button id="confirmBuyButton" data-productId="" data-modal-hide="popup-modal" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Có
                        </button>
                        <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Không</button>
                    </div>
                </div>
            </div>
        </div>
    @endauth
    <section>
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <div class="relative overflow-hidden rounded-lg md:h-96">
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/ab68d3eb-2c7b-4ce7-844b-9b8810bc7187/dg2t1e4-b1b23922-bbc5-4ef5-a6b8-92abf0d3ea66.png/v1/fill/w_1280,h_427,q_80,strp/valorant_header__by_1ndosama_dg2t1e4-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NDI3IiwicGF0aCI6IlwvZlwvYWI2OGQzZWItMmM3Yi00Y2U3LTg0NGItOWI4ODEwYmM3MTg3XC9kZzJ0MWU0LWIxYjIzOTIyLWJiYzUtNGVmNS1hNmI4LTkyYWJmMGQzZWE2Ni5wbmciLCJ3aWR0aCI6Ijw9MTI4MCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS5vcGVyYXRpb25zIl19.rNxejKnza-uXYr2l29VjgMmBRh5FzKyqc1jj7RNE0_Y" class="absolute block w-full " />
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            </div>

        </div>
    </section>

    <main class="w-full p-8 z-10" style="background-color: #ece8e1 ">
        <div class="flex  justify-center mx-auto my-6">
            <div class="text-center">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-blue-600 headerFont">
                    ACCOUNT RANDOM
                </h1>
                <p class="max-w-2xl mb-6 font-bold text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Đa dạng và đến từ nhiều vùng khác nhau</p>
            </div>
        </div>

        @php($listGroup = \App\Models\Categories::where('status', 1)->get())

        <div class="flex justify-center mb-4">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                @foreach($listGroup as $item)
                    <li class="me-2 text-center">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg @if($loop->index > 0) hover:text-blue-600 hover:border-blue-300 @endif"
                            id="{{str_replace(' ', '_', $item->name) . '_' . $item->id}}-tab"
                            data-tabs-target="#{{str_replace(' ', '_', $item->name) . '_' . $item->id}}"
                            type="button" role="tab"
                            aria-controls="profile"
                            aria-selected="false">Region: <strong>{{ $item->name }}</strong></button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="default-tab-content" class="flex justify-center">
            @foreach($listGroup as $item)
                @php($products = \App\Models\Products::where([['groupId', $item->id], ['status', 1]])->get())
                <div class="hidden gap-5 p-4 rounded-lg @if(count($products) > 0) grid grid-cols-1 xl:grid-flow-col xl:auto-cols-fr	 gap-5 p-4 @endif w-full md:w-2/4" id="{{str_replace(' ', '_', $item->name) . '_' . $item->id}}" role="tabpanel" aria-labelledby="{{str_replace(' ', '_', $item->name) . '_' . $item->id}}-tab">
                    @if(count($products) > 0)
                        @foreach($products as $product)
                            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8">
                                <h5 class="mb-4 text-xl font-medium text-gray-500 ">{{ $product->productName }}</h5>
                                <div class="flex items-baseline text-gray-900 ">
                                    <span class="text-5xl font-bold tracking-tight">{{ number_format($product->productPrice) }}</span>
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
                                    class="text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Đã hết hàng</button>
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

    <section style='
    background-color: #3b82f6;
    background-image: linear-gradient(to bottom, rgb(181,209,255) 0%,rgba(0,0,0,0.6) 100%), url("https://preview.redd.it/help-need-grid-lines-gone-v0-ujtagkb2j6z91.png?width=640&crop=smart&auto=webp&s=19bb4f9fe1cf0b24af31b5e08d0723f1fac9e974");
    background-repeat: repeat;
    '>
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-1/2 mt-8 md:mt-0 px-4 md:px-0">
                <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/aae3d9179794175.650016f95ffe4.png" alt="Slider Image" class="mx-auto hidden md:block">
            </div>
            <div class="w-full md:w-1/2 px-4 md:px-0">
                <div class="mx-3 p-5">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 headerFont" style="color: #ece8e1 !important; text-transform: uppercase">Hệ thống Daily Drop đặc biệt</h2>
                    <h5 class="my-5 font-bold" style="color: #ece8e1 !important">SÁNG TẠO LÀ VŨ KHÍ TỐI THƯỢNG CỦA BẠN</h5>
                    <p class="font-light" style="color: #ece8e1 !important"><span class="shadow-2xl">Ngoài việc trang bị súng đạn, hãy chọn cho riêng mình một Đặc Vụ có kỹ năng phù hợp với lối chơi của bạn để giúp bạn tỏa sáng trong nhẫn màn đấu súng khốc liệt tại VALORANT. </span></p>
                    <div class="flex justify-center">
                        <div class="mx-auto md:flex items-center md:gap-8 py-8 justify-items-center">
                            @foreach(\App\Models\Levels::orderBy('expNeeded', 'asc')->take(3)->get() as $item)
                                <div class="relative w-52 mx-auto md:mx-0 shadow-2xl">
                                    <div class="absolute left-0 top-1/2 transform -translate-y-1/2 -ml-3 w-6 h-6 rounded-full" style="background-color: #ece8e1 !important;"></div>
                                    <div class="bg-white p-4 rounded-lg shadow-md max-w-xs">
                                        <h2 class="text-lg font-semibold">{{ $item->levelName }}</h2>
                                        <p class="mt-2 font-semibold">Yêu cầu: <span class="text-blue-600">{{ number_format($item->expNeeded) }} EXP</span></p>
                                        <p class="mt-2 text-sm">Nhận được: {{ \App\Models\Products::where('stockName', $item->stockName)->first()->productName }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style='background-color: #ece8e1;
        background-image: linear-gradient(to top, rgba(149,149,149,0.56) 0%,rgba(0,0,0,0.6) 100%), url("https://static.vecteezy.com/system/resources/previews/028/080/497/original/3d-room-perspective-grid-background-png.png");
    background-repeat: no-repeat;
    background-position: center;
    '>
        <div class="flex flex-wrap items-center">

            <div class="w-full md:w-1/2 px-4 md:px-0 p-10">
                <div class="mx-3 p-10">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 headerFont" style="color: #ece8e1 !important; text-transform: uppercase">BẢN ĐỒ CỦA BẠN
                    </h2>
                    <h5 class="my-5 font-bold" style="color: #ece8e1 !important">CHIẾN ĐẤU KHẮP THẾ GIỚI
                    </h5>
                    <p class="font-light" style="color: #ece8e1 !important"><span>
Mỗi bản đồ đều là một sân chơi để bạn thỏa sức thể hiện tư duy sáng tạo của mình. Được xây dựng với mục đích phát triển chiến lược đội nhóm, các bản đồ VALORANT hứa hẹn mang đến cho người chơi những trận giao tranh ngoạn ngục cùng với muôn vàn khoảnh khắc xuất thần. Hãy là nguồn cảm hứng cho tất cả người chơi VALORANT và tạo ra cho mình lối chơi độc nhất vô nhị.

                        </span></p>
                </div>
            </div>

            <div class="w-full md:w-1/2 mt-8 md:mt-0 px-4 md:px-0">
                <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_3840/15703b179794175.650016f952ff0.png" alt="Slider Image" class="mx-auto">
            </div>
        </div>
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
