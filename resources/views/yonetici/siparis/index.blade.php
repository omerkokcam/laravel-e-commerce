@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Sipariş Sayfası')

@section('content')

    <u><h1 class="page">Sipariş Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">

        <form action="{{route('yonetici.siparis')}}" method="post" class="form-inline" >
            {{csrf_field()}}
            <div style="margin-left: 25%;margin-right:10%;" class="form-group">
                <label  for="aranan">Ara:</label>
                <input style="width:380px" type="text" class="form-control form-control-sm" name="aranan" id="aranan" placeholder="Sipariş Ara..." value="{{old('aranan')}}">
            </div>
            <button style="margin-left: -140px" type="submit" class="btn btn-primary">Ara</button>
            <a  href="{{route('yonetici.siparis')}}" class="btn btn-primary">Temizle</a>

        </form>
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
            @if(count($list) == 0)
            <tr><td colspan="6" class="text-center">Kayıt bulunamadı!</td></tr>

            @endif
            @foreach($list as $list)
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->sepet->kullanici_id}}</td>
                <td>SP-{{$list->id}}</td>
                <td>{{$list->siparis_tutari *(100 + config('cart.tax'))/100}}₺</td>
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
        {{$list->links()}}
    </div>


@endsection
