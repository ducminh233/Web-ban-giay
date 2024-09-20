<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng Ký</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('frontend/logins/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/logins/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/logins/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/logins/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/logins/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/logins/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/logins/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/logins/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/logins/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/logins/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/logins/css/main.css') }}">
    <!--===============================================================================================-->
	 <!-- select2 -->
	 <link rel="stylesheet" href="{!! asset('backend/plugins/select2/css/select2.min.css') !!}">
	 <!-- toastr -->
	 <link rel="stylesheet" href="{!! asset('backend/plugins/toastr/toastr.min.css') !!}">
</head>

<body>

    <div class="limiter">
        <div class="container-login100"
            style="background-image: url('{{ asset('frontend/logins/images/bg-01.jpg') }}' ">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" method="POST" action="{{ route('register.submit') }}">
                    <span class="login100-form-title p-b-49">
                        Đăng Ký
                    </span>
                    @csrf
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                        <span class="label-input100">Họ tên</span>
                        <input class="input100" type="text" name="name" value="{{old('name')}}" placeholder="Nhập họ tên">
                        @error('name')
                        <span class="focus-input100" data-symbol="&#xf206;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" value="{{old('email')}}" placeholder="Nhập email của bạn">
                        @error('email')
                        <span class="focus-input100" data-symbol="&#xf206;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Mật khẩu</span>
                        <input class="input100" type="password" name="password" value="{{old('password')}}" placeholder="Nhập mật khẩu của bạn">
                        @error('password')
                        <span class="focus-input100" data-symbol="&#xf190;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Nhập lại mật khẩu</span>
                        <input class="input100" type="password" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Nhập lại mật khẩu">
                        @error('password_confirmation')
                        <span class="focus-input100" data-symbol="&#xf190;">{{$message}}</span>
                        @enderror
                    </div>
                    
                    <div class="text-right p-t-8 p-b-31">
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit">
                                Đăng ký
                            </button>
                        </div>
                    </div>
                    <div class="flex-col-c p-t-155">
                        <span class="txt1 p-b-17">
                            Bạn đã có tài khoản
                        </span>

                        <a href="{{route('login.form')}}" class="txt2">
                            Đăng nhập
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/logins/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/logins/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/logins/js/main.js') }}"></script>

    <script src="{!! asset('backend/plugins/select2/js/select2.min.js') !!}"></script>
    <!-- toastr -->
    <script src="{!! asset('backend/plugins/toastr/toastr.min.js') !!}"></script>
    <script>
        toastr.options.closeButton = true;
        @if (session('success'))
            var message = "{{ session('success') }}";
            toastr.success(message, {
                timeOut: 3000
            });
        @endif
        @if (session('error'))
            var message = "{{ session('error') }}";
            toastr.error(message, {
                timeOut: 3000
            });
        @endif
        setTimeout(function() {
            toastr.clear()
        }, 3000);
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
</body>

</html>
