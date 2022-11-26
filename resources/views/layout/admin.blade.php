<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @include('admin.includes.navbar')
    @include('admin.includes.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        @include('admin.includes.breadcrumb')
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>

    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2022 </strong>
    </footer>

</div>

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script>$.widget.bridge('uibutton', $.ui.button)</script>

<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}"></script>

<!-- JQVMap -->
<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}"></script>

<!-- daterangepicker -->
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- jquery-validation -->
<script src="{{asset('admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('admin/js/adminlte.js')}}"></script>

<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('admin/js/main.js')}}"></script>

@yield('script_admin')

<!-- Update Order Status -->
<script type="text/javascript">
    $('.order_details').change(function () {
        var id = $('input[name="id_order"]').val();
        var status = $(this).find(':selected').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('admin/update-status-order')}}",
            method: "POST",
            data: {id: id, status: status, _token: _token},
            success: function (data) {
                alert(data.message);
                window.location.href = "{{url('admin/order')}}";
            }
        });
    });
</script>

<!--comment-->
<script type="text/javascript">
    $('.comment_duyet_btn').click(function () {
        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        $.ajax({
            url: "{{url('admin/allow-comment')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {comment_status: comment_status, comment_id: comment_id, comment_product_id: comment_product_id},
            success: function (data) {
                window.location.reload();
            }
        });
    });

    $('.btn-reply-comment').click(function () {
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_' + comment_id).val();
        var comment_product_id = $(this).data('product_id');
        $.ajax({
            url: "{{url('admin/reply-comment')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {comment: comment, comment_id: comment_id, comment_product_id: comment_product_id},
            success: function (data) {
                window.location.reload();
            }
        });
    });

</script>

<!--gallery-->
<script type="text/javascript">
    load_gallery();

    function load_gallery() {
        var pro_id = $('#id_product').val();
        $.ajax({
            url: "{{url('admin/select-gallery')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {pro_id: pro_id},
            success: function (data) {
                $('#gallery_load').html(data);
            }
        });
    }

    $('#file').change(function () {
        var error = '';
        var files = $('#file')[0].files;
        if (files.length > 5) {
            error += '<p>Max 5 Image</p>';
        } else if (files.length == '') {
            error += '<p>No Image</p>';
        } else if (files.size > 2000000) {
            error += '<p>Max 2 MB</p>';
        }
        if (error == '') {

        } else {
            $('#file').val('');
            $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
            return false;
        }
    });

    $(document).on('blur', '.edit_gall_name', function () {
        var gall_id = $(this).data('gall_id');
        var gall_text = $(this).text()
        $.ajax({
            url: "{{url('admin/update-gallery-name')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {gall_id: gall_id, gall_text: gall_text},
            success: function (data) {
                $('#gallery_load').html(data);
                load_gallery();
                $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
            }
        });
    });

    $(document).on('click', '.delete_gall', function () {
        var gall_id = $(this).data('gall_id');
        if (confirm('Bạn muốn xóa hình ảnh này không?')) {
            $.ajax({
                url: "{{url('admin/delete-gallery')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {gall_id: gall_id},
                success: function (data) {
                    $('#gallery_load').html(data);
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                }
            });
        }
    });

    $(document).on('change', '.file_image', function () {
        var gall_id = $(this).data('gall_id');
        var image = document.getElementById('file-'+gall_id).files[0];

        var form_data = new FormData();
        form_data.append("file", image);
        form_data.append("gall_id", gall_id);

        $.ajax({
            url: "{{url('admin/update-gallery')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form_data,
            contentType:false,
            cache:false,
            processData:false,
            success: function (data) {
                $('#gallery_load').html(data);
                load_gallery();
                $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
            }
        });
    });

    //xoa cmt binh luan
    $(document).on('click', '.btn_delete_bl', function () {
        var comment_id = $(this).data('comment_id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('admin/delete-comment')}}",
            method: "POST",
            data: {comment_id: comment_id},
            success: function (data) {
                window.location.reload();
            }
        });
    });

    //xoa cmt tra loi
    $(document).on('click', '.btn_delete_tl', function () {
        var comment_parent_id = $(this).data('comment_parent_id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('admin/delete-reply-comment')}}",
            method: "POST",
            data: {comment_parent_id: comment_parent_id},
            success: function (data) {
                window.location.reload();
            }
        });
    });

</script>

</body>
</html>
