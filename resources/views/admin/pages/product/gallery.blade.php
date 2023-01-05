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
                            <input type="hidden" id="id_product" value="{{$product_id}}">
                            <form action="{{url('admin/insert-gallery/'.$product_id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3"></div>

                                    <div class="col-md-6">
                                        <input type="file" id="file" class="form-control" name="file[]" accept="image/*" multiple>
                                        <span id="error_gallery"></span>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="submit" name="upload" class="btn btn-success" value="Tải ảnh">
                                    </div>

                                </div>
                            </form>
                            <div id="gallery_load" class="table-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
