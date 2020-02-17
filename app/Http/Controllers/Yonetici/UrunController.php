<?php

namespace App\Http\Controllers\Yonetici;

use App\Models\Urun;
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

        if($id > 0 ){
            //guncelleme yap
            $entry = Urun::find($id);
            $entry -> update([
                'urun_adi'=>request('urun_adi'),
                'slug'=>request('slug'),
                'fiyati'=>request('fiyati'),
                'aciklama'=>request('aciklama')

                ]);


        }
        else{
            //yeni kayıt yap
            Urun::create([
                'urun_adi'=>request('urun_adi'),
                'slug'=>request('slug'),
                'fiyati'=>request('fiyati'),
                'aciklama'=>request('aciklama')

            ]);
        }
    return redirect()->route('yonetici.urun');
    }


    public function sil($id){

        Urun::find($id)->delete();

        return redirect()->route('yonetici.urun');
    }
}
