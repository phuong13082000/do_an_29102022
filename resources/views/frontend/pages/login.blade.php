@extends('layout.user')

@section('index')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login Account</h2>

                        {!! Form::open(['url'=>'/login-customer', 'method'=>'POST']) !!}
                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('email_login', 'Email', []) !!}
                                {!! Form::email('email_login',  old('email_account') , ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('password_login', 'Password', []) !!}
                                {!! Form::password('password_login', ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::checkbox('checkbox', 1, '') !!}
                                {!! Form::label('checkbox', 'Ghi nhớ đăng nhập', []) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            {!! Form::submit('Login', ['class'=>'btn btn-success']) !!}
                        </div>

                        {!! Form::close() !!}

                        <div class="mb-3">
                            <a href="{{ url('/login-facebook') }}" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                            <a href="{{ url('/login-google') }}" class="btn btn-danger"><i class="fa fa-google"></i> Google</a>
                        </div>
                    </div><!--/login form-->
                </div>

                <div class="col-sm-2">
                    <h2 class="or">Or</h2>
                </div>

                <div class="col-sm-6">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Sign up</h2>

                        {!! Form::open(['url'=>'/add-customer', 'method'=>'POST']) !!}

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('fullname', 'Full Name', []) !!}
                                {!! Form::text('fullname',  old('fullname') , ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('email', 'Email', []) !!}
                                {!! Form::email('email',  old('customer_email') , ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('password', 'Password', []) !!}
                                {!! Form::password('password', ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('phone', 'Phone', []) !!}
                                {!! Form::text('phone',  old('customer_phone') , ['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="mb-3">
                            {!! Form::submit('Signup', ['class'=>'btn btn-success']) !!}
                        </div>

                        {!! Form::close() !!}

                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </div>
@endsection
