@extends('layouts.guest')
@section('head')
    <link rel="stylesheet" href="{{ asset('/css/Register.css') }}">
     <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet"
    />
@endsection
@section('content')
    <section class="formSignup bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="bg-imageLeft bgimg"></div>
            <div class="bg-imageRight bgimg"></div>

            <div style="border: 2.5px solid;     margin-left: 333px;  border-image: linear-gradient(to left, rgba(255, 102, 102, 0.7), transparent) 1;"  class="form-register w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div style="transition: 3s;" class="form p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Tạo tài khoản
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tên đăng nhập</label>
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                            @if ($errors->has('username'))
                                <span id="username-error" class="error">{{ $errors->first('username') }}</span>
                            @endif
                        </div>

                        <!-- Input cho email -->
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            @if ($errors->has('email'))
                            <span id="email-error" class="error">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <!-- Input cho password -->
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @if ($errors->has('password'))
                            <span id="password-error" class="error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <!-- Input cho confirm password -->
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            @if ($errors->has('password_confirmation'))
                            <span id="confirm-password-error" class="error">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" aria-describedby="terms" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required="">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">Tôi đồng ý <a  id ="tickAccpect" class="font-medium text-primary-600 hover:underline dark:text-primary-500" href="#">chính sách và điều khoản</a></label>
                            </div>
                        </div>
                        <button type="submit" class="custom-button text-black font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                            Đăng ký
                        </button>


                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Bạn đã có tài khoản ? <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Đăng nhập tại đây</a>
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection


@section('javascript')
    <script src="{{ asset('/js/Register.js') }}"></script>
@endsection
