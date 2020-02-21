<?php

namespace App\Http\Controllers\Yonetici;

use App\Kullanici;
use App\Models\Siparis;
use App\Models\Urun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiparisController extends Controller
{
    public function index(){

        if(\request()->filled('aranan')){
            request()->flash();
            $aranan = \request('aranan');
            $liste = Siparis::where('adsoyad','like','%$aranan%')->orWhere('banka','like','%$aranan%')->orderByDesc('id')->paginate(8)->appends('aranan',$aranan);

        }
        else{
            $liste = Siparis::orderByDesc('id')->paginate(8);
        }
        return view('yonetici.siparis.index',compact('liste'));
    }

    public function form($id = 0){



        if($id > 0 ){
            //guncelleme yap
            $entry = Siparis::with('sepet.sepet_urunler.urun')->find($id);
        }
        else{
            //yeni kayit olustur


        }
        return view('yonetici.siparis.form',compact('entry'))
    }

    public function sil($id){
        Siparis::find($id)->forceDelete();
        return redirect()->route('yonetici.siparis')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
