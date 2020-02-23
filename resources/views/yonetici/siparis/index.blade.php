@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Sipariş Sayfası')

@section('content')

    <u><h1 class="page">Sipariş Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">

        <form class="navbar-form navbar-left" action="{{route('yonetici.siparis')}}" method="post">
            {{csrf_field()}}
            <div style="margin-left: -10px" class="input-group">
                <input style="width: 380px" type="text"  name="aranan" id="navbar-search" class="form-control" placeholder="Sipariş Ara..." value="{{old('aranan')}}">
                <span class="input-group-btn">
                            <button  type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
            </div>
        </form>
        <br>
        <br>
        Sipariş Listesi
    </h1>
    @include('layouts.partials.alert')
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Kullanıcı</th>
                <th>Sipariş Kodu</th>
                <th>Sipariş Tutarı</th>
                <th>Durum </th>
                <th>Sipariş Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @if(count($liste) == 0)
            <tr><td colspan="6" class="text-center">Kayıt bulunamadı!</td></tr>

            @endif
            @foreach($liste as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->sepet->kullanici_id}}</td>
                <td>SP-{{$list->id}}</td>
                <td>{{$list->siparis_tutari }}₺</td>
                <td>{{$list->durum}}</td>
               <td>{{$list->created_at}}</td>
                <td style="width: 100px">
                    <a href="{{route('yonetici.siparis.duzenle',$list->id)}}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Düzenle">
                        <span class="fa fa-pencil"></span>
                    </a>
                    <a href="{{route('yonetici.siparis.sil',$list->id)}}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu ürün kaydını silmek istediğinize emin misiniz?')">
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
