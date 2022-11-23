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
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

            <form action="{{url('admin/recover-password')}}" method="post">
                @csrf
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Lấy lại mật khẩu</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="{{url('admin/login')}}">Đăng nhập</a>
            </p>

        </div>
    </div>
</div>

<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script><!-- jQuery -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script><!-- Bootstrap 4 -->
<script src="{{asset('admin/js/adminlte.js')}}"></script><!-- AdminLTE App -->

</body>
</html>
