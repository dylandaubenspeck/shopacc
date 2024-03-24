@extends('admin.layout')
@section('content')
    <form method="POST" action="{{ route('admin.generalInsert', ['table' => 'level_systems']) }}" id="postform">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tên</label>
            <input type="text" class="form-control" placeholder="" name="levelName">
        </div>
        <div class="mb-3">
            <label class="form-label">EXP</label>
            <input type="number" class="form-control" placeholder="" name="expNeeded">
        </div>
        <div class="mb-3">
            <label class="form-label">Thời gian nhận quà</label>
            <input type="number" min="24" class="form-control" placeholder="" name="cooldownHours" value="24">
        </div>
        <div class="mb-3">
            <select class="form-select" name="stockName">
                <option value="" selected>Chọn loại account</option>
                @foreach($list as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="submit">Button</button>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
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
