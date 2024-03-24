@extends('admin.layout')
@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('admin.levels.new') }}">Thêm sản phẩm</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên </th>
                    <th scope="col">EXP</th>
                    <th scope="col">Tên Stock</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->levelName }}</td>
                        <td>{{ number_format($item->expNeeded    ) }}</td>
                        <td>{{ $item->stockName }} <a href="{{ route('admin.accounts', ['type' => $item->stockName]) }}">(Check)</a></td>
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
