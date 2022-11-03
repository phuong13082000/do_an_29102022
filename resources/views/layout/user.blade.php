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

    $.ajax({
        url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
        method: 'GET',
        headers: {'token': token},
        success: function (province) {
            for (let i = 0; i <= province.data.length; i++) {
                let id_province = province.data[i]['ProvinceID'];
                let name_province = province.data[i]['ProvinceName'];
                $('#province').append('<option id="id_province" name="id_province" value=' + id_province + '>' + name_province + '</option>' +
                    '<input type="hidden" id="name_province" value="' + name_province + '">');
            }
        }
    });
    $(document).ready(function () {
        $('#province').on('change', function () {
            var id_province = $(this).val();
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                method: 'GET',
                headers: {'token': token},
                data: {province_id: id_province},
                success: function (district) {
                    $('#district').append('<option selected>Quận Huyện</option>');
                    for (let i_district = 0; i_district <= district.data.length; i_district++) {
                        let id_district = district.data[i_district]['DistrictID'];
                        let name_district = district.data[i_district]['DistrictName'];
                        $('#district').append('<option id="id_district" name="id_district" value=' + id_district + '>' + name_district + '</option>' +
                            '<input type="hidden" id="name_district" value="' + name_district + '">');

                    }
                }
            });
        });
    });
    $(document).ready(function () {
        $('#district').on('change', function () {
            var id_district = $(this).val();
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                method: 'GET',
                headers: {'token': token},
                data: {district_id: id_district},
                success: function (ward) {
                    $('#ward').append('<option selected>Phưòng Xã</option>');
                    for (let i_ward = 0; i_ward <= ward.data.length; i_ward++) {
                        let id_ward = ward.data[i_ward]['WardCode'];
                        let name_ward = ward.data[i_ward]['WardName'];
                        $('#ward').append('<option id="id_ward" name="id_ward" value=' + id_ward + '>' + name_ward + '</option>' +
                            '<input type="hidden" id="name_ward" value="' + name_ward + '">');
                    }
                }
            });
        });
    });
    $(document).ready(function () {
        $('#province').on('change', function () {
            $('#district').empty();
            $('#ward').empty();

            //$('#district').append('<option selected>Quận Huyện</option>');
            $('#ward').append('<option selected>Phưòng Xã</option>');
        });
        $('#district').on('change', function () {
            $('#ward').empty();
        });
    });
</script>

</body>
</html>

