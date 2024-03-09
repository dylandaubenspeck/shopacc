@extends('admin.layout')
@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('admin.accounts.new') }}">Add account</a>
    @if(request()->has('showSold'))
        <a type="button" class="btn btn-dark" href="{{ route('admin.accounts') }}">Hiện thị accounts chưa bán</a>
    @else
        <a type="button" class="btn btn-dark" href="{{ route('admin.accounts', ['showSold' => 1]) }}">Hiện thị kèm accounts đã bán</a>
    @endif
    <form method="GET" action="{{ route('admin.accounts') }}">
    <select class="form-select" aria-label="Default select example">
        <option selected disabled>Lọc theo loại account.</option>
        @foreach($type as $item)
            <option value="{{ $item }}">{{ $item }}</option>
        @endforeach
    </select>
    </form>
    <form method="GET" action="{{ route('admin.accounts') }}">
        <div class="input-group my-3">
            <input type="text" class="form-control" placeholder="Tìm kiếm theo username" aria-label="Recipient's username" aria-describedby="button-addon2" name="username">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Tìm kiếm</button>
        </div>
    </form>
    @if(request()->has('username'))
    <p class="text-center text-danger"><strong>nếu không thấy account thì thử dùng nút filter acc đã bán hay chưa.</strong></p>
    @endif
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Phân Loại</th>
                    <th scope="col">Username:Password</th>
                    <th scope="col">Tình trạng</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->username }}:<b>{{ $item->password }}</b></td>
                            <td>{{ $item->userid ? $item->userid : 'Chưa ai mua' }}</td>
                            <td><button type="button" class="btn btn-danger delete" data-id="{{ $item->id }}">Xoá</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $data->links() !!}

        </div>
    </div>
@endsection
