@extends('layout.user')

@section('index')
    @include('frontend.includes.slider')
    @include('frontend.includes.alert')
    <div class="border mt-2 rounded">
        <nav class="navbar navbar-expand-lg navbar-light bg-light m-2">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
                <span>Lọc</span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item pe-3">
                        <div class="dropdown">
                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="loaisanpham" data-bs-toggle="dropdown" aria-expanded="false">Loại sản phẩm</a>

                            <ul class="dropdown-menu" aria-labelledby="loaisanpham">
                                @foreach($list_category as $category)
                                    <li><a class="dropdown-item" href="{{route('category', $category->id)}}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item pe-3">
                        <div class="dropdown">
                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="giasanpham" data-bs-toggle="dropdown" aria-expanded="false">Giá</a>
                            <ul class="dropdown-menu" aria-labelledby="giasanpham">
                                <li><a class="dropdown-item" href="{{route('price', 'duoi-2-trieu')}}">Dưới 2 triệu</a></li>
                                <li><a class="dropdown-item" href="{{route('price', 'tu-2-den-4-trieu')}}">Từ 2 đến 4 triệu</a></li>
                                <li><a class="dropdown-item" href="{{route('price', 'tu-4-den-7-trieu' )}}">Từ 4 đến 7 triệu</a></li>
                                <li><a class="dropdown-item" href="{{route('price', 'tu-7-den-13-trieu')}}">Từ 7 đến 13 triệu</a></li>
                                <li><a class="dropdown-item" href="{{route('price', 'tu-13-den-20-trieu')}}">Từ 13 đến 20 triệu</a></li>
                                <li><a class="dropdown-item" href="{{route('price', 'tren-20-trieu')}}">Trên 20 triệu</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item pe-3">
                        <div class="dropdown">
                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="ram" data-bs-toggle="dropdown" aria-expanded="false">Ram</a>

                            <ul class="dropdown-menu" aria-labelledby="ram">
                                <li><a class="dropdown-item" href="{{route('ram', '2-gb')}}">2 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('ram', '3-gb')}}">3 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('ram', '4-gb')}}">4 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('ram', '6-gb')}}">6 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('ram', '8-gb')}}">8 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('ram', '12-gb')}}">12 GB</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item pe-3">
                        <div class="dropdown">
                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="dungluong" data-bs-toggle="dropdown" aria-expanded="false">Dung Lượng Lưu Trữ</a>

                            <ul class="dropdown-menu" aria-labelledby="dungluong">
                                <li><a class="dropdown-item" href="{{route('dung-luong', '32-gb')}}">32 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('dung-luong', '64-gb')}}">64 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('dung-luong', '128-gb')}}">128 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('dung-luong', '256-gb')}}">256 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('dung-luong', '512-gb')}}">512 GB</a></li>
                                <li><a class="dropdown-item" href="{{route('dung-luong', '1-tb')}}">1 TB</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item pe-3">
                        <div class="dropdown">
                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="pinsac" data-bs-toggle="dropdown" aria-expanded="false">Pin & Sạc</a>

                            <ul class="dropdown-menu" aria-labelledby="pinsac">
                                <li><a class="dropdown-item" href="{{route('pin-sac', 'pin-khung-tren-5000-mah')}}">Pin khủng trên 5000mAh</a></li>
                                <li><a class="dropdown-item" href="{{route('pin-sac', 'sac-nhanh-tren-20w')}}">Sạc nhanh trên 20w</a></li>
                                <li><a class="dropdown-item" href="{{route('pin-sac', 'sac-khong-day')}}">Sạc không dây</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item pe-3">
                        <div class="dropdown">
                            <a class="btn btn-default dropdown-toggle" href="#" role="button" id="tinhnang" data-bs-toggle="dropdown" aria-expanded="false">Tính Năng Đặc Biệt</a>

                            <ul class="dropdown-menu" aria-labelledby="tinhnang">
                                <li><a class="dropdown-item" href="{{route('tinh-nang', 'khang-nuoc-bui')}}">Kháng nước, bụi</a></li>
                                <li><a class="dropdown-item" href="{{route('tinh-nang', 'ho-tro-5g')}}">Hỗ trợ 5G</a></li>
                                <li><a class="dropdown-item" href="{{route('tinh-nang', 'bao-mat-khuon-mat-3d')}}">Bảo mật khuôn mặt 3D</a></li>
                                <li><a class="dropdown-item" href="{{route('tinh-nang', 'chong-rung-quang-hoc')}}">Chống rung quang học</a></li>
                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="mt-3 m-2 btn-group">
            <label class="">Chọn điện thoại theo nhu cầu: <br>
                @foreach($list_category as $category)
                    <a type="button" href="{{route('category', $category->id)}}" class="btn btn-default border me-2">{{$category->title}}</a>
                @endforeach
             </label>
        </div>
    </div>

    <h3 class="text-center mb-3 mt-3">Sảm phẩm</h3>

    <div class="mt-3">
        <div class="new-item">
            <div class="row">
                @foreach($list_product as $product)
                    @php
                        $gia = number_format($product->price, 0, '', ',');
                        $giaGiam = number_format($product->price_sale, 0, '', ',');
                        $phanTramGiam = round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP); //PHP_ROUND_HALF_UP làm tròn 1,5->2
                    @endphp
                        <div class="col-sm-3">
                            <div class="card p-3 mb-5 bg-body rounded" style="width: 18rem;">
                                <img src="{{asset('uploads/product/'.$product->image)}}" class="card-img-top" alt="{{$product->title}}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$product->title}}</h5>
                                    <p class="card-subtitle text-center">
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
                                    <a href="{{route('detail', $product->id)}}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                @endforeach
                </div>
            </div>
        </div>

    <h3 class="text-center mb-3 mt-3">Sảm phẩm bán chạy</h3>

    <div class="sell-item">
        <div class="row">
            @foreach($list_product_sale as $product_sale)
                @php
                    $gia = number_format($product_sale->price, 0, '', ',');
                    $giaGiam = number_format($product_sale->price_sale, 0, '', ',');
                    $phanTramGiam = round(100 - ($product_sale->price_sale / $product_sale->price * 100), PHP_ROUND_HALF_UP); //PHP_ROUND_HALF_UP làm tròn 1,5->2
                @endphp
                <div class="col-sm-3">
                    <div class="card p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        <img src="{{asset('uploads/product/'.$product_sale->image)}}" class="card-img-top"
                             alt="{{$product_sale->title}}">
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

                            {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                            {{--soluong--}}
                            <input name="qty" type="hidden" min="1" max="{{$product_sale->number}}" class="cart_product_qty_{{$product_sale->id}}" value="1"/>
                            {!! Form::hidden('productid_hidden', $product_sale->id) !!}
                            <a href="{{route('detail',$product_sale->id)}}" class="btn btn-sm btn-outline-secondary">Detail</a>
                            <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('frontend.includes.recommend-items')

@endsection
