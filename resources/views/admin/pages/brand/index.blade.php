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
                            <table id="example1" class="table table-bordered table-striped">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-brand"> Add Brand</button>

                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name Brand</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_Brand as $key => $brand )
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$brand->title}}</td>
                                        <td>
                                            <form method="POST">
                                                @csrf
                                                {!! Form::select('status', ['0'=>'Hiện', '1'=>'Ẩn'], $brand->status ?? '', ['class'=>'form-select brand-status', 'id'=>$brand->id]) !!}
                                            </form>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a href="{{route('brand.edit', [$brand->id])}}" class="btn btn-sm btn-primary">Edit</a>

                                                <form action="{{route('brand.destroy', [$brand->id])}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có muốn xóa danh mục này?');" class="btn btn-sm btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name Brand</th>
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
    </section>

    <div class="modal fade" id="modal-brand" tabindex="-1" aria-labelledby="modallable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallable">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route'=>'brand.store', 'method'=>'POST', 'id'=>'formbrand', 'role'=>'form']) !!}

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('title', 'Name Brand', []) !!}
                            {!! Form::text('title', '', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-group">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select('status', ['0'=>'Hide', '1'=>'UnHide'], '', ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        {!! Form::submit('Add', ['class'=>'btn btn-success']) !!}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_admin')
    <!-- Update Brand Status -->
    <script type="text/javascript">
        $('.brand-status').change(function () {
            var id = $(this).attr('id');
            var status = $(this).find(':selected').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('admin/update-status-brand')}}",
                method: 'POST',
                data: {id: id, status: status, _token: _token},
                success: function () {
                    alert('Change status success!');
                    window.location.href = "{{route('brand.index')}}";
                }
            });
        });
    </script>

@endsection
