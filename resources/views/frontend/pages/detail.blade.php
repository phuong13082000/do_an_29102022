@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')
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
        <div class="col-sm-5">
            {{--Gallery--}}
            <ul id="imageGallery">
                <li data-thumb="{{asset('uploads/product/'.$product->image)}}" data-src="{{asset('uploads/product/'.$product->image)}}">
                    <img width="100%" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->image}}"/>
                </li>
                @foreach($list_gallery as $gallery)
                <li data-thumb="{{asset('uploads/gallery/'.$gallery->image)}}" data-src="{{asset('uploads/gallery/'.$gallery->image)}}">
                    <img width="100%" src="{{asset('uploads/gallery/'.$gallery->image)}}" alt="{{$gallery->title}}"/>
                </li>
                @endforeach

            </ul>
            <hr>
        </div>

        <div class="col-sm-7">
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

            {{--Cấu hình--}}
            <div class="row justify-content-center mt-3 mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b style="font-size: 18px"> Cấu hình {{$product->title}}: </b>
                        </div>
                        <style>
                            #cauhinh_l{
                                font-weight: bold;
                            }
                            #cauhinh_r{
                                padding-left: 5px;
                            }
                        </style>
                        <div class="card-body">
                            <div class="mt-3">
                                <ul style="list-style-type: none">
                                    <li><span id="cauhinh_l">Màn hình:</span><span id="cauhinh_r">{{$product->manhinh}}</span></li>
                                    <li><span id="cauhinh_l">Màu sắc:</span><span id="cauhinh_r">{{$product->mausac}}</span></li>
                                    <li><span id="cauhinh_l">Camera sau:</span><span id="cauhinh_r">{{$product->camera_sau}}</span></li>
                                    <li><span id="cauhinh_l">Camera trước:</span><span id="cauhinh_r">{{$product->camera_truoc}}</span></li>
                                    <li><span id="cauhinh_l">CPU:</span><span id="cauhinh_r">{{$product->cpu}}</span></li>
                                    <li><span id="cauhinh_l">Bộ nhớ:</span><span id="cauhinh_r">{{$product->bonho}}</span></li>
                                    <li><span id="cauhinh_l">Ram:</span><span id="cauhinh_r">{{$product->ram}}</span></li>
                                    <li><span id="cauhinh_l">Kết nối:</span><span id="cauhinh_r">{{$product->ketnoi}}</span></li>
                                    <li><span id="cauhinh_l">Pin sạc:</span><span id="cauhinh_r">{{$product->pin_sac}}</span></li>
                                    <li><span id="cauhinh_l">Tiện ích:</span><span id="cauhinh_r">{{$product->tienich}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

        <!-- Tab thong tin san van va danh gia san pham -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                        role="tab" aria-controls="home" aria-selected="false">Mô Tả
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="true">Bình Luận
                </button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">

            {{--chi tiet thong tin--}}
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container">
                    <div class="mt-3">
                        <h4>Thông tin sản phẩm {{$product->title}}</h4>
                        <p>{!! $product->thongtin_chung !!}</p>
                    </div>
                </div>
            </div>

            {{--chi tiet binh luan--}}
            <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container">
                    <div class="mt-3">
                        <h4>Bình luận về sản phẩm {{$product->title}}</h4>
                        <form>
                            @csrf
                            <input type="hidden" name="comment_product_id" class="comment_product_id"
                                   value="{{$product->id}}">
                            <div id="comment_show"></div>
                        </form>

                        @if(Session::get('name'))
                            <div class="mt-3">
                                <p><b>Viết bình luận của bạn</b></p>
                            </div>
                            <div id="thongbao-comment"></div>
                            <form action="#">
                                @csrf
                                <input type="hidden" name="comment_customer_id" class="comment_customer_id"
                                       value="{{Session::get('id')}}">
                                <input type="hidden" name="comment_product_id" class="comment_product_id"
                                       value="{{$product->id}}">
                                <div class="mt-3">
                                    <textarea name="title" class="form-control title" rows="3"></textarea>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-outline-secondary" id="send-comment">Submit
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('frontend.includes.recommend-items')
@endsection

@section('scripts')
    <script type="text/javascript">
        load_comment();

        <!--binhluan-->
        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/load-comment')}}",
                method: "POST",
                data: {product_id: product_id, _token: _token},
                success: function (data) {
                    $('#comment_show').html(data);
                }
            });
        }

        $('#send-comment').click(function () {
            var customer_id = $('.comment_customer_id').val();
            var product_id = $('.comment_product_id').val();
            var title = $('.title').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/send-comment')}}",
                method: "POST",
                data: {title: title, customer_id: customer_id, product_id: product_id, _token: _token},
                success: function (data) {
                    $('#thongbao-comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chời duyệt</span>')
                    load_comment();
                    $('#thongbao-comment').fadeOut(5000);
                    $('.title').val('');
                }
            });
        });

        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });

    </script>
@endsection

