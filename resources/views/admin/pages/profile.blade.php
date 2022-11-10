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
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$admin_detail->name}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$admin_detail->email}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Phone</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0">{{$admin_detail->phone}}</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-profile">Change password</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-profile" tabindex="-1" aria-labelledby="modallable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallable">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['url'=>'admin/change-password-admin/'.$admin_detail->admin_id, 'method'=>'POST', 'role'=>'form']) !!}

                    <div class="form-floating mb-4">
                        {!! Form::password('password', ['class'=>'form-control']) !!}
                        {!! Form::label('password', 'Password old', []) !!}
                    </div>

                    <div class="form-floating mb-4">
                        {!! Form::password('password_new', ['class'=>'form-control']) !!}
                        {!! Form::label('password_new', 'Password new', []) !!}
                    </div>

                    <div class="form-floating mb-4">
                        {!! Form::password('re_password_new', ['class'=>'form-control']) !!}
                        {!! Form::label('re_password_new', 'Re-Password new', []) !!}
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
