@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Ana Sayfa')

@section('content')

    <u><h1 class="page">Kullanıcı Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">
        <div class="btn-group pull-right" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Print</button>
            <button type="button" class="btn btn-primary">Export</button>
        </div>
        Kullanıcı Listesi
    </h1>
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
                    <a href="#" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Sil" onclick="return confirm('Bu kullanıcı kaydını silmek istediğinize emin misiniz?')">
                        <span class="fa fa-trash"></span>
                    </a>
                </td>
            </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection
