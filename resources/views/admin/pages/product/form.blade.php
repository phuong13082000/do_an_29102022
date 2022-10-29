@extends('layout.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$title}}</div>

                <div class="card-body">

                    @if(!isset($product))
                        {!! Form::open(['route'=>'product.store', 'method'=>'POST', 'id'=>'formproduct', 'enctype'=>'multipart/form-data']) !!}
                    @else
                        {!! Form::open(['route'=>['product.update', $product->id], 'id'=>'formproduct', 'method'=>'PUT','enctype'=>'multipart/form-data']) !!}
                    @endif

                    <div class="mb-3">
                        <a href="{{ route('product.index') }}" type="button" class="btn btn-default">Trở về</a>

                        @if(!isset($product))
                            {!! Form::submit('Add', ['class'=>'btn btn-success']) !!}
                        @else
                            {!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
                        @endif
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($product) ? $product->title : 'dt', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('image', 'Image1', []) !!}
                            {!! Form::file('image', ['class'=>'form-control']) !!}
                            @if(isset($product))
                                <img width="150" src="{{asset('uploads/product/'.$product->image )}}"
                                     alt="{{$product->image}}">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('number', 'Number', []) !!}
                            {!! Form::number('number', isset($product) ? $product->number : '1', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('price', 'Price', []) !!}
                                    {!! Form::number('price', isset($product) ? $product->price : '1', ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('price_sale', 'Price Sale', []) !!}
                                    {!! Form::number('price_sale', isset($product) ? $product->price_sale : '0', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!! Form::label('brand_id', 'Danh mục', ['class'=>'input-group', 'for'=>'inputGroupSelect01']) !!}
                                    {!! Form::select('brand_id', $list_brand, isset($product) ? $product->brand_id : '', ['class'=>'form-control' ,'id'=>'inputGroupSelect01']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group">
                                    {!! Form::label('category_id', 'Thể loại', ['class'=>'input-group', 'for'=>'inputGroupSelect02']) !!}
                                    {!! Form::select('category_id', $list_category, isset($product) ? $product->category_id : '', ['class'=>'form-control' ,'id'=>'inputGroupSelect02']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <h3>Thông tin chi tiết</h3>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('manhinh', 'Man hinh', []) !!}
                                    {!! Form::text('manhinh', isset($product) ? $product->manhinh : '1', ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <div class="form-group">
                                        {!! Form::label('cpu', 'cpu', []) !!}
                                        {!! Form::text('cpu', isset($product) ? $product->cpu : '1', ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('camera_sau', 'camera_sau', []) !!}
                                    {!! Form::text('camera_sau', isset($product) ? $product->camera_sau : '1', ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('camera_truoc', 'camera_truoc', []) !!}
                                    {!! Form::text('camera_truoc', isset($product) ? $product->camera_truoc : '1', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('bonho', 'bonho', []) !!}
                                    {!! Form::select('bonho', ['16GB'=>'16 GB','64GB'=>'64 GB','128GB'=>'128 GB','256GB'=>'256 GB','512GB'=>'512 GB','1TB'=>'1 TB'], isset($product) ? $product->bonho : '', ['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('ram', 'Ram', []) !!}
                                    {!! Form::select('ram', ['4GB'=>'4 GB','8GB'=>'8 GB','16GB'=>'16 GB','36GB'=>'36 GB'], isset($product) ? $product->ram : '', ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('mausac', 'Mau sac', []) !!}
                            {!! Form::text('mausac', isset($product) ? $product->mausac : 'Đen', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('ketnoi', 'ketnoi', []) !!}
                            {!! Form::text('ketnoi', isset($product) ? $product->ketnoi : '1', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('pin_sac', 'pin_sac', []) !!}
                            {!! Form::text('pin_sac', isset($product) ? $product->pin_sac : '1', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('tienich', 'tienich', []) !!}
                            {!! Form::text('tienich', isset($product) ? $product->tienich : '1', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('thongtin_chung', 'thongtin_chung', []) !!}
                            {!! Form::text('thongtin_chung', isset($product) ? $product->thongtin_chung : '1', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select('status', ['0'=>'Hiển thị', '1'=>'Không hiển thị'], isset($product) ? $product->status : '0', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
