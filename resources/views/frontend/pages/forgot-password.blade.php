@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>

                <div class="col-sm-4">
                    <div class="login-form">
                        <h2 class="text-center mb-4">Quên mật khẩu</h2>
                        {!! Form::open(['url'=>'/recover-password', 'method'=>'POST']) !!}
                            <div class="form-floating mb-4">
                                {!! Form::email('email',  old('email') , ['class'=>'form-control', 'placeholder'=>'Email']) !!}
                                {!! Form::label('email', 'Email', []) !!}
                            </div>
                            <div class="d-grid gap-2 mb-3">
                                {!! Form::submit('Lấy lại mật khẩu', ['class'=>'btn btn-primary']) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection
