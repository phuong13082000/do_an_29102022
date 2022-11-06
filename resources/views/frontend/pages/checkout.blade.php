@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    <div class="mt-3">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::open(['url'=>'#']) !!}

                <h3>Thông tin nhận hàng</h3>
                <hr>
                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('name_nguoinhan', 'Tên người nhận hàng', []) !!}
                        {!! Form::text('name_nguoinhan', '', ['class'=>'form-control', 'id'=>'name_nguoinhan']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('phone_nguoinhan', 'Số điện thoại nhận hàng', []) !!}
                        {!! Form::text('phone_nguoinhan', '', ['class'=>'form-control', 'id'=>'phone_nguoinhan']) !!}
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
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id='ward' class="form-control">
                            </select>
                        </div>
                        <span id="address"></span>
                    </div>

                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('payment_method', 'Phương thức thanh toán', []) !!}
                        {!! Form::select('payment_method', ['Tiền mặt'=>'Tiền mặt', 'Trả bằng thẻ ngân hàng'=>'Trả bằng thẻ ngân hàng'], '', ['class'=>'form-control', 'id'=>'payment_method']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('note', 'Ghi chú', []) !!}
                        {!! Form::textarea('note', '', ['class'=>'form-control', 'id'=>'note']) !!}
                    </div>
                </div>

                {!! Form::submit('Xác nhận đơn hàng', ['class'=>'btn btn-success btn-submit']) !!}

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
                                            <td><img src="{{asset('uploads/product/'.$content->options->image)}}" width="90" alt="{{$content->name}}"/></td>
                                            <td><h4>{{$content->name}}</a></h4></td>
                                            <td>
                                                <p>{{number_format($content->price).' '.'vnđ'}}</p>
                                                <input type="hidden" id="product_price" value="{{$content->price}}">
                                            </td>
                                            <td>{{$content->qty}}</td>
                                            <td>
                                                <p>
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

                        <div id="fee_ship_hidden"></div>
                        <h3>Thành tiền :<span>{{Cart::total().' '.'VND'}}</span></h3> + <h3 id="fee_ship">Tiền ship :</h3>

                    </div>
                @else
                    <div class="container">
                        <div class="mt-3">
                            <a href="{{url('/')}}" style="text-decoration: none"> Quay lại trang chủ và chọn đồ để mua</a>
                        </div>
                    </div>
                @endif
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
