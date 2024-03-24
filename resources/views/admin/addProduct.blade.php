@extends('admin.layout')
@section('content')
    <form method="POST" action="{{ route('admin.products.new.post', ['table' => 'products']) }}" id="postform">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" class="form-control" placeholder="" name="productName" id="productname">
        </div>
        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="number" class="form-control" placeholder="" name="productPrice">
        </div>
        <div class="mb-3">
            <label class="form-label">Exp khi mua</label>
            <input type="number" min="1" class="form-control" placeholder="" name="exp">
        </div>
        <div class="mb-3">
            <select class="form-select" name="groupId">
                <option value="" selected>Chọn group</option>
                @foreach(\App\Models\Categories::where('status', 1)->get() as $item)
                    <option value="{{ $item->id }}">[ ID: {{ $item->id }} ] {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tên stock</label>
            <input type="text" class="form-control" placeholder="" name="stockName" id="stockName" readonly>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Button</button>
        </div>
    </form>
@endsection

@section('javascript')
<script>
$(document).ready(function() {
    $('#productname').on('change keyup', function (e) {
        $('#stockName').val(($(this).val().replace(/ /g, '')).toLowerCase())
    });

    $('#postform').submit(function(e){
        e.preventDefault();
        $('button[type=submit]').attr('disabled', 'true')
        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle the response
                if(response.status == 1) {
                    shootToast('success', 'Tạo sản phẩm mới thành công')
                    setTimeout(function() {
                        history.go(-1);
                    }, 1000)
                } else {
                    shootToast('error', response.data)
                }
            },
            error: function(xhr, status, error) {
                shootToast('error', error)
            }
        });
    });
});
</script>
@endsection
