const TOKEN_GHN = "ba8ec0ca-586b-11ed-b824-262f869eb1a7";
const ID_GHN = 3404895;

load_comment();
load_province();

<!--binhluan-->
function load_comment() {
    var product_id = $('.comment_product_id').val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: "/load-comment",
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
        url: "/send-comment'",
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

<!--script-owl-carousel-->
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
});

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
        $('#fee_ship').append('<span id="fees">' + fee + ' VND</span>');
        $('#fee_ship_hidden').append('<input type="hidden" id="fee_input" value="' + fee + '">');

        var total = $('#total_hidden').val();
        var can_total = Number(total) + Number(fee);
        $('#total').append('<span id="total_span">' + can_total + ' VND</span>');

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
            url: "/confirm-order",
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
                window.location.href = "/";
            }
        });
    });
});

<!--search-->
$('#keywords').keyup(function () {
    var keywords = $(this).val();
    if (keywords !== '') {
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/search-ajax", method: "POST", data: {keywords: keywords, _token: _token},
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

<!--validate-register-->
$(function () {
    $("#register_form").validate({
        rules: {
            fullname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            password: {
                minlength: 6,
                maxlength: 6
            },
            password_confirm: {
                minlength: 6,
                maxlength: 6,
                equalTo: "#password"
            },
        },
        messages: {
            fullname: {
                required: "<div style='color: red;'>Please enter some data</div>",
                minlength: "<div style='color: red;'>Full name min 10 character</div>"
            },
            email: {
                required: "<div style='color: red;'>Please enter some data</div>",
                email: "<div style='color: red;'>Wrong format email",
            },
            phone: {
                required: "<div style='color: red;'>Please enter some data</div>",
                number: "<div style='color: red;'>Please enter number</div>",
                minlength: "<div style='color: red;'>Phone length 10 number</div>",
                maxlength: "<div style='color: red;'>Phone length 10 number</div>",
            },
            password: {
                minlength: "<div style='color: red;'>Password length 6 character</div>",
                maxlength: "<div style='color: red;'>Password length 6 character</div>",
            },
            password_confirm: {
                minlength: "<div style='color: red;'>Password length 6 character</div>",
                maxlength: "<div style='color: red;'>Password length 6 character</div>",
                equalTo: "<div style='color: red;'>Wrong Password</div>"
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
});


<!--validate-register-->
$(function () {
    $("#login_form").validate({
        rules: {
            email: {
                email: true
            },
        },
        messages: {
            email: {
                email: "<div style='color: red;'>Wrong format email</div>",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
});

<!--validate-checkout-->
$(function () {
    $("#form_checkout").validate({
        rules: {
            phone_nguoinhan: {
                number: true,
                minlength: 10,
                maxlength: 10
            },
        },
        messages: {
            phone_nguoinhan: {
                number: "<div style='color: red;'>Please enter some number</div>",
                minlength: "<div style='color: red;'>Wrong fotmat</div>",
                maxlength: "<div style='color: red;'>Wrong fotmat</div>",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).removeClass('is-valid').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
});


//update-profile
$(document).ready(function () {
    $("#profile_setup_frm").submit(function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var address = $('#address').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#btn").attr("disabled", true);
        $("#btn").html("Updating...");
        $.ajax({
            url: "/update-profile",
            method: "POST",
            data: {name:name, email:email, phone:phone, address:address},
            success: function (response) {
                if (response.code == 400) {
                    let error = '<span class="alert alert-danger">' + response.msg + '</span>';
                    $("#res").html(error);
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Save Profile");
                } else if (response.code == 200) {
                    let success = '<span class="alert alert-success">' + response.msg + '</span>';
                    $("#res").html(success);
                    $("#btn").attr("disabled", false);
                    $("#btn").html("Save Profile");

                }
            }
        });
    });
});
