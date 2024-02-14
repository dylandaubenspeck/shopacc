@extends('admin.layout')
@section('content')
    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
    </div>

    <div class="row mt-3">
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Tổng tiền</p>
                    <h5 class="card-title" id="transactions">0</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Tổng account đã bán</p>
                    <h5 class="card-title" id="buyOrder">0</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Tổng lượt mua</p>
                    <h5 class="card-title" id="totalOrder">0</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Tổng số tiền người dùng đã nạp</p>
                    <h5 class="card-title" id="topup">0</h5>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">Tổng số tiền nạp đang chờ DUYỆT</p>
                    <h5 class="card-title" id="topupAwait">0</h5>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
<script type="text/javascript">

    let formatMe = (currency) => {
        if (typeof currency != 'int') currency = parseInt(currency)
        return currency.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    }

    function fetchInfo(start, end)
    {
        $('#recentToup').html('');
        $.ajax({
            url: "{{ route('admin.info') }}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                startDate: start,
                endDate: end
            },
            dataType: 'json',
            success: function (data) {
                console.log(data)
                data = data.data
                $('#topup').text(formatMe(data.topup))
                $('#topupAwait').text(formatMe(data.topupAwait))
                $('#transactions').text(formatMe(data.transactions))
                $('#buyOrder').text((data.buyOrder))
                $('#totalOrder').text((data.totalOrder))

            }
        });
    }

    $(document).ready(function() {
        var start = moment();
        var end = moment().add(1, 'days');

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            fetchInfo(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        // $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        //     console.log(picker.startDate.format('YYYY-MM-DD'));
        //     console.log(picker.endDate.format('YYYY-MM-DD'));
        //     fetchInfo(picker.startDate.format('YYYY-MM-DD h:m:s '), picker.endDate.format('YYYY-MM-DD h:m:s'))
        // });
    })
</script>
@endsection
