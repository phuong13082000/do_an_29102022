<div class="mt-3">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="{{$first_slider->url}}">
                    <img src="{{asset('uploads/slider/'.$first_slider->image)}}" alt="{{$first_slider->title}}" class="d-block w-100">
                </a>
            </div>

            @foreach($list_slider as $slider)
                <div class="carousel-item">
                    <a href="{{$slider->url}}">
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
