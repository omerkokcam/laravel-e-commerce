<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AnasayfaController extends Controller
{
    public function index(){
        $kategoriler=Kategori::whereRaw('ust_id is null')->get();
        $urunler_slider=UrunDetay::with('urun')->where('goster_slider',1)->take(5)->get();
        $urun_gunun_firsati= Urun::select('urun.*')->join('urun_detay','urun_detay.urun_id','urun.id')->
        where('urun_detay.goster_gunun_firsati',1)->
        orderBy('updated_at','desc')->
        first();

        $urunler_one_cikan=UrunDetay::with('urun')->where('goster_one_cikan',1)->take(4)->get();
        $urunler_cok_satan=UrunDetay::with('urun')->where('goster_cok_satan',1)->take(4)->get();
        $urunler_indirimli=UrunDetay::with('urun')->where('goster_indirimli',1)->take(4)->get();
        View::share('urunler_slider', $urunler_slider);
        View::share('urun_gunun_firsati',$urun_gunun_firsati);
        View::share('urunler_one_cikan',$urunler_one_cikan);
        View::share('urunler_cok_satan',$urunler_cok_satan);
        View::share('urunler_indirimli',$urunler_indirimli);
        View::share('kategoriler',$kategoriler);

        return view('anasayfa');
    }
}
