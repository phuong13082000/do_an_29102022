@extends('layout.user')

@section('index')
    @php
        $content = Cart::content();
        $count = Cart::count();
        $customer_id = Session::get('id');
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
                                    <img src="{{asset('uploads/product/'.$v_content->options->image)}}" width="90" alt="{{$v_content->name}}"/>
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
                                            <input name="cart_quantity" type="number" min="1" max="{{$v_content->weight}}" class="cart_quantity_input" value="{{$v_content->qty}}">
                                        </label>
                                        {!! Form::submit('Cập nhật', ['class'=>'btn btn-success btn-sm']) !!}
                                        <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
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
                                    <a class="cart_quantity_delete" href="{{url('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCheckout">Thanh toán</button>
                                    <a class="btn btn-success" href="{{url('/')}}">Home</a>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">Đăng nhập</button>
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
