@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
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
        <div class="col-sm-7">
            <img class="img-fluid" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->title}}">
            <hr>
            galery
            <hr>
            <!-- Tab thong tin san van va danh gia san pham -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="false">Mô Tả
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="true">Bình Luận
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container">
                        <div class="mt-3">
                            <h4>Thông tin sản phẩm {{$product->title}}</h4>
                            <p>{!! $product->thongtin_chung !!}</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container">
                        <div class="mt-3">
                            <h4>Bình luận về sản phẩm {{$product->title}}</h4>
                            <form>
                                @csrf
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$product->id}}">
                                <div id="comment_show"></div>
                                {{--<div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title" style="color: green">@NGUOI</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title
                                                        and make up the bulk of the card's content.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ms-5 mt-2">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title" style="color: green">@NGUOI</h5>
                                                    <p class="card-text">Some quick example text to build on the card
                                                        title
                                                        and make up the bulk of the card's content.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                --}}
                            </form>

                            @if(Session::get('name'))
                                <div class="mt-3">
                                    <p><b>Viết bình luận của bạn</b></p>
                                </div>
                                <div id="thongbao-comment"></div>
                                <form action="#">
                                    @csrf
                                    <input type="hidden" name="comment_customer_id" class="comment_customer_id" value="{{Session::get('id')}}">
                                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$product->id}}">

                                    <div class="mt-3">
                                        <textarea name="title" class="form-control title" rows="3"></textarea>
                                    </div>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-outline-secondary" id="send-comment">Submit</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-sm-5">
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

            {{--soluong--}}
            <span>
                <label for="qty">Số lượng
                    <input name="qty" type="number" min="1" max="{{$product->number}}"
                           class="cart_product_qty_{{$product->id}}" value="1">
                </label>
                {!! Form::hidden('productid_hidden', $product->id) !!}
            </span>

            <input type="submit" value="Thêm giỏ hàng" class="btn btn-primary">

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
