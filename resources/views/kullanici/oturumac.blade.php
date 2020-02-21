
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html: charset=UTF-8">
    <meta charset="UTF-8">
    <title>eBuy Yönetici Oturum Aç</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,800">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}"/>

    <meta name="csrf-token" content="{{csrf_token()}}">
</head>


<div class="container" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class="panel panel-default" style="background: #f8f8f8">
                <div style="padding-left:350px" class="panel-heading">eBuy Oturum Aç</div>
                <div class="panel-body">

                    <img style="padding-left:230px; width:600px ;height:150px ;padding-bottom:20px;" src="{{asset('img/logo.png')}}" >
                    @include('layouts.partials.errors')
                    @include('layouts.partials.alert')

                    <form style=" margin-bottom: 200px" class="form-horizontal" role="form" method="POST" action="{{route('kullanici.oturumac')}}">
                        {{csrf_field()}}
                        <div style="padding-top:30px " class="form-group">
                            <label for="email" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="ornek@ornek.com" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sifre" class="col-md-4 control-label">Şifre</label>
                            <div class="col-md-6">
                                <input id="sifre" type="password" class="form-control" name="sifre" id="sifre" placeholder="*********" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="benihatirla" checked> Beni hatırla
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div style="padding-left: 250px;  " class="links">
                            <a style="color:#f33535;" href="{{route('kullanici.kaydol')}}">Hâlâ kayıt olmadın mı ?</a>
                            <br>
                            <a style="color:#f33535;" href="{{route('anasayfa')}}"><-Ana sayfaya geri dön.</a>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <hr>
                                <button type="submit" class="btn btn-primary" style="background: #f55d5d ;border-color: #f55d5d ">

                                    Giriş Yap
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
