@extends('layout.user')

@section('index')
    <div class="mt-3">
        <div class="row">
            {{--thong tin khach hang--}}
            <div class="col-sm-6">
                <h3>Thông tin khách hàng</h3>
                <hr>
                {!! Form::open(['url'=>'/confirm-order', 'method'=>'POST']) !!}

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('fullname', 'Họ tên', []) !!}
                        {!! Form::text('fullname', Session::get('name'), ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('email', 'Email', []) !!}
                        {!! Form::email('email', Session::get('email'), ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('phone', 'Số điện thoại', []) !!}
                        {!! Form::text('phone', Session::get('phone'), ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('address', 'Địa chỉ', []) !!}
                        {!! Form::text('address', Session::get('address'), ['class'=>'form-control']) !!}
                    </div>
                </div>

                <h3>Thông tin nhận hàng</h3>
                <hr>
                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('name_nguoinhan', 'Tên người nhận hàng', []) !!}
                        {!! Form::text('name_nguoinhan', '', ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('phone_nguoinhan', 'Số điện thoại nhận hàng', []) !!}
                        {!! Form::text('phone_nguoinhan', '', ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <span>Địa chỉ nhận hàng</span>
                        <div class="col-sm-4">
                            <select id='province' class="form-control">
                                <option selected>Thành Phố</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id='district' class="form-control">
                                <option selected>Quận Huyện</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id='ward' class="form-control">
                                <option selected>Phường Xã</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('payment_method', 'Phương thức thanh toán', []) !!}
                        {!! Form::select('payment_method', ['Tiền mặt'=>'Tiền mặt', 'Trả bằng thẻ ngân hàng'=>'Trả bằng thẻ ngân hàng'], '', ['class'=>'form-control']) !!}
                    </div>
                </div>

            </div>


            {{--thong tin don hang--}}
            <div class="col-sm-6">
                <h3>Thông tin đơn hàng</h3>
                <hr>

                @if(Cart::count() != 0)
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
                                    @foreach(Cart::content() as $content)
                                        <tr>
                                            <td class="cart_product">
                                                <img src="{{asset('uploads/product/'.$content->options->image)}}"
                                                     width="90" alt="{{$content->name}}"/>
                                            </td>

                                            <td class="cart_description">
                                                <h4>{{$content->name}}</a></h4>
                                            </td>

                                            <td class="cart_price">
                                                <p>{{number_format($content->price).' '.'vnđ'}}</p>
                                            </td>

                                            <td class="cart_quantity">{{$content->qty}}</td>

                                            <td class="cart_total">
                                                <p class="cart_total_price">
                                                    @php
                                                        $subtotal = $content->price * $content->qty;
                                                        echo number_format($subtotal).' '.'vnđ';
                                                    @endphp
                                                </p>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h4>Tiền ship: <span id="fee_ship"></span></h4>

                        <h3>Thành tiền: <span>{{Cart::total().' '.'vnđ'}}</span></h3>

                        <div class="mb-3">
                            <div class="form-group">
                                {!! Form::label('note', 'Ghi chú', []) !!}
                                {!! Form::textarea('note', '', ['class'=>'form-control']) !!}
                            </div>
                        </div>

                    </div>
                @else
                    <div class="container">
                        <div class="mt-3">
                            <a href="{{url('/')}}" style="text-decoration: none"> Quay lại trang chủ và chọn đồ để
                                mua</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        {!! Form::submit('Xác nhận đơn hàng', ['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>

@endsection
