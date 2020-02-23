@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Sipariş Sayfası')

@section('content')

    <u><h1 class="page">Sipariş Yönetimi</h1></u>

    <form method = 'post' action="{{$entry -> id > 0 ?route('yonetici.siparis.kayit', $entry -> id ): route('yonetici.siparis.kayit')}}" enctype="multipart/form-data">
        {{csrf_field()}}
       <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{$entry -> id > 0 ? "Güncelle " : "Kaydet" }}</button>
       </div>
        <h2 class="sub-header">Sipariş {{$entry -> id > 0 ? "Düzenle " : "Ekle"}}</h2>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adsoyad"> Ad Soyad </label>
                    <input type="text" class="form-control" name="adsoyad" id="adsoyad" placeholder = "Ad Soyad" value="{{$entry->adsoyad}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefon"> Telefon </label>
                    <input type="text" class="form-control" name="telefon" id="telefon" placeholder = "Telefon" value="{{$entry->telefon}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ceptelefonu">Cep Telefonu </label>
                    <input type="text" class="form-control" name="ceptelefonu" id="ceptelefonu" placeholder = "Cep Telefonu" value="{{$entry->ceptelefonu}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adres"> Adres </label>
                    <input type="text" class="form-control" name="adres" id="adres" placeholder = "Adres" value="{{$entry->adres}}">
                </div>
                </div>
            </div>
            <div class="col-md-4" style="margin-left:-18px">
                <div class="form-group">
                    <label for="durum">Sipariş Durum</label>
                    <select class="form-control" id="durum" name="durum">
                        <option {{$entry->durum == 'Siparisiniz alındı' ? 'selected' :''}}> Siparişiniz alındı</option>
                        <option {{$entry->durum == 'Ödeme onaylandı' ? 'selected' :''}}> Ödeme onaylandı</option>
                        <option {{$entry->durum == 'Kargoya verildi' ? 'selected' :''}}>Kargoya verildi</option>
                        <option {{$entry->durum == 'Siparişiniz tamamlandı' ? 'selected' :''}}> Siparişiniz tamamlandı</option>
                    </select>
                </div>
            </div>
        <div style="margin-left: 10px;margin-top: -5%" class="col-md-8">
            <div class="form-group">
                <h3>Sipariş (SP-{{$entry->id}})</h3>
                <table class="table table-bordererd table-hover">
                    <tr>
                        <th colspan="2">Ürün</th>
                        <th>Tutar</th>
                        <th>Adet</th>

                    </tr>
                    <tr>
                        @foreach($entry->sepet->sepet_urunler as $sepet_urun)
                            <td style="width: 120px ;% "><img style="width: 120px; height: 120px " src="{{asset('/uploads/urunler/'.$sepet_urun->urun->detay->urun_resmi)}}" ></td>
                            <td>{{$sepet_urun->urun->urun_adi}}</td>
                            <td>{{$sepet_urun->fiyati*$sepet_urun->adet}}</td>
                            <td>{{$sepet_urun->adet}}</td>
                        @endforeach
                    </tr>
                    <tr>

                        <th colspan="4" class="text-right">Toplam Tutar(KDV Dahil) </th>
                        <th colspan="2">{{$entry->siparis_tutari}}₺</th>

                </table>
            </div>
        </div>
        </div>


    </form>


@endsection


