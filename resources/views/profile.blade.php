@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/profile_new.css') }}">
@endsection
@section('content')
    <section id="mainContent">
        <div class="top">
            <div class="avt">
                <div class="avtNav">
                    <div class="nameProfile itemNav"></div>
                    <div class="priceProfile itemNav"></div>
                </div>

                <div class="avt-img"> <img
                        src="https://seeklogo.com/images/V/valorant-logo-FAB2CA0E55-seeklogo.com.png">
                    <span class="nameProfile ">{{ Auth::user()->username }}</span>
                </div>

            </div>
        </div>
        <div class="body">
            <div class="bodyLeft">
                <h2 style="margin-top: 10px;" class=" item  text-3xl font-extrabold mb-2">
                    Thông tin
                </h2>
                <hr>
                <div class="textIntro"style="text-align: left;"  >
        <span class="intro">

          Dĩ nhiên, dưới đây là một đoạn văn ngắn chào mừng đến shop acc:

          Chào mừng đến với Shop Acc - nơi bạn có thể tìm thấy những tài khoản game và dịch vụ trực tuyến hàng đầu. Tại đây, chúng tôi tự hào cung cấp cho bạn các tài khoản chất lượng với đa dạng lựa chọn, từ các trò chơi phổ biến đến các dịch vụ hàng đầu.
                  </span>
                </div>
                <!-- <img class="info-img" src="/img/Gekko_Dark_1.png" alt=""> -->

            </div>
            <div class="bodyRight flex ">
                <div class="bodyTop">
                    <!-- DANH SACH ACC DA MUA  -->
                    <div class="container">
                        <h2 style="margin-top: 10px;" class=" item  text-3xl font-extrabold mb-2">
                            <img style="margin-left: 190px; transform: translateY(30px);" src="/img/logoV.png" alt="Logo" class="h-8" />
                            Danh sách account đã mua
                        </h2>
                        <ul class="responsive-table">
                            <li class="table-header">
                                <div class="col col-1">ID</div>
                                <div class="col col-2">Loại acc</div>
                                <div class="col col-3">Thông tin</div>
                                <div class="col col-4">Ngày mua</div>
                            </li>
                            @foreach($transactions as $item)
                                <li class="table-row">
                                    <div class="col col-1" data-label="Job Id">{{ $item->id }}</div>
                                    <div class="col col-2" data-label="Customer Name">{{ $item->productName }}</div>
                                    <div class="col col-3" data-label="Amount">{{ $item->result }}</div>
                                    <div class="col col-4" data-label="Payment Status">{{ $item->created_at }}</div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="w-4/6 mx-auto my-4 flex justify-center">
                            {{ $transactions->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
                <div class="bodyBot">
                    <!-- DANH SACH NAP TIEN  -->
                    <div class="container">
                        <h2 style="margin-top: 10px;" class=" item  text-3xl font-extrabold mb-2">
                            <img style="margin-left: 300px; transform: translateY(30px);" src="/img/bom.png" alt="Logo" class="h-10" />
                            lịch sử nạp tiền
                        </h2>
                        <ul class="responsive-table">
                            <li class="table-header">
                                <div class="col col-1">ID</div>
                                <div class="col col-2">Phương thức</div>
                                <div class="col col-3">Số tiền</div>
                                <div class="col col-4">Trạng thái</div>
                                <div class="col col-5">Ngày nạp</div>
                            </li>
                            @foreach($topups as $item)
                            <li class="table-row">
                                <div class="col col-1" data-label="Job Id">{{ $item->id }}</div>
                                <div class="col col-2" data-label="Customer Name">{{ $item->paymentBank == "napthe" ? "Thẻ cào" : "Mã QR" }}</div>
                                <div class="col col-3" data-label="Amount">{{ number_format($item->amount) }}đ</div>
                                <div class="col col-4" data-label="Payment Status">@switch($item->status)
                                        @case(0)
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-yellow-300">Chờ xử lí</span>

                                            @break

                                        @case(1)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-green-400">Thành công</span>

                                            @break

                                        @case(2)
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-red-400">Thất bại</span>

                                            @break
                                    @endswitch</div>
                                <div class="col col-5">
                                    {{ $item->created_at }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="w-4/6 mx-auto my-4 flex justify-center">
                            {{ $topups->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        @if(Session::has('msg'))
        toast('success', '{{ Session::get('msg') }}');
        @endif
    })
</script>
@endsection
