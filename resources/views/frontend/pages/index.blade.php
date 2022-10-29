@extends('layout.user')

@section('index')
    @include('frontend.includes.slider')
    <div class="mt-3 btn-group">
        <div class="pe-3">
            <div class="dropdown">
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="loaisanpham" data-bs-toggle="dropdown" aria-expanded="false">
                    Loại sản phẩm
                </a>

                <ul class="dropdown-menu" aria-labelledby="loaisanpham">
                    @foreach($list_category as $category)
                        <li>
                            <a class="dropdown-item" href="{{route('category', $category->id)}}">{{$category->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="pe-3">
            <div class="dropdown">
                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="giasanpham" data-bs-toggle="dropdown" aria-expanded="false">
                    Giá
                </a>

                <ul class="dropdown-menu" aria-labelledby="giasanpham">
                    <li><a class="dropdown-item" href="#">Dưới 2 triệu</a></li>
                    <li><a class="dropdown-item" href="#">Từ 2 đến 4 triệu</a></li>
                    <li><a class="dropdown-item" href="#">Từ 4 đến 7 triệu</a></li>
                    <li><a class="dropdown-item" href="#">Từ 7 đến 13 triệu</a></li>
                    <li><a class="dropdown-item" href="#">Từ 13 đến 20 triệu</a></li>
                    <li><a class="dropdown-item" href="#">Trên 20 triệu</a></li>
                </ul>
            </div>
        </div>

    </div>

    <div class="mt-3">
        <div class="new-item">
            <div class="row">
                <h2 class="text-center mb-3">New Items</h2>
                @foreach($list_product_new as $product_new)
                    @php
                        $gia = number_format($product_new->price, 0, '', ',');
                        $giaGiam = number_format($product_new->price_sale, 0, '', ',');
                        $phanTramGiam = round(100 - ($product_new->price_sale / $product_new->price * 100), PHP_ROUND_HALF_UP); //PHP_ROUND_HALF_UP làm tròn 1,5->2
                    @endphp
                <div class="col-sm-3">
                    <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        <img src="{{asset('uploads/product/'.$product_new->image)}}" class="card-img-top" alt="{{$product_new->title}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$product_new->title}}</h5>
                            <p class="card-subtitle">
                                @if($product_new->number)
                                    @if($product_new->price_sale)
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
                            <a href="{{route('detail',$product_new->id)}}" class="btn btn-default border-dark">Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="sell-item">
            <div class="row">
                <h2 class="text-center mb-3">Top Sell Items</h2>
                @foreach($list_product_sale as $product_sale)
                    @php
                        $gia = number_format($product_sale->price, 0, '', ',');
                        $giaGiam = number_format($product_sale->price_sale, 0, '', ',');
                        $phanTramGiam = round(100 - ($product_sale->price_sale / $product_sale->price * 100), PHP_ROUND_HALF_UP); //PHP_ROUND_HALF_UP làm tròn 1,5->2
                    @endphp
                    <div class="col-sm-3">
                        <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                            <img src="{{asset('uploads/product/'.$product_sale->image)}}" class="card-img-top" alt="{{$product_sale->title}}">
                            <div class="card-body">
                                <h5 class="card-title">{{$product_sale->title}}</h5>
                                <p class="card-subtitle">
                                    @if($product_sale->number)
                                        @if($product_sale->price_sale)
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
                                <a href="{{route('detail',$product_sale->id)}}" class="btn btn-default border-dark">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @include('frontend.includes.recommend-items')

@endsection
