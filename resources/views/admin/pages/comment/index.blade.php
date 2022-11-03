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
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Answer</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_Comment as $key => $comment )
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$comment->title}}</td>
                                        <td>{{$comment->answer}}</td>
                                        <td>{{$comment->reCustomer->fullname}}</td>
                                        <td>{{$comment->reProduct->title}}</td>
                                        <td>{{$comment->status}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Answer</th>
                                    <th>Product</th>
                                    <th>Customer</th>
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

@endsection
