@extends('layouts.master')
@section('title','eBuy | '.$urun->urun_adi)

@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
            @foreach($kategoriler as $kategori)
            <li><a href="{{route('kategori',$kategori->slug)}}">{{$kategori->kategori_adi}}</a></li>

             @endforeach
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{asset('/uploads/urunler/'.$urun->detay->urun_resmi)}}">
                    <hr>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{$urun->urun_adi}}</h1>
                    <p class="price">{{$urun->fiyati}} ₺</p>
                    <form action="{{route('sepet.ekle')}}" method="POST" >
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$urun->id}}">
                        <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                    </form>
                    <form action="{{route('sepet.ekle')}}" method="POST"></form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{!!$urun->aciklama  !!}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">Bu ürün hakkında henüz hiç yorum yapılmadı.İlk yorum yapan SEN ol!</div>
                </div>
            </div>

        </div>
    </div>



@endsection
