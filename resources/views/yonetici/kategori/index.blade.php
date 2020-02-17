@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Kategori Sayfası')

@section('content')

    <u><h1 class="page">Kategori Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">
        <div class="btn-group pull-right" >
            <a href="{{route('yonetici.kategori.yeni')}}" class="btn btn-primary">Yeni</a>
        </div>
        Kategori Listesi
    </h1>
    <div style="margin-left:20px">
    @include('layouts.partials.alert')</div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Kategori Id</th>
                <th>Üst Kategori</th>
                <th>Slug</th>
                <th>Kategori Adı</th>
                <th>Kayıt Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($liste as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->ust_kategori->kategori_adi}}</td>
                <td>{{$list->slug}}</td>
                <td>{{$list->kategori_adi}}</td>
                <td>{{$list->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetici.kategori.duzenle',$list->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetici.kategori.sil',$list->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu kategori kaydını silmek istediğinize emin misiniz?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
