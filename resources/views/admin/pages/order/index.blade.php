@extends('layout.admin')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order chưa xữ lý</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người mua</th>
                                    <th>Người nhận</th>
                                    <th>Phương thức</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders_chuaXuLy as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->reCustomer->fullname}}</td>
                                        <td>{{$order->name_nguoinhan}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>
                                            @if($order->status==1)
                                                <span class="badge badge-info">Chưa xử lý</span>
                                            @elseif($order->status==2)
                                                <span class="badge badge-success">Đã xử lý-Đã giao hàng</span>
                                            @else
                                                <span class="badge badge-dark">Hủy đơn hàng-tạm giữ</span>
                                            @endif
                                        </td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{url('admin/order-detail/'.$order->id)}}" class="btn btn-sm btn-primary">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order đã xữ lý</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người mua</th>
                                    <th>Người nhận</th>
                                    <th>Phương thức</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders_XuLy as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->reCustomer->fullname}}</td>
                                        <td>{{$order->name_nguoinhan}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>
                                            @if($order->status==1)
                                                <span class="badge badge-info">Chưa xử lý</span>
                                            @elseif($order->status==2)
                                                <span class="badge badge-success">Đã xử lý-Đã giao hàng</span>
                                            @else
                                                <span class="badge badge-dark">Hủy đơn hàng-tạm giữ</span>
                                            @endif
                                        </td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{url('admin/order-detail/'.$order->id)}}" class="btn btn-sm btn-primary">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order đã hủy</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Người mua</th>
                                    <th>Người nhận</th>
                                    <th>Phương thức</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders_huy as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->reCustomer->fullname}}</td>
                                        <td>{{$order->name_nguoinhan}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>
                                            @if($order->status==1)
                                                <span class="badge badge-info">Chưa xử lý</span>
                                            @elseif($order->status==2)
                                                <span class="badge badge-success">Đã xử lý-Đã giao hàng</span>
                                            @else
                                                <span class="badge badge-dark">Hủy đơn hàng-tạm giữ</span>
                                            @endif
                                        </td>
                                        <td>{{$order->created_at}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{url('admin/order-detail/'.$order->id)}}" class="btn btn-sm btn-primary">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
