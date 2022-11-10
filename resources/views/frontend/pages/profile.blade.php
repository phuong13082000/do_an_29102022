@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="container">
            <h2 class="text-center mb-4">Profile</h2>
            <form method="POST" id="profile_setup_frm" action="#" >
                @csrf
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="p-3 py-5">
                            <div class="row" id="res"></div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Name</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="first name" value="{{ $customer->fullname }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Email</label>
                                    <input type="text" id="email" name="email" disabled class="form-control" value="{{ $customer->email }}" placeholder="Email">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" value="{{ $customer->phone }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Address</label>
                                    <input type="text" id="address" name="address" class="form-control" value="{{ $customer->address }}" placeholder="Address">
                                </div>
                            </div>

                            @if($customer->provider == 'facebook')
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Provider</label>
                                        <input type="text" id="provider" name="provider" disabled class="form-control" placeholder="provider" value="{{ $customer->provider }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">ID Facebook</label>
                                        <input type="text" id="facebook_id" name="facebook_id" disabled class="form-control" value="{{ $customer->facebook_id }}" placeholder="facebook_id">
                                    </div>
                                </div>
                            @endif
                            @if($customer->provider == 'google')
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="labels">Provider</label>
                                        <input type="text" id="provider" name="provider" disabled class="form-control" placeholder="provider" value="{{ $customer->provider }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">ID Google</label>
                                        <input type="text" id="google_id" name="google_id" disabled class="form-control" value="{{ $customer->google_id }}" placeholder="google_id">
                                    </div>
                                </div>
                            @endif
                            @if($customer->provider !== 'google' && $customer->provider !== 'facebook')
                                <div class="mt-5 text-center">
                                    <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#changePassword">Change Password</button>
                                </div>
                            @else
                                <div class="mt-5 text-center">
                                    <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-2"></div>

                </div>
            </form>
            <hr>
            <h2 class="text-center mb-4">Order History</h2>

            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Người nhận</th>
                        <th>Phương thức</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        {{--<th></th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($history_orders as $order)
                        <tr>
                            <td>{{$order->name_nguoinhan}}</td>
                            <td>{{$order->payment_method}}</td>
                            <td>
                                @if($order->status==1)
                                    Chưa xử lý
                                @elseif($order->status==2)
                                    Đã xử lý-Đã giao hàng
                                @else
                                    Hủy đơn hàng-tạm giữ
                                @endif
                            </td>
                            <td>{{$order->created_at}}</td>
                        {{--<td>
                                <div class="row">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detail">Detail</button>

                                </div>
                            </td>--}}
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal Change Password-->
    <div class="modal fade" id="changePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'change-password-user', 'method'=>'POST', 'id'=>'form_change-password', 'role'=>'form']) !!}

                    <div class="form-floating mb-4">
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                        {!! Form::label('password', 'Password old', []) !!}
                    </div>

                    <div class="form-floating mb-4">
                        {!! Form::password('password_new', ['class'=>'form-control']) !!}
                        {!! Form::label('password_new', 'Password new', []) !!}
                    </div>

                    <div class="form-floating mb-4">
                        {!! Form::password('re_password_new', ['class'=>'form-control']) !!}
                        {!! Form::label('re_password_new', 'Re-Password new', []) !!}
                    </div>

                    <div class="modal-footer justify-content-between">
                        {!! Form::submit('Add', ['class'=>'btn btn-success btn-change-password']) !!}
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Order
    <div class="modal fade" id="detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordLabel">Order Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

                </div>
            </div>
        </div>
    </div>-->
@endsection

@section('scripts')
    <script type="text/javascript">
        //update-profile
        $(document).ready(function () {
            $("#profile_setup_frm").submit(function (e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $("#btn").attr("disabled", true);
                $("#btn").html("Updating...");
                $.ajax({
                    url: "{{url('/update-profile')}}",
                    method: "POST",
                    data: {
                        name:name,
                        email:email,
                        phone:phone,
                        address:address
                    },
                    success: function (response) {
                        if (response.code == 400) {
                            let error = '<span class="alert alert-danger">' + response.msg + '</span>';
                            $("#res").html(error);
                            $("#btn").attr("disabled", false);
                            $("#btn").html("Save Profile");
                        } else if (response.code == 200) {
                            let success = '<span class="alert alert-success">' + response.msg + '</span>';
                            $("#res").html(success);
                            $("#btn").attr("disabled", false);
                            $("#btn").html("Save Profile");

                        }
                    }
                });
            });
        });

    </script>
@endsection
