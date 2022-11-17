@extends('layout.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$title}}</div>

                <div class="card-body">

                    @if(!isset($slider))
                        {!! Form::open(['route'=>'slider.store', 'id'=>'formslider', 'method'=>'POST','enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['slider.update', $slider->id], 'id'=>'formslider', 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('slider.index') }}" type="button" class="btn btn-default">Trở về</a>

                        @if(!isset($slider))
                            {!! Form::submit('Add', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                        @endif
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('image', 'Image', []) !!}
                            {!! Form::file('image', ['class'=>'form-control']) !!}
                            @if(isset($slider))
                                <img width="150" src="{{asset('uploads/slider/'.$slider->image )}}" alt="{{$slider->image}}">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($slider) ? $slider->title : 'dt', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            {!! Form::label('product_id', 'Sản phẩm', ['class'=>'input-group', 'for'=>'inputGroupSelect01']) !!}
                            {!! Form::select('product_id', $list_products, isset($slider) ? $slider->product_id : '', ['class'=>'form-control' ,'id'=>'inputGroupSelect01']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select('status', ['0'=>'Hiển thị', '1'=>'Không hiển thị'], isset($slider) ? $slider->status : '0', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
