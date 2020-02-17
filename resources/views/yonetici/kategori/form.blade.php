@extends('yonetici.layouts.master')
@section('title','ebuy | Yönetici Kategori Yönetimi')

@section('content')

    <u><h1 class="page">Kategori Yönetimi</h1></u>

    <form method = 'post' action="{{ route('yonetici.kategori.kayit') }}">
        {{csrf_field()}}
       <div class="pull-right">
        <button type="submit" class="btn btn-primary">
            {{$entry -> id > 0 ? "Güncelle " : "Kaydet" }}</button>
       </div>
        <h2 class="sub-header">Kategori {{$entry -> id > 0 ? "Düzenle " : "Ekle"}}</h2>
        @include('layouts.partials.errors')
        @include('layouts.partials.alert')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kategori_slug">Üst Kategori</label>

                    <select name="ust_id" id="ust_id" class="form-control">
                        @foreach($kategoriler as $kategori)

                            <option value="{{$kategori->id}}">{{$kategori->kategori_adi}}</option>


                        @endforeach
                    </select>


                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="kategori_adi">Kategori Adı</label>
                    <input type="text" class="form-control" id="kategori_adi" name ="kategori_adi" placeholder="Kategori Adı..." value="{{$entry->kategori_adi}}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="slug">Kategori Slug</label>
                    <input type="text" class="form-control" id="slug" name ="slug" placeholder="Kategori Slug..." value="{{$entry->slug}}">
                    <input type="hidden" name="original_slug" value="{{$entry->slug}}">
                </div>
            </div>

        </div>


    </form>
@endsection
