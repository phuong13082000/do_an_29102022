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
                                        <th>Màn hình</th>
                                        <th>Màu sắc</th>
                                        <th>Camera sau</th>
                                        <th>Camera trước</th>
                                        <th>CPU</th>
                                        <th>Bộ nhớ</th>
                                        <th>Ram</th>
                                        <th>Kết nối</th>
                                        <th>Pin Sạc</th>
                                        <th>Tiện ích</th>
                                        <th>Thông tin chung</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($list_Product as $key => $product )
                                        <tr>
                                            <td>
                                                <img width="100px" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->image}}">
                                            </td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->number}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->price_sale}}</td>
                                            <td>{{$product->manhinh}}</td>
                                            <td>{{$product->mausac}}</td>
                                            <td>{{$product->camera_sau}}</td>
                                            <td>{{$product->camera_truoc}}</td>
                                            <td>{{$product->cpu}}</td>
                                            <td>{{$product->bonho}}</td>
                                            <td>{{$product->ram}}</td>
                                            <td>{{$product->ketnoi}}</td>
                                            <td>{{$product->pin_sac}}</td>
                                            <td>{{$product->tienich}}</td>
                                            <td>{{$product->thongtin_chung}}</td>
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
                                                    <a href="{{route('product.edit', [$product->id])}}"
                                                       class="btn btn-sm btn-primary">Edit</a>

                                                    <form action="{{route('product.destroy', [$product->id])}}"
                                                          method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('Bạn có muốn xóa Product này?');"
                                                            class="btn btn-sm btn-danger">Xóa
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Price</th>
                                        <th>Price Sale</th>
                                        <th>Màn hình</th>
                                        <th>Màu sắc</th>
                                        <th>Camera sau</th>
                                        <th>Camera trước</th>
                                        <th>CPU</th>
                                        <th>Bộ nhớ</th>
                                        <th>Ram</th>
                                        <th>Kết nối</th>
                                        <th>Pin Sạc</th>
                                        <th>Tiện ích</th>
                                        <th>Thông tin chung</th>
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
