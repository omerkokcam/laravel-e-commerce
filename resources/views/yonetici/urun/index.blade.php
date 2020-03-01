@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Ürün Sayfası')

@section('content')

    <u><h1 class="page">Ürün Yönetimi</h1></u>
    <hr>
    <h1 class="sub-header">
        <div class="btn-group pull-right" >
            <a href="{{route('yonetici.urun.yeni')}}" class="btn btn-primary">Yeni</a>
        </div>
        <form class="navbar-form navbar-left" action="{{route('yonetici.urun')}}" method="post">
            {{csrf_field()}}
            <div id="genel">
            <div style="margin-left: -10px" class="input-group">

                <input style="width: 380px" type="text" onkeyup="aramaIslemi(this)" autocomplete="off" name="aranan" id="aranan" class="form-control" placeholder="Ürün Ara..." value="{{old('aranan')}}">
                <span class="input-group-btn">
                    <button  type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                <div id="sonuc"><ul></ul></div>
            </div>

                <style>

                    #sonuc{
                        width: 380px;
                        left: 0;
                        top: 40px;
                        display: none;
                        background-color: #eee;
                        position: absolute;
                    }
                    #sonuc ul{
                        padding:20px;
                        list-style: none;
                    }
                    #sonuc ul li{
                        font-size: 15px;
                    }
                </style>
        </div>
        </form>
        <br>
        <br>

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

            @else
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
            @endif
            </tbody>
        </table>
{{--        {{$liste->appends(['aranan'=>old('aranan')])->links()}}--}}
    </div>

    <script>
        function aramaIslemi(event) {
            var  value =  $(event).val();
            $('#sonuc').find('ul').empty();
            $('#sonuc').css('display','none');
            $.ajax({
                type:"get",
                url:"{{route('yonetici.urun.ara')}}",
                data:{
                    aranan: value,
                },success:function (result) {
                    if(result){
                        $('#sonuc').css('display','block');
                        for(var i=0; i< result.length;i++){
                            var li = result[i];
                            if(li["urun_adi"].length>50){
                                $('#sonuc').find('ul').append('<li><a href="{{route("yonetici.urun")}}?aranan='+li["urun_adi"]+'">'+li["urun_adi"].substr(0,50)+'...'+'</a></li>');
                            }else{
                                $('#sonuc').find('ul').append('<li><a href="{{route("yonetici.urun")}}?aranan='+li["urun_adi"]+'">'+li["urun_adi"]+'</a></li>');
                            }
                        }
                    }
                }
            })
        }
    </script>

@endsection

