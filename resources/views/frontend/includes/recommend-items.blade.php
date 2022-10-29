<div class="mt-3">
    <h2 class="text-center mb-3">Recommended items</h2>
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
                                <b style="color: red">{{ $giaKhuyenMai }} VND</b>
                                <del>&nbsp;{{ $gia }} VND</del><b style="color: red"> -{{ $phanTramGiam }}%</b><br>
                            @else
                                <b>{{ $gia }} VND</b><br>
                            @endif
                        @else
                            <b style="color: red">Hết Hàng</b><br>
                        @endif
                        <p>{{$recommend->title}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
