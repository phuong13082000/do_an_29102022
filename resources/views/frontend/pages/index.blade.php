@extends('layout.user')

@section('index')
    @include('frontend.includes.slider')
    @include('frontend.includes.alert')

    <style>
        .zoom {
            transition: transform .2s; /* Animation */
            margin: 0 auto;
        }
        .zoom:hover {
            transform: scale(1.05); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
        td:hover {
            box-shadow: 0 6px 10px 0 rgba(0, 0, 0, .14), 0 1px 18px 0 rgba(0, 0, 0, .12), 0 3px 5px -1px rgba(0, 0, 0, .2)
        }
    </style>

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

    <h3 class="text-center mb-3 mt-3"><a href="{{url("/supermarket")}}" class="text-decoration-none">Sản phẩm</a></h3>
    <div class="mt-3">
        <div class="mb-3">
            <label for='loc'> Sắp xếp theo:
                <select id='loc' class="form-control">
                    <option value="0" selected>Tất cả</option>
                    <option value="1">Giá thấp đến cao</option>
                    <option value="2">Giá cao đến thấp</option>
                    <option value="3">Iphone</option>
                    <option value="4">Samsung</option>
                </select>
            </label>
        </div>
        <div class="row" id="product_loc"></div>
    </div>

    <h3 class="text-center mb-3 mt-3">Sản phẩm mới nhất</h3>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                @foreach($list_product as $product)
                    <td>
                        <img src="{{asset('uploads/product/'.$product->image)}}" class="img-thumbnail border-0 zoom" alt="{{$product->title}}">
                        <h5 class="mt-2">{{$product->title}}</h5>
                        @if($product->number)
                            @if($product->price_sale)
                                <del>{{ number_format($product->price, 0, '', ',') }} VND</del>
                                <b style="color: red"> -{{ round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP) }}%</b><br>
                                <b>{{ number_format($product->price_sale, 0, '', ',') }} VND</b>
                            @else
                                <b>{{ number_format($product->price, 0, '', ',') }} VND</b>
                            @endif
                        @else
                            <b style="color: red">Hết Hàng</b>
                        @endif

                        soluong
                        {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                            <input name="qty" type="hidden" min="1" max="{{$product->number}}" class="cart_product_qty_{{$product->id}}" value="1"/>
                            {!! Form::hidden('productid_hidden', $product->id) !!}
                            <div class="text-center">
                                <a href="{{route('detail',$product->id)}}" class="btn btn-sm btn-primary">Chi tiết</a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-shopping-cart"></i></button>
                            </div>
                        {!! Form::close() !!}
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    <h3 class="text-center mt-3">Sản phẩm bán chạy</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                @foreach($list_product_sale as $product_sale)
                    <td>
                        <img src="{{asset('uploads/product/'.$product_sale->image)}}" class="img-thumbnail border-0 zoom" alt="{{$product_sale->title}}">
                        <h5 class="mt-2">{{$product_sale->title}}</h5>
                            @if($product_sale->number)
                                @if($product_sale->price_sale)
                                    <del>{{ number_format($product_sale->price, 0, '', ',') }} VND</del>
                                    <b style="color: red"> -{{ round(100 - ($product_sale->price_sale / $product_sale->price * 100), PHP_ROUND_HALF_UP) }}%</b><br>
                                    <b>{{ number_format($product_sale->price_sale, 0, '', ',') }} VND</b>
                                @else
                                    <b>{{ number_format($product_sale->price, 0, '', ',') }} VND</b>
                                @endif
                            @else
                                <b style="color: red">Hết Hàng</b>
                            @endif

                        {{--soluong--}}
                        {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                            <input name="qty" type="hidden" min="1" max="{{$product_sale->number}}" class="cart_product_qty_{{$product_sale->id}}" value="1"/>
                            {!! Form::hidden('productid_hidden', $product_sale->id) !!}
                            <div class="text-center">
                                <a href="{{route('detail',$product_sale->id)}}" class="btn btn-sm btn-primary">Chi tiết</a>
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-shopping-cart"></i></button>
                            </div>
                        {!! Form::close() !!}
                    </td>
                @endforeach
            </tr>
        </table>
    </div>

    @include('frontend.includes.recommend-items')
@endsection

@section('scripts')
    <script type="text/javascript">
        load_product_loc();

        function load_product_loc() {
            var value_loc = $('#loc').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/loc')}}",
                method: "POST",
                data: {value_loc: value_loc, _token: _token},
                success: function (data) {
                    $('#product_loc').html(data);
                }
            });
        }

        $('#loc').on('change', function () {
            var value_loc = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/loc')}}",
                method: "POST",
                data: {value_loc: value_loc, _token: _token},
                success: function (data) {
                    $('#product_loc').html(data);
                }
            });
        });
    </script>
@endsection
