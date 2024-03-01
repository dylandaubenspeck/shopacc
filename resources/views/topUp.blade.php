@extends('layouts.guest')
@section('head')
<style>
    input {
        border-color: #ff9494ff;

        box-shadow: 0 0 0 2px #ff9494ff;

    }

    #mainContent {

        display: flex;
        flex-direction: colum;
        justify-content: center;
        background: linear-gradient(rgba(255, 163, 163, 0.3), rgb(243, 244, 246)), url(https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg);
    }
    .childContent{
        display: flex;
        flex-direction: column;
    }



    .leftContent {
        margin-right: 20px;
        background-color: rgb(252, 252, 252);
        width: 500px;
        max-height: 700px;
        text-align: center;

    }

    .rightContent {
        margin-left: 20px;
        background-color: rgb(252, 252, 252);
        width: 500px;
        height: 700px;
        text-align: left;

    }

    .content {
        /* margin-right: 60px; */
        border-radius: 10px;
        border: 3px solid #ff9494ff;
        margin-top: 40px;
        margin-bottom: 45px;
        opacity: 0;
        animation: fadeIn 1.5s ease forwards;

    }

    .stk,
    .bankMess,
    .typeBank {
        margin-top: 40px;
        margin-left: 40px;
    }

    .typeBank {
        margin-top: 100px;
    }

    .qr {
        margin-top: 59px;
        border: 3px solid rgb(163, 77, 77);
    }

    .step {
        margin-top: 25px;
    }

    .bg-imageLeft {
        background-image: url('img/owen.png');
        background-size: cover;
        background-position: center;
        transform: translateX(-10%);
        position: absolute;
        top: 0;
        left: 0;
        width: 30%;
        height: 100%;
        z-index: -1;
    }
    .bg-imageRight {
        background-image: url('img/chammbar.png');
        background-size: cover;
        transform: translateX(240%);
        background-position: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 27%;
        height: 100%;
        z-index: -2;
    }
    #contentChild {
        justify-content: space-around;
        display: flex;
    }
    @media (max-width: 800px) {
        .backimg {
            visibility: hidden;
        }
        .copy {
            scale: 0.8;
        }
        .content {
            margin: 0;
            margin-top: 10px;
            width: 100%;
        }
        #contentChild  {
            margin: 0;
            flex-direction: column;
        }
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px); /* Di chuyển form lên trên một chút */
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
@section('content')
<div id="mainContent"  class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="bg-imageLeft"></div>
    <div class="bg-imageRight"></div>

    <div id="contentChild">
        <div class="leftContent content"
             style="border: 3px solid; border-image: linear-gradient(to left, rgba(255, 102, 102, 0.7), transparent) 1;">
            <div class="QR">
                <img style="border: 4px solid; border-image: linear-gradient(to left, rgba(255, 102, 102, 0.7), transparent) 1;"
                     class=" qr mx-auto mt-12 h-60 w-60 rounded-lg border p-2 md:mt-0" src="img/QR.png" />
            </div>
            <div class="step">

                <ol style="margin-top: 80px;"
                    class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400">
                    <li class="mb-10 ms-6">
            <span
                class=" absolute flex items-center justify-center w-8 h-8 bg-green-200 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-green-900">
              <svg class="w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M1 5.917 5.724 10.5 15 1.5" />
              </svg>
            </span>
                        <h3 class="font-medium leading-tight">Thông tin người nhận</h3>
                        <p class="text-sm"><b>Chủ shop</b></p>
                    </li>
                    <li class="mb-10 ms-6">
            <span
                class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
              <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                <path
                    d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
              </svg>
            </span>
                        <h3 class="font-medium leading-tight">Vietcombank</h3>
                        <p class="text-sm"><b>STK XXXXXXXXX</b></p>
                    </li>
                    <li class="mb-10 ms-6">
            <span
                class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
              <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                   xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path
                    d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
              </svg>
            </span>
                        <h3 class="font-medium leading-tight">Nội dung chuyển khoản</h3>
                        <p class="text-sm"><b>Anh nho em nyc <3</b>
                        </p>
                    </li>
                </ol>
            </div>
        </div>




        <!---------------------------------------lLEFT-->
        <div class="rightContent content"
             style="border: 3px solid; border-image: linear-gradient(to left, rgba(255, 102, 102, 0.7), transparent) 1;">
            <div class="copy">
                <div class="typeBank">
                    <div class="grid grid-cols-8 gap-2 w-full max-w-[23rem]">
                        <label for="npm-install" class="sr-only">Label</label>
                        <input id="npm-install_typeBank" type="text"
                               class="col-span-6 bg-gray-50 border border-gray-300 text-black font-bold text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="VIETCOMBANK" disabled readonly>
                    </div>
                </div>
                <div class="stk">
                    <div class="grid grid-cols-8 gap-2 w-full max-w-[23rem]">
                        <label for="npm-install" class="sr-only">Label</label>
                        <input id="npm-install_stk" type="text"
                               class="col-span-6 bg-gray-50 border border-gray-300 text-black font-bold text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="STK CỦA CHỦ SHOP" disabled readonly>
                        <button class="w-20 h-15 rounded-full relative inline-flex items-center justify-center  p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white"
                                data-copy-to-clipboard-target="npm-install_stk"
                                class="col-span-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 items-center inline-flex justify-center">
                            <span id="default-message">Copy</span>
                            <span id="success-message" class="hidden inline-flex items-center">
                <svg class="w-3 h-3 text-white me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 16 12">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5.917 5.724 10.5 15 1.5" />
                </svg>
              </span>
                        </button>
                    </div>
                </div>
                <div class="bankMess ">
                    <div class="grid grid-cols-8 gap-2 w-full max-w-[23rem]">
                        <label for="npm-install" class="sr-only">Label</label>
                        <input id="npm-install_bankMess" type="text"
                               class="col-span-6 bg-gray-50 border border-gray-300 text-black font-bold text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="NỘI DUNG CHUYỂN KHOẢN" disabled readonly>
                        <button class="w-20 h-15 rounded-full relative inline-flex items-center justify-center  p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white"
                                ;" data-copy-to-clipboard-target="npm-install_bankMess"
                        class="col-span-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 items-center inline-flex justify-center">
                        <span id="default-message">Copy</span>
                        <span id="success-message" class="hidden inline-flex items-center">
                <svg class="w-3 h-3 text-white me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 16 12">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5.917 5.724 10.5 15 1.5" />
                </svg>
              </span>
                        </button>
                    </div>


                </div>
            </div>
            <div class="relative text-gray-500 border-s border-gray-200 dark:border-gray-700 dark:text-gray-400"
                 style="margin-left: 30px; margin-top: 100px; padding: 10px;      border: none;">
                <p><strong>❗Lưu ý trước khi chuyển khoản:</strong></p>
                <ul>
                    <h3 class="font-medium leading-tight">Kiểm tra kỹ thông tin người nhận và số tiền.</h3>
                    <li>Đảm bảo nhập đúng mã số tài khoản hoặc số thẻ ngân hàng.</li>
                    <li>Chờ đợi để giao dịch được xử lý.</li>
                    <li>Hiểu rõ các khoản phí liên quan và lưu lại thông tin giao dịch.</li>
                    <li>Liên hệ với dịch vụ khách hàng nếu có thắc mắc.</li>
                    <li>Thực hiện giao dịch qua các kênh an toàn và được xác thực.</li>
                </ul>
            </div>
        </div>

    </div>

    </div>
    <!-- Main Content QR-->
@endsection
