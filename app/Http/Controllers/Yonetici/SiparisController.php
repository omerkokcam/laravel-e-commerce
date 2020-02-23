<?php

namespace App\Http\Controllers\Yonetici;

use App\Kullanici;
use App\Models\Siparis;
use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiparisController extends Controller
{
    public function index(){

        if(\request()->filled('aranan')){
            request()->flash();
            $aranan = \request('aranan');
            $liste = Siparis::where('','like','%$aranan%')->orWhere('banka','like','%$aranan%')->orderByDesc('id')->paginate(8)->appends('aranan',$aranan);

        }
        else{
            $liste = Siparis::orderByDesc('id')->paginate(8);
        }
        return view('yonetici.siparis.index',compact('liste'));
    }

    public function form($id){

           if($id>0){
               $entry = Siparis::with('sepet.sepet_urunler.urun')->find($id);
           }


        return view('yonetici.siparis.form',compact('entry','entry2'));
    }
    public function kayit($id){

        $this->validate(\request(),[
            'adsoyad'=>'required',
            'adres'=>'required',
            'ceptelefonu'=>'required',
            'durum'=>'required'
        ]);
        $data = \request()->only('adsoyad','adres','telefon','ceptelefonu','durum');

        if($id > 0 ){
            $entry = Siparis::find($id);
            $entry->update([
                'adsoyad'=>request('adsoyad'),
                'adres'=>request('adres'),
                'telefon'=>request('telefon'),
                'ceptelefonu'=>request('ceptelefonu'),
                'durum'=>request('durum')

            ]);

        }

        return redirect()->route('yonetici.siparis')->with('mesaj','Kayıt Güncellendi')->with('mesaj_tur','success');
    }




    public function sil($id){
        Siparis::find($id)->delete();
        return redirect()->route('yonetici.siparis')->with('mesaj','Kayıt Silindi')->with('mesaj_tur','success');
    }
}
