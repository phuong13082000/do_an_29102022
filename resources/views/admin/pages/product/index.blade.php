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
                                    <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Price</th>
                                        <th>Price Sale</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($list_Product as $key => $product)
                                        <tr>
                                            <td>
                                                <img width="100px" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->image}}">
                                            </td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->number}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->price_sale}}</td>
                                            <td>{{$product->reBrand->title}}</td>
                                            <td>{{$product->reCategory->title}}</td>
                                            <td>
                                                @if ($product->status==0)
                                                    <span class="text text-success"><i class="fa fa-thumbs-up"></i></span>
                                                @else
                                                    <span class="text text-danger"><i class="fa fa-thumbs-down"></i></span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-product_{{$product->id}}">View</button>

                                                    <a href="{{route('product.edit', [$product->id])}}"
                                                       class="btn btn-sm btn-primary">Edit</a>

                                                    <form action="{{route('product.destroy', [$product->id])}}"
                                                          method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có muốn xóa Product này?');" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-product_{{$product->id}}" tabindex="-1" aria-labelledby="modallable_{{$product->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modallable_{{$product->id}}">Chi tiết</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Màn hình: {{$product->manhinh}}<br>
                                                        Màu sắc: {{$product->mausac}}<br>
                                                        Camera sau: {{$product->camera_sau}}<br>
                                                        Camera trước: {{$product->camera_truoc}}<br>
                                                        CPU: {{$product->cpu}}<br>
                                                        Bộ nhớ: {{$product->bonho}}<br>
                                                        Ram: {{$product->ram}}<br>
                                                        Kết nối: {{$product->ketnoi}}<br>
                                                        Pin Sạc: {{$product->pin_sac}}<br>
                                                        Tiện ích: {{$product->tienich}}<br>
                                                        Thông tin chung: {{$product->thongtin_chung}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Price</th>
                                        <th>Price Sale</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
