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
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->reCustomer->fullname}}</td>
                                        <td>{{$order->name_nguoinhan}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td>
                                            @if($order->status==1)
                                                <form>
                                                    @csrf
                                                    <select class="form-control order_details">
                                                        <option value="">----Chọn hình thức đơn hàng-----</option>
                                                        <option selected value="1">Chưa xử lý</option>
                                                        <option value="2">Đã xử lý-Đã giao hàng</option>
                                                        <option value="3">Hủy đơn hàng-tạm giữ</option>
                                                        <input type="hidden" name="id_order" value="{{$order->id}}">
                                                    </select>
                                                </form>
                                            @elseif($order->status==2)
                                                <form>
                                                    @csrf
                                                    <select class="form-control order_details">
                                                        <option value="">----Chọn hình thức đơn hàng-----</option>
                                                        <option value="1">Chưa xử lý</option>
                                                        <option selected value="2">Đã xử lý-Đã giao hàng</option>
                                                        <option value="3">Hủy đơn hàng-tạm giữ</option>
                                                        <input type="hidden" name="id_order" value="{{$order->id}}">
                                                    </select>
                                                </form>

                                            @else
                                                <form>
                                                    @csrf
                                                    <select class="form-control order_details">
                                                        <option value="">----Chọn hình thức đơn hàng-----</option>
                                                        <option value="1">Chưa xử lý</option>
                                                        <option value="2">Đã xử lý-Đã giao hàng</option>
                                                        <option selected value="3">Hủy đơn hàng-tạm giữ</option>
                                                        <input type="hidden" name="id_order" value="{{$order->id}}">
                                                    </select>
                                                </form>

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
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Người mua</th>
                                    <th>Người nhận</th>
                                    <th>Phương thức</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
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
