@extends('layouts.master')
@section('title','eBuy | Sipariş Sayfası')


@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sipariş (SP-{{$siparis->id}})</h2>
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="2">Ürün</th>
                    <th>Tutar</th>
                    <th>Adet</th>

                </tr>
                <tr>
                  @foreach($siparis->sepet->sepet_urunler as $sepet_urun)
                      <td style="width: 120px "><img style="width: 120px; height: 120px " src="{{asset('/uploads/urunler/'.$sepet_urun->urun->detay->urun_resmi)}}" ></td>
                      <td>{{$sepet_urun->urun->urun_adi}}</td>
                      <td>{{$sepet_urun->fiyati*$sepet_urun->adet}}</td>
                      <td>{{$sepet_urun->adet}}</td>

                  @endforeach
                </tr>
                <tr>

                    <th colspan="4" class="text-right">Toplam Tutar(KDV Dahil) </th>
                    <th colspan="2">{{$siparis->siparis_tutari}}₺</th>

                <tr>
                    <th colspan="4" class="text-right">Sipariş Durumu</th>
                    <th colspan="2">{{$siparis->durum}}</th>
                </tr>

            </table>
        </div>
    </div>


@endsection
