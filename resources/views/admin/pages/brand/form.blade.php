@extends('layout.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$title}}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('brand.index') }}" type="button" class="btn btn-default">Trở về</a>
                    </div>
                    {!! Form::open(['route'=>['brand.update', $brand->id], 'method'=>'PUT', 'id'=>'formbrand', 'role'=>'form']) !!}
                        <div class="form-group mb-3">
                            {!! Form::label('title', 'Name', []) !!}
                            {!! Form::text('title', isset($brand) ? $brand->title : '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select('status', ['0'=>'Hiển thị', '1'=>'Không hiển thị'], isset($brand) ? $brand->status : '', ['class'=>'form-control']) !!}
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
