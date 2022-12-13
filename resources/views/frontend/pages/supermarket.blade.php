@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    @include('frontend.includes.breadcrumb')

    <div class="row">
        <div class="col-sm-3">
            <div class="card mb-3 mt-3 accordion">
                <div class="card-header fw-bold text-uppercase accordion-button" data-bs-toggle="collapse" data-bs-target="#filterCategory" aria-expanded="true" aria-controls="filterCategory">
                    Thể loại
                </div>
                <ul class="list-group list-group-flush show" id="filterCategory">
                    @foreach($list_all_category as $category)
                        <li class="list-group-item"><a href="#" class="text-decoration-none stretched-link">{{$category->title}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="card mb-3 mt-3 accordion">
                <div class="card-header fw-bold text-uppercase accordion-button" data-bs-toggle="collapse" data-bs-target="#filterPrice" aria-expanded="true" aria-controls="filterPrice">
                    Giá Tiền
                </div>
                <ul class="list-group list-group-flush show" id="filterPrice">
                    <li class="list-group-item"><a class="text-decoration-none stretched-link" href="{{route('price', 'duoi-2-trieu')}}">Dưới 2 triệu</a></li>
                    <li class="list-group-item"><a class="text-decoration-none stretched-link" href="{{route('price', 'tu-2-den-4-trieu')}}">Từ 2 đến 4 triệu</a></li>
                    <li class="list-group-item"><a class="text-decoration-none stretched-link" href="{{route('price', 'tu-4-den-7-trieu' )}}">Từ 4 đến 7 triệu</a></li>
                    <li class="list-group-item"><a class="text-decoration-none stretched-link" href="{{route('price', 'tu-7-den-13-trieu')}}">Từ 7 đến 13 triệu</a></li>
                    <li class="list-group-item"><a class="text-decoration-none stretched-link" href="{{route('price', 'tu-13-den-20-trieu')}}">Từ 13 đến 20 triệu</a></li>
                    <li class="list-group-item"><a class="text-decoration-none stretched-link" href="{{route('price', 'tren-20-trieu')}}">Trên 20 triệu</a></li>
                </ul>
            </div>

        </div>

        <div class="col-sm-9">
            <div class="btn-group-sm mt-3" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                <label class="btn btn-outline-primary" for="btnradio1">Dạng ô</label>

                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Dạng danh sách</label>

            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        @php
                            $i = 0;
                        @endphp
                        @foreach($list_all_product as $product)
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

                                {{--soluong--}}
                                {!! Form::open(['url' => '/save-cart', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
                                <input name="qty" type="hidden" min="1" max="{{$product->number}}" class="cart_product_qty_{{$product->id}}" value="1"/>
                                {!! Form::hidden('productid_hidden', $product->id) !!}
                                <div class="text-center">
                                    <a href="{{route('detail',$product->id)}}" class="btn btn-sm btn-outline-secondary">Chi tiết</a>
                                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-shopping-cart"></i></button>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        @php
                            $i++;
                            if ($i == 3) {
                                echo '</tr>';
                                $i = 0;
                            } else {
                                echo '';
                            }
                        @endphp
                        @endforeach
                        </tr>
                    </table>
                </div>

        </div>
    </div>

@endsection
