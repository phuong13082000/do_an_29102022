<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
          integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid bg-black">

    @include('frontend.includes.top-header')

</div>

<div class="container">

    @include('frontend.includes.header')

    @yield('index')

    @include('frontend.includes.footer')

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
        integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"
        integrity="sha256-xLD7nhI62fcsEZK2/v8LsBcb4lG7dgULkuXoXB/j91c=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!--script-owl-carousel-->
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        //nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
</script>

<!--binhluan-->
<script type="text/javascript">
    $(document).ready(function () {
        load_comment();

        function load_comment() {
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/load-comment')}}",
                method: "POST",
                data: {product_id: product_id, _token: _token},
                success: function (data) {
                    $('#comment_show').html(data);
                }
            });
        }

        $('#send-comment').click(function () {
            var customer_id = $('.comment_customer_id').val();
            var product_id = $('.comment_product_id').val();
            var title = $('.title').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/send-comment')}}",
                method: "POST",
                data: {title: title, customer_id: customer_id, product_id: product_id, _token: _token},
                success: function (data) {
                    $('#thongbao-comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chời duyệt</span>')
                    load_comment();
                    $('#thongbao-comment').fadeOut(5000);
                    $('.title').val('');
                }
            });
        });
    });
</script>

<!--script-diachi-->
<script type="text/javascript">
    const token = "{{env('TOKEN_GHN')}}";
    const ID_GHN = 3404895;

    load_province();
    load_district();
    load_ward();

    function load_province() {
        var provinces = {
            "url": "https://online-gateway.ghn.vn/shiip/public-api/master-data/province",
            "method": "GET",
            "timeout": 0,
            "headers": {"token": token},
        };
        $.ajax(provinces).done(function (response) {
            var data_province = response.data;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/data-province')}}",
                method: "POST",
                data: {data_province: data_province, _token: _token},
                success: function (data) {
                    $('#province').html(data);
                }
            });
        });
    }

    function load_district() {
        $(document).ready(function () {
            $('#province').on('change', function () {
                var id_province = $(this).val();
                var districts = {
                    "url": "https://online-gateway.ghn.vn/shiip/public-api/master-data/district?province_id=" + id_province + "",
                    "method": "GET",
                    "timeout": 0,
                    "headers": {"token": token},
                };
                $.ajax(districts).done(function (response) {
                    let length_district;
                    if (response.data.length) {
                        length_district = response.data.length;
                    } else {
                        length_district = 0;
                    }
                    var data_district = response.data;
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/data-district')}}",
                        method: "POST",
                        data: {data_district: data_district, length_district: length_district, _token: _token},
                        success: function (data) {
                            $('#district').html(data);
                        }
                    });
                });
            });
        });
    }

    function load_ward() {
        $(document).ready(function () {
            $('#district').on('change', function () {
                var id_district = $(this).val();
                var districts = {
                    "url": "https://online-gateway.ghn.vn/shiip/public-api/master-data/ward?district_id=" + id_district + "",
                    "method": "GET",
                    "timeout": 0,
                    "headers": {"token": token},
                };
                $.ajax(districts).done(function (response) {
                    var length_ward = response.data.length;
                    var data_ward = response.data;
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/data-ward')}}",
                        method: "POST",
                        data: {length_ward: length_ward, data_ward: data_ward, _token: _token},
                        success: function (data) {
                            $('#ward').html(data);
                        }
                    });
                });
            });
        });
    }

    //service-fee
    $('#district').on('change', function () {
        var form_district = 1450; //q8-tphcm
        var to_district = $('#district').val();

        var settings = {
            "url": "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/available-services?shop_id=" + ID_GHN + "&from_district=" + form_district + "&to_district=" + to_district + "",
            "method": "GET",
            "timeout": 0,
            "headers": {"token": token},
        };
        $.ajax(settings).done(function (response) {
            var service_id = response['data'][0]['service_id'];
            $('#fee_ship').append('<input type="hidden" id="fee_service" value="' + service_id + '">');
        });
    });

    //canc fee
    $('#ward').on('change', function () {
        var to_ward_code = $(this).val();
        var to_district_id = $('#district').val();
        var price_product = $('#product_price').val();
        var service_id = $('#fee_service').val();
        var from_district_id = 1450; //q8-tphcm
        var height = 15; //cm
        var length = 15; //cm
        var weight = 3000; //g
        var width = 15; //cm

        var calculatorFee = {
            "url": "https://online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee?service_id=" + service_id + "&insurance_value=" +
                price_product + "&coupon=&from_district_id=" + from_district_id + "&to_district_id=" + to_district_id + "&to_ward_code=" +
                to_ward_code + "&height=" + height + "&length=" + length + "&weight=" + weight + "&width=" + width + "",
            "method": "GET",
            "timeout": 0,
            "headers": {"token": token, "shop_id": ID_GHN},
        };
        $.ajax(calculatorFee).done(function (response) {
            var price = response['data']['total'];
            $('#fee_ship').append('<span id="fee">' + price + '</span>');
        });
        $.ajax(calculatorFee).fail(function (response) {
            $('#fee_ship').append('<span id="fee">Free ship</span>');
        });
    });

    //reset -- luu name_address
    $(document).ready(function () {
        $('#ward').on('change', function () {
            $('#fee').remove();
            $('#name_address').remove();

            var id_province = $('#province').val();
            var id_district = $('#district').val();
            var id_ward = $('#ward').val();
            var name_province = $('#id_province_'+id_province).text();
            var name_district = $('#id_district_'+id_district).text();
            var name_ward = $('#id_ward_'+id_ward).text();
            $('#address').append('<input type="hidden" id="name_address" value="'+name_ward+'-'+name_district+'-'+name_province+'">');

        });
    });

    //checkout
    $(document).ready(function () {
        $('.btn-submit').on('click', function () {
            var _token = $('input[name="_token"]').val();
            var price_ship = $('#fee').text();
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
                    note: note,
                    name_address: name_address,
                    price_ship: price_ship,
                    _token: _token
                },
                success: function (data) {
                    window.location.href = "{{url('/')}}";
                }
            });
        });
    });

</script>

<!--search-->
<script type="text/javascript">
    $('#keywords').keyup(function () {
        var keywords = $(this).val();
        if (keywords !== '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/search-ajax') }}",
                method: "POST",
                data: {keywords: keywords, _token: _token},
                success: function (data) {
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                }
            });
        } else {
            $('#search_ajax').fadeOut();
        }
    });
    $(document).on('click', '.li_search_ajax', function () {
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>

</body>
</html>

