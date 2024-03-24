@extends('admin.layout')
@section('content')
    <a type="button" class="btn btn-primary" href="{{ route('admin.products.new') }}">Thêm sản phẩm</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Group</th>
                    <th scope="col">Tên SP</th>
                    <th scope="col">Giá</th>
                    <th scope="col">EXP</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Tên Stock</th>
                    <th scope="col">#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ \App\Models\Categories::where('id', $item->groupId)->first()->name }}</td>
                        <td>{{ $item->productName }}</td>
                        <td>{{ number_format($item->productPrice) }}</td>
                        <td>{{ number_format($item->exp    ) }}</td>
                        <td>{{ $item->status == 1? 'Hoạt động' : 'Tạm dừng' }}</td>
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

@section('javascript')
<script>
    $(document).ready(function() {
        $('.edit').click(function(e) {
            const rowId = $(this).data('id');

            $.ajax({
                url: `{{ route('admin.generalFind') }}/products/${rowId}`, // Replace 'your_api_endpoint' with your actual API endpoint
                type: 'POST',
                success: function(response) {
                    response = response.data
                    Swal.fire({
                        title: 'Edit Product',
                        html:
                            '<input id="productName" class="swal2-input" placeholder="Product Name" value="' + response.productName + '">' +
                            '<input id="productPrice" class="swal2-input" placeholder="Product Price" value="' + response.productPrice + '">' +
                            '<input id="exp" class="swal2-input" placeholder="Product EXP" value="' + response.exp + '" type="number">' +
                            '<select id="productType" class="swal2-input">' +
                            '<option value="1" ' + (response.status === 1 ? 'selected' : '') + '>Online</option>' +
                            '<option value="2" ' + (response.status === 2 ? 'selected' : '') + '>Offline</option>' +
                            '</select>',
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'OK',
                        preConfirm: function() {
                            var updatedData = {
                                exp: $('#exp').val(),
                                productName: $('#productName').val(),
                                productPrice: $('#productPrice').val(),
                                status: $('#productType').val()
                            };

                            $.ajax({
                                url: `{{ route('admin.generalUpdate') }}/products/${rowId}`, // Replace 'your_api_endpoint' with your actual API endpoint
                                type: 'POST',
                                data: updatedData,
                                success: function(response) {
                                    location.reload()
                                }
                            })
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })
    })
</script>
@endsection
