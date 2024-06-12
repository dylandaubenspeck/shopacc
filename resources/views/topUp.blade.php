@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/toup.css') }}">
@endsection
@section('content')
    @php($thecao = ['Viettel', 'Mobifone', 'Vinaphone', 'Vietnammobile', 'GATE', 'ZING'])
    @php($menhGia = [10000, 20000, 30000, 50000, 100000, 200000, 300000, 500000, 1000000])
    <div id="mainContent" class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="">
                <div style="height: 55-p;" class="bg-white p-6  shadow-lg max-w-md mx-auto w-96">
                    <form action="{{ route('topup.createThecao') }}" method="POST">
                        @csrf
                        <label for="cars" class="block text-gray-700">Vui lòng chọn mệnh giá:</label>
                        <select id="cars" name="thecaoMenhgia"
                                class="block w-full mt-1 py-2 px-3 border rounded-md shadow-sm bg-white focus:outline-none focus:border-indigo-500"
                                style="margin-top: 10px;">
                            @foreach ($menhGia as $item)
                                <option value="{{ $item }}">{{ number_format($item) }}đ</option>
                            @endforeach
                        </select>

                        <label for="cars" class="block text-gray-700 mt-4">Loại thẻ:</label>

                        <select style="outline: none;" id="card"
                                name="thecaoLoaithe"
                                class="block w-full mt-1 py-2 px-3 border rounded-md shadow-sm bg-white focus:outline-none focus:border-indigo-500"
                                style="margin-top: 10px;">
                            @foreach ($thecao as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                        <div>
                            <input id="IdCard" placeholder="Seri "
                                   name="thecaoSeri"
                                   class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100"
                                   type="text">
                            <input id="IdCard" placeholder="Mã thẻ"
                                   name="thecaoMathe"
                                   class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100"
                                   type="text">
                        </div>

                        <button style=" background-color:rgb(255, 69, 84) ;" type="submit"
                                class=" custom-button w-full h-12 px-6 text-white transition-colors duration-150  rounded-lg focus:shadow-outline hover:bg-blue-700 mt-6">
                        <span class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-6 h-6 my-auto">
                                <path fill-rule="evenodd"
                                      d="M3 4.875C3 3.839 3.84 3 4.875 3h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 9.375v-4.5ZM4.875 4.5a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875.375c0-1.036.84-1.875 1.875-1.875h4.5C20.16 3 21 3.84 21 4.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5a1.875 1.875 0 0 1-1.875-1.875v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75A.75.75 0 0 1 6 7.5v-.75Zm9.75 0A.75.75 0 0 1 16.5 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM3 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.035-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 19.125v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875-.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM6 16.5a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm9.75 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm-3 3a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Z"
                                      clip-rule="evenodd" />
                            </svg>
                            <span class="my-auto ml-2">Gửi mã thẻ cào</span>
                        </span>
                        </button>
                    </form>

                    <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded md:my-10 dark:bg-gray-700">

                    <form id="topupForm">
                        <label for="cars" class="block text-gray-700">Vui lòng chọn mệnh giá:</label>
                        <select id="cars" name="menhGia"
                                class="block w-full mt-1 py-2 px-3 border rounded-md shadow-sm bg-white focus:outline-none focus:border-indigo-500">
                            @foreach (explode(',', \App\Http\Controllers\UtilsController::getSetting('topupRange')['data']) as $item)
                                <option value="{{ $loop->index }}">{{ number_format($item) }}</option>
                            @endforeach
                        </select>
                        <button style=" background-color:rgb(255, 69, 84) ;"
                                class=" custom-button w-full h-12 px-6 text-white transition-colors duration-150  rounded-lg focus:shadow-outline hover:bg-blue-700 mt-6"
                                id="submitBtn">
                        <span class="flex justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                 class="w-6 h-6 my-auto">
                                <path fill-rule="evenodd"
                                      d="M3 4.875C3 3.839 3.84 3 4.875 3h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 9.375v-4.5ZM4.875 4.5a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875.375c0-1.036.84-1.875 1.875-1.875h4.5C20.16 3 21 3.84 21 4.875v4.5c0 1.036-.84 1.875-1.875 1.875h-4.5a1.875 1.875 0 0 1-1.875-1.875v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75A.75.75 0 0 1 6 7.5v-.75Zm9.75 0A.75.75 0 0 1 16.5 6h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM3 14.625c0-1.036.84-1.875 1.875-1.875h4.5c1.036 0 1.875.84 1.875 1.875v4.5c0 1.035-.84 1.875-1.875 1.875h-4.5A1.875 1.875 0 0 1 3 19.125v-4.5Zm1.875-.375a.375.375 0 0 0-.375.375v4.5c0 .207.168.375.375.375h4.5a.375.375 0 0 0 .375-.375v-4.5a.375.375 0 0 0-.375-.375h-4.5Zm7.875-.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75ZM6 16.5a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm9.75 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm-3 3a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Zm6 0a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-.75.75h-.75a.75.75 0 0 1-.75-.75v-.75Z"
                                      clip-rule="evenodd" />
                            </svg>
                            <span class="my-auto ml-2">Tạo mã QR chuyển khoản</span>
                        </span>
                        </button>
                    </form>
                </div>

                <div class="recharge">
                </div>
            </div>

            <div class="w-full max-w-sm p-4 bg-white border border-gray-200 shadow sm:p-6 order-1">
                <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                    Thông tin nạp tiền
                </h5>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Hiện tại hệ thống đang có 2 phương thức nạp:</p>
                <div class="mt-3">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Thẻ cào:</h2>
                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 px-3">
                        <li>
                            Thời gian xác nhận lâu. Do xác nhận thông qua admin
                        </li>
                        <li>
                            Mất phí tuỳ trên loại thẻ
                        </li>
                    </ul>
                </div>

                <div class="mt-3">
                    <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Chuyển khoản:</h2>
                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 px-3">
                        <li>
                            Thời gian xác nhận nhanh, tự động, hoạt động 24/7
                        </li>
                        <li>
                            Không mất phí
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="contentChildTwo" style="display: none" class="maincontent2">
            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
                <div class="flex justify-center items-center">
                    <img id="qrCode" class="object-cover max-w-full max-h-full" style="width: 70%" />
                </div>
                <div class="mt-6">
                    <h5 class="text-xl font-bold leading-none text-gray-900 text-center my-3">Thông tin chuyển khoản
                    </h5>
                    <p class="text-center text-sm text-gray-500 truncate dark:text-gray-400">
                        ( Bấm vào thông tin để copy )
                    </p>
                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate">
                                        Ngân hàng
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    MB Bank
                                </div>
                            </div>
                        </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate">
                                        Số tiền
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 copyable"
                                     id="sotien">
                                </div>
                            </div>
                        </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate">
                                        Tên TK:
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 copyable"
                                     id="tentk">
                                </div>
                            </div>
                        </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        Số TK:
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 copyable"
                                     id="sotk">
                                </div>
                            </div>
                        </li>

                        <li class="py-3 sm:py-4">
                            <div class="flex items-center">

                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-sm font-medium text-gray truncate">
                                        Nội dung:
                                    </p>

                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 copyable"
                                     id="noidung">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <h5 class="text-xl font-bold leading-none text-red-400 text-center my-3">Lưu ý!</h5>
                    <ul>
                        <li>- Đây là hệ thống tự động.</li>
                        <li>- Không chịu trách nhiệm khi chuyển nhiều/ít hơn số tiền.</li>
                        <li>- Giao dịch được giới hạn trong <b id="timer">05:00</b>, qua thời gian vui lòng không
                            chuyển
                            khoản vào thông tin trên.</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"
            integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://alecrios.github.io/image-zoom-js/demo/js/image-zoom.js"></script>
    <script>
        $(document).ready(function() {
            @if(Session::has('error'))
            toast('error', '{{ Session::get('error') }}');
            @endif
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

            function formatCurrency(number) {
                var formattedNumber = parseFloat(number).toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                return formattedNumber;
            }
            $(".copyable").click(function(e) {
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
            $('#submitBtn').click(function(e) {
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
                    success: function(data) {
                        $('.mainContent1').hide();
                        data = data.data
                        $('#qrCode').attr('src',
                            `https://img.vietqr.io/image/${data.bin}-${data.number}-qr_only.png?amount=${data.amount}&addInfo=${data.description.split(' ').join('+')}`
                        )
                        // generateQrCode(data.qr)
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
