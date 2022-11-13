<div class="mt-3">
    <h2 class="text-center mb-3">Sản phẩm gợi ý</h2>
    <div class="owl-carousel owl-theme">
        @foreach($list_recommend as $recommend)
            @php
                $gia = number_format($recommend->price, 0, '', ',');
                $giaKhuyenMai =  number_format($recommend->price_sale, 0, '', ',');
                $phanTramGiam = round(100 - ($recommend->price_sale / $recommend->price * 100), PHP_ROUND_HALF_UP);
            @endphp
            <div class="item shadow-sm bg-body rounded">
                <div class="card text-center">
                    <div class="card-body ">
                        <img src="{{asset('uploads/product/'.$recommend->image)}}" alt="{{$recommend->title}}"/>
                        @if($recommend->number)
                            @if($recommend->price_sale)
                                <b style="color: red">{{ $giaKhuyenMai }} VND</b><br>
                                <del>&nbsp;{{ $gia }} VND</del><b style="color: red"> -{{ $phanTramGiam }}%</b><br>
                            @else
                                <b>{{ $gia }} VND</b><br>
                            @endif
                        @else
                            <b style="color: red">Hết Hàng</b><br>
                        @endif
                        <p>{{$recommend->title}}</p>
                        {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

                        {{--soluong--}}
                        <input name="qty" type="hidden" min="1" max="{{$recommend->number}}" class="cart_product_qty_{{$recommend->id}}" value="1"/>
                        {!! Form::hidden('productid_hidden', $recommend->id) !!}
                        <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
