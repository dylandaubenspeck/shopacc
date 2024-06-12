@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/dailyDrop.css') }}">
@endsection
@section('content')
    <div id="mainContent" class=" flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div>
            <img class="character-image" src="/img/text2.png" alt="">
        </div>
        <div class="btn mainContent1">
            <div class="textEffect">
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto w-96">
                @if(!empty(\Illuminate\Support\Facades\Auth::user()->level()))
                    <h5 class="mb-2 text-2xl tracking-tight text-gray-900">Hiện tại bạn
                        đang ở cấp: <font class="font-bold">{{ \Illuminate\Support\Facades\Auth::user()->level()->levelName }}</font>
                    </h5>
                    @if(\App\Models\Levels::where('expNeeded', '>', \Illuminate\Support\Facades\Auth::user()->exp)->orderBy('expNeeded', 'asc')->count() > 0)
                        @php($currentLvl = \Illuminate\Support\Facades\Auth::user()->level())
                        @php($nextLvl = \App\Models\Levels::where('expNeeded', '>', \Illuminate\Support\Facades\Auth::user()->exp)->orderBy('expNeeded', 'asc')->first())
                        <div class="flex items-center justify-between my-5">
                            <span>{{ $currentLvl->levelName }}</span>
                            <div class="w-full bg-gray-200 h-4 rounded-full mx-4 relative">
                                <div class="bg-red-300 h-full rounded-full absolute left-0 top-0"
                                     style="width: 0%;" id="levelbardiv" data-percent="{{ (\Illuminate\Support\Facades\Auth::user()->exp / $nextLvl->expNeeded) * 100 }}"></div>
                            </div>
                            <span>{{ $nextLvl->levelName }}</span>
                        </div>

                        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 my-2 text-center">Bạn
                            còn {{ number_format($nextLvl->expNeeded - \Illuminate\Support\Facades\Auth::user()->exp) }}
                            EXP nữa để lên cấp tiếp theo!</p>
                    @else
                        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-center">Bạn đang ở cấp cao nhất
                            của hệ
                            thống! Xin chúc mừng bạn và cảm ơn vì đã đồng hành cùng tụi mình.</p>
                    @endif

                    <hr class="w-48 h-1 mx-auto my-6 bg-gray-100 border-0 rounded md:my-6 ">
                    @if(\Carbon\Carbon::parse(\Illuminate\Support\Facades\Auth::user()->reward_claimed)->diffInHours(\Carbon\Carbon::now()->timezone('Asia/Ho_Chi_Minh')) >= 24)
                        <form method="POST">
                            @csrf
                            <button type="button" id="confirmBuyButton"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                                <span class="flex justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 my-auto">
  <path d="M9.375 3a1.875 1.875 0 0 0 0 3.75h1.875v4.5H3.375A1.875 1.875 0 0 1 1.5 9.375v-.75c0-1.036.84-1.875 1.875-1.875h3.193A3.375 3.375 0 0 1 12 2.753a3.375 3.375 0 0 1 5.432 3.997h3.943c1.035 0 1.875.84 1.875 1.875v.75c0 1.036-.84 1.875-1.875 1.875H12.75v-4.5h1.875a1.875 1.875 0 1 0-1.875-1.875V6.75h-1.5V4.875C11.25 3.839 10.41 3 9.375 3ZM11.25 12.75H3v6.75a2.25 2.25 0 0 0 2.25 2.25h6v-9ZM12.75 12.75v9h6.75a2.25 2.25 0 0 0 2.25-2.25v-6.75h-9Z" />
</svg>



                            <span class="my-auto ml-2">Nhận quà hôm nay</span>
                        </span>
                            </button>
                        </form>
                    @else
                        <button type="button" disabled=""
                                class="text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5
                    inline-flex justify-center w-full text-center">
                            <span class="my-auto ml-2">Đã nhận quà hôm nay<br><span class="text-sm font-light">Trở lại sau <span id="cooldownTime" data-claimed="{{ \Illuminate\Support\Facades\Auth::user()->reward_claimed }}"></span> nhé.</span></span>

                        </button>
                    @endif
                @else
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900">Bạn chưa được
                        sử dụng hệ thống này!</h5>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Bắt đầu mua hàng và bạn sẽ nhận được
                        phần thưởng hàng ngày rồi, còn chờ gì nữa mà không mua ngay nào!</p>
                @endif
            </div>
            <div style="z-index: 10;" class="rightNav">
                <li>
                    <div id="happy" class="icon" style="background-image: url({{ \Illuminate\Support\Facades\Auth::user()->level()->imgLink }});     background-position: center; background-size: unset">
                        <strong>
                            <img  alt="">
                        </strong>
                    </div>
                </li>
            </div>
        </div>
    </div>
@endsection

@section('authJs')
    <script>
        $(document).ready(function (e) {
            function animateProgressBar(percent, duration) {
                let currentWidth = 0;
                const startTime = Date.now();
                const endTime = startTime + duration;

                const easeOut = t => {
                    return 1 - Math.pow(1 - t, 2); // Ease-out function
                };

                const step = () => {
                    const now = Date.now();
                    const elapsedTime = now - startTime;
                    const progress = elapsedTime / duration;
                    const easedProgress = easeOut(progress);
                    currentWidth = percent * easedProgress;
                    $('#levelbardiv').css('width', `${currentWidth}%`);

                    if (now < endTime) {
                        requestAnimationFrame(step);
                    }
                };

                step();
            }
            if ($('#levelbardiv'))
            {
                const percent = $('#levelbardiv').data("percent");
                animateProgressBar(percent, 1000);
            }

            if($('#cooldownTime').length > 0)
            {
                const cooldownEl = $('#cooldownTime');
                const claimedDate = new Date(cooldownEl.attr('data-claimed'));

                var now = new Date();
                var difference = claimedDate.getTime() + (24 * 60 * 60 * 1000) - now.getTime();
                function updateCooldown() {
                    var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((difference % (1000 * 60)) / 1000);
                    $('#cooldownTime').html(hours + 'h ' + minutes + 'm ' + seconds + 's');
                    difference -= 1000;
                }
                updateCooldown();
                var cooldownInterval = setInterval(updateCooldown, 1000);
            }

            $('#confirmBuyButton').click(function (e) {
                $(this).attr('disabled', '')
                const btn = $(this)
                const typeAcc = $(this).data('productid');
                $.ajax({
                    url: "{{ route('level.claim') }}",
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (data) {
                        Swal.fire({
                            title: "Nhận quà hàng ngày thành công!",
                            text: data.data,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload()
                            }
                        });
                    },
                    error: function(error)
                    {
                        data = error.responseJSON
                        btn.attr('disabled', false)
                        toast('error', data.data)
                    }
                });
            })
        })

        $(function () {
            boxRollovers();
        });

        function boxRollovers() {
            $selector = $("li");
            XAngle = 0;
            YAngle = 0;
            Z = 50;

            $selector.on("mousemove", function (e) {
                var $this = $(this);
                var XRel = e.pageX - $this.offset().left;
                var YRel = e.pageY - $this.offset().top;
                var width = $this.width();

                YAngle = -(0.5 - (XRel / width)) * 40;
                XAngle = (0.5 - (YRel / width)) * 40;
                updateView($this.children(".icon"));
            });

            $selector.on("mouseleave", function () {
                oLayer = $(this).children(".icon");
                oLayer.css({ "transform": "perspective(525px) translateZ(0) rotateX(0deg) rotateY(0deg)", "transition": "all 150ms linear 0s", "-webkit-transition": "all 150ms linear 0s" });
                oLayer.find("strong").css({ "transform": "perspective(525px) translateZ(0) rotateX(0deg) rotateY(0deg)", "transition": "all 150ms linear 0s", "-webkit-transition": "all 150ms linear 0s" });
            });
        }

        function updateView(oLayer) {
            oLayer.css({ "transform": "perspective(525px) translateZ(" + Z + "px) rotateX(" + XAngle + "deg) rotateY(" + YAngle + "deg)", "transition": "none", "-webkit-transition": "none" });
            oLayer.find("strong").css({ "transform": "perspective(525px) translateZ(" + Z + "px) rotateX(" + (XAngle / 0.66) + "deg) rotateY(" + (YAngle / 0.66) + "deg)", "transition": "none", "-webkit-transition": "none" });
        }
    </script>
@endsection
