@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Kullanıcı Sayfası')

@section('content')

    <u><h1 class="page">Kullanıcı Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">
        <div class="btn-group pull-right" >
            <a href="{{route('yonetici.kullanici.yeni')}}" class="btn btn-primary">Yeni</a>
        </div>
        <form class="navbar-form navbar-left" action="{{route('yonetici.urun')}}" method="post">
            {{csrf_field()}}
            <div style="margin-left: -10px" class="input-group">
                <input style="width: 380px" type="text"  name="aranan" id="navbar-search" class="form-control" placeholder="Kullanıcı Ara..." value="{{old('aranan')}}">
                <span class="input-group-btn">
                            <button  type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                </span>
            </div>
        </form>
        <br>
        <br>
        Kullanıcı Listesi
    </h1>
    @include('layouts.partials.alert')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Kullanıcı Id</th>
                <th>Ad Soyad</th>
                <th>E Mail</th>
                <th>Aktif mi?</th>
                <th>Yönetici mi?</th>
                <th>Kayıt Olma Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($liste as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->adsoyad}}</td>
                <td>{{$list->email}}</td>
                <td>
                @if($list->aktif_mi==1)

                        <span class="label label-success">Aktif</span>
                    @else

                        <span class="label label-warning">Pasif</span>

                @endif
                </td>
                <td>
                @if($list->yonetici_mi==1)
                        <span class="label label-success">Yönetici</span>

                @else
                        <span class="label label-warning">Müşteri</span>


                @endif
                </td>

                <td>{{$list->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetici.kullanici.duzenle',$list->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetici.kullanici.sil',$list->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu kullanıcı kaydını silmek istediğinize emin misiniz?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
        {{$liste->appends(['aranan'=>old('aranan')])->links()}}
    </div>


@endsection
