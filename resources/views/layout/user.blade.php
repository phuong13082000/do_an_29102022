<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{$title ?? ''}}</title>

    <link type="text/css" rel="stylesheet" href="{{asset('frontend/bootstrap5.1.3/css/bootstrap.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/gallery/lightslider.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/gallery/prettify.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/gallery/lightgallery.min.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.7.0/css/lightgallery-bundle.min.css" integrity="sha512-nUqPe0+ak577sKSMThGcKJauRI7ENhKC2FQAOOmdyCYSrUh0GnwLsZNYqwilpMmplN+3nO3zso8CWUgu33BDag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    #button {
        display: inline-block;
        background-color: #FF9800;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 4px;
        position: fixed;
        bottom: 30px;
        right: 30px;
        transition: background-color .3s,
        opacity .5s, visibility .5s;
        opacity: 0;
        visibility: hidden;
        z-index: 1000;
    }
    #button::after {
        content: "\f077";
        font-family: FontAwesome, serif;
        font-weight: normal;
        font-style: normal;
        font-size: 2em;
        line-height: 50px;
        color: #fff;
    }
    #button:hover {
        cursor: pointer;
        background-color: #333;
    }
    #button:active {
        background-color: #555;
    }
    #button.show {
        opacity: 1;
        visibility: visible;
    }
</style>

<!-- Back to top button -->
<a id="button"></a>

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

    <!--scroll top-->
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            $('#button').addClass('show');
        } else {
            $('#button').removeClass('show');
        }
    });

    $('#button').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
    });


</script>

</body>
</html>

