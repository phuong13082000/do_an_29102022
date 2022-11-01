@extends('layout.user')

@section('index')
    @php

        $customer_id = Session::get('id');
        $customer_name = Session::get('name');
        $customer_email = Session::get('email');
        $customer_address = Session::get('address');
        $customer_phone = Session::get('phone');
        $customer_gender = Session::get('gender');
    @endphp
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
                                    <img src="{{asset('uploads/product/'.$content->options->image)}}" width="90" alt="{{$content->name}}"/>
                                </td>

                                <td class="cart_description">
                                    <h4>{{$content->name}}</a></h4>
                                </td>

                                <td class="cart_price">
                                    <p>{{number_format($content->price).' '.'vnđ'}}</p>
                                </td>

                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        {!! Form::open(['url'=>'/update-cart-quantity', 'method'=>'POST']) !!}
                                        <label>
                                            <input name="cart_quantity" type="number" min="1" max="{{$content->weight}}" class="cart_quantity_input" value="{{$content->qty}}">
                                        </label>
                                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-success btn-sm']) !!}
                                        <input type="hidden" value="{{$content->rowId}}" name="rowId_cart" class="form-control">
                                        {!! Form::close() !!}
                                    </div>
                                </td>

                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        @php
                                            $subtotal = $content->price * $content->qty;
                                            echo number_format($subtotal).' '.'vnđ';
                                        @endphp
                                    </p>
                                </td>

                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{url('/delete-to-cart/'.$content->rowId)}}"><i class="fa fa-times"></i></a>
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
                                    <a type="button" href="{{ url('checkout') }}" class="btn btn-primary">Checkout</a>
                                    <a class="btn btn-success" href="{{url('/')}}">Home</a>
                                @else
                                    <a type="button" href="{{ url('dang-nhap') }}" class="btn btn-primary">Login</a>
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
@endsection
