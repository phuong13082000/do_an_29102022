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

                <!-- Split dropstart button -->
                <div class="btn-group">
                    <div class="btn-group dropstart" role="group">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropstart</span>
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
                                                        <b>{{$content->name}}</b>
                                                        <p>Price: {{number_format($content->price).' '.'vnđ'}}</p>
                                                        <p>Number: {{$content->qty}}</p>
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
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a type="button" class="btn btn-outline-info" href="{{url('show-cart')}}">Cart</a>
                            </div>
                        </ul>
                    </div>
                    <a type="button" class="btn btn-outline-secondary" href="{{url('show-cart')}}">
                        {{Cart::count()}} <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</nav>
