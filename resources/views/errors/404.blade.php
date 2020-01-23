@extends('layouts.master')
@section('title','eBuy | Sayfa Bulunamadı!')
@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1>404</h1>
        <h2>Aradığınız sayfa bulunamadı!</h2>
        <h2>Ana sayfaya dönmek için <a href="{{route('anasayfa')}} " style="color:green;"> tıklayınız.</a></h2>
    </div>
</div>
@endsection
