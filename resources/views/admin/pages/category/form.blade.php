@extends('layout.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$title}}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('category.index') }}" type="button" class="btn btn-default">Trở về</a>
                    </div>

                    {!! Form::open(['route'=>['category.update', $category->id], 'method'=>'PUT', 'id'=>'formcategory', 'role'=>'form']) !!}

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('title', 'Name Category', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select('status', ['0'=>'Hiển thị', '1'=>'Không hiển thị'], isset($category) ? $category->status : '', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
