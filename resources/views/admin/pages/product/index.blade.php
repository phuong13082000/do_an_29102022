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
                                        <th>Gallery</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($listProduct as $key => $product)
                                        <tr>
                                            <td>
                                                <img width="100px" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->image}}">
                                            </td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->number}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->price_sale}}</td>
                                            <td><a href="{{url('admin/add-gallery/'.$product->id)}}">Add Gallery</a></td>
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

                                        <div class="modal fade bd-example-modal-lg" id="modal-product_{{$product->id}}" tabindex="-1" aria-labelledby="modallable_{{$product->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modallable_{{$product->id}}">Chi tiết</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <b>Màn hình: </b>{{$product->manhinh}}<br>
                                                        <b>Màu sắc: </b>{{$product->mausac}}<br>
                                                        <b>Camera sau: </b>{{$product->camera_sau}}<br>
                                                        <b>Camera trước: </b>{{$product->camera_truoc}}<br>
                                                        <b>CPU: </b>{{$product->cpu}}<br>
                                                        <b>Bộ nhớ: </b>{{$product->bonho}}<br>
                                                        <b>Ram: </b>{{$product->ram}}<br>
                                                        <b>Kết nối: </b>{{$product->ketnoi}}<br>
                                                        <b>Pin Sạc: </b>{{$product->pin_sac}}<br>
                                                        <b>Chiều cao: </b>{!! $product->height !!} cm<br>
                                                        <b>Chiều dày: </b>{!! $product->length !!} cm<br>
                                                        <b>Trọng lượng: </b>{!! $product->weight !!} g<br>
                                                        <b>Chiều rộng: </b>{!! $product->width !!} cm<br>
                                                        <b>Tiện ích: </b>{{$product->tienich}}<br>
                                                        <b>Thông tin chung: </b>{!! $product->thongtin_chung !!}
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
                                        <th>Gallery</th>
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
