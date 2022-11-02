@extends('layout.admin')

@section('content')
    <div class="mt-3">
        Thông tin đăng nhập
    </div>

    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th style="width:30px;"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$customer->fullname}}</td>
                <td>{{$customer->phone}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->address}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển hàng
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th>Tên người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$order->name_nguoinhan}}</td>
                        <td>{{$order->address_nguoinhan}}</td>
                        <td>{{$order->phone_nguoinhan}}</td>
                        <td>{{$order->notes}}</td>
                        <td>{{$order->payment_method}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <br><br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng kho còn</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Tổng tiền</th>

                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 0;
                        $total = 0;
                    @endphp
                    @foreach($order_details as $key => $details)
                        @php
                            $i++;
                            $subtotal = $details->price*$details->num;
                            $total+=$subtotal;
                        @endphp
                        <tr class="color_qty_{{$details->product_id}}">
                            <td><i>{{$i}}</i></td>
                            <td>{{$details->reProduct->title}}</td>
                            <td>{{$details->reProduct->number}}</td>
                            <td>{{$details->num}}</td>
                            <td>{{number_format($details->price ,0,',','.')}}đ</td>
                            <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">
                            @php
                                $total_coupon = 0;
                                $total_coupon = $total + 50000 ;
                            @endphp
                            Tổng : {{number_format($total,0,',','.')}}đ <br>
                            Phí ship : 50.000đ <br>
                            Thanh toán: {{number_format($total_coupon,0,',','.')}}đ
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
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
                    </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#don-hang"> Xem trước bản
                    in
                </button>
            </div>

        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="don-hang" tabindex="-1" aria-labelledby="modallable"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modallable">Đơn Hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="text-center">Hoá đơn</h1>
                    <b>Người đặt</b>
                    <table class="table-bordered">
                        <thead>
                        <tr>
                            <th>Tên khách đặt</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$customer->fullname}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->address}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <b>Ship hàng tới</b>
                    <table class="table-bordered">
                        <thead>
                        <tr>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Sdt</th>
                            <th>Ghi chú</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$order->name_nguoinhan}}</td>
                            <td>{{$order->address_nguoinhan}}</td>
                            <td>{{$order->phone_nguoinhan}}</td>
                            <td>{{$order->notes}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <b>Đơn hàng đặt</b>
                    <table class="table-bordered">
                        <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>;
                        @foreach($order_details as $key => $details)
                            @php
                                $i++;
                                $subtotal = $details->price * $details->num;
                                $total+=$subtotal;
                            @endphp
                            <tr>
                                <td>{{$details->reProduct->title}}</td>
                                <td>{{$details->num}}</td>
                                <td>{{number_format($details->price ,0,',','.')}}đ</td>
                                <td>{{number_format($subtotal ,0,',','.')}}đ</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">
                                @php
                                    $total_coupon = 0;
                                    $total_coupon = $total + 50000 ;
                                @endphp
                                Phí ship : 50.000đ <br>
                                Thanh toán: {{number_format($total_coupon,0,',','.')}}đ
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <p>Ký tên</p>
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 200px">Người lập phiếu</th>
                            <th style="width: 200px">Người nhận</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div class="modal-footer justify-content-between">
                        <a target="_blank" type="button" class="btn btn-default" href="{{url('admin/print-order/'.$details->order_id)}}">In đơn hàng</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
