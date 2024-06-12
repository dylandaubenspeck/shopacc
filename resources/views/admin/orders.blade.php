@extends('admin.layout')
@section('content')
    <div class="card">

        <div class="card-body">
            <h2 class="font-bold text-lg mb-10">Recent Orders</h2>

            <!-- start a table -->
            <table class="table-fixed w-full">

                <!-- table head -->
                <thead class="text-left">
                <tr>
                    <th scope="col" class="w-1/2 pb-10 text-sm font-extrabold tracking-wide">Thời gian</th>
                    <th scope="col" class="w-1/4 pb-10 text-sm font-extrabold tracking-wide text-right">ID</th>
                    <th scope="col" class="w-1/2 pb-10 text-sm font-extrabold tracking-wide text-right">User</th>
                    <th scope="col" class="w-1/2 pb-10 text-sm font-extrabold tracking-wide text-right">Số tiền</th>
                    <th scope="col" class="w-1/2 pb-10 text-sm font-extrabold tracking-wide text-right">Trạng thái</th>
                    <th scope="col" class="w-1/2 pb-10 text-sm font-extrabold tracking-wide text-right">Nội dung</th>
                    <th scope="col" class="w-1/2 pb-10 text-sm font-extrabold tracking-wide text-right">#</th>
                </tr>
                </thead>
                <!-- end table head -->

                <!-- table body -->
                <tbody class="text-left text-gray-600">


                <!-- item -->
                @foreach($data as $item)
                    <tr>
                        <th class="w-1/2 mb-4 font-extrabold tracking-wider flex flex-row items-center w-full">{{ $item->created_at }}</th>
                        <th class="w-1/4 mb-4 font-extrabold tracking-wider text-right">{{ $item->id }}</th>
                        <th class="w-1/4 mb-4 font-extrabold tracking-wider text-right">{{ \App\Models\User::where('id', $item->userId)->first()->username ?? 'Khách Discord' }}</th>
                        <th class="w-1/4 mb-4 font-extrabold tracking-wider text-right">{{ number_format($item->amount) }} đ</th>
                        <th class="w-1/4 mb-4 font-extrabold tracking-wider text-right">
                            <select class="form-select statusChange" data-id="{{ $item->id }}" @if($item->status > 0) disabled @endif>
                                @foreach(array(['0' => 'Chờ xủ lí'], ['1' => 'Hoàn thành'], ['2' => 'Thất bại']) as $beforeLoop => $afterLoop)
                                    <option value="{{ $beforeLoop }}" @if($item->status == $beforeLoop) selected @endif>{{ ($afterLoop[$beforeLoop]) }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th class="w-1/4 mb-4 font-extrabold tracking-wider text-right">{{ $item->result }}</th>
                    </tr>
                @endforeach



                </tbody>
                <!-- end table body -->

            </table>

            <div>
                {{ $data->links('pagination::tailwind') }}

            </div>
            <!-- end a table -->
        </div>

    </div>
@endsection
