<header class="py-3 border-bottom">
    <div class="container d-flex flex-wrap justify-content-center">
        <a href="{{url('/')}}" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"/>
            </svg>
            <span class="fs-4">PhoneShop</span>
        </a>

        <div class="nav-item">
            <button class="btn btn-default position-relative text-decoration-none me-5" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-shopping-cart me-2"></i>
                Giỏ Hàng
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ count(Cart::content()) }}
                    <span class="visually-hidden">New cart</span>
                </span>
            </button>

            <ul class="dropdown-menu" style="width: 500px">
                <li class="dropdown-item" href="#">
                    @if(Cart::count() != 0)
                        <div class="container">
                            <div class="mt-3">
                                @foreach(Cart::content() as $content)
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="{{asset('uploads/product/'.$content->options->image)}}" width="90" alt="{{$content->name}}"/>
                                        </div>
                                        <div class="col-sm-8">
                                            <p><b>{{$content->name}}</b></p>
                                            <p>Đơn giá: {{number_format($content->price).' '.'vnđ'}}</p>
                                            <p>Số lượng: {{$content->qty}}</p>
                                        </div>
                                        <hr>
                                    </div>
                                @endforeach
                                <p>Tổng tiền tạm tính: {{number_format(Cart::total()).' '.'vnđ'}}</p>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="mt-3">
                                <a class="text-decoration-none" href="{{url('/')}}"> Không có sản phẩm</a>
                            </div>
                        </div>
                    @endif
                </li>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <div class="row">
                        <a type="button" class="btn btn-outline-secondary" href="{{url('show-cart')}}">Giỏ hàng</a>
                    </div>
                </div>
            </ul>
        </div>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0" action="{{ route('search') }}" method="POST" autocomplete="off">
            @csrf
            <input class="form-control" type="search" id="keywords" name="tukhoa" aria-label="Search" placeholder="Tìm kiếm">
            <div id="search_ajax"></div>
        </form>
    </div>
</header>

<div class="nav-scroller sm-body shadow-sm">
    <div class="container d-flex flex-wrap justify-content-center">
        <nav class="nav nav-underline align-items-center" aria-label="Secondary navigation">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">Home</a>
            @foreach($list_brand as $brand)
                <a class="nav-link" href="{{route('brand',$brand->id)}}">{{$brand->title}}</a>
            @endforeach
        </nav>
    </div>
</div>
