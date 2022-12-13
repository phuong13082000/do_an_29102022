@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    @php
        $customer_name = Session::get('name');
        $customer_email = Session::get('email');
        $customer_address = Session::get('address');
        $customer_phone = Session::get('phone');
        $customer_gender = Session::get('gender');
    @endphp

    @if(Cart::count() != 0)
        <div class="container">
            <div class="mt-3">
                <div class="table-responsive border border-dark rounded cart_info">
                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Tên sản phẩm</td>
                            <td class="price">Đơn giá</td>
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
                                <td><p>{{number_format($content->price).' '.'vnđ'}}</p></td>

                                <td>
                                    <div>
                                        {!! Form::open(['url'=>'/update-cart-quantity', 'method'=>'POST']) !!}
                                        <label>
                                            <input name="cart_quantity" type="number" min="1" max="{{$content->weight}}" class="cart_quantity_input" value="{{$content->qty}}">
                                        </label>
                                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-sm btn-default border-dark']) !!}
                                        <input type="hidden" value="{{$content->rowId}}" name="rowId_cart" class="form-control">
                                        {!! Form::close() !!}
                                    </div>
                                </td>

                                <td><p class="cart_total_price">{{ number_format($content->price * $content->qty).' '.'vnđ'}}</p></td>

                                <td><a class="cart_quantity_delete" href="{{url('/delete-to-cart/'.$content->rowId)}}"><i class="fa fa-times"></i></a></td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="container mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="total_area">
                                    @if(Session::get('id')!=NULL)
                                        <a class="btn btn-secondary" href="{{url('/')}}"><< Trở lại mua sắm</a>
                                        <a type="button" href="{{ url('checkout') }}" class="btn btn-primary">Checkout >></a>
                                    @else
                                        <a class="btn btn-secondary" href="{{url('/')}}"><< Trở lại mua sắm</a>
                                        <a type="button" href="{{ url('dang-nhap') }}" class="btn btn-primary">Đăng nhập >></a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    @else
        <div class="container">
            <div class="mt-3">
                <a href="{{url('/')}}" style="text-decoration: none"> Quay lại trang chủ và chọn đồ để mua</a>
            </div>
        </div>
    @endif
@endsection
