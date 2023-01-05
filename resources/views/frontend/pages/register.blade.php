@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="signup-form">
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
                                {!! Form::password('password', ['class'=>'form-control password', 'placeholder'=>'Mật khẩu']) !!}
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
                    </div>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        <!--validate-register-->
        $(function () {
            $("#register_form").validate({
                rules: {
                    fullname: {
                        required: true, minlength: 2
                    },
                    email: {
                        required: true, email: true
                    },
                    phone: {
                        required: true, number: true, minlength: 10, maxlength: 10
                    },
                    password: {
                        required: true, minlength: 1
                    },
                    password_confirm: {
                        required: true, minlength: 1, equalTo: ".password"
                    },
                },
                messages: {
                    fullname: {
                        required: "<div style='color: red;'>Please enter some data</div>", minlength: "<div style='color: red;'>Full name min 10 character</div>"
                    },
                    email: {
                        required: "<div style='color: red;'>Please enter some data</div>", email: "<div style='color: red;'>Wrong format email",
                    },
                    phone: {
                        required: "<div style='color: red;'>Please enter some data</div>", number: "<div style='color: red;'>Please enter number</div>", minlength: "<div style='color: red;'>Phone length 10 number</div>", maxlength: "<div style='color: red;'>Phone length 10 number</div>",
                    },
                    password: {
                        required: "<div style='color: red;'>Please enter some data</div>", minlength: "<div style='color: red;'>Password length 6 character</div>",
                    },
                    password_confirm: {
                        required: "<div style='color: red;'>Please enter some data</div>", minlength: "<div style='color: red;'>Password length 6 character</div>", equalTo: "<div style='color: red;'>Wrong Password</div>"
                    },
                },
                errorElement: "div",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    error.insertAfter(element);
                },
                highlight: function (element) {
                    $(element).removeClass('is-valid').addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });
        });
    </script>
@endsection
