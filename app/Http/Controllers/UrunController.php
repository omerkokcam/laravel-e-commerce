<?php

namespace App\Http\Controllers;

use App\Models\Urun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class UrunController extends Controller
{
    public function index($slug_urunadi){


        $urun = Urun::whereSlug($slug_urunadi)->firstOrFail();//direk olarak slug kolonunda arama yapar key e gerek kalmaz
        $kategoriler= $urun->kategoriler()->distinct()->get();//distinct() komutu burada iki tane aynı id olsa bile teke düşürecektir
        return view('urun',compact('urun','kategoriler')) ;
    }
    public function ara(){
        //dd(request()->input())

        if(request()->input('aranan') != ''){

            $aranan=request()->input('aranan');
            $urunler=Urun::where('urun_adi','like' ,"%$aranan%")
                ->orWhere('aciklama','like',"%$aranan%")
                ->paginate(8);
            request()->flash();
            View::share('urunler',$urunler);
            return view('arama');
        }
        else{

            return  redirect()->route('anasayfa');
        }


    }
}
