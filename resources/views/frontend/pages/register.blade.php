@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2 class="text-center mb-4">Sign up</h2>
                        {!! Form::open(['url'=>'/add-customer', 'method'=>'POST', 'id'=>'register_form']) !!}

                        <div class="form-floating mb-4">
                            {!! Form::text('fullname',  old('fullname') , ['class'=>'form-control', 'placeholder'=>'Full Name']) !!}
                            {!! Form::label('Full Name', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::email('email',  old('customer_email') , ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                            {!! Form::label('Email', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::text('phone',  old('customer_phone') , ['class'=>'form-control', 'placeholder'=>'Phone']) !!}
                            {!! Form::label('Phone', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password']) !!}
                            {!! Form::label('Password', []) !!}
                        </div>

                        <div class="form-floating mb-4">
                            {!! Form::password('password_confirm', ['class'=>'form-control', 'placeholder'=>'Password Confirm']) !!}
                            {!! Form::label('Password Confirm', []) !!}
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            {!! Form::submit('Sign up', ['class'=>'btn btn-success btn_signup']) !!}
                        </div>

                        {!! Form::close() !!}

                    </div><!--/sign up form-->
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection
