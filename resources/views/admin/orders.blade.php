@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Thời gian</th>
                    <th scope="col">ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Loại GD</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ \App\Models\User::where('id', $item->userId)->first()->username ?? 'User bị xoá.' }}</td>
                        <td>{{ $item->transactionType == 2 ? 'Nạp tiền' : 'Mua account' }}</td>
                        <td>{{ number_format($item->amount) }}</td>
                        <td>
                            <select class="form-select statusChange" data-id="{{ $item->id }}" @if($item->status > 0) disabled @endif>
                                @foreach(array(['0' => 'Chờ xủ lí'], ['1' => 'Hoàn thành'], ['2' => 'Thất bại']) as $beforeLoop => $afterLoop)
                                    <option value="{{ $beforeLoop }}" @if($item->status == $beforeLoop) selected @endif>{{ ($afterLoop[$beforeLoop]) }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>{{ $item->result }}</td>
                        <td>
                            <button type="button" class="btn btn-primary edit" data-id="{{ $item->id }}">Sửa</button>
                            <button type="button" class="btn btn-danger delete" data-id="{{ $item->id }}">Xoá</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $data->links() !!}

        </div>
    </div>
@endsection
