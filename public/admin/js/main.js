<!--Page specific script -->
$(function () {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});

<!-- Validate brand -->
$(function () {
    $("#formbrand").validate({
        rules: {
            title: {required: true,},
            action: "required"
        },
        messages: {
            title: {
                required: "Please enter some data",
            },
            action: "Please provide some data"
        }
    });
});

<!-- Validate slider -->
$(function () {
    $("#formslider").validate({
        rules: {
            title: {required: true,},
            url: {required: true,},
            action: "required"
        },
        messages: {
            title: {
                required: "Please enter some data",
            },
            url: {
                required: "Please enter some data",
            },
            action: "Please provide some data"
        }
    });
});

<!-- Validate category -->
$(function () {
    $("#formcategory").validate({
        rules: {
            title: {required: true,},
            action: "required"
        },
        messages: {
            title: {
                required: "Please enter some data",
            },
            action: "Please provide some data"
        }
    });
});

<!-- Validate product -->
$(function () {
    $("#formproduct-create").validate({
        rules: {
            title: {required: true,},
            image: {required: true,},
            number: {required: true,},
            price: {required: true,},
            price_sale: {required: true,},
            manhinh: {required: true,},
            mausac: {required: true,},
            camera_sau: {required: true,},
            camera_truoc: {required: true,},
            cpu: {required: true,},
            bonho: {required: true,},
            ram: {required: true,},
            ketnoi: {required: true,},
            pin_sac: {required: true,},
            tienich: {required: true,},
            thongtin_chung: {required: true,},
            action: "required"
        },
        messages: {
            title: {
                required: "Please enter some data",
            },
            image: {
                required: "Please enter some data",
            },
            number: {
                required: "Please enter some data",
            },
            price: {
                required: "Please enter some data",
            },
            price_sale: {
                required: "Please enter some data",
            },
            manhinh: {
                required: "Please enter some data",
            },
            mausac: {
                required: "Please enter some data",
            },
            camera_sau: {
                required: "Please enter some data",
            },
            camera_truoc: {
                required: "Please enter some data",
            },
            cpu: {
                required: "Please enter some data",
            },
            bonho: {
                required: "Please enter some data",
            },
            ram: {
                required: "Please enter some data",
            },
            ketnoi: {
                required: "Please enter some data",
            },
            pin_sac: {
                required: "Please enter some data",
            },
            tienich: {
                required: "Please enter some data",
            },
            thongtin_chung: {
                required: "Please enter some data",
            },
            action: "Please provide some data"
        }
    });
});

