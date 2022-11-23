<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- CSRF Token -->

    <title>{{$title}}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}"><!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}"><!-- Theme style -->

</head>
<body class="hold-transition login-page">
<div class="login-box">

    <div class="login-logo">
        <a href="#"><b>Admin</b>Login</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

            <form action="{{url('admin/reset-new-password')}}" method="post">
                @csrf
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @php
                    $token = $_GET['token'];
                    $email = $_GET['email'];
                @endphp
                <input type="hidden" name="email" value="{{$email}}">
                <input type="hidden" name="token" value="{{$token}}">

                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Đổi mật khẩu</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{url('admin/login')}}">Login</a>
            </p>
        </div>
    </div>
</div>

<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script><!-- jQuery -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script><!-- Bootstrap 4 -->
<script src="{{asset('admin/js/adminlte.js')}}"></script><!-- AdminLTE App -->

</body>
</html>
