@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Ürün Sayfası')

@section('content')

    <u><h1 class="page">Ürün Yönetimi</h1></u>

    <form method = 'post' action="{{$entry -> id > 0 ?route('yonetici.urun.kayit', $entry -> id ): route('yonetici.urun.kayit')}}" enctype="multipart/form-data">
        {{csrf_field()}}
       <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{$entry -> id > 0 ? "Güncelle " : "Kaydet" }}</button>
       </div>
        <h2 class="sub-header">Ürün {{$entry -> id > 0 ? "Düzenle " : "Ekle"}}</h2>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
{{--            <input type="hidden" name="id" value="{{$entry->id}}">--}}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="urun_adi"> Ürün Adı </label>
                    <input type="text" class="form-control" name="urun_adi" id="urun_adi" placeholder = "Ürün Adını giriniz..." value="{{$entry->urun_adi}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Slug Adı</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug Adı" value="{{$entry->slug}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="aciklama">Ürün Açıklaması</label>
                    <textarea class="form-control" id="aciklama" name="aciklama" rows="9">{{$entry->aciklama}}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fiyati">Ürün Fiyatı</label>
                    <input type="text" class="form-control" name="fiyati" id="fiyati" placeholder="Örn: 50, 70, 1020"  value="{{$entry->fiyati}}">
                </div>
            </div>


        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_slider" value="0">
                <input type="checkbox" name="goster_slider" value = "1" {{$entry->detay->goster_slider == 1 ? 'checked' : '' }}> Slider'da Göster
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_gunun_firsati" value="0">
                <input type="checkbox" name="goster_gunun_firsati" value = "1" {{$entry->detay->goster_gunun_firsati == 1 ? 'checked' : '' }}> Günün Fırsatında Göster
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_one_cikan" value="0">
                <input type="checkbox" name="goster_one_cikan" value = "1" {{$entry->detay->goster_one_cikan == 1 ? 'checked' : '' }}> Öne Çıkanlarda göster
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_cok_satan" value="0">
                <input type="checkbox" name="goster_cok_satan" value = "1" {{$entry->detay->goster_cok_satan == 1 ? 'checked' : '' }}> Çok Satanlarda göster
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="hidden" name="goster_indirimli" value="0">
                <input type="checkbox" name="goster_indirimli" value = "1" {{$entry->detay->goster_indirimli == 1 ? 'checked' : '' }}> İndirimli Ürünlerde göster
            </label>
        </div>
        <div class="col-md-6" style="margin-left:-18px">
            <div class="form-group">
                <label for="kategoriler">Kategoriler</label>
                <select class="form-control" id="kategoriler" name="kategoriler[]" multiple>
                    @foreach($kategoriler as $kategori)
                    <option onclick="tiklamaislemi()" value="{{$kategori->id}}" {{$entry->id ?collect(old('kategoriler',$urun_kategorileri))->contains($kategori->id) ? 'selected': '' : '' }} >{{ $kategori->kategori_adi}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <br>
        <div class="form-group">
            @if($entry->detay->urun_resmi!=null)
                <img src="{{asset('/uploads/urunler/'.$entry->detay->urun_resmi)}}" style="margin-top: -20%;margin-left: 51%;max-height:100px;max-width:400px"class="thumbnail pull-left" >
            @endif
            <div style="margin-left: 51%;margin-top: -20%">
            <label for="urun_resmi">Ürün Resmi</label>
            <input type="file" id="urun_resmi" name="urun_resmi">

            </div>
        </div>
    </form>
@endsection

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#kategoriler').select2({
                placeholder : 'Lütfen kategori seçiniz.'
            });
            $('#kategoriler').on('select2:select', function (e) {
                // Do something
                tiklamaislemi();
            });
            function tiklamaislemi(){
                function b(){
                    $('.select2-selection__choice').mouseup(function(){
                        $($(this).find('.select2-selection__choice__remove')[0]).click();
                        b();
                    })
                }
                b();
            }
            tiklamaislemi();
        })
    </script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <script>

        var options = {
            language :'tr',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('aciklama',options);
    </script>>

@endsection
