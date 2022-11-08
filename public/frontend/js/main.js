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

