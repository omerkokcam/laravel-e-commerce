@extends('layouts.master')
@section('title','eBuy | Sepet Sayfası')

@section('content')

    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')
            @if(count(Cart::content())>0)
            <table class="table table-bordererd table-hover">
                <tr>
                    <th colspan="1">Ürün</th>
                    <th>Adet Fiyatı</th>
                    <th>Adet</th>
                    <th>Tutar</th>
                </tr>

                @foreach(Cart::content() as $urunCartItem)
                <tr>
                    @php
                        $rastgele=rand(1,7)
                    @endphp


                    <td style="width:20px; height:20px;"> <img src="{{asset('img/images/'.$rastgele.'.jpg')}}"> {{$urunCartItem->name}}
                        <form action="{{route('sepet.kaldir',$urunCartItem->rowId)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" class="btn btn-danger btn-xs" value="Sepetten Kaldır">
                        </form></td>
                    <td>{{$urunCartItem->price}} ₺</td>
                    <td>
                        <a href="#" class="btn btn-xs btn-default urun-adet-azalt" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty-1}}">-</a>

                        <span style="padding: 10px 20px">{{$urunCartItem->qty}}</span>
                        <a href="#" class="btn btn-xs btn-default urun-adet-artir" data-id="{{$urunCartItem->rowId}}" data-adet="{{$urunCartItem->qty+1}}">+</a>
                    </td>
                    <td class="text-right">
                        {{$urunCartItem->subtotal}}₺
                    </td>
                </tr>

                @endforeach
                <tr>
                    <th colspan="4" class="text-right">Alt Toplam </th>
                    <th class="text-right">{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}} ₺</th>

                </tr>
                <tr>
                    <th colspan="4" class="text-right">KDV </th>
                    <th class="text-right">{{Cart::tax()}} ₺</th>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Genel Toplam </th>
                    <th class="text-right">{{Cart::total()}} ₺</th>
                </tr>
            </table>
                <a href="{{route('odeme')}}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                <form action="{{route('sepet.bosalt')}}" method="post">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <input type="submit" class="btn btn-info pull-left" value="Sepeti boşalt">

                </form>

            @else
                <tr>
                    <th>Sepette Henüz bir ürün bulunmamaktadır.</th>
                    <hr>

                    <th><a href="{{route('anasayfa')}}">Anasayfaya git.<-</a></th>
                    <br>
                    <br>
                </tr>
            @endif


            <div>





            </div>
        </div>
    </div>








@endsection
