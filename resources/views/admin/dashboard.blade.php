@extends('admin.layout')
@section('content')
    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
        <i class="fa fa-calendar"></i>&nbsp;
        <span></span> <i class="fa fa-caret-down"></i>
    </div>

    <div class="grid grid-cols-5 gap-6 xl:grid-cols-1">

        <div class="card mt-6">
            <div class="card-body flex items-center">
                <div class="px-3 py-2 rounded bg-indigo-500 text-white mr-3">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
                <div class="flex flex-col">
                    <p>Tổng tiền</p>
                    <h1 class="font-semibold"><span class="num-2" id="transactions">0</span></h1>
                </div>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-body flex items-center">
                <div class="px-3 py-2 rounded bg-blue-500 text-white mr-3">
                    <i class="fa-solid fa-hand-holding-dollar"></i>                </div>
                <div class="flex flex-col">
                    <p>Tổng Account đã bán</p>
                    <h1 class="font-semibold"><span class="num-2" id="buyOrder">0</span></h1>
                </div>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-body flex items-center">
                <div class="px-3 py-2 rounded bg-red-300 text-white mr-3">
                    <i class="fa-solid fa-cart-shopping"></i>                </div>
                <div class="flex flex-col">
                    <p>Tổng lượt mua</p>
                    <h1 class="font-semibold"><span class="num-2" id="totalOrder">0</span></h1>
                </div>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-body flex items-center">
                <div class="px-3 py-2 rounded bg-yellow-400 text-white mr-3">
                    <i class="fa-solid fa-money-bill-wave"></i>                </div>
                <div class="flex flex-col">
                    <p>Tổng tiền nạp (CK + Thẻ cào)</p>
                    <h1 class="font-semibold"><span class="num-2" id="topup">0</span></h1>
                </div>
            </div>
        </div>

        <div class="card mt-6">
            <div class="card-body flex items-center">
                <div class="px-3 py-2 rounded bg-green-400 text-white mr-3">
                    <i class="fa-solid fa-vault"></i>                </div>
                <div class="flex flex-col">
                    <p>Tổng tiền chờ Duyệt (CK + Thẻ cào)</p>
                    <h1 class="font-semibold"><span class="num-2" id="topupAwait">0</span></h1>
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
