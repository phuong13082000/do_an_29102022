@extends('layout.admin')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{$title}}</h3>
                        </div>
                        <div class="card-body">
                            <table id="categoryTable" class="table table-bordered table-striped">
                                <button type="button" class="btn btn-default mb-3" data-toggle="modal" data-target="#modal-category"> Add Category</button>
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($listCategory as $key => $category )
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>
                                            <form method="POST">
                                                @csrf
                                                {!! Form::select('status', ['0'=>'Hiện', '1'=>'Ẩn'], $category->status ?? '', ['class'=>'custom-select category-status', 'id'=>$category->id]) !!}
                                            </form>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <a href="{{route('category.edit', [$category->id])}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>

                                                <form action="{{route('category.destroy', [$category->id])}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn có muốn xóa thể loại này?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
    </section>

    <div class="modal fade" id="modal-category" tabindex="-1" aria-labelledby="modallable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallable">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route'=>'category.store', 'method'=>'POST', 'id'=>'formcategory', 'role'=>'form']) !!}
                        <div class="form-group mb-3">
                            {!! Form::label('title', 'Name', []) !!}
                            {!! Form::text('title', '', ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group mb-3">
                            {!! Form::label('status', 'Status', []) !!}
                            {!! Form::select('status', ['0'=>'Hiện', '1'=>'Ẩn'], '', ['class'=>'form-control']) !!}
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
<!-- Update Category Status -->
<script type="text/javascript">
    $('.category-status').change(function () {
        var id = $(this).attr('id');
        var status = $(this).find(':selected').val();
        $.ajax({
            url: "{{url('admin/update-status-category')}}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {id: id, status: status},
            success: function () {
                Swal.fire(
                    'Change status success!',
                    '',
                    'success',
                )
            }
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#categoryTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#formcategory").validate({
            rules: {
                title: {required: true,},
                action: "required"
            },
            messages: {
                title: {
                    required: "Please enter some data",
                },
                action: "Please provide some data"
            }
        });
    });
</script>
@endsection
