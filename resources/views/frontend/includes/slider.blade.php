@if($first_slider && $list_slider == NULL)
    <div class="mt-2">
        <div class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{asset('detail/'.$first_slider->reProduct->id)}}">
                        <img src="{{asset('uploads/slider/'.$first_slider->image)}}" alt="{{$first_slider->title}}" class="d-block w-100">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

@if($first_slider && $list_slider)
    <div class="mt-2">
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{asset('detail/'.$first_slider->reProduct->id)}}">
                        <img src="{{asset('uploads/slider/'.$first_slider->image)}}" alt="{{$first_slider->title}}" class="d-block w-100">
                    </a>
                </div>

                @foreach($list_slider as $slider)
                    <div class="carousel-item">
                        <a href="{{asset('detail/'.$slider->reProduct->id)}}">
                            <img src="{{asset('uploads/slider/'.$slider->image)}}" alt="{{$slider->title}}" class="d-block w-100">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
@endif
