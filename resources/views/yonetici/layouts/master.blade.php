<!DOCTYPE html>
<html lang="{{config('app.locale')}}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title',config('app.name').'| Yönetim')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}"/>
    @yield('head')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>

@include('yonetici.layouts.partials.navbar')

<div class="container-fluid" style="padding-top:60px">
    <div class="row" >
        <div class="col-sm-3 col-md-3 col-lg-2" style="margin-top: 40px;  " >
            @include('yonetici.layouts.partials.sidebar')
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2 main" style="position: absolute ">

            @yield('content')

        </div>
    </div>
</div>

<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

@yield('footer')



</body>
</html>
