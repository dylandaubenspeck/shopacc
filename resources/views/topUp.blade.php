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
    </style>
@endsection
@section('content')

    <div id="mainContent" class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="bg-imageLeft"></div>
        <div class="bg-imageRight"></div>

        <div class="mainContent1">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto w-96">
                    <form id="topupForm" action="#">
                        <label for="cars" class="block text-gray-700">Vui lòng chọn mệnh giá:</label>
                        <select id="cars" name="menhGia"
                                class="block w-full mt-1 py-2 px-3 border rounded-md shadow-sm bg-white focus:outline-none focus:border-indigo-500">
                            @foreach(explode(',', \App\Http\Controllers\UtilsController::getSetting('topupRange')['data']) as $item)
                                <option value="{{ $loop->index	 }}">{{ number_format($item) }}</option>
                            @endforeach
                        </select>

                        <button
                            class="w-full h-12 px-6 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800 mt-6" id="submitBtn">
                            Tạo Mã QR
                        </button>
                    </form>
                </div>
        </div>

        <div id="contentChildTwo" style="display: none" class="maincontent2">
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div id="qrCode" class="flex justify-center items-center"></div>
                <div class="mt-6">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white text-center my-3">Thông tin chuyển khoản</h5>
                    <p class="text-center text-sm text-gray-500 truncate dark:text-gray-400">
                        ( Bấm vào thông tin để copy )
                    </p>
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate dark:text-white">
                                        Ngân hàng
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    MB Bank
                                </div>
                            </div>
                        </li>

                            <li class="py-3 sm:py-4">
                                <div class="flex items-center">

                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray truncate dark:text-white">
                                            Số tiền
                                        </p>

                                    </div>
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white copyable" id="sotien">
                                    </div>
                                </div>
                            </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate dark:text-white">
                                        Tên TK:
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white copyable" id="tentk">
                                </div>
                            </div>
                        </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        Số TK:
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white copyable" id="sotk">
                                </div>
                            </div>
                        </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate dark:text-white">
                                        Nội dung:
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white copyable" id="noidung">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h5 class="text-xl font-bold leading-none text-red-400 dark:text-white text-center my-3">Lưu ý!</h5>
                    <ul>
                        <li>- Đây là hệ thống tự động.</li>
                        <li>- Không chịu trách nhiệm khi chuyển nhiều/ít hơn số tiền.</li>
                        <li>- Giao dịch được giới hạn trong <b id="timer">05:00</b>, qua thời gian vui lòng không chuyển khoản vào thông tin trên.</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
    <!-- Main Content QR-->
@endsection

@section('javascript')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
        integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
    <script src="https://alecrios.github.io/image-zoom-js/demo/js/image-zoom.js"></script>
    <script>
        $(document).ready(function () {
            var timeInSeconds = 300;
            function updateTimer() {
                var minutes = Math.floor(timeInSeconds / 60);
                var seconds = timeInSeconds % 60;
                var formattedMinutes = String(minutes).padStart(2, '0');
                var formattedSeconds = String(seconds).padStart(2, '0');
                $('#timer').text(formattedMinutes + ':' + formattedSeconds);
            }

            function startCountdown() {
                updateTimer();
                var timerInterval = setInterval(function() {
                    timeInSeconds--;
                    updateTimer();
                    if (timeInSeconds <= 0) {
                        clearInterval(timerInterval);
                        location.reload()
                    }
                }, 1000);
            }
            const generateQrCode = (url) => {
                const qr = new QRCode(document.getElementById("qrCode"), {
                    text: url,
                    width: 200,
                    height: 200,
                });
            };
            function formatCurrency(number) {
                var formattedNumber = parseFloat(number).toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                return formattedNumber;
            }
            $(".copyable").click(function(e){
                const old = $(this).html();
                navigator.clipboard.writeText(($(this).html()).replace(/,/g, ''))
                    .then(function() {
                        toast('success', 'Đã copy "' + $(this).html() + '" !')
                    })
                    .catch(function(err) {
                        console.error('Failed to copy HTML: ', err);
                    });

                toast('success', 'Đã copy "' + $(this).html() + '"')
            });
            $('#submitBtn').click(function (e) {
                e.preventDefault();
                const menhGia = $('select[name="menhGia"]').val();
                $(this).attr('disabled', '')
                $(this).html('Vui lòng đợi')
                $.ajax({
                    url: "{{ route('topup.create') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        amount: menhGia
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('.mainContent1').hide();
                        data = data.data
                        generateQrCode(data.qr)
                        $('#qrCode').addClass('object-cover max-w-full max-h-full')
                        $('#tentk').html(data.name)
                        $('#sotk').html(data.number)
                        $('#noidung').html(data.description)
                        $('#sotien').html(formatCurrency(data.amount))
                        $('.maincontent2').fadeIn();
                        startCountdown();
                    }
                });
            })
        })
    </script>
@endsection

