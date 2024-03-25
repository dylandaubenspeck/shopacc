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
                    <th scope="col">Payment ID</th>
                    <th scope="col">STK</th>
                    <th scope="col">User</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->paymentId }}</td>
                        <td>{{ $item->paymentNumber }}</td>
                        <td>{{ \App\Models\User::where('id', $item->userId)->first()->username ?? 'User bị xoá.' }}</td>
                        <td>{{ number_format($item->amount) }}</td>
                        <td>
                            <select class="form-select statusChange" data-id="{{ $item->id }}" @if($item->status > 0) disabled @endif>
                                @foreach(array(['0' => 'Chờ xủ lí'], ['1' => 'Hoàn thành'], ['2' => 'Thất bại']) as $beforeLoop => $afterLoop)
                                    <option value="{{ $beforeLoop }}" @if($item->status == $beforeLoop) selected @endif>{{ ($afterLoop[$beforeLoop]) }}</option>
                                @endforeach
                            </select>
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
    $('.statusChange').on('change', function(e) {
        const rowId = $(this).data('id');
        const changeTo = $(this).val();

        $.ajax({
            type: 'POST',
            url: `{{ route('admin.generalUpdate') }}/topup/${rowId}`,
            data: {
                status: changeTo
            },
            dataType: 'json',
            success: function(response) {
                // Handle the response
                if(response.status == 1) {
                    shootToast('success', 'Cập nhật thành công')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)
                } else {
                    shootToast('error', response.data)
                }
            },
            error: function(xhr, status, error) {
                shootToast('error', error)
            }
        });
    })
</script>
@endsection
