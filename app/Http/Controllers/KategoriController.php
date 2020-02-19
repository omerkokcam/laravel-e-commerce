<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index($slug_kategoriadi){

        $kategori=Kategori::where('slug',$slug_kategoriadi)->firstOrFail();
        $alt_kategoriler=Kategori::where('ust_id', $kategori->id)->get();

        $urunler = $kategori->urunler()->paginate(6);//kategori modelinden urunleri cekiyoruz ve 2 li olarak listeliyoruz

        $order=request('order');
        if($order == 'coksatanlar')
        {
            $urunler = $kategori -> urunler() //kategori modelinden urunleri cekiyoruz
                ->distinct()
                -> join('urun_detay','urun_detay.urun_id','urun.id')
                -> orderBy( 'urun_detay.goster_cok_satan' ,'desc' )
                -> paginate( 6 ) ;

        }
        else if($order == 'yeni')
        {
            $urunler = $kategori -> urunler()
                ->distinc()
                ->orderByDesc('guncelleme_tarihi')
                -> paginate(6);
        }
        else
        {
            $urunler = $kategori -> urunler()
                ->paginate(6);


        }

        return view('kategori',compact('kategori','alt_kategoriler','urunler'));
    }
}
