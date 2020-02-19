@extends('layouts.master')
@section('title','eBuy | '.$kategori->kategori_adi)
@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>

            <li class="active">{{$kategori->kategori_adi}}</li>
        </ol>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$kategori->kategori_adi}}</div>
                    <div class="panel-body">
                        @if(count($alt_kategoriler)>0)
                        <h3>Alt Kategoriler</h3>
                        <div class="list-group categories">
                            @foreach($alt_kategoriler as $alt_kategori)
                            <a href="{{route('kategori',$alt_kategori->slug)}}" class="list-group-item"><i class="fa fa-arrow-right"></i>{{$alt_kategori->kategori_adi}}</a>

                            @endforeach
                        </div>
                        @else
                            Bu kategoride alt kategori bulunmamaktadır.
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="products bg-content">
                    @if(count($urunler)> 0)
                    Sırala
                    <a href="?order=coksatanlar" class="btn btn-default">Çok Satanlar</a>

                    <hr>
                    @endif
                    <div class="row">
                        @if(count($urunler) == 0)
                            <div class="col-md-12">Bu kategoride henüz ürün bulunmamaktadır.</div>
                        @endif

                              @foreach($urunler as $urun)
                                  @for($i=1;$i<=count($urun);$i++)
                                    <div class="col-md-3 product">

                                    <a href="{{route('urun',$urun->slug)}}"><img src="{{asset('/uploads/urunler/'.$urun->detay->urun_resmi)}}"></a>
                                @endfor
                                <p><a title ="{{$urun->urun_adi}}" href="{{route('urun',$urun->slug)}}">{{ strlen(strip_tags($urun->urun_adi)) > 5? substr(strip_tags($urun->urun_adi), 0, 10) ."..." : "" }} </a></p>


                                <p class="price">{{$urun->fiyati}}₺</p>
                                <p><a href="{{route('sepet')}}" class="btn btn-theme">Sepete Ekle</a></p>
                                    </div>

                                    @endforeach
                    </div>
                        {{request() -> has('order') ? $urunler->appends(['order' => request('order')]) -> links() : $urunler -> links()}}

                </div>
            </div>
        </div>
    </div>
@endsection




