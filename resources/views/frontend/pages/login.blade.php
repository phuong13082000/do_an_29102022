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
                        <h2 class="text-center mb-4">Login Account</h2>
                        {!! Form::open(['url'=>'/login-customer', 'method'=>'POST', 'id'=>'login_form']) !!}

                        <div class="form-floating mb-4">
                            {!! Form::email('email_login',  old('email_account') , ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                            {!! Form::label('email_login', 'Email', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::password('password_login', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                            {!! Form::label('password_login', 'Password', []) !!}
                        </div>

                        <div class="row mb-4">
                            <div class="col d-flex">
                                <div class="form-check">
                                    {!! Form::checkbox('checkbox', 'checked', ['class'=>'form-check-input']) !!}
                                    {!! Form::label('checkbox', 'Remember me', ['class'=>'form-check-label']) !!}
                                </div>
                                <div class="col"></div>
                                <div class="col">
                                    <a href="#">Forgot password?</a>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            {!! Form::submit('Sign in', ['class'=>'btn btn-primary']) !!}
                        </div>

                        {!! Form::close() !!}

                        <!-- Register buttons -->
                        <div class="text-center">
                            <p>Not a member? <a href="{{ url('dang-ki') }}">Register</a></p>
                            <p>or sign up with:</p>
                            <a type="button" class="btn btn-link btn-floating mx-1" href="{{ url('/login-facebook') }}">
                                <i class="fa fa-facebook-f"></i>
                            </a>

                            <a type="button" class="btn btn-link btn-floating mx-1" href="{{ url('/login-google') }}">
                                <i class="fa fa-google"></i>
                            </a>
                        </div>

                    </div><!--/login form-->
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection
