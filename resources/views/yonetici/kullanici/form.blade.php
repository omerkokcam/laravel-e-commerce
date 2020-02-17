@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Ana Sayfa')

@section('content')

    <u><h1 class="page">Kullanıcı Yönetimi</h1></u>

    <form method = 'post' action="{{$entry -> id > 0 ?route('yonetici.kullanici.kayit', $entry -> id ): route('yonetici.kullanici.kayit')}}">
        {{csrf_field()}}
       <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{$entry -> id > 0 ? "Güncelle " : "Kaydet" }}</button>
       </div>
        <h2 class="sub-header">Kullanıcı {{$entry -> id > 0 ? "Düzenle " : "Ekle"}}</h2>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
{{--            <input type="hidden" name="id" value="{{$entry->id}}">--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Adınız ve Soyadınız </label>
                    <input type="text" class="form-control" name="adsoyad" id="adsoyad" placeholder="Ad ve Soyad" value="{{$entry->adsoyad}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email adresi</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{$entry->email}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sifre">Şifre</label>
                    <input type="password" class="form-control" name="sifre" id="sifre" placeholder="Şifreniz..." >
                </div>
            </div>
        </div>


        <div class="checkbox">
            <label>
                <input type="checkbox" name="aktif_mi" value = "1" {{$entry->yonetici_mi == 1 ? 'checked' : '' }}> Beni Hatırla
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="yonetici_mi" value = "1" {{$entry->yonetici_mi == 1 ? 'checked' : '' }}> Yönetici mi?
            </label>
        </div>

    </form>
@endsection
