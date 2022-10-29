@extends('layout.user')

@section('index')
    <div class="row mt-3">
        @php
            $gia = number_format($product->price, 0, '', ',');
            $giaKhuyenMai =  number_format($product->price_sale, 0, '', ',');
            $phanTramGiam = round(100 - ($product->price_sale / $product->price * 100), PHP_ROUND_HALF_UP);
        @endphp

        <div class="mb-3">
            <b style="font-size: 18px">{{$product->title}}</b><br>
        </div>
        <hr>
        <div class="col-sm-6">
            <img class="img-fluid" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->title}}">
            <hr>
            galery
            <hr>
            <!-- Tab thong tin san van va danh gia san pham -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Mô tả</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Đánh giá</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container">
                        <div class="mt-3">
                            <h4>Thông tin sản phẩm {{$product->title}}</h4>
                            <p>{{$product->thongtin_chung}}</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container">
                        <div class="mt-3">
                            <h4>Đánh giá sản phẩm {{$product->title}}</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-6">
            {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

            @if($product->number)
                @if($product->price_sale)
                    Giá: <br> <b style="color: red">{{ $giaKhuyenMai }} VND</b>
                    <del>&nbsp;{{ $gia }} VND</del><b style="color: red"> -{{ $phanTramGiam }}%</b><br>
                @else
                    <b>Giá: <br> {{ $gia }} VND</b><br>
                @endif
            @else
                <b style="color: red">Hết Hàng</b><br>
            @endif

            <!--Khuyến mãi-->
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><b>Khuyến mãi: </b></div>
                        <div class="card-body">
                            <div class="mb-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{--soluong--}}
            <span>
                <label for="qty">Số lượng
                    <input name="qty" type="number" min="1" max="{{$product->number}}" class="cart_product_qty_{{$product->id}}" value="1">
                </label>
                {!! Form::hidden('productid_hidden', $product->id) !!}
            </span>

            <input type="submit" value="Thêm giỏ hàng" class="btn btn-primary add-to-cart">

            <!--Cấu hình-->
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b style="font-size: 18px"> Cấu hình {{$product->title}}: </b>
                        </div>
                        <div class="card-body">
                            <div class="mt-3">
                                <p>Màn hình: {{$product->manhinh}}</p>
                                <p>Màu sắc: {{$product->mausac}}</p>
                                <p>Camera sau: {{$product->camera_sau}}</p>
                                <p>Camera trước: {{$product->camera_truoc}}</p>
                                <p>CPU: {{$product->cpu}}</p>
                                <p>Bộ nhớ: {{$product->bonho}}</p>
                                <p>Ram: {{$product->ram}}</p>
                                <p>Kết nối: {{$product->ketnoi}}</p>
                                <p>Pin sạc: {{$product->pin_sac}}</p>
                                <p>Tiện ích: {{$product->tienich}}</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    @include('frontend.includes.recommend-items')

@endsection
