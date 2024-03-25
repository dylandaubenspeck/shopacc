@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="https://alecrios.github.io/image-zoom-js/demo/css/image-zoom.css">
    <style>
        input {
            border-color: #ff9494ff;

            box-shadow: 0 0 0 2px #ff9494ff;

        }

        #mainContent {

            display: flex;
            flex-direction: colum;
            justify-content: center;
            background: linear-gradient(rgba(255, 163, 163, 0.3), rgb(243, 244, 246)), url(https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg);
        }

        .childContent {
            display: flex;
            flex-direction: column;
        }


        .leftContent {
            margin-right: 20px;
            background-color: rgb(252, 252, 252);
            width: 500px;
            max-height: 700px;
            text-align: center;

        }

        .rightContent {
            margin-left: 20px;
            background-color: rgb(252, 252, 252);
            width: 500px;
            height: 700px;
            text-align: left;

        }

        .content {
            /* margin-right: 60px; */
            border-radius: 10px;
            border: 3px solid #ff9494ff;
            margin-top: 40px;
            margin-bottom: 45px;
            opacity: 0;
            animation: fadeIn 1.5s ease forwards;

        }

        .stk,
        .bankMess,
        .typeBank {
            margin-top: 40px;
            margin-left: 40px;
        }

        .typeBank {
            margin-top: 100px;
        }

        .qr {
            margin-top: 59px;
            border: 3px solid rgb(163, 77, 77);
        }

        .step {
            margin-top: 25px;
        }

        .bg-imageLeft {
            background-image: url('img/owen.png');
            background-size: cover;
            background-position: center;
            transform: translateX(-10%);
            position: absolute;
            top: 0;
            left: 0;
            width: 30%;
            height: 100%;
            z-index: -1;
        }

        .bg-imageRight {
            background-image: url('img/chammbar.png');
            background-size: cover;
            transform: translateX(240%);
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 27%;
            height: 100%;
            z-index: -2;
        }

        #contentChild {
            justify-content: space-around;
            display: flex;
        }

        @media (max-width: 800px) {
            .backimg {
                visibility: hidden;
            }

            .copy {
                scale: 0.8;
            }

            .content {
                margin: 0;
                margin-top: 10px;
                width: 100%;
            }

            #contentChild {
                margin: 0;
                flex-direction: column;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px); /* Di chuyển form lên trên một chút */
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media screen and (min-width: 35em) {
            .gl-star-rating .gl-star-rating--stars > span {
                --gl-star-size: 40px;
            }

            .gl-star-rating .gl-star-rating--stars[aria-label]:after {
                --gl-tooltip-padding: 0.75em 1em;
            }
        }

        @media screen and (min-width: 42em) {
            .gl-star-rating .gl-star-rating--stars > span {
                --gl-star-size: 46px;
            }
        }

        @media screen and (min-width: 50em) {
            .gl-star-rating .gl-star-rating--stars > span {
                --gl-star-size: 52px;
            }
        }

        .gl-star-rating .gl-emote-bg {
            transition: fill 0.15s ease-in-out;
        }

        .gl-star-rating [data-value]:not(.gl-active) .gl-emote-bg {
            fill: #dcdce6;
        }

        .gl-star-rating .gl-emote {
            transform: scale(0.9);
            transition: transform 0.25s ease-in-out;
        }

        .gl-star-rating .gl-selected .gl-emote {
            transform: scale(1.1);
        }

        .gl-star-rating--stars::after, .gl-star-rating--stars::before {
            display: none;
        }
    </style>
    <link rel="stylesheet" href="https://pryley.github.io/star-rating.js/dist/star-rating.min.css?ver=4.3.0">
@endsection
@section('content')
    <div id="mainContent" class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="bg-imageLeft"></div>
        <div class="bg-imageRight"></div>

        <div class="mainContent1">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto w-96">
                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white text-center">
                    Đánh giá khách hàng
                </h5>
                <form method="POST" action="{{ route('feedbacks.create.post') }}" id="postform">
                    @csrf
                    <div class="flex justify-center my-3">
                    <span class="gl-star-rating">
                    <select id="glsr-prebuilt" class="star-rating" name="stars">
                        <option value="">Select a rating</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                    <span class="gl-star-rating--stars" role="tooltip" data-rating="0" aria-label="Select a Rating">
                        <span data-value="1" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                           class="gl-emote" style="pointer-events: none;"><circle
                                    class="gl-emote-bg" fill="#FFA98D" cx="12" cy="12" r="10"></circle><path
                                    fill="#393939"
                                    d="M12 14.6c1.48 0 2.9.38 4.15 1.1a.8.8 0 01-.79 1.39 6.76 6.76 0 00-6.72 0 .8.8 0 11-.8-1.4A8.36 8.36 0 0112 14.6zm4.6-6.25a1.62 1.62 0 01.58 1.51 1.6 1.6 0 11-2.92-1.13c.2-.04.25-.05.45-.08.21-.04.76-.11 1.12-.18.37-.07.46-.08.77-.12zm-9.2 0c.31.04.4.05.77.12.36.07.9.14 1.12.18.2.03.24.04.45.08a1.6 1.6 0 11-2.34-.38z"></path></svg></span>
                        <span data-value="2" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                           class="gl-emote" style="pointer-events: none;"><circle
                                    class="gl-emote-bg" fill="#FFC385" cx="12" cy="12" r="10"></circle><path
                                    fill="#393939"
                                    d="M12 14.8c1.48 0 3.08.28 3.97.75a.8.8 0 11-.74 1.41A8.28 8.28 0 0012 16.4a9.7 9.7 0 00-3.33.61.8.8 0 11-.54-1.5c1.35-.48 2.56-.71 3.87-.71zM15.7 8c.25.31.28.34.51.64.24.3.25.3.43.52.18.23.27.33.56.7A1.6 1.6 0 1115.7 8zM8.32 8a1.6 1.6 0 011.21 2.73 1.6 1.6 0 01-2.7-.87c.28-.37.37-.47.55-.7.18-.22.2-.23.43-.52.23-.3.26-.33.51-.64z"></path></svg></span>
                        <span data-value="3" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                           class="gl-emote" style="pointer-events: none;"><circle
                                    class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path
                                    fill="#393939"
                                    d="M15.33 15.2a.8.8 0 01.7.66.85.85 0 01-.68.94h-6.2c-.24 0-.67-.26-.76-.7-.1-.38.17-.81.6-.9zm.35-7.2a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                        <span data-value="4" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                           class="gl-emote" style="pointer-events: none;"><circle
                                    class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path
                                    fill="#393939"
                                    d="M15.45 15.06a.8.8 0 11.8 1.38 8.36 8.36 0 01-8.5 0 .8.8 0 11.8-1.38 6.76 6.76 0 006.9 0zM15.68 8a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                        <span data-value="5" class=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                           class="gl-emote" style="pointer-events: none;"><circle
                                    class="gl-emote-bg" fill="#FFD885" cx="12" cy="12" r="10"></circle><path
                                    fill="#393939"
                                    d="M16.8 14.4c.32 0 .59.2.72.45.12.25.11.56-.08.82a6.78 6.78 0 01-10.88 0 .78.78 0 01-.05-.87c.14-.23.37-.4.7-.4zM15.67 8a1.6 1.6 0 011.5 1.86A1.6 1.6 0 1115.68 8zM8.32 8a1.6 1.6 0 011.21 2.73A1.6 1.6 0 118.33 8z"></path></svg></span>
                    </span>
                </span>
                    </div>
                    <div>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ý kiến
                            của bạn</label>
                        <textarea name="message" id="message" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="Sẽ lên tv đó, bạn ghi hay vào nhé!"></textarea>
                    </div>

                    <div class="my-3">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sản
                            phẩm bạn thích nhất</label>
                        <select id="countries" name="product"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="all">Đánh giá chung</option>
                            @foreach(\App\Models\Products::where('status', 1)->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->productName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" id="pleasesubmit"
                            class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                        Thêm đánh giá
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('authJs')
    <script src="https://pryley.github.io/star-rating.js/dist/star-rating.min.js?ver=4.3.0"></script>
    <script>
        var starratingPrebuilt = new StarRating('.star-rating', {
            prebuilt: true,
            maxStars: 5,
        });

        $('#postform').submit(function (e) {
            e.preventDefault();
            $('button[type=submit]').attr('disabled', 'true')
            var formData = $(this).serialize(); // Serialize form data

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                success: function (response) {
                    // Handle the response
                    if (response.status == 1) {
                        toast('success', 'Thêm đánh giá thành công!')
                        setTimeout(function () {
                            window.location.href = '{{ route('home') }}';
                        }, 1000)
                    } else {
                        toast('error', response.data)
                    }
                },
                error: function (xhr, status, error) {
                    toast('error', error)
                }
            });
        });
    </script>
@endsection
