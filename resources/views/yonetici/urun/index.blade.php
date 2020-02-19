@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Ürün Sayfası')

@section('content')

    <u><h1 class="page">Ürün Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">
        <div class="btn-group pull-right" >
            <a href="{{route('yonetici.urun.yeni')}}" class="btn btn-primary">Yeni</a>
        </div>
        Ürün Listesi
    </h1>
    @include('layouts.partials.alert')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Ürün Id</th>
                <th>Ürün Resmi</th>
                <th>Ürün Adı</th>
                <th>Ürün Slug Adı</th>
                <th>Ürün Fiyatı</th>
                <th>Kayıt Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @if(count($liste) == 0)
            <tr><td colspan="6" class="text-center">Kayıt bulunamadı!</td></tr>

            @endif
            @foreach($liste as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td><img style="height:100px;width:80px" src="{{asset('/uploads/urunler/'.$list->detay->urun_resmi)}}" ></td>
                <td>{{$list->urun_adi}}</td>
                <td>{{$list->slug}}</td>
                <td>{{$list->fiyati}}</td>
               <td>{{$list->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetici.urun.duzenle',$list->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetici.urun.sil',$list->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu ürün kaydını silmek istediğinize emin misiniz?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
