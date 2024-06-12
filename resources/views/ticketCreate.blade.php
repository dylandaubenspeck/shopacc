@extends('layouts.guest')
@section('content')

    <section style='
  background-image: url(/img/back3.jpg);
    background-repeat: repeat;
    background-size: cover;
    '>
        <div class="py-8 mx-auto max-w-screen-2xl lg:py-16 p-3 flex h-screen justify-center items-center">
            <form method="POST" enctype="multipart/form-data" action="{{ route('ticket.createTicket') }}" class="bg-white p-6 rounded-lg shadow-lg max-w-md mx-auto w-full">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Tiêu đề</label>
                    <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="" required />
                </div>

                <div class="mb-6">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Chọn khu vực cần hỗ trợ</label>
                    <select name="productId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option @if(empty(request()->segment(2))) selected @endif disabled>Vui lòng chọn Đơn hàng</option>
                        <option value="0" @if(!empty(request()->segment(2))) selected @endif>Đơn hàng</option>
                        <option value="1">Market (Người mua)</option>
                        <option value="2">Market (Người bán)</option>
                        <option value="2">Nạp tiền</option>
                        <option value="2">Khác</option>
                    </select>
                </div>

                <div class="mb-6">

                    <label class="block mb-2 text-sm font-medium text-gray-900">Mô tả</label>
                    <textarea name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder=""></textarea>

                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Hình ảnh đính kèm (không bắt buộc)</label>
                    <input name="img" class="block w-full text-sm text-red-900 border border-red-300 rounded-lg cursor-pointer bg-red-50 focus:outline-none" id="file_input" type="file">
                </div>

                <button type="submit" class="text-white bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-200 font-medium rounded-lg text-sm px-5 py-2.5
                    inline-flex justify-center w-full text-center">
                    <span class="my-auto ml-2">Gửi ticket</span>

                </button>
            </form>
        </div>
    </section>
@endsection
