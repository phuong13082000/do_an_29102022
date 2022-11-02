@extends('layout.user')

@section('index')
    @include('frontend.includes.slider')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1"
                aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
            <span>Lọc</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item pe-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="loaisanpham"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Loại sản phẩm
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="loaisanpham">
                            @foreach($list_category as $category)
                                <li>
                                    <a class="dropdown-item"
                                       href="{{route('category', $category->id)}}">{{$category->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>

                <li class="nav-item pe-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="giasanpham"
                           data-bs-toggle="dropdown" aria-expanded="false">
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
                </li>

                <li class="nav-item pe-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="ram"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Ram
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="ram">
                            <li><a class="dropdown-item" href="#">2 GB</a></li>
                            <li><a class="dropdown-item" href="#">3 GB</a></li>
                            <li><a class="dropdown-item" href="#">4 GB</a></li>
                            <li><a class="dropdown-item" href="#">6 GB</a></li>
                            <li><a class="dropdown-item" href="#">8 GB</a></li>
                            <li><a class="dropdown-item" href="#">12 GB</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item pe-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dungluong"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Dung Lượng Lưu Trữ
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dungluong">
                            <li><a class="dropdown-item" href="#">32 GB</a></li>
                            <li><a class="dropdown-item" href="#">64 GB</a></li>
                            <li><a class="dropdown-item" href="#">128 GB</a></li>
                            <li><a class="dropdown-item" href="#">256 GB</a></li>
                            <li><a class="dropdown-item" href="#">512 GB</a></li>
                            <li><a class="dropdown-item" href="#">1 TB</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item pe-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="pinsac"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Pin & Sạc
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="pinsac">
                            <li><a class="dropdown-item" href="#">Pin khủng trên 5000mAh</a></li>
                            <li><a class="dropdown-item" href="#">Sạc nhanh trên 18w</a></li>
                            <li><a class="dropdown-item" href="#">Sạc siêu nhanh trên 33w</a></li>
                            <li><a class="dropdown-item" href="#">Sạc không dây</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item pe-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="tinhnang"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Tính Năng Đặc Biệt
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="tinhnang">
                            <li><a class="dropdown-item" href="#">Kháng nước, bụi</a></li>
                            <li><a class="dropdown-item" href="#">Hỗ trợ 5G</a></li>
                            <li><a class="dropdown-item" href="#">Bảo mật khuôn mặt 3D</a></li>
                            <li><a class="dropdown-item" href="#">Chống rung quang học</a></li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </nav>

    <div class="mt-3 btn-group">
        <label>Chọn điện thoại theo nhu cầu: <br>
            <button type="button" class="btn btn-default border-dark">Chơi game Cấu hình cao</button>
            <button type="button" class="btn btn-default border-dark">Chụp ảnh Quay phim</button>
            <button type="button" class="btn btn-default border-dark">Mỏng nhẹ</button>
            <button type="button" class="btn btn-default border-dark">Nhỏ gọn dễ cầm</button>
        </label>
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
                            <img src="{{asset('uploads/product/'.$product_new->image)}}" class="card-img-top"
                                 alt="{{$product_new->title}}">
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

                                {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                                {{--soluong--}}
                                <input name="qty" type="hidden" min="1" max="{{$product_new->number}}" class="cart_product_qty_{{$product_new->id}}" value="1"/>
                                {!! Form::hidden('productid_hidden', $product_new->id) !!}
                                <a href="{{route('detail',$product_new->id)}}" class="btn btn-sm btn-outline-secondary">Detail</a>
                                <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                {!! Form::close() !!}
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
