<div class="list-group" >
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Giriş</a>
    <a href="{{route('yonetici.urun')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Ürünler
        <span class="badge badge-dark badge-pill pull-right">{{count(\App\Models\Urun::all())}}</span>
    </a>
    <a href="{{route('yonetici.kategori')}}" class="list-group-item collapsed"><span class="fa fa-fw fa-dashboard"></span> Kategoriler<span class="caret arrow"></span> <span class="badge badge-dark badge-pill pull-right">{{count(\App\Models\Kategori::all())}}</span></a>

    <div class="list-group collapse" id="submenu1">
        <a href="#" class="list-group-item">Category</a>
        <a href="#" class="list-group-item">Category</a>
    </div>
    <a href="{{route('yonetici.kullanici')}}" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Kullanıcılar
        <span class="badge badge-dark badge-pill pull-right">{{count(\App\Kullanici::all())}}</span>
    </a>
    <a href="#" class="list-group-item">
        <span class="fa fa-fw fa-dashboard"></span> Siparişler
        <span class="badge badge-dark badge-pill pull-right">14</span>
    </a>
</div>
