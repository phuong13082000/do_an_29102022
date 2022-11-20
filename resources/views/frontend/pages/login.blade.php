@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="login-form"><!--login form-->
                        <h2 class="text-center mb-4">Đăng Nhập</h2>
                        {!! Form::open(['url'=>'/login-customer', 'method'=>'POST', 'id'=>'login_form']) !!}

                        <div class="form-floating mb-4">
                            {!! Form::email('email_login',  old('email_account') , ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                            {!! Form::label('email_login', 'Email', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::password('password_login', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                            {!! Form::label('password_login', 'Mật khẩu', []) !!}
                        </div>

                        <div class="row mb-4">
                            <div class="col d-flex">
                                <div class="col"></div>
                                <div class="col"></div>
                                <div class="col">
                                    <a class="text-decoration-none" href="{{url('/forgot-password')}}">Quên mật khẩu?</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            {!! Form::submit('Đăng nhập', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}

                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Bạn không phải thành viên? <a class="text-decoration-none" href="{{ url('dang-ki') }}">Đăng kí</a></p>
                            <p>hoặc đăng nhập bằng:</p>
                            <a type="button" class="btn btn-link btn-floating mx-1" href="{{ url('/login-facebook') }}"><i class="fa fa-facebook-f"></i></a>
                            <a type="button" class="btn btn-link btn-floating mx-1" href="{{ url('/login-google') }}"><i class="fa fa-google"></i></a>
                        </div>

                    </div><!--/login form-->
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection

