<?php

namespace App\Http\Controllers\Yonetici;

use App\Models\Urun;
use App\Models\UrunDetay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UrunController extends Controller
{
    public function index(){

        $liste = Urun::orderByDesc('created_at')->get();

        return view('yonetici.urun.index',compact('liste'));
    }

    public function form($id = 0){

        $entry = new Urun;

        if($id > 0 ){

            $entry = Urun::find($id);

        }

        return view('yonetici.urun.form',compact('entry'));
    }
    public function kayit($id = 0){
        $this->validate(\request(),[
           'urun_adi'=>'required',
            'slug'=>'required',
            'fiyati'=>'required|int',
            'aciklama'=>'required',

        ]);
        $data_detay = \request()->only('goster_slider','goster_one_cikan','goster_gunun_firsati','goster_cok_satan','goster_indirimli');
        if($id > 0 ){
            //guncelleme yap
            $entry = Urun::find($id);
            $entry -> update([
                'urun_adi'=>request('urun_adi'),
                'slug'=>request('slug'),
                'fiyati'=>request('fiyati'),
                'aciklama'=>request('aciklama')

                ]);

            $entry -> detay -> update($data_detay);
            $entry->detay->save();
        }
        else{
            //yeni kayıt yap

           $entry = Urun::create([
                'urun_adi'=>request('urun_adi'),
                'slug'=>request('slug'),
                'fiyati'=>request('fiyati'),
                'aciklama'=>request('aciklama')

            ]);
            $entry->detay->create($data_detay);

            $entry->detay->save();
        }

    return redirect()->route('yonetici.urun.duzenle',$entry->id)->with('mesaj','Güncellendi')->with('mesaj_tur','success');
    }


    public function sil($id){

        $urun = Urun::find($id);
        $urun->kategoriler()->detach();
        $urun->detay()->delete();
        $urun->delete();

        return redirect()->route('yonetici.urun')->with('mesaj','Kayıt silindi')->with('mesaj_tur','success');
    }
}
