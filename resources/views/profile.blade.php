@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/Profile.css') }}">
@endsection
@section('content')
    <section>
        <div id="mainContent">
            <div class="box">
                <div class="bg-imageLeft bgimg"></div>
                <div class="bg-imageRight bgimg"></div>
                <div class="childContent">
                    <div
                        class="leftContent content"
                        style="
                border: 5px solid;
                border-image: linear-gradient(
                    to left,
                    rgba(255, 102, 102, 0.7),
                    transparent
                  )
                  1;
              "
                    >
                        <div class="profile">
                            <h3>Thông tin cá nhân</h3>
                        </div>
                        <div class="itemProfile">
                            <label class="itemProfile_Child">Tên đăng nhập: </label>
                            <label class="itemProfile_Child itemProfile_Child1"
                            >{{ \Illuminate\Support\Facades\Auth::user()->username }}</label
                            >
                        </div>
                        <div class="itemProfile">
                            <label class="itemProfile_Child">Email: </label>
                            <label class="itemProfile_Child itemProfile_Child1"
                            >{{ \Illuminate\Support\Facades\Auth::user()->email ?? 'Trống' }}</label
                            >
                        </div>
                        <div class="itemProfile">
                            <label class="itemProfile_Child">Số dư: </label>
                            <label class="itemProfile_Child itemProfile_Child1"
                            >{{ number_format(\Illuminate\Support\Facades\Auth::user()->balance) }}</label
                            >
                        </div>
                    </div>

                    <!---------------------------------------RIGHT-->
                    <div
                        class="rightContent content"
                        style="
                z-index: 999;
                margin-right: 0px;
                border: 5px solid;
                border-image: linear-gradient(
                    to left,
                    rgba(255, 102, 102, 0.7),
                    transparent
                  )
                  1;
              "
                    >
                        <div class="changedPass">
                            <h3>Thay đổi mật khẩu</h3>
                        </div>
                        <div class="itemPass userName">
                            <label class="itemProfile_Child">Mật khẩu cũ </label>
                            <input type="text" class="oldPass inputPass" />
                        </div>
                        <div class="itemPass email">
                            <label class="itemProfile_Child">Mật khẩu mới: </label>
                            <input type="text" class="newPass inputPass" />
                            <br />

                            <div>
                  <span
                      class="errorPass errline1"
                      style="
                      color: rgb(222, 52, 52);
                      font-size: 13px;
                      margin-left: 27%;
                    "
                  ></span>
                                <span
                                    class="errorPass errline2"
                                    style="
                      color: rgb(222, 52, 52);
                      font-size: 13px;
                      margin-left: 32%;
                    "
                                ></span>
                            </div>
                        </div>
                        <div class="itemPass price">
                            <label class="itemProfile_Child">Nhập lại mật khẩu mới: </label>
                            <input type="text" class="renewPass inputPass" />
                            <br />
                            <span
                                class="errorRePass"
                                style="
                    color: rgb(222, 52, 52);
                    font-size: 13px;
                    margin-left: 26%;
                  "
                            ></span>
                        </div>

                        <div class="flex items-center space-x-4">
                            <button
                                onclick="validatePasswords()"
                                style="margin-left: 47%; margin-top: 27px"
                                class="rounded-full relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800"
                            >
                  <span
                      class="rounded-full relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 group-hover:bg-opacity-0"
                  >
                    Thay đổi
                  </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="orderHistory">
                <h3 class="headerHistory"><b>Lịch sử mua hàng</b></h3>
                <table class="orderHistory_child history">
                    <tr>
                        <th class="itemTd itemID">ID</th>
                        <th class="itemTd">Tên sản phẩm</th>
                        <th class="itemTd">Số tiền</th>

                        <th class="itemTd">Tài khoản</th>
                        <th class="itemTd">Ngày mua</th>
                    </tr>
                    @foreach($transactions as $item)
                    <tr>
                        <td class="itemTd">{{ $item->id }}</td>
                        <td class="itemTd">{{ $item->productName }}</td>
                        <td class="itemTd">{{ $item->amount }}</td>

                        <td class="itemTd">{{ $item->result }}</td>
                        <td class="itemTd">{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="w-4/6 mx-auto mt-4">
                    {{ $transactions->links('pagination::tailwind') }}
                </div>
            </div>
            <div class="orderHistory">
                <h3 class="headerHistory"><b>Lịch sử nạp tiền </b></h3>
                <table class="depositHistory_child history">
                    <tr>
                        <th class="itemTd itemID">ID</th>
                        <th class="itemTd">Bank</th>
                        <th class="itemTd">Trạng thái</th>
                        <th class="itemTd">Số tiền</th>
                        <th class="itemTd">Ngày nạp</th>
                    </tr>
                    @foreach($topups as $item)
                    <tr>
                        <td class="itemTd">{{ $item->id }}</td>
                        <td class="itemTd">MB</td>
                        <td class="itemTd">{{ $item->status == 1 ? "Thành công" : ($item->status == 2 ? "Thất bại" : "Đang chờ") }}</td>
                        <td class="itemTd">{{ number_format($item->amount) }}</td>
                        <td class="itemTd">{{ $item->created_at }}</td>
                    </tr>
                    @endforeach
                </table>
                <div class="w-4/6 mx-auto mt-4">
                    {{ $topups->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </section>
@endsection
