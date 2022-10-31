<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <h4><a href="/" style="text-decoration: none">PhoneShop</a></h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 justify-content-end">
                &nbsp;
                @foreach($list_brand as $brand)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('brand',$brand->id)}}">{{$brand->title}}</a>
                    </li>
                @endforeach
            </ul>

            <div class="nav-item justify-content-end">
                {{--<a class="nav-link" href="{{url('show-cart')}}">{{Cart::count()}} Cart</a>--}}

                <div class="dropdown">
                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="cart"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{Cart::count()}} Cart
                    </a>

                    <ul class="dropdown-menu" style="width: 400px" aria-labelledby="cart">
                        <li class="dropdown-item" href="#">
                            @if(Cart::count() != 0)
                                <div class="container">
                                    <div class="mt-3">
                                        @foreach(Cart::content() as $v_content)
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <img src="{{asset('uploads/product/'.$v_content->options->image)}}"
                                                         width="90" alt="{{$v_content->name}}"/>
                                                </div>
                                                <div class="col-sm-8">
                                                    <h4>Name: {{$v_content->name}}</h4>
                                                    <p>Price: {{number_format($v_content->price).' '.'vnđ'}}</p>
                                                    <p>Number: {{$v_content->qty}}</p>
                                                    <hr>
                                                </div>
                                            </div>
                                        @endforeach
                                        <p>Subtotal: {{Cart::total().' '.'vnđ'}}</p>
                                    </div>
                                </div>
                            @else
                                <div class="container">
                                    <div class="mt-3">
                                        <a href="{{url('/')}}" style="text-decoration: none"> Cart empty</a>
                                    </div>
                                </div>
                            @endif
                        </li>
                        <a type="button" class="btn btn-default" href="{{url('show-cart')}}">Cart</a>

                    </ul>
                </div>
            </div>

            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
