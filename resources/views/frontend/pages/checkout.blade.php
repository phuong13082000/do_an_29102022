@extends('layout.user')

@section('index')
    @include('frontend.includes.alert')
    <div class="mt-3">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::open(['url'=>'#', 'id'=>'form_checkout']) !!}

                <h3>Thông tin nhận hàng</h3>
                <hr>
                <div class="form-floating mb-4">
                    {!! Form::text('name_nguoinhan', '', ['class'=>'form-control', 'id'=>'name_nguoinhan', 'placeholder'=>'Tên người nhận hàng']) !!}
                    {!! Form::label('name_nguoinhan', 'Tên người nhận hàng', []) !!}
                </div>

                <div class="form-floating mb-4">
                    {!! Form::text('phone_nguoinhan', '', ['class'=>'form-control', 'id'=>'phone_nguoinhan', 'placeholder'=>'Số điện thoại nhận hàng']) !!}
                    {!! Form::label('phone_nguoinhan', 'Số điện thoại nhận hàng', []) !!}
                </div>

                <div class="mb-3">
                    <div class="row">
                        <span>Địa chỉ nhận hàng</span>

                        <div class="col-sm-4">
                            <select id='province' class="form-control">
                                <option selected>Thành Phố</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id='district' class="form-control">
                                <option selected>Quận Huyện</option>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select id='ward' class="form-control">
                                <option selected>Phường Xã</option>
                            </select>
                        </div>
                        <span id="address"></span>
                    </div>

                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('payment_method', 'Phương thức thanh toán', []) !!}
                        {!! Form::select('payment_method', ['Tiền mặt'=>'Tiền mặt', 'Trả bằng thẻ ngân hàng'=>'Trả bằng thẻ ngân hàng'], '', ['class'=>'form-control', 'id'=>'payment_method']) !!}
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-group">
                        {!! Form::label('note', 'Ghi chú', []) !!}
                        {!! Form::textarea('note', '', ['class'=>'form-control', 'id'=>'note']) !!}
                    </div>
                </div>

                {!! Form::submit('Xác nhận đơn hàng', ['class'=>'btn btn-success btn-submit']) !!}

            </div>

            {{--thong tin don hang--}}
            <div class="col-sm-6">
                <h3>Thông tin đơn hàng</h3>
                <hr>

                @if(Cart::count() != 0)
                    <div class="container">
                        <div class="mt-3">
                            <div class="table-responsive cart_info">
                                <table class="table table-condensed">
                                    <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Hình ảnh</td>
                                        <td class="description">Tên sản phẩm</td>
                                        <td class="price">Giá</td>
                                        <td class="quantity">Số lượng</td>
                                        <td class="total">Tổng</td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $content)
                                        <tr>
                                            <td><img src="{{asset('uploads/product/'.$content->options->image)}}"
                                                     width="90" alt="{{$content->name}}"/></td>
                                            <td><h4>{{$content->name}}</a></h4></td>
                                            <td>
                                                <p>{{number_format($content->price).' '.'vnđ'}}</p>
                                                <input type="hidden" id="product_price" value="{{$content->price}}">
                                            </td>
                                            <td>{{$content->qty}}</td>
                                            <td>
                                                <p>
                                                    @php
                                                        $subtotal = $content->price * $content->qty;
                                                        echo number_format($subtotal).' '.'vnđ';
                                                    @endphp
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h4 id="fee_ship">Tiền ship :</h4>
                        <div id="fee_ship_hidden"></div>
                        <h4 id="total">Thành tiền :</h4>
                        <input type="hidden" id="total_hidden" value="{{Cart::total()}}">
                    </div>
                @else
                    <div class="container">
                        <div class="mt-3">
                            <a href="{{url('/')}}" style="text-decoration: none"> Quay lại trang chủ và chọn đồ để
                                mua</a>
                        </div>
                    </div>
                @endif
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const TOKEN_GHN = 'ba8ec0ca-586b-11ed-b824-262f869eb1a7';
        const ID_GHN = 3404895;

        load_province();

        <!--script-diachi-->
        function load_province() {
            var provinces = {
                "url": "https://online-gateway.ghn.vn/shiip/public-api/master-data/province",
                "method": "GET",
                "timeout": 0,
                "headers": {"token": TOKEN_GHN},
            };
            $.ajax(provinces).done(function (province) {
                let length_province = province.data.length;
                let data_province = province.data;
                for (let i = 0; i < length_province; i++) {
                    $('#province').append('<option id="id_province_' + data_province[i]['ProvinceID'] + '" value="' + data_province[i]['ProvinceID'] + '">' + data_province[i]['ProvinceName'] + '</option>');
                }
            });
        }

        //load-district
        $(document).ready(function () {
            $('#province').on('change', function () {
                var id_province = $(this).find(":selected").val();
                var districts = {
                    "url": "https://online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=" + id_province + "",
                    "method": "GET",
                    "timeout": 0,
                    "headers": {"token": TOKEN_GHN},
                };
                $.ajax(districts).done(function (district) {
                    let data_district = district.data;
                    let length_district = district.data.length;
                    for (let i = 0; i < length_district; i++) {
                        $('#district').append('<option id="id_district_' + data_district[i]['DistrictID'] + '" value="' + data_district[i]['DistrictID'] + '">' + data_district[i]['DistrictName'] + '</option>');
                    }
                });
            });
        });

        //load-ward
        $(document).ready(function () {
            $('#district').on('change', function () {
                var id_district = $(this).find(":selected").val();
                var wards = {
                    "url": "https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=" + id_district + "",
                    "method": "GET",
                    "timeout": 0,
                    "headers": {"token": TOKEN_GHN},
                };
                $.ajax(wards).done(function (ward) {
                    let data_ward = ward.data;
                    let length_ward = ward.data.length;
                    for (let i = 0; i < length_ward; i++) {
                        $('#ward').append('<option id="id_ward_' + data_ward[i]['WardCode'] + '" value="' + data_ward[i]['WardCode'] + '">' + data_ward[i]['WardName'] + '</option>');
                    }
                });

                //service-fee
                var form_district = 1450; //q8-tphcm
                var service_fee = {
                    "url": "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services?shop_id=" + ID_GHN + "&from_district=" + form_district + "&to_district=" + id_district + "",
                    "method": "GET",
                    "timeout": 0,
                    "headers": {"token": TOKEN_GHN},
                };
                $.ajax(service_fee).done(function (response) {
                    var service_id = response['data'][0]['service_id'];
                    $('#fee_ship').append('<input type="hidden" id="fee_service" value="' + service_id + '">');
                });
            });
        });

        //canc fee
        $('#ward').on('change', function () {
            var ward_code = $(this).val();
            var district_id = $('#district').val();
            var price_product = $('#product_price').val();
            var service_id = $('#fee_service').val();
            var from_district_id = $('#footer_id_address').val(); // 1450 q8-tphcm
            var height = 15; //cm
            var length = 15; //cm
            var weight = 400; //g
            var width = 8; //cm

            var calculatorFee = {
                "url": "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee?service_id=" + service_id + "&insurance_value=" + price_product + "&coupon=&from_district_id=" + from_district_id + "&to_district_id=" + district_id + "&to_ward_code=" + ward_code + "&height=" + height + "&length=" + length + "&weight=" + weight + "&width=" + width + "",
                "method": "GET",
                "timeout": 0,
                "headers": {"token": TOKEN_GHN, "shop_id": ID_GHN},
            };
            $.ajax(calculatorFee).done(function (response) {
                var fee = response['data']['total'];
                $('#fee_ship').append('<span id="fees" >' + fee.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</span>');
                $('#fee_ship_hidden').append('<input type="hidden" id="fee_input" value="' + fee + '">');

                var total = $('#total_hidden').val();
                var can_total = Number(total) + Number(fee);
                $('#total').append('<span id="total_span">' + can_total.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) + '</span>');

            });
            $.ajax(calculatorFee).fail(function (response) {
                $('#fee_ship').append('<span id="fees">0 VND</span>');
                $('#fee_ship_hidden').append('<input type="hidden" id="fee_input" value=0>');
            });

            //reset -- luu name_address
            $('#fees').remove();
            $('#total_span').remove();
            $('#name_address').remove();

            var id_province = $('#province').val();

            var name_province = $('#id_province_' + id_province).text();
            var name_district = $('#id_district_' + district_id).text();
            var name_ward = $('#id_ward_' + ward_code).text();

            $('#address').append('<input type="hidden" id="name_address" value="' + name_ward + '-' + name_district + '-' + name_province + '">');

        });

        //checkout
        $(document).ready(function () {
            $('.btn-submit').on('click', function () {
                var _token = $('input[name="_token"]').val();
                var price_ship = $('#fee_input').val();
                var name_address = $('#name_address').val();

                var name_nguoinhan = $('#name_nguoinhan').val();
                var phone_nguoinhan = $('#phone_nguoinhan').val();
                var payment_method = $('#payment_method').val();
                var note = $('#note').val();

                $.ajax({
                    url: "{{url('/confirm-order')}}",
                    method: "POST",
                    data: {
                        name_nguoinhan: name_nguoinhan,
                        phone_nguoinhan: phone_nguoinhan,
                        payment_method: payment_method,
                        name_address: name_address,
                        price_ship: price_ship,
                        note: note,
                        _token: _token
                    },
                    success: function (data) {
                        window.location.href = "{{url('/')}}";
                    }
                });
            });
        });

    </script>
@endsection

