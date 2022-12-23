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
                                    @foreach ($listProduct as $product)
                                        <tr>
                                            <td>
                                                <img width="100px" src="{{asset('uploads/product/'.$product->image)}}" alt="{{$product->image}}">
                                            </td>
                                            <td>{{$product->title}}</td>
                                            <td>{{$product->number}}</td>
                                            <td>{{ number_format($product->price, 0, '', ',')}}</td>
                                            <td>{{ number_format($product->price_sale, 0, '', ',')}}</td>
                                            <td><a href="{{url('admin/add-gallery/'.$product->id)}}">Add Gallery</a></td>
                                            <td>
                                                <span class="badge badge-info">{{$product->reBrand->title}}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary">{{$product->reCategory->title}}</span>
                                            </td>
                                            <td>
                                                <form method="POST">
                                                    @csrf
                                                    {!! Form::select('status', ['0'=>'Hiện', '1'=>'Ẩn'], $product->status ?? '', ['class'=>'form-select product-status', 'id'=>$product->id]) !!}
                                                </form>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-product_{{$product->id}}"><i class="fa fa-eye"></i></button>

                                                    <a href="{{route('product.edit', [$product->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                                    <form action="{{route('product.destroy', [$product->id])}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn có muốn xóa Product này?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
                                                        <b>Chiều cao: </b>{{ $product->height }} cm<br>
                                                        <b>Chiều dày: </b>{{ $product->length }} cm<br>
                                                        <b>Trọng lượng: </b>{{ $product->weight }} g<br>
                                                        <b>Chiều rộng: </b>{{ $product->width }} cm<br>
                                                        <b>Tiện ích: </b>{{$product->tienich}}<br>
                                                        <b>Thông tin chung: </b>{!! $product->thongtin_chung !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

@section('script_admin')
    <!-- Update Status -->
    <script type="text/javascript">
        $('.product-status').change(function () {
            var id = $(this).attr('id');
            var status = $(this).find(':selected').val();
            $.ajax({
                url: "{{url('admin/update-status-product')}}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {id: id, status: status},
                success: function () {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Change status succes',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        });
    </script>
@endsection
