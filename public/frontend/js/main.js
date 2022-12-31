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

