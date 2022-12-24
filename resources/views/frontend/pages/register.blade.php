@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2 class="text-center mb-4">Đăng kí</h2>
                        {!! Form::open(['url'=>'/add-customer', 'method'=>'POST', 'id'=>'register_form']) !!}

                        <div class="form-floating mb-4">
                            {!! Form::text('fullname',  old('fullname') , ['class'=>'form-control', 'placeholder'=>'Họ Và Tên']) !!}
                            {!! Form::label('Họ Và Tên', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::email('email',  old('customer_email') , ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                            {!! Form::label('Email', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::text('phone',  old('customer_phone') , ['class'=>'form-control', 'placeholder'=>'Số điện thoại']) !!}
                            {!! Form::label('Số điện thoại', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Mật khẩu']) !!}
                            {!! Form::label('Mật khẩu', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::password('password_confirm', ['class'=>'form-control', 'placeholder'=>'Nhập lại mật khẩu']) !!}
                            {!! Form::label('Nhập lại mật khẩu', []) !!}
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            {!! Form::submit('Đăng kí', ['class'=>'btn btn-primary btn_signup']) !!}
                        </div>

                        {!! Form::close() !!}

                    </div><!--/sign up form-->
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection
