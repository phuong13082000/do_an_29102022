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
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
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

<!--script-diachi-->
<script type="text/javascript">
    $.ajax({
        url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province',
        method: 'GET',
        headers: {'token': 'ba8ec0ca-586b-11ed-b824-262f869eb1a7'},
        success: function (province) {
            let i_province = 0;
            for (i_province; i_province <= province.data.length; i_province++) {
                let id_province = province.data[i_province]['ProvinceID'];
                let name_province = province.data[i_province]['ProvinceName'];

                $('#province').append('<option name="id_province" value=' + id_province + '>' + name_province + '</option>');
            }
        }
    });
    $(document).ready(function () {
        $('#province').on('change', function () {
            var id_district = $(this).val();
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district',
                method: 'GET',
                headers: {'token': 'ba8ec0ca-586b-11ed-b824-262f869eb1a7'},
                data: {province_id: id_district},
                success: function (district) {
                    let i_district = 0;
                    for (i_district; i_district <= district.data.length; i_district++) {
                        let id_district = district.data[i_district]['DistrictID'];
                        let name_district = district.data[i_district]['DistrictName'];

                        $('#district').append('<option name="id_district" value=' + id_district + '>' + name_district + '</option>');
                    }
                }
            });
        });
    });

    $(document).ready(function () {
        $('#district').on('change', function () {
            var id_ward = $(this).val();
            $.ajax({
                url: 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward',
                method: 'GET',
                headers: {'token': 'ba8ec0ca-586b-11ed-b824-262f869eb1a7'},
                data: {district_id: id_ward},
                success: function (ward) {
                    let i_ward = 0;
                    for (i_ward; i_ward <= ward.data.length; i_ward++) {
                        let id_ward = ward.data[i_ward]['WardCode'];
                        let name_ward = ward.data[i_ward]['WardName'];

                        $('#ward').append('<option name="id_ward" value=' + id_ward + '>' + name_ward + '</option>');
                    }
                }
            });
        });
    });

</script>

</body>
</html>

