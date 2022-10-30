@extends('layout.user')

@section('index')
    @php
        $content = Cart::content();
        $count = Cart::count();
        $customer_id = Session::get('id');
        $customer_name = Session::get('name');
        $customer_email = Session::get('email');
        $customer_address = Session::get('address');
        $customer_phone = Session::get('phone');
        $customer_gender = Session::get('gender');
    @endphp
    @if($count != 0)
        <div class="container">
            <div class="mt-3">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Tên sản phẩm</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng</td>
                            <td></td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($content as $v_content)
                            <tr>
                                <td class="cart_product">
                                    <img src="{{asset('uploads/product/'.$v_content->options->image)}}" width="90"
                                         alt="{{$v_content->name}}"/>
                                </td>

                                <td class="cart_description">
                                    <h4>{{$v_content->name}}</a></h4>
                                </td>

                                <td class="cart_price">
                                    <p>{{number_format($v_content->price).' '.'vnđ'}}</p>
                                </td>

                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {!! Form::open(['url'=>'/update-cart-quantity', 'method'=>'POST']) !!}
                                        <label>
                                            <input name="cart_quantity" type="number" min="1"
                                                   max="{{$v_content->weight}}" class="cart_quantity_input"
                                                   value="{{$v_content->qty}}">
                                        </label>
                                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-success btn-sm']) !!}
                                        <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"
                                               class="form-control">
                                        {!! Form::close() !!}
                                    </div>
                                </td>

                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        @php
                                            $subtotal = $v_content->price * $v_content->qty;
                                            echo number_format($subtotal).' '.'vnđ';
                                        @endphp
                                    </p>
                                </td>

                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                       href="{{url('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <section id="do_action">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="total_area">
                                <ul>
                                    <li>Thành tiền <span>{{Cart::total().' '.'vnđ'}}</span></li>
                                </ul>
                                @if($customer_id!=NULL)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalCheckout">Thanh toán
                                    </button>
                                    <a class="btn btn-success" href="{{url('/')}}">Home</a>
                                @else
                                    <button type="button" class="btn btn-primary">Đăng nhập</button>
                                    <a class="btn btn-primary" href="{{url('/')}}">Home</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </section><!--/#do_action-->
        </div>
    @else
        <div class="container">
            <div class="mt-3">
                <a href="{{url('/')}}" style="text-decoration: none"> Quay lại trang chủ và chọn đồ để mua</a>
            </div>
        </div>
    @endif

    {{--modal checkout--}}
    <div class="modal fade" id="modalCheckout" tabindex="-1" aria-labelledby="modalCheckoutLable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCheckoutLable">Thông tin khách hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['url'=>'/confirm-order', 'method'=>'POST']) !!}

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::radio('gender', 1 , $customer_gender==1 ? 'checked' : '' ) !!}
                            {!! Form::label('gender', 'Anh', []) !!}
                            {!! Form::radio('gender', 0 , $customer_gender==0 ? 'checked' : '' ) !!}
                            {!! Form::label('gender', 'Chị', []) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('email', 'Email', []) !!}
                            {!! Form::email('email', $customer_email, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('fullname', 'Họ tên', []) !!}
                            {!! Form::text('fullname', $customer_name, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('address', 'Địa chỉ', []) !!}
                            {!! Form::text('address', $customer_address, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('phone', 'Số điện thoại', []) !!}
                            {!! Form::text('phone', $customer_phone, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('note', 'Ghi chú', []) !!}
                            {!! Form::textarea('note', '', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('payment_method', 'Chọn hình thức', []) !!}
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item p-3" role="presentation">
                                    {!! Form::radio('payment_method', 1 , 'checked' ,
                                        ["class" => "nav-link active", "id" => "home-tab", "data-bs-toggle" => "tab" ,
                                       "data-bs-target" => "#home", "type" => "radio", "role" => "tab", "aria-controls"=>"home",
                                        "aria-selected" => "true"]) !!}
                                    {!! Form::label('payment_method', 'Giao tận nơi', []) !!}
                                </li>
                                <li class="nav-item p-3" role="presentation">
                                    {!! Form::radio('payment_method', 0 , '',
                                        ["class" => "nav-link", "id" => "profile-tab", "data-bs-toggle" => "tab" ,
                                       "data-bs-target" => "#profile", "type" => "radio", "role" => "tab", "aria-controls"=>"profile",
                                        "aria-selected" => "false"]) !!}
                                    {!! Form::label('payment_method', 'Nhận tại cửa hàng', []) !!}
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                     aria-labelledby="home-tab">
                                    <div class="container">
                                        <div class="mt-3">
                                            <label for='province'>Thành Phố
                                                <select id='province' class="form-control">
                                                    <option selected>Thành Phố</option>
                                                </select>
                                            </label>

                                            <label for='district'>Quận Huyện
                                                <select id='district' class="form-control">
                                                    <option selected>Quận Huyện</option>

                                                </select>
                                            </label>

                                            <label for='ward'>Phường Xã
                                                <select id='ward' class="form-control">
                                                    <option selected>Xã</option>
                                                </select>
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="container">
                                        <div class="mt-3">
                                            Địa chỉ cửa hàng
                                            {!! Form::hidden('diachi_cuahang', 'Thành Phố Hồ Chí Minh') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mb-3">
                        {!! Form::submit('Xác nhận đơn hàng', ['class'=>'btn btn-success']) !!}<br>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
