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
                        <h2 class="text-center mb-4">Reset Account</h2>
                        {!! Form::open(['url'=>'/reset-new-password', 'method'=>'POST']) !!}
                            @php
                                $token = $_GET['token'];
                                $email = $_GET['email'];
                            @endphp

                            <input type="hidden" name="email" value="{{$email}}">
                            <input type="hidden" name="token" value="{{$token}}">

                            <div class="form-floating mb-4">
                                {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                                {!! Form::label('password', 'Password', []) !!}
                            </div>
                            <div class="form-floating mb-4">
                                {!! Form::password('password_2', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                                {!! Form::label('password_2', 'Re Password', []) !!}
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                {!! Form::submit('Reset', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}

                    </div><!--/login form-->
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection
