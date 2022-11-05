@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    <div class="mt-3">
        <div class="new-item">
            <div class="row">
                <h2 class="text-center mb-3">{{$title}}</h2>
                @foreach($list_product as $product)
                    @php
                        $gia = number_format($product->price, 0, '', ',');
                        $giaGiam = number_format($product->price_sale, 0, '', ',');
                        $phanTramGiam = round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP); //PHP_ROUND_HALF_UP làm tròn 1,5->2
                    @endphp
                    <div class="col-sm-3">
                        <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                            <img src="{{asset('uploads/product/'.$product->image)}}" class="card-img-top" alt="{{$product->title}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-subtitle">
                                    @if($product->number)
                                        @if($product->price_sale)
                                            <del>{{ $gia }} VND</del><b style="color: red"> -{{ $phanTramGiam }}%</b>
                                            <br><b>{{ $giaGiam }} VND</b>
                                        @else
                                            <b>{{ $gia }} VND</b>
                                        @endif
                                    @else
                                        <b style="color: red">Hết Hàng</b>
                                    @endif
                                </p>
                                <p class="card-text">

                                </p>
                                {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                                {{--soluong--}}
                                <input name="qty" type="hidden" min="1" max="{{$product->number}}" class="cart_product_qty_{{$product->id}}" value="1"/>
                                {!! Form::hidden('productid_hidden', $product->id) !!}
                                <a href="{{route('detail',$product->id)}}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection
