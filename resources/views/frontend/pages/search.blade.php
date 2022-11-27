@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
    <div class="mt-3">
        <div class="row">
            <h2 class="text-center mb-3">{{$title}}</h2>
            @foreach($list_product as $product)
                <div class="col-sm-3">
                    <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        <img src="{{asset('uploads/product/'.$product->image)}}" class="card-img-top" alt="{{$product->title}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <p class="card-subtitle">
                                @if($product->number)
                                    @if($product->price_sale)
                                        <del>{{ number_format($product->price, 0, '', ',') }} VND</del>
                                        <b style="color: red">
                                            -{{ round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP) }}
                                            %</b>
                                        <br><b>{{ number_format($product->price_sale, 0, '', ',') }} VND</b>
                                    @else
                                        <b>{{ number_format($product->price, 0, '', ',') }} VND</b>
                                    @endif
                                @else
                                    <b style="color: red">Hết Hàng</b>
                                @endif
                            </p>
                            <p class="card-text">

                            </p>
                            {{--soluong--}}
                            {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
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
@endsection
