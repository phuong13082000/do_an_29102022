@extends('layout.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <a href="{{route('slider.create')}}" type="button" class="btn btn-default">Add Slider</a>
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($list_Slider as $key => $slider )
                                        <tr>
                                            <td><img width="500" src="{{asset('uploads/slider/'.$slider->image)}}" alt="{{$slider->image}}"></td>
                                            <td>{{$slider->title}}</td>
                                            <td><a href="{{url('/detail/'.$slider->reProduct->id)}}" target="_blank">{{$slider->reProduct->title}}</a></td>
                                            <td>
                                                @if ($slider->status==0)
                                                    <span class="text text-success"><i class="fa fa-thumbs-up"></i></span>
                                                @else
                                                    <span class="text text-danger"><i class="fa fa-thumbs-down"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <a href="{{route('slider.edit', [$slider->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                                    <form action="{{route('slider.destroy', [$slider->id])}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có muốn xóa slider này?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
