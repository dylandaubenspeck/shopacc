@extends('layouts.guest')
@section('content')
    @php($lastId = "")

    <section style='
  background-image: url(/img/back3.jpg);
    background-repeat: repeat;
    background-size: cover;
    '>
        <div class="py-8 mx-auto max-w-screen-lg lg:py-16 p-3 flex h-screen justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto w-full">
                <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $data->title }} <span class="text-gray-400 text-sm">(ID: {{ $data->id }})</span></h5>
                <span class="text-sm text-gray-900">Tạo lúc: {{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</span>
                <div class="grid grid-cols-1 p-3 rounded-lg max-h-96 overflow-auto snap-end my-3" id="chatArea">
                    @foreach($messages as $item)
                        @if($loop->last)
                        @php($lastId = $item->id)
                        @endif
                       @if(!empty($item->userId))
                            <div class="flex gap-2.5 mb-3 col-start-1 col-end-1 top-0 left-0">
                                <img class="w-8 h-8 rounded-full" src="https://i.pinimg.com/474x/2f/aa/d3/2faad31c599c50d588953bd9d09a2362.jpg" alt="Jese image">
                                <div class="flex flex-col w-full max-w-md leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-gray-900">{{ \Illuminate\Support\Facades\Auth::user()->username }}</span>
                                        <span class="text-sm font-normal text-gray-500">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm font-normal py-2.5 text-gray-900">{{ $item->message }}</p>
                                    @if(!empty($item->attachments))
                                        <div class="group relative my-2.5">
                                            <img src="{{ asset('ticketsImg/' . $item->attachments) }}" class="rounded-lg"/>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="flex gap-2.5 mb-3 col-start-1 col-end-1 top-0 right-0">
                                <div class="flex flex-col w-full max-w-md leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-gray-900">Hệ thống</span>
                                        <span class="text-sm font-normal text-gray-500">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm font-normal py-2.5 text-gray-900">{{ $item->message }}</p>
                                    @if(!empty($item->attachments))
                                        <div class="group relative my-2.5">
                                            <img src="{{ asset('ticketsImg/' . $item->attachments) }}" class="rounded-lg"/>
                                        </div>
                                    @endif
                                </div>
                                <img class="w-8 h-8 rounded-full" src="https://i.pinimg.com/474x/2f/aa/d3/2faad31c599c50d588953bd9d09a2362.jpg" alt="Jese image">
                            </div>
                       @endif
                    @endforeach
                </div>
                @if($data->status == 2)
                    <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 justify-center">
                        <span class="text-red-400">Ticket đã bị đóng.</span>
                    </div>
                @else
                    <form method="POST" enctype="multipart/form-data" action="{{ route('ticket.sendMessage', ['id' => $data->id]) }}" id="postform">
                        @csrf
                        <label for="chat" class="sr-only">Your message</label>
                        <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 ">
                            <label for="imageasd" type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path fill="currentColor" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 1H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0ZM7.565 7.423 4.5 14h11.518l-2.516-3.71L11 13 7.565 7.423Z"/>
                                </svg>
                                <span class="sr-only">Upload image</span>
                            </label>
                            <input hidden id="imageasd" name="img" type="file">
                            <textarea name="message" id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Nhập tin nhắn..."></textarea>
                            <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100">
                                <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                    <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                                </svg>
                                <span class="sr-only">Gửi</span>
                            </button>
                        </div>
                        <div id="imgpreview"></div>
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection
@section('authJs')
<script>
    let msgObj = {
        imgPayload: [],
        sentTime: '',
        sentMsg: ''
    };
    function timeDifference(current, previous) {

        var msPerMinute = 60 * 1000;
        var msPerHour = msPerMinute * 60;
        var msPerDay = msPerHour * 24;
        var msPerMonth = msPerDay * 30;
        var msPerYear = msPerDay * 365;

        var elapsed = current - previous;

        if (elapsed < msPerMinute) {
            return Math.round(elapsed/1000) + ' seconds ago';
        }

        else if (elapsed < msPerHour) {
            return Math.round(elapsed/msPerMinute) + ' minutes ago';
        }

        else if (elapsed < msPerDay ) {
            return Math.round(elapsed/msPerHour ) + ' hours ago';
        }

        else if (elapsed < msPerMonth) {
            return 'approximately ' + Math.round(elapsed/msPerDay) + ' days ago';
        }

        else if (elapsed < msPerYear) {
            return 'approximately ' + Math.round(elapsed/msPerMonth) + ' months ago';
        }

        else {
            return 'approximately ' + Math.round(elapsed/msPerYear ) + ' years ago';
        }
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(async function (e) {
        let latestMsgId = {{ $lastId }};
        let objDiv = document.getElementById('chatArea');
        objDiv.scrollTop = objDiv.scrollHeight

        @if($data->status < 2)
        $('#imageasd').on('change', function (e) {
            e.preventDefault();
            file = this.files[0];
            if (file) {
                msgObj.imgPayload = file;
                const reader = new FileReader();
                reader.onload = function (event) {
                    $("#imgpreview").html(`
                    <div class="group relative my-2.5">
                                            <img src="${event.target.result}" class="rounded-lg"/>
                    </div>
                    `)
                };
                reader.readAsDataURL(file);
            }
        })

        async function displayMsg()
        {
            if(msgObj.imgPayload instanceof File)
            {
                const reader = new FileReader();
                reader.onload = function (event) {
                    $('#chatArea').append(`
            <div class="flex gap-2.5 mb-3 col-start-1 col-end-1 top-0 left-0">
                <img class="w-8 h-8 rounded-full" src="https://i.pinimg.com/474x/2f/aa/d3/2faad31c599c50d588953bd9d09a2362.jpg" alt="Jese image">
                <div class="flex flex-col w-full max-w-md leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900">{{ \Illuminate\Support\Facades\Auth::user()->username }}</span>
                    <span class="text-sm font-normal text-gray-500">${timeDifference(new Date(), msgObj.sentTime)}</span>
                </div>
                <p class="text-sm font-normal py-2.5 text-gray-900">${msgObj.sentMsg}</p>
                                <div class="group relative my-2.5">
                                            <img src="${event.target.result}" class="rounded-lg"/>
                                        </div>
            </div>
        </div>
`)
                };
                reader.readAsDataURL(msgObj.imgPayload);

            }else{
                $('#chatArea').append(`
            <div class="flex gap-2.5 mb-3 col-start-1 col-end-1 top-0 left-0">
                <img class="w-8 h-8 rounded-full" src="https://i.pinimg.com/474x/2f/aa/d3/2faad31c599c50d588953bd9d09a2362.jpg" alt="Jese image">
                <div class="flex flex-col w-full max-w-md leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-sm font-semibold text-gray-900">{{ \Illuminate\Support\Facades\Auth::user()->username }}</span>
                    <span class="text-sm font-normal text-gray-500">${timeDifference(new Date(), msgObj.sentTime)}</span>
                </div>
                <p class="text-sm font-normal py-2.5 text-gray-900">${msgObj.sentMsg}</p>

            </div>
        </div>
`)
            }
            $('textarea[name=message]').val("")
            $('input[name=img]').val("")
            $('#imgpreview').html("")
            objDiv.scrollTop = objDiv.scrollHeight

            msgObj = {
                imgPayload: [],
                sentTime: '',
                sentMsg: ''
            }
        }

        $('#postform').submit(async function(e){
            e.preventDefault();
            $('button[type=submit]').attr('disabled', 'true')
            var data = new FormData(this);
            msgObj.sentTime = new Date();
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: async function (response) {
                    if (response.status == 1) {
                        msgObj.sentMsg = $('textarea[name=message]').val()
                        toast('success', 'Gửi tin nhắn thành công')
                        const result = await displayMsg()
                    } else {
                        toast('error', response.data)
                    }
                    $('button[type=submit]').prop('disabled', false)

                },
                error: function(xhr, status, error) {
                    toast('error', error)
                    $('button[type=submit]').prop('disabled', false)

                }
            });
        });

        setInterval(async function(e) {
            console.log(latestMsgId);
            $.ajax({
                url: "{{ route('ticket.getMessage') }}/{{ $data->id }}/" + latestMsgId,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (response) {
                    let data = response.data;
                    if (data.length > 0) {
                        console.log(data);

                        // Get the ID of the last message
                        let lastMsgId = data[data.length - 1].id;

                        if (lastMsgId > latestMsgId) {
                            latestMsgId = lastMsgId;
                            data = data[data.length - 1]
                            var parsedDate = new Date(data.created_at);
                            $('#chatArea').append(`
                            <div class="flex gap-2.5 mb-3 col-start-1 col-end-1 top-0 right-0">
                                <div class="flex flex-col w-full max-w-md leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <span class="text-sm font-semibold text-gray-900">Hệ thống</span>
                    <span class="text-sm font-normal text-gray-500">${timeDifference(new Date(), parsedDate)}</span>
                                    </div>
                                    <p class="text-sm font-normal py-2.5 text-gray-900">${data.message}</p>
    ${data.attachments ? `<div class="group relative my-2.5"><img src="{{ asset('ticketsImg') }}/` + data.attachments + `" class="rounded-lg" /></div>` : ""}
                            </div>
                            <img class="w-8 h-8 rounded-full" src="https://i.pinimg.com/474x/2f/aa/d3/2faad31c599c50d588953bd9d09a2362.jpg" alt="Jese image">
                        </div>`)
                            objDiv.scrollTop = objDiv.scrollHeight

                        }
                    }
                },
                error: function(error) {
                    toast('error', msg);
                }
            });
        }, 3000);
        @endif
    })
</script>
@endsection
