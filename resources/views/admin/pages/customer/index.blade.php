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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Birthday</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Google_id</th>
                                    <th>Facebook_id</th>
                                    <th>Provider</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($list_Customer as $key => $customer )
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$customer->fullname}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>{{$customer->gender}}</td>
                                        <td>{{$customer->birthday}}</td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->address}}</td>
                                        <td>{{$customer->google_id}}</td>
                                        <td>{{$customer->facebook_id}}</td>
                                        <td>{{$customer->provider}}</td>
                                        <td>{{$customer->status}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Birthday</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Google_id</th>
                                    <th>Facebook_id</th>
                                    <th>Provider</th>
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