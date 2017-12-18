<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! asset('images/logo/sygnet.png') !!}"/>
    <title>HURTMET</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

</head>

<body>
<div class="wrapper" id="app">
    @include('shop_layouts.header')

    @include('shop_layouts.info-bar')

    @include('shop_layouts.content')

    @include('shop_layouts.info-panel')

    @include('shop_layouts.footer')

</div>

<script src="{{ asset('js/app.js') }}"></script>
<script>

//    document.querySelectorAll('[data-category]').forEach(item => {
//
//        item.addEventListener('mouseover', function () {
//                document.querySelector('[data-toggle="' + item.dataset.category + '"]').classList.add('is-visible');
//        });
//
//        item.addEventListener('mouseout', function () {
//            setTimeout(function () {
//                document.querySelector('[data-toggle="' + item.dataset.category + '"]').classList.remove('is-visible');
//
//            }, 100);
//        });
//    });


    $(document).ready(function(){

        $("#one").mouseenter(function(){
            $("#one-sub").stop(true).slideDown("slow");
        });
        $("#one").mouseleave(function(){
            $("#one-sub").stop(true).slideUp("fast");
        });
        $("#two").mouseenter(function(){
            $("#two-sub").stop(true).slideDown("slow");
        });
        $("#two").mouseleave(function(){
            $("#two-sub").stop(true).slideUp("fast");
        });

        $("#three").mouseenter(function(){
            $("#three-sub").stop(true).slideDown("slow");
        });
        $("#three").mouseleave(function(){
            $("#three-sub").stop(true).slideUp("fast");
        });

        $("#four").mouseenter(function(){
            $("#four-sub").stop(true).slideDown("slow");
        });
        $("#four").mouseleave(function(){
            $("#four-sub").stop(true).slideUp("fast");
        });


});

</script>

</body>

</html>
