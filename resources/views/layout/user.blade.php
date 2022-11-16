<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!---------Seo--------->
{{--    <meta name="description" content="{{$meta_desc ?? ''}}">--}}
{{--    <meta name="keywords" content="{{$meta_keywords ?? ''}}"/>--}}
{{--    <meta name="robots" content="INDEX,FOLLOW"/>--}}
{{--    <link rel="canonical" href="{{$url_canonical ?? ''}}"/>--}}
{{--    <meta name="author" content="">--}}
{{--    <link rel="icon" type="image/x-icon" href=""/>--}}
    <title>{{$title ?? ''}}</title>
    <!--//-------Seo--------->

    <link type="text/css" rel="stylesheet" href="{{asset('frontend/bootstrap5.1.3/css/bootstrap.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/gallery/lightslider.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/gallery/prettify.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/gallery/lightgallery.min.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>

    @include('frontend.includes.top-header')

    @include('frontend.includes.header')

<div class="container">
    @yield('index')
</div>

    @include('frontend.includes.footer')

<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.js')}}"></script>
<script src="{{asset('frontend/bootstrap5.1.3/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.js')}}"></script>

<script src="{{asset('frontend/js/gallery/lightgallery-all.min.js')}}"></script>
<script src="{{asset('frontend/js/gallery/lightslider.js')}}"></script>
<script src="{{asset('frontend/js/gallery/prettify.js')}}"></script>
<script src="{{asset('frontend/js/gallery/jquery.sharrre.min.js')}}"></script>

<!-- jquery-validation -->
<script src="{{asset('frontend/js/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-validation/additional-methods.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('frontend/js/main.js')}}"></script>

@yield('scripts')
<!--search-->
<script type="text/javascript">
    $('#keywords').keyup(function () {
        var keywords = $(this).val();
        if (keywords !== '') {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/search-ajax')}}",
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

